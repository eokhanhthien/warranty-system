<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Mpdf\Mpdf;
use \Mpdf\Output\Destination;
use App\Order;
use App\OrderItem;

class PDFInvoiceController extends Controller
{
    public function orderInvoice(Request $request, $id)
    {
        $order = Order::find($id);
        $items = OrderItem::where('order_id',$id )->get();

        $data = [
            'order' => $order,
            'items' => $items,
        ];
        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('admin.order.invoice', $data));
        $mpdf->Output('example.pdf', Destination::INLINE);
    }
}
