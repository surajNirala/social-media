<?php 

namespace App\Http\Helper;
use App\Http\Resources\ForAddFriendResource;
use App\Http\Resources\PostResource;
use URL;
Trait UserTransformHelper 
{
  public function withoutPostuserDetailTransformer($userDetails,$ForAddfriend)
  {
    $tmp = array();

    foreach($userDetails as $value){
      //date('l',strtotime($value->created_at))
      //date('d F,Y',strtotime($value->created_at))
      //date('h:i A',strtotime($value->created_at))

      $t1 = strtotime($value->dop); 
      $t2 = strtotime($value->created_at); 

      $diff = $t2 - $t1;
      $hours = round($diff / ( 60 * 60 ), 2);
      /*'profile_image'   => filter_var($value->profiles->profile_image,FILTER_VALIDATE_URL) === false ? ''      : url('social/'.$value->profiles->profile_image),*/

    $tmp = [
        'id'              => $value->id                      ? (int) $value->id                                  : '',
        'first_name'      => $value->first_name              ? $value->first_name                                : '',
        'last_name'       => $value->last_name               ? $value->last_name                                 : '',
        'Gender'          => $value->gender == 1             ? 'male'                                            :'female',
        'mobile'          => (count($value->profiles)>0)     ? $value->profiles->mobile                          : '',
        'username'        => (count($value->profiles)>0)     ? $value->profiles->username                        : '',
        'email'           => $value->email                   ? $value->email                                     : '',
        'dop'             => $value->dop                     ? date('(h:i A),d F,Y',strtotime($value->dop))      : '',
        'Day'             => $value->dop                     ? date('l',strtotime($value->dop))                  : '',
        'hours'           => $value->dop                     ? $hours                                            : '',
        'city'            => (count($value->profiles) > 0)   ? $value->profiles->city                            : '',
        'country'         => (count($value->profiles) > 0)   ? $value->profiles->country                         : '',
        'profile_image'   => (count($value->profiles) > 0)   ? url('social/'.$value->profiles->profile_image)    : '',
        'cover_image'     => (count($value->profiles) > 0)   ? url('social/'.$value->profiles->cover_image)      : '',
        'status'          => $value->status                  ? $value->status                                    : '',
        'role'            => $value->role                    ? $value->role                                      : '',   
        'created_at'      => $value->created_at              ? date('h:i A, d F,Y',strtotime($value->created_at)): '',   
        'updated_at'      => $value->updated_at              ? date('h:i A,d F Y',strtotime($value->updated_at)) : '',
        'posts'           => []                              ? []                                                : [],
        'ForAddFriend'    => ForAddFriendResource::collection($ForAddfriend)/*$this->AddFriendTransform($ForAddfriend)*/,
        'AddfriendPagination'=> $this->addfriendpagination($ForAddfriend),
       ];
     }
     return $tmp;
  }
  public function addfriendpagination($ForAddfriend)
  {
      $tmp = array();

      foreach ($ForAddfriend as $value) {
        $tmp = [
            "first_page_url"  => URL::current()."?page=1",
            "from"            =>  1,
            "last_page"       =>  4,
            "last_page_url"   => URL::current()."?page=4",
            "next_page_url"   => URL::current()."?page=2",
            "path"            => URL::current()."",
            "per_page"        =>  2,
            "prev_page_url"   =>  null,
            "to"              =>  2,
            "total"           =>  7

        ];
      }
      return $tmp;
  }

  public function withoutAddfrienduserDetailTransformer($userDetails,$posts)
  {
    $tmp = array();

    foreach($userDetails as $value){
      //date('l',strtotime($value->created_at))
      //date('d F,Y',strtotime($value->created_at))
      //date('h:i A',strtotime($value->created_at))

      $t1 = strtotime($value->dop); 
      $t2 = strtotime($value->created_at); 

      $diff = $t2 - $t1;
      $hours = round($diff / ( 60 * 60 ), 2);
      /*'profile_image'   => filter_var($value->profiles->profile_image,FILTER_VALIDATE_URL) === false ? ''      : url('social/'.$value->profiles->profile_image),*/

    $tmp = [
        'id'              => $value->id                      ? (int) $value->id                                  : '',
        'first_name'      => $value->first_name              ? $value->first_name                                : '',
        'last_name'       => $value->last_name               ? $value->last_name                                 : '',
        'Gender'          => $value->gender == 1             ? 'male'                                            :'female',
        'mobile'          => (count($value->profiles)>0)     ? $value->profiles->mobile                          : '',
        'username'        => (count($value->profiles)>0)     ? $value->profiles->username                        : '',
        'email'           => $value->email                   ? $value->email                                     : '',
        'dop'             => $value->dop                     ? date('(h:i A),d F,Y',strtotime($value->dop))      : '',
        'Day'             => $value->dop                     ? date('l',strtotime($value->dop))                  : '',
        'hours'           => $value->dop                     ? $hours                                            : '',
        'city'            => (count($value->profiles) > 0)   ? $value->profiles->city                            : '',
        'country'         => (count($value->profiles) > 0)   ? $value->profiles->country                         : '',
        'profile_image'   => (count($value->profiles) > 0)   ? url('social/'.$value->profiles->profile_image)    : '',
        'cover_image'     => (count($value->profiles) > 0)   ? url('social/'.$value->profiles->cover_image)      : '',
        'status'          => $value->status                  ? $value->status                                    : '',
        'role'            => $value->role                    ? $value->role                                      : '',   
        'created_at'      => $value->created_at              ? date('h:i A, d F,Y',strtotime($value->created_at)): '',   
        'updated_at'      => $value->updated_at              ? date('h:i A,d F Y',strtotime($value->updated_at)) : '',
        'Posts'           => $this->PostTransform($posts),
        'Addfriend'       => [],
       ];
     }
     return $tmp;
  }
  public function withoutPostandAddfrienduserDetailTransformer($userDetails)
  {
      $tmp = array();

    foreach($userDetails as $value){
      //date('l',strtotime($value->created_at))
      //date('d F,Y',strtotime($value->created_at))
      //date('h:i A',strtotime($value->created_at))

      $t1 = strtotime($value->dop); 
      $t2 = strtotime($value->created_at); 

      $diff = $t2 - $t1;
      $hours = round($diff / ( 60 * 60 ), 2);
      /*'profile_image'   => filter_var($value->profiles->profile_image,FILTER_VALIDATE_URL) === false ? ''      : url('social/'.$value->profiles->profile_image),*/

    $tmp = [
        'id'              => $value->id                      ? (int) $value->id                                  : '',
        'first_name'      => $value->first_name              ? $value->first_name                                : '',
        'last_name'       => $value->last_name               ? $value->last_name                                 : '',
        'Gender'          => $value->gender == 1             ? 'male'                                            :'female',
        'mobile'          => (count($value->profiles)>0)     ? $value->profiles->mobile                          : '',
        'username'        => (count($value->profiles)>0)     ? $value->profiles->username                        : '',
        'email'           => $value->email                   ? $value->email                                     : '',
        'dop'             => $value->dop                     ? date('(h:i A),d F,Y',strtotime($value->dop))      : '',
        'Day'             => $value->dop                     ? date('l',strtotime($value->dop))                  : '',
        'hours'           => $value->dop                     ? $hours                                            : '',
        'city'            => (count($value->profiles) > 0)   ? $value->profiles->city                            : '',
        'country'         => (count($value->profiles) > 0)   ? $value->profiles->country                         : '',
        'profile_image'   => (count($value->profiles) > 0)   ? url('social/'.$value->profiles->profile_image)    : '',
        'cover_image'     => (count($value->profiles) > 0)   ? url('social/'.$value->profiles->cover_image)      : '',
        'status'          => $value->status                  ? $value->status                                    : '',
        'role'            => $value->role                    ? $value->role                                      : '',   
        'created_at'      => $value->created_at              ? date('h:i A, d F,Y',strtotime($value->created_at)): '',   
        'updated_at'      => $value->updated_at              ? date('h:i A,d F Y',strtotime($value->updated_at)) : '',
       ];
     }
     return $tmp;
  }
	public function userDetailTransformer($userDetails,$posts,$ForAddfriend)
	{

		$tmp = array();

		foreach($userDetails as $value){
      //date('l',strtotime($value->created_at))
      //date('d F,Y',strtotime($value->created_at))
      //date('h:i A',strtotime($value->created_at))

      $t1 = strtotime($value->dop); 
      $t2 = strtotime($value->created_at); 

      $diff = $t2 - $t1;
      $hours = round($diff / ( 60 * 60 ), 2);
      /*'profile_image'   => filter_var($value->profiles->profile_image,FILTER_VALIDATE_URL) === false ? ''      : url('social/'.$value->profiles->profile_image),*/

		$tmp = [
        'id'              => $value->id                      ? (int) $value->id                                  : '',
        'first_name'      => $value->first_name              ? $value->first_name                                : '',
        'last_name'       => $value->last_name               ? $value->last_name                                 : '',
        'Gender'          => $value->gender == 1             ? 'male'                                            :'female',
        'mobile'          => (count($value->profiles)>0)     ? $value->profiles->mobile                          : '',
        'username'        => (count($value->profiles)>0)     ? $value->profiles->username                        : '',
        'email'           => $value->email                   ? $value->email                                     : '',
        'dop'             => $value->dop                     ? date('(h:i A),d F,Y',strtotime($value->dop))      : '',
        'Day'             => $value->dop                     ? date('l',strtotime($value->dop))                  : '',
        'hours'           => $value->dop                     ? $hours                                            : '',
        'city'            => (count($value->profiles) > 0)   ? $value->profiles->city                            : '',
        'country'         => (count($value->profiles) > 0)   ? $value->profiles->country                         : '',
        'profile_image'   => (count($value->profiles) > 0)   ? url('social/'.$value->profiles->profile_image)    : '',
        'cover_image'     => (count($value->profiles) > 0)   ? url('social/'.$value->profiles->cover_image)      : '',
        'status'          => $value->status                  ? $value->status                                    : '',
        'role'            => $value->role                    ? $value->role                                      : '',   
        'created_at'      => $value->created_at              ? date('h:i A, d F,Y',strtotime($value->created_at)): '',   
        'updated_at'      => $value->updated_at              ? date('h:i A,d F Y',strtotime($value->updated_at)) : '',
        'Posts'		  	    => PostResource::collection($posts),
        'ForPostpaginations'=> $this->PostTransform($posts),
        'ForAddFriend'	  => ForAddFriendResource::collection($ForAddfriend)/*$this->AddFriendTransform($ForAddfriend)*/,
        'AddfriendPagination'=> $this->addfriendpagination($ForAddfriend),
   		 ];
	   }
	   return $tmp;
  	}

  	public function PostTransform($posts)
  	{
  		$tmp = array();

  		foreach ($posts as $value) {
  			$tmp = [
  				  "first_page_urll"         =>  URL::current()."?page=1",
            "from"                    =>  1,
            "last_page"               =>  5,
            "last_page_url"           => URL::current()."?page=5",
            "next_page_url"           => URL::current()."?page=2",
            "path"                    => URL::current()."",
            "per_page"                =>  2,
            "prev_page_url"           =>  null,
            "to"                      =>  2,
            "total"                   =>  10,
           // "links"           =>$value->links()
  			];
  		}
  		return $tmp;
  	}

  	public function AddFriendTransform($ForAddfriend)
  	{
  		$tmp = array();
  		foreach ($ForAddfriend as $value) {
  		$tmp = [
  			'id'			=>  $value->id							? $value->id 							: '',
  			'first_name'	=>  $value->first_name					? $value->first_name					: '',
  			'last_name'		=>  $value->last_name					? $value->last_name 					: '',
  			'gender'		=>  $value->gender						? $value->gender						: '',
  			'profile_image' =>  $value->profiles->profile_image		? $value->profiles->profile_image 		: '',
  		];
       }

       return $tmp;
  	}

  	public function transform($user,$token)
	{
	    $tmp = array();

	    foreach ($user as $value) {
	    $tmp = [
	      "first_name"    => $value->first_name      ? $value->first_name     : '',
	      "last_name"     => $value->last_name		 ? $value->last_name	  : '',
	      "username"      => $value->username		 ? $value->username       : '',
	      "email"         => $value->role		 	 ? $value->role 		  : '',
	      "status"        => $value->status		     ? $value->status 		  : '',
	      "token"         => $token				     ? $token				  : ''
	      ];
	  
	    }
	    return $tmp;
	}
}