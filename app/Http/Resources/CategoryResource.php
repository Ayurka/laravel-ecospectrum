<?php

namespace App\Http\Resources;

use App\Models\Backend\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryResource extends JsonResource
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
            'id' => $this->id,
            'type' => 'category',
            'title' => $this->title,
            'url' => $this->url->url,
            'images' => $this->images,
            'description' => $this->description,
            'seo_title' => $this->seo_title,
            'seo_keywords' => $this->seo_keywords,
            'seo_description' => $this->seo_description,
            'filterGroups' => FilterGroupResource::collection($this->getGroupsFilters),
            'products' => new ProductCollection($this->filterProducts($request, $this->id)->paginate(12)),
            'categories' => CategoryResource::collection($this->children),
            'breadcrumbs' => BreadcrumbsResource::collection($this->getAncestorsBreadcrumbs()),
            'minMax' => [(int)$this->getMinPrice(), (int)$this->getMaxPrice()]
        ];
    }
}
