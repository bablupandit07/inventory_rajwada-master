{{-- {{ $supplier_data }} --}} @php $i = 1;
$net_amount = 0;
@endphp
@foreach ($supplier_data as $item)
    <tr id="pid{{ $item->id }}">
        <td>{{ $i++ }}</td>
        <td>{{ $item->product_name }}</td>
        <td>{{ $item->unit_name }}</td>
        <td>{{ number_format($item->rate, 2) }}</td>
        <td>{{ $item->qty }}</td>
        <td style="text-align: right">{{ number_format($item->total, 2) }}</td>

        <td class="text-center">
            <button type="button"
                onclick="show_product('{{ $item->id }}','{{ $item->product_id }}','{{ $item->unit_name }}','{{ $item->rate }}','{{ $item->qty }}','{{ $item->total }}')"
                class="btn btn-sm btn-outline-success"><i class="bi bi-pencil-square"> </i></button>
        </td>
        <td style="text-align: center"><button type="button" onclick="fundel({{ $item->id }})"
                class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>
        </td>
    </tr>
    @php($net_amount += $item->total)
@endforeach
</tbody>
<tr>
    <input type="hidden" name="g_total" id="g_total" value="{{ $net_amount }}">
    <td colspan="5"><strong> Total </strong></td>
    <td style="text-align: right;"><strong>{{ number_format($net_amount, 2) }}</strong>
    </td>

</tr>
