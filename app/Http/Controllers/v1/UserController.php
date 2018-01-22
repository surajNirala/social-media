<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\User;
use JWTAuthException;
use JWTAuth;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    protected function validatorLogin(array $data)
    {
      return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);
    }
    protected function validatorRegister(array $data)
    {
        return Validator::make($data, [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'dop'           => 'required|max:255',
            'gender'        => 'required|max:255',
        ]);
    }

    public function register(Request $request)
    {   
        return $request->all();die;
        $validatorRegister = $this->validatorRegister($request->all());
        if ($validatorRegister->fails()) 
            {
                $messages = $validatorRegister->messages();
                $response = [
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'error' => true,
                    'result'=>false ,
                    'message' => $messages,
                    'data'=> []
                ];
                return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
            }

        else{
        //return $request->all();die;

        $user = $this->user->create([
          'first_name' => $request->get('first_name'),
          'last_name'  => $request->get('last_name'),
          'email'      => $request->get('email'),
          'password'   => bcrypt($request->get('password')),
          'dop'        => $request->get('dop'),
          'gender'     => $request->get('gender'),     
        ]);

        $response = [
            'status'    => Response::HTTP_CREATED,
            'result'    => true,
            'error'     => false,
            'message'   =>'User created successfully',
            'data'      => $user
        ];
        return response()->json($response,Response::HTTP_CREATED);
    }
}

        public function login(Request $request){

          $validator = $this->validatorLogin($request->all());

            if ($validator->fails()) {
                $messages = $validator->messages();
                $response = [
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'error' => true,
                    'result'=>false ,
                    'message' => $messages,
                    'data'=> []
                ];

                return response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY);
            }else{

            $email = $request->email;

            if($user = $this->user::where('email',$email)->get())
                {

        $credentials = $request->only('email', 'password');
        {
       // return $credentials; die;
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            $response = [
                'status' => Response::HTTP_UNAUTHORIZED,
                'error' => true,
                'result'=>false ,
                /*'message' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.',*/
                'message' => 'Invalid Credentials.Please make sure you entered the right information.',
                'data'=> []
                ];
            return response()->json($response, Response::HTTP_UNAUTHORIZED);
           }
        } catch (JWTAuthException $e) {
          $response = [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'error' => true,
                    'result'=>false ,
                    'message' => 'failed_to_create_token',
                    'data'=> []
                ];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
                 "status"    => Response::HTTP_OK,
                   "result"    => true,
                   "error"     => false,
                 "msg"       => "Login successfully",
                 "data"      => $this->transform($user,$token)
        ],Response::HTTP_OK);
        }
        }
    }
 }

  public function transform($user,$token)
  {
    $tmp = array();

    foreach ($user as $value) {
      $tmp = [

          "first_name"      => $value->first_name,
          "last_name"       => $value->last_name,
          "username"        => $value->username,
          "email"           => $value->email,
          "role"            => $value->role,
          "status"          => $value->status,
          "token"           => $token,

      ];
    }
    return $tmp;
  }

   /* public function getAuthUser(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }*/

    public function index(Request $request)
    {
        $token     = $request->header('token');
        $user      = JWTAuth::toUser($token);
        $id        =  $user->id;
        $userDetails = $this->user::where('id',$id)->get();

        $userDetail  = UserResource::collection($userDetails);

        return $userDetail;
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
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "suraj".$id;
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
        //return $this->user::findOrfail($id);

        return $request;
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
}
