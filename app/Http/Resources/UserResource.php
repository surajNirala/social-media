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
        //'image'           => route('socials.show',$this->id),

    return [          
            'id'              => $this->id                        ? $this->id                                    : '',
            'first_name'      => $this->first_name                ? $this->first_name                            : '',
            'last_name'       => $this->last_name                 ? $this->last_name                             : '',
            'profile_image'   => $this->profiles->profile_image   ? url('social/'.$this->profiles->profile_image): '',
            'cover_image'     => $this->profiles->cover_image     ? url('social/'.$this->profiles->cover_image)  : '',
            'mobile'          => $this->profiles->mobile          ? $this->profiles->mobile                      : '',
            'username'        => $this->profiles->username        ? $this->profiles->username                    : '',
            'email'           => $this->email                     ? $this->email                                 : '',
            'dop'             => $this->dop                       ? $this->dop                                   : '',
            'city'            => $this->profiles->city            ? $this->profiles->city                        : '',
            'country'         => $this->profiles->country         ? $this->profiles->country                     : '',
            'status'          => $this->status                    ? $this->status                                : '',
            'role'            => $this->role                      ? $this->role                                  : '',   
            'created_at'      => $this->created_at                ? $this->created_at->format('y-m-d')           : '',   
            'updated_at'      => $this->updated_at                ? $this->updated_at->format('y-m-d')           : ''
        //'links'             => new UserResource($request),
        ];
    }

    public function with($request)
    {
        return [
            'version'    => '2.0.0',
            'Attribution'    => 'test',
        ];
    }
}
