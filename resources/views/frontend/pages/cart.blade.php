@extends('frontend.index')
@section('content')	
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart table-hover">
						<tr class="table-head">
							<th class="column-1">#</th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<th class="column-4 p-l-70">Quantity</th>
							<th class="column-4">Total</th>
							<th class="column-1">Delete</th>
						</tr>
						
						@foreach($products as $product)
						<tr class="table-row" id="{{$product->rowId}}">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="{{asset('upload/' . $product->options->image) }}" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2">{{$product->name}}</td>
							<td class="column-3" id="price-{{$product->rowId}}">{{$product->price}} $</td>
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" onclick="minusQty(event, '{{$product->rowId}}')">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" name="num-product2" value="{{$product->qty}}" onchange="changeQty(event, '{{$product->rowId}}')" id="qty-{{$product->rowId}}"/>

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" onclick="plusQty(event, '{{$product->rowId}}')">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5" id="total-{{$product->rowId}}">{{ $product->price * $product->qty}} $</td>
							<td><a href="#" onclick="deleteCart(event, '{{$product->rowId}}', this)"><i class="fa fa-times" aria-hidden="true"></i></a></td>
						</tr>
						@endforeach
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Total:</td>
							<td id="total">{{$total}} $</td>
						</tr>
					</table>

				</div>
			

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Apply coupon
						</button>
					</div>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" onclick="destroyCart(event)">
						Delete Cart
					</button>
				</div>
				<div class="size10 trans-0-4">
					<a href="/checkout">	<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Proceed to Checkout
						</button>
					</a>
				</div>

			</div>
		</div>
	</section>
@endsection

<script type="text/javascript">
	function plusQty(event, id){
		event.preventDefault();
        var numProduct = $("#qty-" + id).val();
		$("#qty-" + id).val(parseInt(numProduct) + 1);
		this.process(id);
		
	}
	function minusQty(event, id){
		event.preventDefault();
        var numProduct = $("#qty-" + id).val();
        if(numProduct > 1){
        	$("#qty-" + id).val(parseInt(numProduct) - 1);	
        }
		this.process(id);
	
	}
	function changeQty(event, id){
		event.preventDefault();
		this.process(id);
	}

	function process(id){
		var url = "/update-cart/" + id;
		var qty = $("#qty-" + id).val();
		var price = $("#price-" +id).html();
		var self = $(this);
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			data:{'qty' : qty},
			success: function(response){
				$("#total-" + id).html(qty * price);
				$("#total").html(response.total + " đ");
				$(".header-icons-noti").html(response.count);
				$(".header-cart-wrapitem").html(response.content);
				$(".header-cart-total").html(response.total + 'đ');
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
			
	}
	function deleteCart(event, id, btn){
		event.preventDefault();
		var row = btn.parentNode.parentNode;
  		row.parentNode.removeChild(row);
  		var url = "delete-cart/" + id;
  		$.ajax({
			url: url,
			type: 'GET',
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
	function destroyCart(event){
		event.preventDefault();
		$.ajax({
			url: 'destroy-cart',
			type: 'GET',
			success: function(){
				$(".table-shopping-cart").children().remove();
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
</script>