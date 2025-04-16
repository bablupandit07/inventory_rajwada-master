<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\m_party_supp;
use App\Models\M_products;
use App\Models\Purchase_details;
use App\Models\purchase_entrys;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    var $widths;
    var $aligns;
    protected $fpdf;
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }


    public function index($id)
    {

        function convert_number_to_words($number)
        {

            $hyphen      = '-';

            $conjunction = ' and ';

            $separator   = ', ';

            $negative    = 'negative ';

            $decimal     = ' point ';

            $dictionary  = array(

                0                   => 'zero',

                1                   => 'one',

                2                   => 'two',

                3                   => 'three',

                4                   => 'four',

                5                   => 'five',

                6                   => 'six',

                7                   => 'seven',

                8                   => 'eight',

                9                   => 'nine',

                10                  => 'ten',

                11                  => 'eleven',

                12                  => 'twelve',

                13                  => 'thirteen',

                14                  => 'fourteen',

                15                  => 'fifteen',

                16                  => 'sixteen',

                17                  => 'seventeen',

                18                  => 'eighteen',

                19                  => 'nineteen',

                20                  => 'twenty',

                30                  => 'thirty',

                40                  => 'fourty',

                50                  => 'fifty',

                60                  => 'sixty',

                70                  => 'seventy',

                80                  => 'eighty',

                90                  => 'ninety',

                100                 => 'hundred',

                1000                => 'thousand',

                1000000             => 'million',

                1000000000          => 'billion',

                1000000000000       => 'trillion',

                1000000000000000    => 'quadrillion',

                1000000000000000000 => 'quintillion'

            );

            if (!is_numeric($number)) {

                return false;
            }



            if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {

                // overflow

                trigger_error(

                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,

                    E_USER_WARNING

                );

                return false;
            }



            if ($number < 0) {

                return $negative . convert_number_to_words(abs($number));
            }



            $string = $fraction = null;



            if (strpos($number, '.') !== false) {

                list($number, $fraction) = explode('.', $number);
            }



            switch (true) {

                case $number < 21:

                    $string = $dictionary[$number];

                    break;

                case $number < 100:

                    $tens   = ((int) ($number / 10)) * 10;

                    $units  = $number % 10;

                    $string = $dictionary[$tens];

                    if ($units) {

                        $string .= $hyphen . $dictionary[$units];
                    }

                    break;

                case $number < 1000:

                    $hundreds  = $number / 100;

                    $remainder = $number % 100;

                    $string = $dictionary[$hundreds] . ' ' . $dictionary[100];

                    if ($remainder) {

                        $string .= $conjunction . convert_number_to_words($remainder);
                    }

                    break;

                default:

                    $baseUnit = pow(1000, floor(log($number, 1000)));

                    $numBaseUnits = (int) ($number / $baseUnit);

                    $remainder = $number % $baseUnit;

                    $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];

                    if ($remainder) {

                        $string .= $remainder < 100 ? $conjunction : $separator;

                        $string .= convert_number_to_words($remainder);
                    }

                    break;
            }

            if (null !== $fraction && is_numeric($fraction)) {

                $string .= $decimal;

                $words = array();

                foreach (str_split((string) $fraction) as $number) {

                    $words[] = $dictionary[$number];
                }

                $string .= implode(' ', $words);
            }

            return $string;
        }
        // return $id;
        $product_details = Purchase_details::all()->where('purchase_id', $id);
        $purchasedata = purchase_entrys::find($id);
        $purchase_no = $purchasedata->purchase_no;
        $remark = $purchasedata->remark;
        $par_sup_id = $purchasedata->par_sup_id;
        $purchase_date = date('d-m-Y', strtotime($purchasedata->purchase_date));
        $suplier_data = m_party_supp::find($par_sup_id);
        $name = $suplier_data->name;
        $mobile = $suplier_data->mobile;
        $address = $suplier_data->address;

        $company_data = Company::find(1);

        // pdf
        $this->fpdf->SetFont('Arial', 'B', 18);
        $this->fpdf->AddPage("P", 'a4');
        $this->fpdf->SetXY(5, 5);;
        $this->fpdf->Cell(200, 8, ucfirst($company_data->name), 0, 1, 'C');
        $this->fpdf->Rect(5, 5, 200, 287, 'D');
        $this->fpdf->SetFont('Arial', '', 9);
        $this->fpdf->SetX(5);
        $this->fpdf->Cell(200, 5, ucfirst($company_data->address), 0, 1, 'C');
        $this->fpdf->SetFont('Arial', '', 11);
        $this->fpdf->SetX(5);
        $this->fpdf->Cell(200, 5, "Phone:" . $company_data->contact_no . "," . "Email:" . $company_data->email, 0, 1, "C");

        $this->fpdf->SetFont('courier', 'b', 15);

        $this->fpdf->SetX(5);
        $this->fpdf->Cell(200, 7, "PURCHASE ENTRY", 0, 1, 'C');

        $this->fpdf->SetX(5);

        $this->fpdf->SetFont('Helvetica', 'b', 9);

        $this->fpdf->Cell(200, 7, " Purchase Details -", "TB", 1, 'L');

        $this->fpdf->SetFont('Helvetica', '', 9);

        $this->fpdf->Cell(190, 3, "", 0, 1, 'L');

        $this->fpdf->Cell(30, 5, "Purchase No", 0, 0, 'L');

        $this->fpdf->Cell(70, 5, ":" . $purchase_no, 0, 0, 'L');

        $this->fpdf->Cell(30, 5, "Purchase Date", 0, 0, 'L');

        $this->fpdf->Cell(70, 5, ":" . "$purchase_date" . "", 0, 1, 'L');

        $this->fpdf->Cell(30, 5, "Supplier Name", 0, 0, 'L');

        $this->fpdf->Cell(70, 5, ":" . ucfirst($name), 0, 0, 'L');

        $this->fpdf->Cell(30, 5, "Mobile No.", 0, 0, 'L');

        $this->fpdf->Cell(70, 5, ":" . $mobile, 0, 1, 'L');

        $this->fpdf->Cell(30, 5, "Address", 0, 0, 'L');

        $this->fpdf->MultiCell(65, 5, ":" . ucfirst($address));

        $this->fpdf->Ln();
        $this->fpdf->SetX(5);
        $this->fpdf->SetFont('Arial', 'B', 8);
        $this->fpdf->SetFillColor(255, 255, 255); //WHITE
        $this->fpdf->Cell(7, 5, 'Sno', '1', 0, 'L', 1);
        $this->fpdf->Cell(103, 5, 'Product Name', 1, 0, 'L', 1);
        $this->fpdf->Cell(25, 5, 'UNIT', 1, 0, 'C', 1);
        $this->fpdf->Cell(20, 5, 'QTY', 1, 0, 'C', 1);
        $this->fpdf->Cell(20, 5, 'Rate', 1, 0, 'C', 1);
        $this->fpdf->Cell(25, 5, 'TOTALSALE', 1, 1, 'R', 1);
        // $this->SetWidths(array(7, 103, 25, 20, 20, 25));
        // $this->SetAligns(array("L", "L", "C", "C", "C", "R"));
        $sr_no = 1;
        $grand_total = 0;
        foreach ($product_details as $key) {
            $product_dat =   M_products::find($key->product_id);
            $this->fpdf->SetFont('Arial', 'B', 8);
            $this->fpdf->SetX(5);
            $this->fpdf->SetFont('Arial', 'B', 8);
            $this->fpdf->SetFillColor(255, 255, 255); //WHITE
            $this->fpdf->Cell(7, 7, $sr_no++, '1', 0, 'L', 1);
            $this->fpdf->Cell(103, 7,  ucfirst($product_dat->product_name), 1, 0, 'L', 1);
            // $this->fpdf->multiCell(103, 7,  ucfirst($product_dat->product_name), 1, 0, 1);
            $this->fpdf->Cell(25, 7, $key['unit_name'], 1, 0, 'C', 1);
            $this->fpdf->Cell(20, 7, $key['qty'], 1, 0, 'C', 1);
            $this->fpdf->Cell(20, 7, $key['rate'], 1, 0, 'C', 1);
            $this->fpdf->Cell(25, 7, number_format($key['total'], 2), 1, 1, 'R', 1);
            $grand_total += $key['total'];
        }
        $this->fpdf->SetX(5);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(175, 7,  "Net Total", 1, 0, 'L', 0);
        $this->fpdf->Cell(25, 7, number_format($grand_total, 2), 1, 0, 'R', 1);
        $this->fpdf->Ln(7);
        $this->fpdf->SetX(5);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->multiCell(200, 7,  "Remark:-" . $remark, 1, 0);


        $this->fpdf->SetX(5);
        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->Cell(200, 5, 'Total Amount in Words : ' . ucfirst(convert_number_to_words(round($grand_total))) . " Rupees ONLY", 0, 1, 'L', 0);
        $this->fpdf->Output();
        // $this->fpdf->AddPage('P', '');


        exit;
    }
}
