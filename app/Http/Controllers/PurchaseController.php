<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\m_party_supp;
use App\Models\purchase_entrys;
use App\Models\Purchase_details;
use App\Models\M_products;
use App\Models\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use function PHPUnit\Framework\returnSelf;

class PurchaseController extends Controller
{
    public function index()
    {
        $maxValue = purchase_entrys::where("type", "purchase")->orderBy('purchase_no', 'desc')->value('purchase_no');
        $purchase_no = "00" . $maxValue + 1;
        $btnname = "Save";
        $module = "Sale Entry";
        $purchase_date = date('d-m-Y');
        $supplier_data = m_party_supp::all()->where('type', 'supplier');
        $product_data = M_products::all();
        $unit_data = Units::all();
        $purchase_id = 0;
        return view('admin/inventory/purchase_entry', compact('btnname', 'supplier_data', 'product_data', 'unit_data', 'purchase_id', 'purchase_date', 'purchase_no', "module"));
    }
    public function show_data()
    {
        $purchase_entrys = purchase_entrys::all()->where('type', "purchase",);
        $btnName = 'Search';
        $module = 'Purchase  Entery';
        $from_date = date('d-m-Y');
        $to_date = date('d-m-Y');
        $purchase_entrys = m_party_supp::Join('purchase_entrys', function ($join) {
            $join->on('m_party_supp.id', '=', 'purchase_entrys.par_sup_id');
        })->whereNotNull('purchase_entrys.par_sup_id')
            ->get();
        return view('admin/inventory/purchase_details', compact('purchase_entrys', 'btnName', 'from_date', 'to_date', "module"));
    }

    public function save(Request $request)
    {

        // return   $request;
        $request->validate(
            [
                'par_sup_id' => 'required',
                'purchase_no' => 'required',
                'purchase_date' => 'required',
                'purchase_type' => 'required',
            ],
            ['par_sup_id.required' => 'Please Choose Supplier', 'purchase_no.required' => 'Please Enter Purchase No.']
        );

        if ($request->purchase_id == 0) {

            $purchase_data = new purchase_entrys;
            $purchase_data->par_sup_id = $request->par_sup_id;
            $purchase_data->purchase_no = $request->purchase_no;
            $purchase_data->purchase_date = date('Y-m-d', strtotime($request->purchase_date));
            $purchase_data->purchase_type = $request->purchase_type;
            $purchase_data->net_amount = $request->g_total;
            $purchase_data->remark = $request->remark . "";
            $purchase_data->ipaddress = $request->ip();
            // $purchase_data->net_amount = 0;
            $purchase_data->save();
            $lastid =  $purchase_data->id;
            Purchase_details::where('purchase_id', '=', 0)->update(['purchase_id' => $lastid]);

            return redirect('admin/inventory/purchase_entry')->with('success', 'Data Insert Successfully');
        } else {
            $purchase_data = purchase_entrys::find($request->purchase_id);
            $purchase_data->par_sup_id = $request->par_sup_id;
            $purchase_data->purchase_no = $request->purchase_no;
            $purchase_data->purchase_date = date('Y-m-d', strtotime($request->purchase_date));
            $purchase_data->purchase_type = $request->purchase_type;
            $purchase_data->net_amount = $request->g_total;
            $purchase_data->remark = $request->remark . "";
            $purchase_data->ipaddress = $request->ip();
            $purchase_data->update();
            return redirect('admin/inventory/purchase_entry')->with('update', 'Data Update Successfully');
        }
    }

    public function add_data(Request $request)
    {
        // return $request;
        $purchase_details = new Purchase_details;
        $purchase_details->product_id = $request->product_id;
        $purchase_details->unit_name = $request->unit_name;
        $purchase_details->rate = $request->rate;
        $purchase_details->qty = $request->qty;
        $purchase_details->total = $request->total;
        $purchase_details->purchase_id = $request->purchase_id;
        $purchase_details->ipaddress = $request->ip();
        // return $purchase_details;
        $purchase_details->save();
        echo 1;
    }


    // show product/
    public function show_product($id)
    {

        $supplier_data = DB::table('purchase_details')
            ->join('m_product', 'm_product.id', '=', 'purchase_details.product_id')
            ->select('purchase_details.*', 'm_product.product_name')->where('purchase_details.purchase_id', $id)->orderBy('purchase_details.id', 'DESC')
            ->get();

        $data = ["html" => view('admin/inventory/show_record', compact('supplier_data'))->render()];
        return $data;
        return response()->json($data);
    }


