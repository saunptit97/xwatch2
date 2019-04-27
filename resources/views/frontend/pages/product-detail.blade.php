@extends('frontend.index')
@section('content')

	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
						<div class="item-slick3" data-thumb="{{ asset('upload/'.$product['image'])}}">
							<div class="wrap-pic-w">
								<img src="{{ asset('upload/'.$product['image'])}}" alt="IMG-PRODUCT">
							</div>
						</div>

						<!-- <div class="item-slick3" data-thumb="images/thumb-item-02.jpg">
							<div class="wrap-pic-w">
								<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">
							</div>
						</div>

						<div class="item-slick3" data-thumb="images/thumb-item-03.jpg">
							<div class="wrap-pic-w">
								<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">
							</div>
						</div> -->
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					{{ $product['name']}}
				</h4>

				<span class="m-text17">
					{{ $product['price'] }} đ
				</span>

				<p class="s-text8 p-t-10">
					{{ $product['description'] }}
				</p>

				<!--  -->
				
				<div class="p-b-45">
					<div><a href="{{url('brand/' . $brand['name'])}}"><img src="{{ asset('upload/' .$brand['image'])}}" width="100"></a></div>
					</br>
					<span class="s-text8 m-r-35">SKU: {{$product['id']}}</span></br>
				</div>
				<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
					
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" onclick=" return addToCart(event, {{$product['id']}})">
						Add to Cart
					</button>
				</div>
				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Description
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							{{$product['description']}}
							
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Additional information
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Reviews (0)
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
<script type="text/javascript">
	function addToCart(event, id){
		
		event.preventDefault();
		var url = '/add-to-cart/' + id;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function(response){
				swal("Add to cart successfully!", "You clicked the button!", "success");
				var qty =  parseInt($(".header-icons-noti").html());
				$(".header-icons-noti").html(qty + 1);
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
</script>