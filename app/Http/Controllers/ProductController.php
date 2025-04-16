<?php

namespace App\Http\Controllers;

use App\Models\Units;
use App\Models\M_products;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // return Units::find(7)->getProduct;
        $btnName = "Save";
        $module = "Product Master";
        $unit_data = Units::all();
        // $productData = M_products::all();
        $productData = Units::Join('m_product', function ($join) {
            $join->on('units.id', '=', 'm_product.unit_id');
        })->whereNotNull('m_product.unit_id')
            ->get();
        return view('admin/master/product_master', compact('btnName', 'unit_data', 'productData', "module"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required',
            'product_name' => 'required|unique:m_product,product_name,' . $request->product_id,
            'rate' => 'required',
        ], ['unit_id.required' => 'Please Choose Unit Name']);
        if ($request->product_id != "") {
            $product_data = M_products::find($request->product_id);
            $product_data->product_name = $request->product_name;
            $product_data->unit_id = $request->unit_id;
            $product_data->rate = $request->rate;
            $product_data->update();
            return redirect('admin/master/product_master')->with('success', 'Data Updated Successfully');
        }
        $product =  new M_products;
        $product->product_name = $request->product_name;
        $product->unit_id = $request->unit_id;
        $product->rate = $request->rate;
        $product->ipaddress = $request->ip();
        $product->save();
        if ($product) {
            return redirect('admin/master/product_master')->with('success', 'Data Saved Successfully');
        }
        return redirect()->back()->with('error', 'Data Not Saved');
    }
    public function edit($id)
    {
        $departments_data = M_products::all();
        $unit_data = Units::all();
        $productData = Units::Join('m_product', function ($join) {
            $join->on('units.id', '=', 'm_product.unit_id');
        })->whereNotNull('m_product.unit_id')
            ->get();
        // return $id;
        $editData = M_products::find($id);
        $btnName = "Update";
        return view('admin/master/product_master', compact('btnName', 'editData', 'unit_data', 'departments_data', 'productData'));
    }
    public function delete($id)
    {
        // return $id;
        $department = M_products::find($id);
        $department->delete($id);
        echo 1;
        // return redirect('admin/master/product_master')->with('error', 'Data Delete Successfully!!');
    }
    public function test()
    {
        return ("shds");
    }
}
