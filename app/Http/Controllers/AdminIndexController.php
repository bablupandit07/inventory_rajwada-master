<?php

namespace App\Http\Controllers;

use App\Models\m_party_supp;
use App\Models\M_products;
use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    public function show()
    {
        $total_party = m_party_supp::where('type', 'party')->count();
        $total_supplier = m_party_supp::where('type', 'supplier')->count();
        $total_product = M_products::count();

        return view('admin/index', compact('total_party', 'total_supplier', 'total_product'));
    }
}
