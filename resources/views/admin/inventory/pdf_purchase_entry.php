<?php include("../adminsession.php");



function getinwordsbyindia()

{

   $no = round($number);

   $point = round($number - $no, 2) * 100;

   $hundred = null;

   $digits_1 = strlen($no);

   $i = 0;

   $str = array();

   $words = array(
      '0' => '', '1' => 'one', '2' => 'two',

      '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',

      '7' => 'seven', '8' => 'eight', '9' => 'nine',

      '10' => 'ten', '11' => 'eleven', '12' => 'twelve',

      '13' => 'thirteen', '14' => 'fourteen',

      '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',

      '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',

      '30' => 'thirty', '40' => 'forty', '50' => 'fifty',

      '60' => 'sixty', '70' => 'seventy',

      '80' => 'eighty', '90' => 'ninety'
   );

   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');

   while ($i < $digits_1) {

      $divider = ($i == 2) ? 10 : 100;

      $number = floor($no % $divider);

      $no = floor($no / $divider);

      $i += ($divider == 10) ? 1 : 2;

      if ($number) {

         $plural = (($counter = count($str)) && $number > 9) ? '' : null;

         $hundred = ($counter == 1 && $str[0]) ? 'and ' : null;

         $str[] = ($number < 21) ? $words[$number] .

            " " . $digits[$counter] . $plural . " " . $hundred

            :

            $words[floor($number / 10) * 10]

            . " " . $words[$number % 10] . " "

            . $digits[$counter] . $plural . " " . $hundred;
      } else $str[] = null;
   }

   $str = array_reverse($str);

   $result = implode('', $str);

   $points = ($point) ?

      "." . $words[$point / 10] . " " .

      $words[$point = $point % 10] : '';







   if ($points != '' && $points != '0') {

      $words =  "$result Rupees $points  Paise";
   } else {

      $words =  "$result Rupees ";
   }



   return $words;
}



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

class PDF_MC_Table extends FPDF

{

   var $widths;

   var $aligns;



   function Header()

   {

      global $title1, $title2, $company_name, $gsttinnoc, $mobilec, $emailc, $addressc, $customer_name, $billno, $purchasedate, $gsttinno, $gsttinNno, $cus_code, $gsttinno, $supplier_name, $title3, $title4, $tinno, $tinno, $date, $date1, $supplier_name, $bill_date, $email, $mobile, $address, $branch_name, $project_name, $consultant_name, $branch_head, $branch_mobile, $prepared_by, $remark;



      // $this->Rect(5, 5,140,287,'D');

      //$this->Image("../img/qsepl_logo.jpg", 7, 7, 30, 15);

      //courier 25

      $this->Rect(5, 5, 200, 287, 'D');

      //for first Rect

      // $this->Rect(5, 28, 100, 48, 'D');

      //for second Rect

      // $this->Rect(105, 28, 100, 48, 'D');



      $this->SetFont('Arial', '', 18);

      $this->SetXY(5, 5);

      $this->Cell(200, 8, strtoupper($company_name), 0, 1, 'C');

      $this->SetFont('Arial', '', 9);

      $this->SetX(5);
      $this->Cell(200, 5, ucwords($addressc), 0, 1, 'C');

      $this->SetFont('Arial', '', 11);

      $this->SetX(5);
      $this->Cell(200, 5, "Phone:" . $mobilec . "," . "Email:" . $emailc, 0, 1, "C");

      $this->SetFont('courier', 'b', 15);

      $this->SetX(5);
      $this->Cell(200, 7, "PURCHASE ENTRY", 0, 1, 'C');


      $this->SetX(5);

      $this->SetFont('Helvetica', 'b', 9);

      $this->Cell(200, 7, "      Purchase Details -", "TB", 1, 'L');

      $this->SetFont('Helvetica', '', 9);

      $this->Cell(190, 3, "", 0, 1, 'L');

      $this->Cell(30, 5, "Purchase No", 0, 0, 'L');

      $this->Cell(70, 5, ":" . $billno, 0, 0, 'L');

      $this->Cell(30, 5, "Purchase Date", 0, 0, 'L');

      $this->Cell(70, 5, ":" . $bill_date, 0, 1, 'L');

      $this->Cell(30, 5, "Supplier Name", 0, 0, 'L');

      $this->Cell(70, 5, ":" . $supplier_name, 0, 0, 'L');

      $this->Cell(30, 5, "Mobile No.", 0, 0, 'L');

      $this->Cell(70, 5, ":" . $mobile, 0, 1, 'L');

      $this->Cell(30, 5, "Address", 0, 0, 'L');

      $this->MultiCell(65, 5, ":" . $address);

      $this->Ln();
      $this->SetX(5);
      $this->SetFont('Arial', 'B', 8);
      $this->SetFillColor(255, 255, 255); //WHITE
      $this->Cell(7, 5, 'Sno', '1', 0, 'L', 1);
      $this->Cell(103, 5, 'Product Name', 1, 0, 'L', 1);
      $this->Cell(25, 5, 'UNIT', 1, 0, 'C', 1);
      $this->Cell(20, 5, 'QTY', 1, 0, 'C', 1);
      $this->Cell(20, 5, 'Rate', 1, 0, 'C', 1);
      $this->Cell(25, 5, 'TOTALSALE', 1, 1, 'R', 1);
      $this->SetWidths(array(7, 103, 25, 20, 20, 25));
      $this->SetAligns(array("L", "L", "C", "C", "C", "R"));
      $this->SetFont('Arial', 'B', 8);
      $this->SetX(5);
   }

