<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
//resource is like a middle layer between eloquent model and API response
//format response how i want
//hide unecessary data etc

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // replace this return parent::toArray($request);
        return [ 
            'id' => $this->id, 
            'title' => $this->title, 
            'author' => $this->author, 
            'description' => $this->description, 
            'published_year' => $this->published_year, 
            'created_at' => $this->created_at->toDateTimeString(), 
            'updated_at' => $this->updated_at->toDateTimeString(), 
        ]; 
        //replace so in full control of what goes into API response no private data
    }
}
