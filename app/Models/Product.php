<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'soft_delete', 'name', 'value', 'description'];

    protected $casts = [
        'soft_delete' => 'date',
    ];

    public function attributes()
    {
        return $this->hasManyThrough('App\Models\Attribute', 'App\Models\ProductAttribute', 'product_id', 'id', 'id', 'attribute_id');
    }
}
