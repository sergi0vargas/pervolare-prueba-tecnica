<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Alert;
use Carbon\Carbon;

class AttributeController extends Controller
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
        $data = Attribute::all();
        return view('attributes.index', compact('data'));
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
            'name' => 'required|min:2|max:10',
            'type' => 'required|in:Color,Talla,Marca,Fabrica',
        ]);
        Attribute::create([
            'name' => $request->name,
            'type' => $request->type
        ]);
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
        $item = Attribute::find($id);
        $item->status = 1;
        $item->soft_delete = null;
        $item->save();

        Alert::success('Attribute Activated', 'Attribute ' . $item->name . ' Successfully Activated');
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
        $item = Attribute::find($id);
        $item->status = 0;
        $item->soft_delete = Carbon::now();
        $item->save();

        $qry = ProductAttribute::where('attribute_id', $id)->get();
        foreach ($qry as $value) {
            $value->delete();
        }

        Alert::success('Attribute Deleted', 'Attribute ' . $item->name . ' Successfully Soft Deleted');
        return redirect()->back();
    }
}
