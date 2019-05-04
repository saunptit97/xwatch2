@extends('frontend.index');

@section('content')
<style>
	.checkout label{
	    color: #fff;
	    background: #1979c3;
	    width: 100%;
	    /* height: 50px; */
	    padding: 15px;
	    text-transform: uppercase;
	    font-size: 16px;
	    margin-bottom: 20px;
	}
</style>
<script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<section class="checkout bgwhite p-t-70 p-b-100">
		<div class="container">
			<form method="POST" id="form-checkout" action="/process-checkout">
				{{ csrf_field() }}
				<div class="row">
				<div class="col-md-6 p-b-30 checkout">
					<label><i class="fa fa-home"></i> Shipping address</label>
					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" required type="text" name="email" id="email" placeholder="Email address">
					</div>
					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" required  type="text" name="fullname" id="fullname" placeholder="Full Name">
					</div>
					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" required  type="text" name="phone" id="phone" placeholder="Phone">
					</div>
					<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" required type="text" name="address" id="address" placeholder="Address">
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="checkout">
						<label><i class="fa fa-check-square"></i> ORDER SUMMARY</label>
						<ul class="header-cart-wrapitem">
							<?php $total  = 0; ?>
							@foreach($cart as $product)
							<li class="header-cart-item">
								<div class="header-cart-item-img">
									<img src="{{ asset('upload/' .$product->options->image)}}" alt="IMG" width="100" height="150">
								</div>

								<div class="header-cart-item-txt">
									<a href="#" class="header-cart-item-name">
										{{$product->name}}
									</a>

									<span class="header-cart-item-info">
										{{$product->qty}} x {{$product->price}} $
									</span>
								</div>
							</li>	
							<?php $total  += $product->qty * $product->price?>
							@endforeach
						</ul>

					

							
					</div>
					<div class="method">
						<label><i class="fa fa-check-square"></i> Method</label>
						<select name="method"  class="form-control">
							<option value="0">Paym ent on delivery</option>
							<option value="1">Payment on Paypal</option>
						</select>
					</div>
					<div class="header-cart-total">
							<input type="hidden" name="total" value="{{$total}}" />Total: <?php echo $total ?> $
						</div> 
					<div class="header-cart-buttons">
						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<button type="submit" id="checkout-submit"  class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								<!-- <button type="submit" id="checkout-submit" onclick="processCheckOut(event)"  class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4"> -->
								Proceed To CheckOut
							</button>
						</div>
					</div>
				
				</div>
			</div>
				
			</form>
		</div>
	</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		<?php if(isset($user)) : ?>
		$("#email").val("<?php echo $user->email ?>");
		$("#address").val("<?php echo $user->address ?>");
		$("#fullname").val("<?php echo $user->fullname ?>");
		$("#phone").val("<?php echo $user->phone ?>")
		<?php endif?>
		$('select').on('change', function () {
			var selectedValue = this.selectedOptions[0].value;
			if(selectedValue == 1){
				$("#form-checkout").attr("action", "/paypalpost");
			}else{
				$("#form-checkout").attr("action", "/process-checkout");
			}
		});
	});
	
	function processCheckOut(event){
		event.preventDefault();

		// $.ajax({
		// 	url: '/process-checkout',
		// 	type: 'json',
		// 	method: 'POST',
		// 	data: $("#form-checkout").serialize(),
		// 	success: function(response){
		// 		if(response['errors']){
		// 			var error = "";
                    
        //             $.each(response['errors'] , function(key, value){
        //                 $("." + key).addClass('has-error');
        //                 error += response['errors'][key];
        //             });
        //             sweetAlert(error, "Something went wrong!", "error");
		// 		}
		// 		else{
		// 			swal("we will contact to you soon. thanks about your purchase", "", "success")
        //             .then((value) => {
        //                 window.location.href = "/";
        //             });
		// 		}
		// 	}
		// })
		// .done(function() {
		// 	console.log("success");
		// })
		// .fail(function() {
		// 	console.log("error");
		// })
		// .always(function() {
		// 	console.log("complete");
		// });
		
	}
	
</script>