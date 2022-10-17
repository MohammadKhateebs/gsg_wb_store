<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        //select * from categories
        //if you wente to show the name of name for forginkey id
        //can use jline to join tow column and show the name of parent id
        // so go ..
        //category::withTrashed() return all data with delete item
        //category::onlyTrashed() return only delete item
        $search = $request->query('search');
        $categories = category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->search($search)
            ->orderBy('name')
            //to review sql statment use dd()
            // ->dd();
            //to remove globalscope from this quer..
            // ->withOutGlobalScope('main-categories')

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
            'category' => new category(),
        ]);
    }
    public function store(Request $request)
    {

        //Validiton
        //Laravel Validtion
        //use validate() to validation the forme
        //Throw validationExption do redirect back to page with error
        $rules = $this->rules();
        $message = $this->message();
        $request->validate($rules, $message);
        //save the file to the database
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
        //(issets($request->image))
        //search if the request has a file or no
        //isValid check if the file is good of upload
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            //file upload with type UploadedFile
            $file = $request->file('image'); //$request->image
            // dd($file,$request->post('image'));
            // dd($file,$request->image);
            if ($file->isValid()) {
                //save the file from temporary location  to actual location
                //    $filepath= $file->store('thumbnails');
                $data['image'] = $file->store('thumbnails', [
                    'disk' => 'uploads',
                ]);
            }
        }

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
        // dd($data);

        $category = Category::create(
            $data
            // [

            // 'name' => $request->name,
            // 'parent_id' => $request->input('parent_id'),
            // 'slug' => Str::slug($request->name),
            // 'description' => $request->post('description'),
            //To Insert All Data CVome From Requst
            // $request->all(),
            //  $request->except('_token','_method'),

            // ]
        );
        //PRG :Post Redirect Get
        //Convert any Post Requst To Get
        //redirect is a helper function from laravel
        return redirect()
            ->route('dashboard.categories.index')
            ->with('success', "Category ($category->name) Created !");
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


    public function update(CategoryRequest $request, $id)
    {



        // $rules = $this->rules($id);
        //    $request->validate($rules);
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

        // $category=category::find($id);
        // $category->name = $request->input('name');
        // $category->slug = Str::slug($category->name);
        // $category->parent_id = $request->input('parent_id');
        // $category->description = $request->description;
        // $category->save();


        $data = $request->except('image');

        $category = category::findOrFail($id);
        $old_image = $category->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image'); //$request->image
            if ($file->isValid()) {
                $data['image'] = $file->store('thumbnails', [
                    'disk' => 'uploads',
                ]);
                //to save file with orginal name and add th uniqid() to get random number
                //use storeAS() to save file
                // $filename=uniqid().'_'.$this->getClientOriginlName();
                // $file->getSize();//to return size of file
                // $file->getMimeType();//to return typy of image //image/png,jpg...etc
                // $file->storeAs('thumbnails',$filename,[
                //     'disk'=>'uploads',
                // ]);
            }
        }


        $category->update($data);

        if ($old_image && $old_image != $category->image) {
            Storage::disk('uploads')->delete($old_image);
        }

        //Session()->flash('message', "Categor ($category->name) updated");
        // Session::flash('message', "Categor ($category->name) updated");
        //   Session::remove('message');
        // Session::put('message',"Categor ($category->name) updated");
        // category::where('id','=',$id)->update($request->all());
        return redirect()->route('dashboard.categories.index')
            ->with('success', "Category ($category->name) Updataed !");;
    }



    public function destroy($id)
    {

        //check the delete type softDelete of forceDelete...
        $category = category::withTrashed()
            ->findOrFail($id);
        //to check can use $category->deleted_at or trashed
        if ($category->trashed()) {
            $category->forceDelete();
            // dont use it in softdelets

        } else {
            $category->delete();
        }




        // category::where('id', '=', $id);

        // category::destroy($id);
        return redirect()->route('dashboard.categories.index')
            ->with('success', "Category ($category->name) deleted !");
    }
    public function trash()
    {
        //latest retuen the data order from newest to oldist
        $categories = category::onlyTrashed()->latest('deleted_at')->get();
        return view('dashboard.categories.trash', compact('categories'));
    }
    public function restore(Request $request, $id)
    {
        $category = category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.index')
            ->with('success', "Category ($category->name) Restore !");
    }
    protected function rules($id = 0)
    {
        return [
            // 'name of input '=>'Condtion',
            //if use parameter use :
            // 'name' => 'required|string|max:255|unique:categories,name,'.$id,
            'name' => [
                'required',
                'string',
                'max:255',
                // 'unique:categories,name,'.$id,
                Rule::unique('categories', 'name')->ignore($id, 'id'),
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
    protected function message()
    {
        return [
            "name.required" => ":attribute Is Empty pleas fill it !"
        ];
    }
}
