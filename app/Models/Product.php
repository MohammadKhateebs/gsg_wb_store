<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'category_id', 'price', 'compare_price', 'cost',
        'quantity', 'availability', 'status', 'image', 'sku', 'barcode'
    ];

    public static function statusOptions()
    {
        return [
            'active'=>'Active',
            'draft'=>'Draft',
            'archived'=>'Archived'
        ];
    }

    public static function availabilities()
    {
        return [
            'in-stoke'=>'In Stock',
            'out-of-stoke'=>'Out Of Stocks',
            'back-order'=>'Back Order'
        ];
    }

}
