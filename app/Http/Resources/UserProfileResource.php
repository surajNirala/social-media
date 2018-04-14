<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
class UserProfileResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

        return [
            'id'          => $this->id                           ? $this->id                              : '', 
            'user_id'     => $this->user_id                      ? $this->user_id                         : '', 
            'profilePic'  => $this->profile_image                ? url($this->profile_image)              : '',  
            'cover_image' => $this->cover_image                  ? url($this->cover_image)                : '',
            'mobile'      => $this->mobile                       ? $this->mobile                          : '',
            'username'    => $this->username                     ? $this->username                        : '',
            'city'        => $this->city                         ? $this->city                            : '',
            'country'     => $this->country                      ? $this->country                         : '',
            'created_at'  => $this->created_at                   ? $this->created_at->toDateTimeString()  : '',
            'updated_at'  => $this->updated_at                   ? $this->updated_at->toDateTimeString()  : '',
        ];
    }
}
