
<section class="newproduct bgwhite ">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					New Product
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2" style="height: 400px !important;">
				<div class="slick2">
					@foreach($pr_news as $key => $value)
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="<?php echo asset('upload') . '/' .$value['image']?>" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="{{ url('product/'. $value['id'])}}" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<a href="" onclick="addToCart(event,{{$value['id']}})">
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
										</a>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="{{ url('product/'. $value['url '])}}" class="block2-name dis-block s-text3 p-b-5">
									{{$value['name']}}
								</a>

								<span class="block2-price m-text6 p-r-5">
									{{$value['price']}} $
								</span>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>

		</div>
	</section>

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