<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ForAddFriendResource extends Resource
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
            'first_name'    => $this->first_name                    ? $this->first_name                      : '',
            'last_name'     => $this->last_name                     ? $this->last_name                       : '',
            'gender'        => $this->gender == 1                   ? 'male'                                 : 'female',
            'profile_image' => $this->profiles->profile_image       ? $this->profiles->profile_image         : '',
        ];
    }
}
