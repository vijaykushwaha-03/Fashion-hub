<!DOCTYPE html>
<html>
<head>
  <title>Order @if($order) - {{ $order->order_number }} @endif</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .invoice-header {
      background: #f7f7f7;
      padding: 10px 20px;
      border-bottom: 1px solid gray;
    }
    .site-logo {
      margin-top: 20px;
    }
    .invoice-right-top h3 {
      margin-top: 20px;
      color: green;
      font-size: 30px;
      font-family: serif;
    }
    .invoice-left-top {
      border-left: 4px solid green;
      padding-left: 20px;
      padding-top: 20px;
    }
    .invoice-left-top p {
      margin: 0 0 5px 0;
      font-size: 16px;
    }
    thead {
      background: green;
      color: white;
    }
    .authority h5 {
      margin-top: -10px;
      color: green;
    }
    .thanks h4 {
      color: green;
      font-size: 25px;
      font-family: serif;
      margin-top: 20px;
    }
    .site-address p {
      line-height: 1.2;
      font-weight: 300;
    }
    .table td, .table th {
      padding: 0.4rem;
    }
  </style>
</head>
<body>

@if($order)
  <div class="invoice-header d-flex justify-content-between align-items-start">
    <div class="site-logo">
      <img src="{{ asset('backend/img/logo.png') }}" alt="Logo">
    </div>
    <div class="site-address text-right">
      <h4>{{ env('APP_NAME') }}</h4>
      <p>{{ env('APP_ADDRESS') }}</p>
      <p>Phone: <a href="tel:{{ env('APP_PHONE') }}">{{ env('APP_PHONE') }}</a></p>
      <p>Email: <a href="mailto:{{ env('APP_EMAIL') }}">{{ env('APP_EMAIL') }}</a></p>
    </div>
  </div>

  <div class="invoice-description d-flex justify-content-between mt-4">
    <div class="invoice-left-top">
      <h6>Invoice To</h6>
      <h3>{{ $order->first_name }} {{ $order->last_name }}</h3>
      <p><strong>Country:</strong> {{ $order->country }}</p>
      <p><strong>Address:</strong> {{ $order->address1 }} {{ $order->address2 ? ' OR '.$order->address2 : '' }}</p>
      <p><strong>Phone:</strong> {{ $order->phone }}</p>
      <p><strong>Email:</strong> {{ $order->email }}</p>
    </div>
    <div class="invoice-right-top text-right">
      <h3>Invoice #{{ $order->order_number }}</h3>
      <p>{{ $order->created_at->format('D d M Y') }}</p>
    </div>
  </div>

  <section class="order_details pt-4">
    <div class="table-header mb-2">
      <h5>Order Details</h5>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="col-6">Product</th>
          <th class="col-3">Quantity</th>
          <th class="col-3">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->cart_info as $cart)
          <tr>
            <td>{{ $cart->product->title ?? 'N/A' }}</td>
            <td>x{{ $cart->quantity }}</td>
            <td>₹{{ number_format($cart->price, 2) }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <th class="text-right">Subtotal:</th>
          <th>₹{{ number_format($order->sub_total, 2) }}</th>
        </tr>
        <tr>
          <td></td>
          <th class="text-right">Shipping:</th>
          <th>
            ₹{{ number_format($order->shipping->price ?? 0, 2) }}
          </th>
        </tr>
        <tr>
          <td></td>
          <th class="text-right">Total:</th>
          <th>₹{{ number_format($order->total_amount, 2) }}</th>
        </tr>
      </tfoot>
    </table>
  </section>

  <div class="thanks text-center">
    <h4>Thank you for your business !!</h4>
  </div>

  <div class="authority text-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature</h5>
  </div>
@else
  <h5 class="text-danger text-center mt-5">Invalid Order</h5>
@endif

</body>
</html>
