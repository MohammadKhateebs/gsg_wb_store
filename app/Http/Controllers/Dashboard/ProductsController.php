<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function __construct()

    {
        //if you went to do middlewaer in some route or some page
           // $this->middleware(['auth'])->except(['index','create']);
        // $this->middleware(['auth'])->only(['index','create']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'products' => new Product(),
            'availabilitys' => Product::availabilities(),
            'status_options' => Product::statusOptions(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $rules = $this->rules();
        $message = $this->message();
        $request->validate($rules, $message);
        //upload image

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image'); //$request->image
            if ($file->isValid()) {
                $data['image'] = $this->upload($file);
            }
        }
        //create the product

        $products = Product::create($data);
        return redirect()->route('dashboard.products.index')->with(['success' => "Products ($products->name) Created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view('dashboard.products.show', [
            'product' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('dashboard.products.edit', [
            'products' => $products,
            'availabilitys' => Product::availabilities(),
            'status_options' => Product::statusOptions(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validation
        $rules = $this->rules();
        $message = $this->message();
        $request->validate($rules, $message);

        $products = Product::findOrFail($id);
        //uplaod image
        $data = $request->except('image'); //to remove any dublicate
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $data['image'] = $this->upload($request->file('image'));
            }
        }

        tap($products->image, function ($old_image) use ($products, $data) {
            $products->update($data);
            //tap()
            if ($old_image && $old_image != $products->image) {
                Storage::disk('uploads')->delete($old_image);
            }
        });
        // $old_image = $products->image;
        // $products->update($data);
        //     //tap()
        // if ($old_image && $old_image != $products->image) {
        //     Storage::disk('uploads')->delete($old_image);
        // }

        return redirect()->route('dashboard.products.index')->with(['success' => "Products ($products->name) Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $products = Product::withTrashed()->findOrFail($id);
        if ($products->trashed()) {
            $products->forceDelete();
        } else {
            $products->delete();
        }

        return redirect()->route('dashboard.products.index')->with(['success' => "Products ($products->name) deleted"]);
    }
    public function trash()
    {
        //latest retuen the data order from newest to oldist
        $products = Product::onlyTrashed()->latest('deleted_at')->get();
        return view('dashboard.products.trash', compact('products'));
    }
    public function restore(Request $request, $id)
    {
        $products = Product::onlyTrashed()->findOrFail($id);
        $products->restore();
        return redirect()->route('dashboard.products.index')
            ->with('success', "Product ($products->name) Restore !");
    }
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|int|exists:categories,id',
            'price' => 'required|numeric|min:0',
            //gt : The field under validation must be greater than or equal to the given field.
            'compare_price' => 'nullable|numeric|gt:price',
            //in =>use to select just what you want
            'availability' => 'in:active,draft,archived',
            'availability' => 'in:in-stoke,out-of-stoke,back-order',
            'quantity' => 'nullable|int|min:0',
            //unique:products,sku ,mean the sku is unq in products table at sku column
            'sku' => 'nullable|string|unique:products,sku',
            'barcode' => 'nullable|string|unique:products,barcode',
            'image' => 'nullable|image',




        ];
    }
    protected function message()
    {
        return [];
    }
    protected function upload(UploadedFile $file)
    {
        return $file->store('thumbnails', [
                'disk' => 'uploads',
            ]);
    }
}
