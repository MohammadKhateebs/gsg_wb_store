<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
    //to use event models
    protected static function booted(){
        /*
        event model =>
        creating ,created ,updating,updated,saveing,saved
        deleting,deleted,restoring,restored,forcedeleting,forcedeleted
        */
        static::forceDeleted(function($products){
               // dont use it in softdelets
               if($products->image){
                Storage::disk('uploads')->delete($products->image);
            }
        });
            static::saving(function($products) {
                $products->slug = Str::slug($products->name);
            });


    }

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
