<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserinfoResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id'            => $this->id                     ? $this->id                                           : '',
            'first_name'    => $this->first_name             ? $this->first_name                                   : '',
            'last_name'     => $this->last_name              ? $this->last_name                                    : '',
            'email'         => $this->email                  ? $this->email                                        : '',
            'dob'           => $this->dob                    ? date('(h:i A),d F,Y',strtotime($this->dob))         : '',
            'gender'        => $this->gender == '1'          ? 'male'                                              : 'female',
            'profilePic'    => $this->profiles               ? url($this->profiles->profile_image)                 : '',  
            'cover_image'   => $this->profiles               ? url($this->profiles->cover_image)                   : '',
            'mobile'        => $this->profiles               ? $this->profiles->mobile                             : '',
            'username'      => $this->profiles               ? $this->profiles->username                           : '',
            'city'          => $this->profiles               ? $this->profiles->city                               : '',
            'country'       => $this->profiles               ? $this->profiles->country                            : '',
            'status'        => $this->status                 ? $this->status                                       : '',
            'role'          => $this->role                   ?  $this->role                                        : '',
            'created_at'    => $this->created_at             ? $this->created_at->toDateTimeString()               : '',
            'updated_at'    => $this->updated_at             ? $this->updated_at->toDateTimeString()               : '',
            'is_verified'   => $this->is_verified == 0       ? $this->is_verified                                  : '',
          //'profile'       => (!is_null($this->profiles))   ? new UserProfileResource($this->profiles)            : '',
            'education'     => (count($this->education) > 0) ? UserEducationResource::collection($this->education) : '', 
            'workexperience'=> (count($this->workexperiences)>0) ? UserWorkexperienceResource::collection($this->workexperiences) : '', 
        ];
    }
}
