<?php

namespace App\Http\Controllers;

use App\Models\m_party_supp;
use App\Models\M_products;
use App\Models\purchase_entrys;
use App\Models\Units;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    function index()
    {

        $maxValue = purchase_entrys::where("type", "sale")->orderBy('purchase_no', 'desc')->value('purchase_no');
        $purchase_no = "00" . $maxValue + 1;
        $module = "Sale Entry";
        $btnname = "Save";
        $purchase_date = date('d-m-Y');
        $supplier_data = m_party_supp::all()->where('type', 'party');
        $product_data = M_products::all();
        $unit_data = Units::all();
        $purchase_id = 0;
        return view('admin/inventory/sale_entry', compact('btnname', 'supplier_data', 'product_data', 'unit_data', 'purchase_id', 'purchase_date', 'purchase_no', 'module'));
    }
}
