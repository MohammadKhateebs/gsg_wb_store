<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Scopes\MainCategoryScope;
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

    // protected static function booted()
    // {
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

    //}
    public function scopeSearch(Builder $builder,$value)
    {
        if($value){
            $builder->where('categories.name', 'LIKE', "%{$value}%");

        }
    }
    //to use event models
    protected static function booted(){
        /*
        event model =>
        creating ,created ,updating,updated,saveing,saved
        deleting,deleted,restoring,restored,forcedeleting,forcedeleted
        */
        static::forceDeleted(function($category){
               // dont use it in softdelets
               if ($category->image) {
                Storage::disk('uploads')->delete($category->image);
            }
        });
            static::saving(function($category){
                $category->slug=Str::slug($category->name);

            });



    }
    //Accessors : get(Name)Attribute
    //$category ->image_url
    public function getImageUrlAttribute(){
        if(!$this->image){
            return asset('uploads/default-thumbnail.jpg');
        }
        if(Str::startsWith($this->image,['http://','https://'])){
            return $this->image;
        }
        return Storage::disk('uploads')->url($this->image);

    }
    public function getNameAttribute($value)
    {
        return Str::title($value);
    }

    //Mutatores :set(Name)Attribute
    public function setNameAttribute($value){

        $this->attributes['name']=Str::upper($value);
    }

}
