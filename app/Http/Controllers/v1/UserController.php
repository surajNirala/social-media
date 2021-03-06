<?php

namespace App\Http\Controllers\v1;

use URL;
use App\User;
use Password;
use JWTAuth;
use App\Model\Post;
use JWTAuthException;
use App\Model\Profile;
use App\Http\Requests;
use App\User_verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Helper\userhelper as helper;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Helper\UserTransformHelper as userDetailsTransformer;
use Mail;

class UserController extends Controller
{
   
   use helper,userDetailsTransformer;

    private $user;

    public function __construct(User $user, Post $post,User_verification $user_verification){
        $this->user = $user;
        $this->post = $post;
        $this->user_verification = $user_verification;
    }

    public function register(Request $request)
    {   
       // return $request->all();die;
        $validatorRegister = $this->validatorRegister($request->all());
        if ($validatorRegister->fails()) 
        {
                $messages = $validatorRegister->messages();
                $response = [
                    'status'    => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'error'     => true,
                    'result'    =>false ,
                    'message'   => $messages,
                    'data'      => []
                ];
                return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $save = [
          'first_name' => $request->get('first_name')       ? $request->get('first_name')           : '' ,
          'last_name'  => $request->get('last_name')        ? $request->get('last_name')            : '',
          'email'      => $request->get('email')            ? $request->get('email')                : '',
          'password'   => $request->get('password')         ? bcrypt($request->get('password'))     : '',
          'dop'        => $request->get('dop')              ? $request->get('dop')                  : '',
          'gender'     => $request->get('gender') == 'male' ? '1'                                   : '2',  
        ];
        $name = $request->first_name;
        $user = $this->user->create($save);
        $userID = $user->id;
        
        $verification_code = str_random(30);

        $Token = $this->user_verification->create(['user_id' => $userID,'token' => $verification_code]);
         
        $verifiedLink =  Mail::send('email.verify',['name' => $name, 'verification_code' => $verification_code],function($message){
            $subject  = "Please verify your email address.";
            $email    = "suraj@yopmail.com";
            $message->to($email)->subject($subject);
            $message->from('suraj.nirala1995@gmail.com','surajNirala');
          });
          if($user && $Token){

          $user = [
          'first_name' => $request->get('first_name')       ? $request->get('first_name')           : '' ,
          'last_name'  => $request->get('last_name')        ? $request->get('last_name')            : '',
          'email'      => $request->get('email')            ? $request->get('email')                : '',
          'dop'        => $request->get('dop')              ? $request->get('dop')                  : '',
          'gender'     => $request->get('gender') == 'male' ? 'male'                                : 'female',  
        ];

          $link = [

                //'Link'=>route('verifyUser',$verification_code),
                'Link'=>URL('api/v1/verify/'.$verification_code),
          ];

        $response = [
            'status'           => Response::HTTP_CREATED,
            'result'           => true,
            'error'            => false,
            'message'          =>'Thanks for signing up! Please check your email to complete your registration.',
            'data'             => $user,
            'Verificaton Link' => $link,
        ];
        return response()->json($response,Response::HTTP_CREATED);

        }else{
          $response = [
            'status'    => Response::HTTP_UNPROCESSABLE_ENTITY,
            'result'    => true,
            'error'     => false,
            'message'   =>'Registraton is not successfully please try again later.',
            'data'      => []
        ];
        return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
       
        
    }
    public function verifyUser($verifyUser){

      $check = $this->user_verification::where('token',$verifyUser)->first();

      if(!is_null($check)){

        $user = $this->user::find($check->user_id);

         if($user->is_verified == 1){
            $response = [
            'status'    => Response::HTTP_BAD_REQUEST,
            'result'    => true,
            'error'     => false,
            'message'   =>'Account already verified..',
            'data'      => []
        ];
         return response()->json($response,Response::HTTP_BAD_REQUEST);
        }

        $user->update(['is_verified' => 1]);

        $this->user_verification::where('token',$verifyUser)->delete();

        $response = [
          'status'   =>  Response::HTTP_OK,
          'result'   =>  true,
          'error'    =>  false,
          'message'  =>  'You have successfully verified your email address.',
        ];
        return response()->json($response,Response::HTTP_OK);
      }else{

        $response = [
          'status'   =>  Response::HTTP_BAD_REQUEST,
          'result'   =>  true,
          'error'    =>  false,
          'message'  =>  'Verification code is invalid.',
        ];
        return response()->json($response,Response::HTTP_BAD_REQUEST);
      }
    }
   public function recover(Request $request){

    $validator = $this->validatorRecover($request->all()); 

        if ($validator->fails()) {
            $messages = $validator->messages();
            $response = [
                'status'    => Response::HTTP_UNPROCESSABLE_ENTITY,
                'error'     => true,
                'result'    =>false ,
                'message'   => $messages,
                'data'      => []
            ];

            return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $email = $request->email;

        $getEmail = $this->user::where('email',$email)->first();

        if(!$getEmail){
             $response = [
                'status'    => Response::HTTP_UNAUTHORIZED,
                'error'     => true,
                'result'    => false ,
                'message'   => 'Your email address was not found.',
                'data'      => []
            ];

            return response()->json($response,Response::HTTP_UNAUTHORIZED);
        }
        $resetEmail = $getEmail->email;
        $name       = $getEmail->first_name;

        $verifiedLink =  Mail::send('email.reset',['name' => $name,'resetEmail' => $resetEmail],function($message){
            $subject  = "Reset Password";
            $email    = "suraj@yopmail.com";
            $message->to($email)->subject($subject);
            $message->from('suraj.nirala1995@gmail.com','surajNirala');
          });

        $response  = [
              'status'  => Response::HTTP_OK,
              'error'   => true,
              'result'  => false,
              'message' => "A reset email has been sent! Please check your email.",
              'data'    => [],  
            ];
            return response()->json($response, Response::HTTP_OK);

   } 
   public function reset_password(Request $request)
   {
      $validator = $this->validatorResetPassword($request->all());

        if ($validator->fails()) {
            $messages = $validator->messages();
            $response = [
                'status'    => Response::HTTP_UNPROCESSABLE_ENTITY,
                'error'     => true,
                'result'    =>false ,
                'message'   => $messages,
                'data'      => []
            ];

            return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $password = bcrypt($request->password);
        $user = $this->user::where('email','suraj@gmail.com')->update(['password' => $password]);
        $user  = $this->user::where('email','suraj@gmail.com')->first();
        $response = [
                'status'    => Response::HTTP_OK,
                'error'     => true,
                'result'    => false ,
                'message'   => 'your password reset successfully',
                'data'      => $user,
            ];

            return response()->json($response,Response::HTTP_OK);
   }
   public function login(Request $request)
   {
      $validator = $this->validatorLogin($request->all());

        if ($validator->fails()) {
            $messages = $validator->messages();
            $response = [
                'status'    => Response::HTTP_UNPROCESSABLE_ENTITY,
                'error'     => true,
                'result'    =>false ,
                'message'   => $messages,
                'data'      => []
            ];

            return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $email = $request->email;

        if($user = $this->user::where('email',$email)->get())
        {

        //  $credentials = $request->only('email', 'password');
          $credentials = [
            'email'       => $request->email,
            'password'    => $request->password,
            'is_verified' => 0
          ];
          {
         // return $credentials; die;
          $token = null;
          try {
             if (!$token = JWTAuth::attempt($credentials)) {
              $response = [
                  'status'    => Response::HTTP_UNAUTHORIZED,
                  'error'     => true,
                  'result'    =>false ,
                  'message'   => 'Invalid Credentials.Please make sure you entered the right information.',
                  'data'      => []
                  ];
              return response()->json($response, Response::HTTP_UNAUTHORIZED);
             }
          } catch (JWTAuthException $e) {
            $response = [
                      'status'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                      'error'    => true,
                      'result'   =>false ,
                      'message'  => 'failed_to_create_token',
                      'data'     => []
                  ];
              return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
          }
            return response()->json([
                       "status"    => Response::HTTP_OK,
                       "result"    => true,
                       "error"     => false,
                       "msg"       => "Login successfully",
                       "data"      => $this->loginTransform($user,$token)
            ],Response::HTTP_OK);
          }
        }
    }
   public function logout(Request $request) {

    $token =  $request->header('token');
     // $validateLogout = $this->validateLogout($request->all());

        if ($token == '') {
            $response = [
                'status'    => Response::HTTP_UNPROCESSABLE_ENTITY,
                'error'     => true,
                'result'    => false ,
                'message'   => "The Token is required",
                'data'      => []
            ];

            return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            JWTAuth::invalidate($token);
            $response = [
              'status'    => Response::HTTP_OK,
              'error'     => true,
              'result'    => false,
              'message'   => 'Logout successfully.',
              'data'      => [],
            ];
            return response()->json($response,Response::HTTP_OK);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
          $response = [
             'status'     => Response::HTTP_INTERNAL_SERVER_ERROR,
             'error'      => true,
             'result'     => false,
             'message'    => 'Failed to logout, please try again.', 
          ];
            return response()->json($response,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index(Request $request)
    {
        $token       = $request->header('token');
        $user        = JWTAuth::toUser($token);
        $user_id     = $user->id;


        /*$ip= \Request::ip();
    $data = \Location::get($ip);
    return $data;*/
        
       /* $userDetails = $this->user::find($user_id);
        $userDetail  = new UserResource($userDetails,$profile);*/
        

        // tranform---
        $userDetails = $this->user::where('id',$user_id)->get();

        $posts = $this->post::where('user_id',$user_id)->paginate(2);
        
        $forAddfriend = $this->user::where('id','!=',$user_id)->paginate(15);
        

       // $allData = $this->post->where('user_id', 1)->with('users')->paginate(3)->toArray();

       // return $allData;
        if($userDetails->isEmpty())
        {
            $response    = [
            "status"      => Response::HTTP_BAD_REQUEST,
            "error"       => false,
            "result"      => true,
            "message"     => "No Exists Any User",
            "data"        => [],
        ];
        return response()->json($response,Response::HTTP_BAD_REQUEST);
        }


       if($posts->isEmpty() && $forAddfriend->isEmpty())
        {
            $userDetailAndPost   = $this->withoutPostandAddfrienduserDetailTransformer($userDetails);
            $response    = [
                "status"      => Response::HTTP_OK,
                "error"       => false,
                "result"      => true,
                "message"     => "User Details",
                "data"        => $userDetailAndPost,
            ];

        return response()->json($response,Response::HTTP_OK); 
        }
        // posts mein array [] aa rha tha ishiliye isEmpty wala function use kiya h 
        if($forAddfriend->isEmpty())
        {
            $userDetailAndPost   = $this->withoutAddfrienduserDetailTransformer($userDetails,$posts);
            $response    = [
                "status"      => Response::HTTP_OK,
                "error"       => false,
                "result"      => true,
                "message"     => "User Details and All posts",
                "data"        => $userDetailAndPost,
            ];

        return response()->json($response,Response::HTTP_OK); 
        }

        if($posts->isEmpty())
        {

     $userDetailAndFriend   = $this->withoutPostuserDetailTransformer($userDetails,$forAddfriend);

            $response    = [
            "status"      => Response::HTTP_OK,
            "error"       => false,
            "result"      => true,
            "message"     => "User Details  and Add friend",
            "data"        => $userDetailAndFriend,
        ];
        return response()->json($response,Response::HTTP_OK); 

        }else{

        $userDetail   = $this->userDetailTransformer($userDetails,$posts,$forAddfriend);

        $response    = [
            "status"      => Response::HTTP_OK,
            "error"       => false,
            "result"      => true,
            "message"     => "User Details,posts And addfriends",
            "data"        => $userDetail,
            //"Ip Address"  => $ipadress,
            //"profile"     => url('/')."/social/".($profile->profile_image),
            //"profile"     => route("/social/",'suraj')
           // storage_path
        ];

        return response()->json($response,Response::HTTP_OK);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$userdata = $request->isMethod('put') ? $this->user::findOrfail($request->id) : new $this->user;

        $request->name; /// like that data 

        $fileExtension      =  $request->file('image')->getClientOriginalExtension();
        $fileName           = time(). '.' .$request->file('image')->getClientOriginalName();
        $fromtmp            = $request->file('image');
        $destinationPath    = public_path('images/');

   //return $destinationPath;die;
        // This will store only the filename. Update with full path if you like

        //$post->image = $filename; 

        $uploadSuccess      = $fromtmp->move($destinationPath, $fileName);*/

        return "this is store data";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $token            = $request->header('token');
        $user             = JWTAuth::toUser($token);
        $user_id          = $user->id;
        $userdetail       = $this->user::where('id',$id)
                            ->where('id',$user_id)
                                         ->get();
        $singleUserdetail = $this->withoutPostandAddfrienduserDetailTransformer($userdetail); 
        if($userdetail->isEmpty()){
            $response = [
               'status'  => Response::HTTP_BAD_REQUEST,
               'error'   => false,
               'result'  => true,
               'message' => "No Exists user",
               'data'    => [],
            ];
            return response()->json($response,Response::HTTP_BAD_REQUEST);
        }else{
            $response = [
              'status'     => Response::HTTP_OK,
              'error'      => false,
              'result'     => true,
              'message'    => "user Details",  
              'data'       => $singleUserdetail, 
            ];
            return response()->json($response,Response::HTTP_OK);
          }                                
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $token =  $request->header('token');

        $user = JWTAuth::touser($token);

        $user_id =  $user->id; 

      $validatorUpdate = $this->validatorUpdate($request->all());

      if($validatorUpdate->fails())
      {
        $message = $validatorUpdate->messages();
        $response = [

            "status"      => Response::HTTP_UNPROCESSABLE_ENTITY,
            "error"       => false,
            "result"      => true,
            "message"     => $message,
            "data"        => [],
        ];
        return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
      }

      $userDetail =  $this->user::where('id',$user_id)
                                     ->where('id',$id)
                                               ->get();
        if($userDetail->isEmpty())
        {
            $response = [
                "status"    => Response::HTTP_BAD_REQUEST,
                "error"     => false,
                "result"    => true,
                "messages"  => "No Exists User.",
                "data"      =>  [],   
            ];
            return response()->json($response,Response::HTTP_BAD_REQUEST);
        }
        $userDetails =  $userDetail->where('id',$user_id)
                                        ->where('id',$id)
                                ->update($request->all());
        $response = [

            "status"      => Response::HTTP_CREATED,
            "error"       => false,
            "result"      => true,
            "message"     => "user Update successfully.",
            "data"        => $request->all(),
        ];
        return response()->json($response, Response::HTTP_CREATED); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profilepic(Request $request)
    {
        return "image here..";
    }
}
