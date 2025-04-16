<html>

<head>
    <title> INVOICE</title>
</head>

<body>
    <div style="max-width:600px; margin: 0 auto; background-color:#ffffff; padding: 20px; border-radius: 8px;">

        <!-- Header -->
        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 30px;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <img src="https://trinitysolutions.in/img/logo.png" width="200" height="45" alt="logo" />


                </td>
                <td style="width: 50%; text-align: right; vertical-align: top;">
                    <h2 style="color: #ff0000; margin: 0;">Purchase Invoice</h2>
                    <p style="font-size: 12px; color: #5b5b5b;">Purchase No. #{{$purchase_entries->purchase_no}}<br />{{ date('d M Y', strtotime($purchase_entries->purchase_date)) }}
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size: 14px; color: #5b5b5b;">{{$company_data->name}}<br />{{$company_data->number}},{{$company_data->email}} <br>
                        {{$company_data->address}}
                    </p>
                </td>
            </tr>
        </table>

        <!-- Order Details -->
        <table width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; margin-bottom: 20px;">
            <tr style="background-color: #f7f7f7;">
                <th align="left" style="font-size: 12px;">Item</th>
                <th align="left" style="font-size: 12px;">Unit</th>
                <th align="left" style="font-size: 12px;">Price</th>
                <th align="center" style="font-size: 12px;">Qty</th>
                <th align="right" style="font-size: 12px;">Subtotal</th>
            </tr>

            @foreach($purchase_details_data as $data)
            <tr>
                <td style="font-size: 12px; color: #ff0000;">{{$data->product_name}}</td>
                <td style="font-size: 12px; ">{{$data->unit_name}}</td>
                <td style="font-size: 12px;">{{$data->rate}}</td>
                <td align="center" style="font-size: 12px;">{{$data->qty}}</td>
                <td align="right" style="font-size: 12px;">{{$data->total}}</td>
            </tr>

            @endforeach

        </table>

        <!-- Totals -->
        <table width="100%" cellpadding="5" cellspacing="0" style="margin-bottom: 20px;">
            <tr>
                <td align="right" style="font-size: 12px;">Subtotal:</td>
                <td align="right" style="font-size: 12px;">{{$total_amount}}</td>
            </tr>
            <!-- <tr>
                <td align="right" style="font-size: 12px;">Shipping & Handling:</td>
                <td align="right" style="font-size: 12px;">$15.00</td>
            </tr> -->
            <!-- <tr>
                <td align="right" style="font-size: 12px; font-weight: bold;">Grand Total (Incl. Tax):</td>
                <td align="right" style="font-size: 12px; font-weight: bold;">$344.90</td>
            </tr>
            <tr>
                <td align="right" style="font-size: 12px; color: #999;">TAX:</td>
                <td align="right" style="font-size: 12px; color: #999;">$72.40</td>
            </tr> -->
        </table>

        <!-- Billing & Payment Info -->
        <table width="100%" cellpadding="5" cellspacing="0" style="margin-bottom: 10px;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <p style="font-size: 11px;"><strong>BILLING INFORMATION</strong></p>
                    <p style="font-size: 12px;">{{ $supplier_data->name}}<br />{{ $supplier_data->mobile}}, {{ $supplier_data->email}}<br />{{ $supplier_data->address}}</p>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <p style="font-size: 11px;"><strong>PAYMENT METHOD</strong></p>
                    <p style="font-size: 12px;">Credit Card<br />Visa<br />Transaction ID: 4185939336</p>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>