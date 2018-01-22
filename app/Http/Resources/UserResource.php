<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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

        return ([
            'id'                => $this->id,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'profile_image'     => $this->profile_image,
            'cover_image'       => $this->cover_image,
            'mobile'            => $this->mobile,
            'username'          => $this->username,
            'email'             => $this->email,
            'dop'               => $this->dop,
            'city'              => $this->city,
            'country'           => $this->country,
            'status'            => $this->status,
            'role'              => $this->role,
            'created_at'        => $this->created_at->format('y-m-d'),    
            'updated_at'        => $this->updated_at->format('y-m-d'), 
            //'links'             => new UserResource($request),
        ]);
    }
    public function with($request)
    {
        return ([
            'links'    => $this->first_name,
        ]);
    }
}
