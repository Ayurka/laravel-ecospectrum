<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'product',
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => $this->url->url,
            'price' => $this->price,
            'images' => $this->images,
            'description' => $this->description,
            'attributes' => $this->getPivotAttributes,
            'breadcrumbs' => BreadcrumbsResource::collection($this->getAncestorsBreadcrumbs()),
        ];
    }
}
