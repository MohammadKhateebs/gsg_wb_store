<?php

namespace App\Models;

use App\Models\Scopes\MainCategoryScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    //The code of softDelete its a globel Scope
    //gloabel scope can add statment with condition ...
    use SoftDeletes;
    use HasFactory;
    protected $fillable=['name','slug','parent_id','description','image'];

    //gloabel scope
    //to add code when call model
    //service povider
    //can call multi scope at the one model
    //add where categories.parent_id = null

    protected static function booted()
    {
      //  static::addGlobalScope(new MainCategoryScope());
        //   static::addGlobalScope('main-category',function(Builder $builder)
        //   {
        // //  $builder->whereNull('categories.parent_id');
        // $builder->leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
        // ->select([
        //     'categories.*',
        //     'parents.name as parent_name'
        // ]);

        //   });

        //  localScope

    }
    public function scopeSearch(Builder $builder,$value)
    {
        if($value){
            $builder->where('categories.name', 'LIKE', "%{$value}%");

        }
    }

}
