<!DOCTYPE html>
<html>
<head>
	<title>Delivery Slip</title>
	<link rel="stylesheet" type="text/css" href="css/delivery-slip.css">
</head>
<body>
	@foreach ($orders as $index => $order)
		<div class="header">
			<div class="logo">
				<img src="img/decathlon-logo-main.jpg" alt="">
			</div>
			<div class="title">
				<div class="name">DELIVERY</div>
				<div class="date">2019-07-01</div>
				<div class="order-number">#DE030310</div>
			</div>
		</div>

		<div class="delivery">
			<div class="details">
				<div class="title">Delivery Address</div>
				<div class="content">
					<div class="customer">J.R. Jabillo</div>
					<div class="address">Blk13 L11 Bulgaria St., Town and Country Southville, Laguna, Binan 4024, Philippines</div>
					<div class="contact">09152832397</div>
				</div>
				
			</div>
			<div class="order">
				<div class="title">Order Details</div>
				<div class="content">
					
					<table class="order-details">
						<tr>
							<td>Order Reference</td>
							<td>{{$order->reference}}</td>
						</tr>
						<tr>
							<td>Order ID</td>
							<td>90745</td>
						</tr>
						<tr>
							<td>Order Date</td>
							<td>2019-07-01</td>
						</tr>
						<tr>
							<td>Delivery Method</td>
							<td>Ninja Van (D) - Standard Delivery - Mega Manila</td>
						</tr>
						<tr>
							<td>Delivery Amount</td>
							<td>PHP150.00</td>
						</tr>
						<tr>
							<td>Payment Method</td>
							<td>Cash on delivery (COD)</td>
						</tr>
						<tr>
							<td>Total Amount</td>
							<td>PHP750.00</td>
						</tr>
						<tr>
							<td>Number of Articles</td>
							<td>4</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="articles">
			<table>
				@foreach ($order->order_details as $orderDetails)
				<tr>
					<td colspan=3 class="product-head">{{ ($orderDetails->product_category) ? $orderDetails->product_category->name : '' }}</td>
				</tr>
				<tr>
					<td style="text-align: center;">
						<img width=100 height=100 src="{{$orderDetails->image_path}}" alt="">
					</td>
					<td>
						<div>Name: {{$orderDetails->product_name}}</div>
						<div>{{$orderDetails->name}}</div>
						<div>Model: {{$orderDetails->name}}</div>
						<div>Reference: {{$orderDetails->name}}</div>
					</td>
					<td>
						<div>Price</div>
						<div>Quantity</div>
						<div>30 on Stock*</div>
						<div>Estimated store stock</div>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		@if ($index !== (count($orders) - 1))
			<footer>
				<div>An electronic version of this invoice is available in your account. To access it, log in to our website using your e-mail address and password (which you created when placing your first order).</div>
				<div>Decathlon - Metro Manila - Philippines</div>
				<div>DECATHLON PILIPINAS</div>
			</footer>
        	<div class="page-break"></div>
    	@endif
	@endforeach
</body>
</html>