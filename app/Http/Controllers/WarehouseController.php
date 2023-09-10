<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\WarehouseProduct;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;

class WarehouseController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:warehouses-list', ['only' => ['index','show']]);
         $this->middleware('permission:warehouses-create', ['only' => ['create','store']]);
         $this->middleware('permission:warehouses-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:warehouses-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['warehouses'] = Warehouse::get();
        return view('backend.warehouses.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        $warehouse = Warehouse::create([
            'name'=>$request->name,
            'location'=>$request->location,
        ]);
        if(!empty($warehouse)){
            return redirect()->route('warehouses.index')->with('success' ,'Your Warehouse has been added');
            }
            return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    
    // public function show(Warehouse $warehouse)
    // {   
        // $data['pivotData'] = WarehouseProduct::findOrFail($warehouse);
        // dd($data);
        // dd($data);
    //     $data['pivotDatas'] = WarehouseProduct::where('warehouse_id',$warehouse->id)->get();
    //     $data['warehouse'] = $warehouse;
    //     $data['products'] = Product::get();

    //     return view('backend.warehouses.show', $data);
    // }    


    // public function show($warehouse)
    // {   
    //     $warehouse_products = WarehouseProduct::where('warehouse_id',$warehouse)->get();
    //     return view('backend.warehouses.show2',compact('warehouse_products','warehouse'));
    // }

    public function show($warehouseId)
    {   
        // Retrieve the warehouse by ID
        $data['warehouse'] = Warehouse::find($warehouseId);

        if (!$data) {
            // Handle the case where the warehouse is not found.
            return redirect()->back()->with('error', 'Warehouse not found.');
        }
        // Retrieve warehouse products related to the warehouse
        $data['warehouse_products'] = WarehouseProduct::where('warehouse_id', $warehouseId)->get();

        return view('backend.warehouses.show2', $data);
    }


    public function update_quantity(Request $request, $warehouse)
    {   
        $input = $request->only('quantity', 'damage','status');

        $input['status'] = true;

        WarehouseProduct::where(['id' => $warehouse])->update($input);

        // $warehouse_product = WarehouseProduct::find($warehouse);
        // $warehouse_product->quantity = $request->quantity;
        // $warehouse_product->damage = $request->quantity;
        // $warehouse_product->status = '1';
        // $warehouse_product -> update();

        return redirect()->back();
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Warehouse $warehouse)
    {
    
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
