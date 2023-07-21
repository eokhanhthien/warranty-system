<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    protected $fillable = [
        'name',
        'business_id',
    ];

    public function parrent_category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

}
