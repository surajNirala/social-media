<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostResource extends Resource
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
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'post_content'  => $this->post_content,
            'post_image'    => url('social/'.$this->post_file),
            'like'          => $this->like,
            'dislike'       => $this->dislike,
            'status'        => $this->status,
            'created_at'    => date('d-m-y',strtotime($this->created_at)),
            'updated_at'    => $this->updated_at->diffForHumans(),
        ];
    }
}
