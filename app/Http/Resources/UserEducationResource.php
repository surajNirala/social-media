<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserEducationResource extends Resource
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
            'id'            => $this->id            ?  $this->id                             :     '',
            'user_id'       => $this->user_id       ?  $this->user_id                        :     '',
            'university'    => $this->university    ?  $this->university                     :     '',
            'course'        => $this->course        ?  $this->course                         :     '',
            'from_year'     => $this->from_year     ?  $this->from_year                      :     '',
            'to_year'       => $this->to_year       ?  $this->to_year                        :     '',
            'description'   => $this->description   ?  $this->description                    :     '',
            'status'        => $this->status        ?  $this->status                         :     '',
            'created_at'    => $this->created_at    ?  $this->created_at->toDateTimeString() :     '',
            'updated_at'    => $this->updated_at    ?  $this->updated_at->toDateTimeString() :     '', 
        ];
    }
}