   // Page footer

   function Footer()

   {

      global $company_name, $prepared_by;

      // Position at 1.5 cm from bottom

      $this->SetY(-11);

      // Arial italic 8

      $this->SetFont('Arial', 'I', 8);

      // Page number

      $this->SetX(5);

      $this->MultiCell(200, 5, '', 0, 'C');



      //$pdf->Ln(71);

      $this->SetY(-30);

      $this->SetX(143);

      $this->SetFont('Arial', 'B', 9);

      $this->Cell(143, 5, 'Prepared by: ' . $prepared_by, 0, 1, 'L', 0);



      $this->SetX(5);

      $this->SetFont('Arial', 'b', 8);

      $this->SetTextColor(0, 0, 0);

      $this->Cell(195, 5, "For :" . " " . $company_name, 0, '1', 'R', 0);
   }

   function SetWidths($w)

   {

      //Set the array of column widths

      $this->widths = $w;
   }

   function SetAligns($a)

   {

      //Set the array of column alignments

      $this->aligns = $a;
   }

   function Row($data)

   {

      //Calculate the height of the row

      $nb = 0;

      for ($i = 0; $i < count($data); $i++)

         $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));

      $h = 8 * $nb;

      //Issue a page break first if needed

      $this->CheckPageBreak($h);

      //Draw the cells of the row

      for ($i = 0; $i < count($data); $i++) {

         $w = $this->widths[$i];

         $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

         //Save the current position

         $x = $this->GetX();

         $y = $this->GetY();

         //Draw the border

         $this->Rect($x, $y, $w, $h);

         //Print the text

         $this->MultiCell($w, 8, $data[$i], 0, $a);

         //Put the position to the right of the cell

         $this->SetXY($x + $w, $y);
      }

      //Go to the next line

      $this->Ln($h);
   }

   function CheckPageBreak($h)

   {

      //If the height h would cause an overflow, add a new page immediately

      if ($this->GetY() + $h > $this->PageBreakTrigger)

         $this->AddPage($this->CurOrientation);
   }



   function NbLines($w, $txt)

   {

      //Computes the number of lines a MultiCell of width w will take

      $cw = &$this->CurrentFont['cw'];

      if ($w == 0)

         $w = $this->w - $this->rMargin - $this->x;

      $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;

      $s = str_replace("\r", '', $txt);

      $nb = strlen($s);

      if ($nb > 0 and $s[$nb - 1] == "\n")

         $nb--;

      $sep = -1;

      $i = 0;

      $j = 0;

      $l = 0;

      $nl = 1;

      while ($i < $nb) {

         $c = $s[$i];

         if ($c == "\n") {

            $i++;

            $sep = -1;

            $j = $i;

            $l = 0;

            $nl++;

            continue;
         }

         if ($c == ' ')

            $sep = $i;

         $l += $cw[$c];

         if ($l > $wmax) {

            if ($sep == -1) {

               if ($i == $j)

                  $i++;
            } else

               $i = $sep + 1;

            $sep = -1;

            $j = $i;

            $l = 0;

            $nl++;
         } else

            $i++;
      }

      return $nl;
   }
}


