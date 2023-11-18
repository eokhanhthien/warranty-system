<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="vi">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .invoice-title {
            text-align: center;
        }

        .invoice-title h2 {
            font-size: 28px;
            margin: 0;
        }

        .invoice-title h3 {
            font-size: 18px;
            margin: 0;
        }

        .details {
            margin-top: 20px;
        }

        .details > div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .details strong {
            min-width: 150px;
        }

        .order-summary {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        table th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-title">
            <h2>Hóa đơn mua hàng</h2>
            <h3>Order #{{$order->order_code}}</h3>
        </div>
        <div class="details">
            <div>
                <strong>Người đặt:</strong>
                <span>{{$order->name}}</span>
            </div>
            <div>
                <strong>Email:</strong>
                <span>{{$order->email}}</span>
            </div>
            <div>
                <strong>Số điện thoại:</strong>
                <span>{{$order->phone_number}}</span>
            </div>
            <div>
                <strong>Ngày đặt:</strong>
                <span>{{$order->order_date}}</span>
            </div>
            <div>
                <strong>Phương thức thanh toán:</strong>
                <span>{{$order->pay_method}}</span>
            </div>
            <div>
                <strong>Order Date:</strong>
                <span>March 7, 2014</span>
            </div>
        </div>
        <div class="order-summary">
            <h3>Danh sách sản phẩm</h3>
            <table>
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Số lượng</th>
                        <!-- <th class="text-right">Giá/ sản phẩm</th> -->
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ \App\Product::where('id', $item->product_id)->value('name') }}</td>
                        <td class="text-center">{{ \App\Product::where('id', $item->product_id)->value('price') }}</td>
                        <td class="text-center">{{$item->quantity}}</td>
                        <!-- <td class="text-right">{{$item->price}}</td> -->
                    </tr>
                @endforeach

                   
                </tbody>
            </table>
            <div class="totals" style="margin-top: 20px">
                <div>
                    <strong>Shipping:</strong>
                    <span class="text-right">30,000 đ</span>
                </div>
                <div>
                    <strong>Mã giảm giá:</strong>
                    <span class="text-right">{{$order->discount_code?$order->discount_code:"#No_discount"}}</span>
                </div>
            
                <div>
                    <strong>Tổng cộng:</strong>
                    <span class="text-right">{{number_format($order->total_price)}} đ</span>
                </div>
            </div>
        </div>
        <div class="signature">
            <div>
                <strong>Store signature</strong>
                <div style="border-top: 1px solid #000; width: 150px;"></div>
            </div>
        </div>
    </div>
</body>
</html>
