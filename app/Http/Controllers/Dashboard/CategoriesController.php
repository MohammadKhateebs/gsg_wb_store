<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CategoriesController extends Controller
{
    public function index()
    {
        //select * from categories
        //if you wente to show the name of name for forginkey id
        //can use jline to join tow column and show the name of parent id
        // so go ..
        $categories = category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->orderBy('name')
            //to review sql statment use dd()
            // ->dd();
            ->get();
        // $categories = category::all();

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
            'category'=>new category(),
        ]);
    }
    public function store(Request $request)
    {
        //Validiton
        //Laravel Validtion
        //use validate() to validation the forme
        //Throw validationExption do redirect back to page with error
     $rules=$this->rules();
     $message =$this->message();
        // $rules = [
        //     // 'name of input '=>'Condtion',
        //     //if use parameter use :
        //     'name' => 'required|string|max:255|',
        //     //exists : use to check if data exite in table

        //     'parent_id' => 'nullable |int|exists:categories,id',
        //     'description' => 'nullable|string|min:5',
        //     'image' => 'nullable|mimes:jpg,png|max:300000|
        //         dimensions:min_width=150,min_hight=150,
        //         max_width=150,max_hight=150', //kb
        // ];
        // $this->validate($request,$rules);
        $request->validate($rules,$message);


        // $request->validate([
        //     // 'name of input '=>'Condtion',
        //     //if use parameter use :
        //     'name'=>'required|string|max:255|',
        //     //exists : use to check if data exite in table

        //     'parent_id'=>'nullable |int|exists:categories,id',
        //     'description'=>'nullable|string|min:5',
        //     'image'=>'nullable|mimes:jpg,png|max:300000|
        //     dimensions:min_width=150,min_hight=150,
        //     max_width=150,max_hight=150',//100kb
        // ]);




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
        $rules=$this->rules($id);
        // $rules = [
        //     // 'name of input '=>'Condtion',
        //     //if use parameter use :
        //     'name' => 'required|string|max:255|',
        //     //exists : use to check if data exite in table

        //     'parent_id' => 'nullable |int|exists:categories,id',
        //     'description' => 'nullable|string|min:5',
        //     'image' => 'nullable|mimes:jpg,png|max:300000|
        //         dimensions:min_width=150,min_hight=150,
        //         max_width=150,max_hight=150', //kb
        // ];
        // $this->validate($request,$rules);
        $request->validate($rules);
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
    protected function rules($id=0){
        return [
            // 'name of input '=>'Condtion',
            //if use parameter use :
            // 'name' => 'required|string|max:255|unique:categories,name,'.$id,
           'name'=>[
            'required',
            'string',
            'max:255',
            // 'unique:categories,name,'.$id,
            Rule::unique('categories','name')->ignore($id,'id'),
            // (new Unique('categories','name'))->ignore($id,'id'),

           ],
            //exists : use to check if data exite in table

            'parent_id' => 'nullable |int|exists:categories,id',
            'description' => 'nullable|string|min:5',
            'image' => 'nullable|mimes:jpg,png|max:300000|
                dimensions:min_width=150,min_hight=150,
                max_width=150,max_hight=150', //kb
        ];
        // $this->validate($request,$rules);

    }
    protected function message(){
        return [
            "name.required"=>":attribute Is Empty pleas fill it !"
        ];
    }
}