    public function delete_purchase($id)
    {
        if ($id != "") {
            // return $id;
            $purchase_details = Purchase_details::whereIn('purchase_id', explode(",", $id))->delete();
            $purchase_entry = purchase_entrys::find($id);
            $purchase_entry->delete($id);
            echo 1;
        }
    }
    public function delete($id)
    {
        // return $id;
        if ($id != "") {
            $department = Purchase_details::find($id);
            $department->delete($id);
            echo 1;
        }
    }

    public function search_purchase(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',

        ]);
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $from_date1 = date('Y-m-d', strtotime($from_date));
        $to_date1 = date('Y-m-d', strtotime($to_date));

        $btnName = 'Search';
        $module = 'Purchase Entry';
        $purchase_entrys = m_party_supp::Join('purchase_entrys', function ($join) {
            $join->on('m_party_supp.id', '=', 'purchase_entrys.par_sup_id');
        })->whereBetween('purchase_date',  array($from_date1, $to_date1))->whereNotNull('purchase_entrys.par_sup_id')->where('type', "purchase")
            ->get();

        // $supplier_name = "";
        return view('admin/inventory/purchase_details', compact('purchase_entrys', 'btnName', 'from_date', 'to_date', "module"));
    }
    public function getunit($id)
    {
        if (!empty($id)) {
            $product_data = M_products::find($id);

            if ($product_data) {
                $unit_data = Units::find($product_data->unit_id);
                $p_data = [
                    "unit_name" => $unit_data ? $unit_data->unit_name : null,
                    "rate" => $product_data->rate
                ];
                return response()->json($p_data);
            }
        }

        // Optional: return error if product not found
        return response()->json(['error' => 'Product not found'], 404);
    }
    public function purchase_edit($id)
    {
        $editData = purchase_entrys::find($id);
        $purchase_no =  $editData->purchase_no;
        $btnname = "Update";
        $allData = [];
        $supplier_data = m_party_supp::all()->where('type', 'supplier');
        $product_data = M_products::all();
        $unit_data = Units::all();
        $purchase_id = $editData->id;
        return view('admin/inventory/purchase_entry', compact('btnname', 'allData', 'supplier_data', 'product_data', 'unit_data', 'purchase_id', 'editData', 'purchase_no'));
    }
    public function add_product(Request $request)
    {
        $count = M_products::where('product_name', $request->product_name)->count();
        if ($count == 0) {
            $product =  new M_products;
            $product->product_name = $request->product_name;
            $product->rate = $request->rate;
            $product->unit_id = $request->unit_id;
            $product->ipaddress = $request->ip();
            $product->save();
            $lastid =  $product->id;
            return  $product_data = M_products::find($lastid);
            echo json_encode($product_data);
        } else {
            return response()->json(['error' => 'Data Already Seved !']);
        }
    }

    public function ajax_edit_product_details(Request $request)
    {
        $purchase_details = Purchase_details::find($request->m_id);
        $purchase_details->product_id = $request->m_product_id;
        $purchase_details->qty = $request->m_qty;
        $purchase_details->rate = $request->m_rate;
        $purchase_details->total = $request->m_total;
        $purchase_details->unit_name = $request->m_unit_name;
        $purchase_details->ipaddress = $request->ip();
        $purchase_details->update();
        echo 1;
    }



    // use Mpdf\Mpdf;

    public function downloadPDF($id)
    {
        $purchase_entries = purchase_entrys::find($id);
        $par_sup_id = $purchase_entries->par_sup_id;

        $company_data = Company::find(1);
        $supplier_data = m_party_supp::find($par_sup_id);



        // return $company_data;

        $purchase_details_data = Purchase_details::join('m_product', function ($join) {
            $join->on('purchase_details.product_id', '=', 'm_product.id');
        })
            ->whereNotNull('purchase_details.product_id')
            ->where('purchase_details.purchase_id', $id)
            ->select(
                'purchase_details.*',
                'm_product.product_name as product_name',
            )
            ->get();

        $total_amount = $purchase_details_data->sum('total');
        // dd($purchase_details_data);
        $suppler_data = ['suppliername' => $par_sup_id];
        $html = view('pdf.invoice', compact('purchase_details_data',  "total_amount", "company_data", "purchase_entries", "supplier_data"))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Download PDF
        return response($mpdf->Output('', 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="invoice.pdf"');
    }
}
