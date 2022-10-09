<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        //select * from categories

        $categories = category::all();

        return view('dashboard.categories.index', [
            'enteries' => $categories,
            'title' => 'categories List',
        ]);
    }
    public function create()
    {
        $parents = category::orderBy('name')->get();

        return view('dashboard.categories.create', [
            'parents' => $parents,
        ]);
    }
    public function store(Request $request)
    {
        //with out mass assiment
        // $category = new Category();
        // $category->name = $request->input('name');
        // $category->slug = Str::slug($category->name);
        // $category->parent_id = $request->input('parent_id');
        // $category->description = $request->description;
        // $category->save();

        //with out mass assiment
        // $category = new category([
        //     'name'=>$request->name,
        // ]);
        // $category->save();
        //you went to use mass assigment
        // $category=new category();
        // $category->fill([
        //     'name'=>$request->post('name'),
        // ])->save();

        //mass assigment
        //to use mass assigment use the white area in model
        //use $requst->all() to insert all data to database
        //if you went to add column not come from frome use merge()
        // $request->merge([
        //  'slug'=>Str::slug($request->post('name')),
        // ]);
        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->input('parent_id'),
            'slug' => Str::slug($request->name),
            'description' => $request->post('description'),
            //To Insert All Data CVome From Requst
            // $request->all(),
            //  $request->except('_token','_method'),

        ]);
        //PRG :Post Redirect Get
        //Convert any Post Requst To Get
        //redirect is a helper function from laravel
        return redirect()->route('dashboard.categories.index');
    }
    public function edit($id)
    {
        //    category::where('id','=',$id)->firstOrFail();
        $category = category::findOrFail($id);
        //can use this as like findOrFail , fisrtOrFail
        // if($category == null){
        //     return abort(404);
        // }
        $parents = category::where('id', '<>', $id)->orderBy('name')->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }
    public function update(Request $request, $id)
    {
        // $category=category::find($id);
        // $category->name = $request->input('name');
        // $category->slug = Str::slug($category->name);
        // $category->parent_id = $request->input('parent_id');
        // $category->description = $request->description;
        // $category->save();
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);
        $category = category::findOrFail($id);
        $category->update($request->all());

        // category::where('id','=',$id)->update($request->all());
        return redirect()->route('dashboard.categories.index');
    }
    public function destroy($id)
    {
        // $category = category::find($id);
        // $category->delete();


        // category::where('id', '=', $id);

        category::destroy($id);
        return redirect()->route('dashboard.categories.index');

    }
}