function GenerateWord()
{

   //Get a random word

   $nb = rand(3, 10);

   $w = '';

   for ($i = 1; $i <= $nb; $i++)

      $w .= chr(rand(ord('a'), ord('z')));

   return $w;
}



function GenerateSentence()

{

   //Get a random sentence

   $nb = rand(1, 10);

   $s = '';

   for ($i = 1; $i <= $nb; $i++)

      $s .= GenerateWord() . ' ';

   return substr($s, 0, -1);
}

$pdf = new PDF_MC_Table();

$title1 = "PURCHASE INVOICE";



$pdf->SetTitle($title1);



$pdf->AliasNbPages();

$pdf->AddPage('P', 'A4');

$slno = 1;

$nettotal_amt  = 0;



$res = $obj->executequery("Select * from purchase_details where purchaseid='$purchaseid'");

foreach ($res as $row_get) {
   //    $unit_name = 0;

   //    $transport_charge = 0;

   //    $unit_name = $row_get['unit_name'];

   $product_id = $row_get['product_id'];

   $prodname = $obj->getvalfield("m_product", "product_name", "product_id='$product_id'");

   $unit_name = $row_get['unit'];

   $qty = $row_get['qty'];

   $rate = $row_get['rate'];
   $total_amt = $row_get['total_amt'];







   $pdf->SetX(5);

   $pdf->SetFont('Arial', '', 8);

   $pdf->SetTextColor(0, 0, 0);

   $pdf->Row(array($slno++, strtoupper($prodname), strtoupper($unit_name), $qty, number_format($rate, 2), number_format(round($total_amt), 2)));

   $nettotal_amt += $total_amt;
}



$pdf->SetX(5);

$pdf->SetFont('Arial', 'B', 9);

$pdf->SetFillColor(255, 255, 255); //WHITE

//$pdf->SetTextColor(0,0,0);

$pdf->Cell(175, 7, 'NET TOTAL', '1', 0, 'L', 1);

$pdf->Cell(25, 7, number_format(round($nettotal_amt), 2), 1, 1, 'R', 1);



$pdf->SetX(5);

$pdf->SetFont('Arial', 'B', 9);

$pdf->SetFillColor(255, 255, 255); //WHITE

//$pdf->SetTextColor(0,0,0);

$pdf->Cell(200, 7, 'REMARKS : ' . $remark, 1, 0, 'L', 1);

$pdf->Ln(7);

$pdf->SetX(5);

$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(200, 5, 'Total Amount in Words : ' . ucfirst(convert_number_to_words(round($nettotal_amt))) . " Rupees ONLY", 0, 1, 'L', 0);

// $pdf->Ln(71);

// $pdf->SetX(143);

// $pdf->SetFont('Arial','B',9);

// $pdf->Cell(143,5,'Prepared by: '.$prepared_by,0,1,'L',0);

$pdf->Output();

?>



<?php

mysqli_close($db_link);



?>
