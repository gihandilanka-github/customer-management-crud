<?php

namespace App\Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PawelMysior\Publishable\Publishable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Storage;

class Customer extends Model
{
    use Userstamps;
    use SoftDeletes;
    use Publishable;

    protected $guarded = ['id'];

    public function categoryImages() {
        return $this->hasMany('App\Image', 'resource_id', 'id')->where('resource_type', RESOURCE_TYPE_CATEGORY);
    }

    public function categoryImage() {
        return $this->hasOne('App\Image', 'resource_id', 'id')->where('resource_type', RESOURCE_TYPE_CATEGORY);
    }

    public function getThumbnailImageUrlAttribute()
    {
        return $this->categoryImage ? Storage::disk('category')->url(''.$this->categoryImage->resource_id.'/thumbnail/'.$this->categoryImage->path.'') : env('APP_URL').'/img/no-image.png';
    }

    public function products(){
        return $this->hasMany('App\Modules\Product\Models\Product', 'category_id', 'id');
    }
    public function hasProduct(){
        return $this->hasOne('App\Modules\Product\Models\Product', 'category_id', 'id');
    }
}
