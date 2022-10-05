<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sql
        //insert into categories (name,parent_id,slug,image,description)
        //values('Clothes',null,'clothes','sdssdsd','sdsd');
        //Query Builder
        DB::table('categories')->insert([
            'name'=>'Clothes',
            'parent_id'=>null,
            'slug'=>'clothes',
            'description'=>null,
            'image'=>'null',
        ]);
        //to use sql statment we use
        // DB::statement('Insert into categories (name,parent_id,slug,image,description)
        //values('Clothes',null,'clothes','sdssdsd','sdsd');');
    }
}
