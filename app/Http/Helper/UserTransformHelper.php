<?php 

namespace App\Http\Helper;
use App\Http\Resources\PostResource;
use App\Http\Resources\ForAddFriendResource;

Trait UserTransformHelper 
{
  public function withoutPostuserDetailTransformer($userDetails,$ForAddfriend)
  {
    $tmp = array();

    foreach($userDetails as $value){
      //date('l',strtotime($value->created_at))
      //date('d F,Y',strtotime($value->created_at))
      //date('h:i A',strtotime($value->created_at))

      $t1 = strtotime($value->dob); 
      $t2 = strtotime($value->created_at); 

      $diff = $t2 - $t1;
      $hours = round($diff / ( 60 * 60 ), 2);
      /*'profile_image'   => filter_var($value->profiles->profile_image,FILTER_VALIDATE_URL) === false ? ''      : url('social/'.$value->profiles->profile_image),*/

    $tmp = [
        'id'              => $value->id                      ? (int) $value->id                                  : '',
        'first_name'      => $value->first_name              ? $value->first_name                                : '',
        'last_name'       => $value->last_name               ? $value->last_name                                 : '',
        'Gender'          => $value->gender == 1             ? 'male'                                            :'female',
        'mobile'          => (! empty ($value->profiles))    ? $value->profiles->mobile                          : '',
        'username'        => (! empty ($value->profiles))    ? $value->profiles->username                        : '',
        'email'           => $value->email                   ? $value->email                                     : '',
        'dob'             => $value->dob                     ? date('(h:i A),d F,Y',strtotime($value->dob))      : '',
        'Day'             => $value->dob                     ? date('l',strtotime($value->dob))                  : '',
        'hours'           => $value->dob                     ? $hours                                            : '',
        'city'            => (! empty ($value->profiles))    ? $value->profiles->city                            : '',
        'country'         => (! empty ($value->profiles))    ? $value->profiles->country                         : '',
        'profile_image'   => (! empty ($value->profiles))    ? url('social/'.$value->profiles->profile_image)    : '',
        'cover_image'     => (! empty ($value->profiles))    ? url('social/'.$value->profiles->cover_image)      : '',
        'status'          => $value->status                  ? $value->status                                    : '',
        'role'            => $value->role                    ? $value->role                                      : '',   
        'created_at'      => $value->created_at              ? date('h:i A, d F,Y',strtotime($value->created_at)): '',   
        'updated_at'      => $value->updated_at              ? date('h:i A,d F Y',strtotime($value->updated_at)) : '',
        'posts'           => []                              ? []                                                : [],
        'forAddFriend'    => ForAddFriendResource::collection($ForAddfriend),
        'addfriendPagination'=> $this->addfriendpagination($ForAddfriend),
       ];
     }
     return $tmp;
  }

  public function addfriendpagination($ForAddfriend)
  {
      $tmp = array();

      $data =  $ForAddfriend->toArray();

      $tmp = [
        "first_page_url" => $data['first_page_url'],
        "from"           => $data['from'],
        "last_page"      => $data['last_page'],
        "last_page_url"  => $data['last_page_url'],
        "next_page_url"  => $data['next_page_url'],
        "path"           => $data['path'],
        "per_page"       => $data['per_page'],
        "prev_page_url"  => $data['prev_page_url'],
        "to"             => $data['to'],
        "total"          => $data['total']
      ];
 
      /*foreach ($ForAddfriend as $value) {
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
      }*/
      return $tmp;
  }

  public function withoutAddfrienduserDetailTransformer($userDetails,$posts)
  {
    $tmp = array();

    foreach($userDetails as $value){
      //date('l',strtotime($value->created_at))
      //date('d F,Y',strtotime($value->created_at))
      //date('h:i A',strtotime($value->created_at))

      $t1 = strtotime($value->dob); 
      $t2 = strtotime($value->created_at); 

      $diff = $t2 - $t1;
      $hours = round($diff / ( 60 * 60 ), 2);
      /*'profile_image'   => filter_var($value->profiles->profile_image,FILTER_VALIDATE_URL) === false ? ''      : url('social/'.$value->profiles->profile_image),*/

    $tmp = [
        'id'              => $value->id                      ? (int) $value->id                                  : '',
        'first_name'      => $value->first_name              ? $value->first_name                                : '',
        'last_name'       => $value->last_name               ? $value->last_name                                 : '',
        'Gender'          => $value->gender == 1             ? 'male'                                            :'female',
        'mobile'          => (! empty ($value->profiles))    ? $value->profiles->mobile                          : '',
        'username'        => (! empty ($value->profiles))    ? $value->profiles->username                        : '',
        'email'           => $value->email                   ? $value->email                                     : '',
        'dob'             => $value->dob                     ? date('(h:i A),d F,Y',strtotime($value->dob))      : '',
        'Day'             => $value->dob                     ? date('l',strtotime($value->dob))                  : '',
        'hours'           => $value->dob                     ? $hours                                            : '',
        'city'            => (! empty ($value->profiles))    ? $value->profiles->city                            : '',
        'country'         => (! empty ($value->profiles))    ? $value->profiles->country                         : '',
        'profile_image'   => (! empty ($value->profiles))    ? url('social/'.$value->profiles->profile_image)    : '',
        'cover_image'     => (! empty ($value->profiles))    ? url('social/'.$value->profiles->cover_image)      : '',
        'status'          => $value->status                  ? $value->status                                    : '',
        'role'            => $value->role                    ? $value->role                                      : '',   
        'created_at'      => $value->created_at              ? date('h:i A, d F,Y',strtotime($value->created_at)): '',   
        'updated_at'      => $value->updated_at              ? date('h:i A,d F Y',strtotime($value->updated_at)) : '',
        'posts'           => $this->PostTransform($posts),
        'addfriend'       => [],
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

      $t1 = strtotime($value->dob); 
      $t2 = strtotime($value->created_at); 

      $diff = $t2 - $t1;
      $hours = round($diff / ( 60 * 60 ), 2);
      /*'profile_image'   => filter_var($value->profiles->profile_image,FILTER_VALIDATE_URL) === false ? ''      : url('social/'.$value->profiles->profile_image),*/

    $tmp = [
        'id'              => $value->id                      ? (int) $value->id                                  : '',
        'first_name'      => $value->first_name              ? $value->first_name                                : '',
        'last_name'       => $value->last_name               ? $value->last_name                                 : '',
        'Gender'          => $value->gender == 1             ? 'male'                                            :'female',
        'mobile'          => (! empty ($value->profiles))    ? $value->profiles->mobile                          : '',
        'username'        => (! empty ($value->profiles))    ? $value->profiles->username                        : '',
        'email'           => $value->email                   ? $value->email                                     : '',
        'dob'             => $value->dob                     ? date('(h:i A),d F,Y',strtotime($value->dob))      : '',
        'Day'             => $value->dob                     ? date('l',strtotime($value->dob))                  : '',
        'hours'           => $value->dob                     ? $hours                                            : '',
        'city'            => (! empty ($value->profiles))    ? $value->profiles->city                            : '',
        'country'         => (! empty ($value->profiles))    ? $value->profiles->country                         : '',
        'profile_image'   => (! empty ($value->profiles))    ? url('social/'.$value->profiles->profile_image)    : '',
        'cover_image'     => (! empty ($value->profiles))    ? url('social/'.$value->profiles->cover_image)      : '',
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

      $t1 = strtotime($value->dob); 
      $t2 = strtotime($value->created_at); 

      $diff = $t2 - $t1;
      $hours = round($diff / ( 60 * 60 ), 2);
      /*'profile_image'   => filter_var($value->profiles->profile_image,FILTER_VALIDATE_URL) === false ? ''      : url('social/'.$value->profiles->profile_image),*/

		$tmp = [
        'id'              => $value->id                      ? (int) $value->id                                  : '',
        'first_name'      => $value->first_name              ? $value->first_name                                : '',
        'last_name'       => $value->last_name               ? $value->last_name                                 : '',
        'Gender'          => $value->gender == 1             ? 'male'                                            :'female',
        'mobile'          => (! empty ($value->profiles))    ? $value->profiles->mobile                          : '',
        'username'        => (! empty ($value->profiles))    ? $value->profiles->username                        : '',
        'email'           => $value->email                   ? $value->email                                     : '',
        'dob'             => $value->dob                     ? date('(h:i A),d F,Y',strtotime($value->dob))      : '',
        'Day'             => $value->dob                     ? date('l',strtotime($value->dob))                  : '',
        'hours'           => $value->dob                     ? $hours                                            : '',
        'city'            => (! empty ($value->profiles))    ? $value->profiles->city                            : '',
        'country'         => (! empty ($value->profiles))    ? $value->profiles->country                         : '',
        'profile_image'   => (! empty ($value->profiles))    ? url('social/'.$value->profiles->profile_image)    : '',
        'cover_image'     => (! empty ($value->profiles))    ? url('social/'.$value->profiles->cover_image)      : '',
        'status'          => $value->status                  ? $value->status                                    : '',
        'role'            => $value->role                    ? $value->role                                      : '',   
        'created_at'      => $value->created_at              ? date('h:i A, d F,Y',strtotime($value->created_at)): '',   
        'updated_at'      => $value->updated_at              ? date('h:i A,d F Y',strtotime($value->updated_at)) : '',
        'posts'		  	    => PostResource::collection($posts),
        'forPostpaginations'=> $this->PostTransform($posts),
        'forAddFriend'	  => ForAddFriendResource::collection($ForAddfriend),
        'addfriendPagination'=> $this->addfriendpagination($ForAddfriend),
   		 ];
	   }
	   return $tmp;
  }

  public function PostTransform($posts)
  {
  		$tmp = array();

      $data =  $posts->toArray();

      $tmp = [
        "first_page_url" => $data['first_page_url'],
        "from"           => $data['from'],
        "last_page"      => $data['last_page'],
        "last_page_url"  => $data['last_page_url'],
        "next_page_url"  => $data['next_page_url'],
        "path"           => $data['path'],
        "per_page"       => $data['per_page'],
        "prev_page_url"  => $data['prev_page_url'],
        "to"             => $data['to'],
        "total"          => $data['total']
      ];
  		return $tmp;
  }

  public function loginTransform($user,$token)
	{

	    $tmp = array();
      //Trying to get property 'id' of non-object show error without foreach loop
	    foreach ($user as $value) {
	    $tmp = [
        "id"            => $value->id              ? $value->id                                            : '',
	      "first_name"    => $value->first_name      ? $value->first_name                                    : '',
        "last_name"     => $value->last_name       ? $value->last_name                                     : '',
        "email"         => $value->email           ? $value->email                                         : '',
        "dob"           => $value->dob             ? date('(h:i A),d F,Y',strtotime($value->dob))          : '',
        "token"         => $token,
	      
	      ];
	  
	    }
	    return $tmp;
	}
}