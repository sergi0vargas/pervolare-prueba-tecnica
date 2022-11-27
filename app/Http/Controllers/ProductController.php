<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use Alert;
use Carbon\Carbon;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        $attributes = Attribute::where('status', 1)->get();
        return view('products.index', compact('data', 'attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha_num|min:2|max:10',
            'value' => 'required|numeric|min:1',
            'description' => 'required|regex:/^[a-zA-Z0-9\s]+$/|min:10|max:500'
        ]);
        Product::create([
            'name' => $request->name,
            'value' => $request->value,
            'description' => $request->description
        ]);
        Alert::success('Product Added', 'Product ' . $request->name . ' Successfully added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $item = Product::find($id);
        $item->status = 1;
        $item->soft_delete = null;
        $item->save();

        Alert::success('Product Activated', 'Product ' . $item->name . ' Successfully Activated');
        return redirect()->back();
    }


    public function addAttr(Request $request, $id)
    {
        $qry = ProductAttribute::where('product_id', $id)->where('attribute_id', $request->attribute)->get();
        if ($qry->count() > 0) {
            Alert::error('Error', 'The product already has this attribute');
        } else {
            ProductAttribute::create([
                'product_id' => $id,
                'attribute_id' => $request->attribute
            ]);
            Alert::success('Attribute Added', 'Attribute Successfully added');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Product::find($id);
        $prod->status = 0;
        $prod->soft_delete = Carbon::now();
        $prod->save();

        Alert::success('Product Deleted', 'Product ' . $prod->name . ' Successfully Soft Deleted');
        return redirect()->back();
    }
}
