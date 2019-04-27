<style type="text/css">
	
	.header-cart-item-img img{
		width: 50px !important;
		height: 80px !important;
	}
	#login-social , #register-social{
			float:right;
		}
        .content input{
            width: 100%;
            margin: 5px 0px 10px 0px;
          
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #3399cc;
            border-radius: 1px;
            font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;
            font-size: 14px;
            height: 32px;
            line-height: 1.42857143;
            padding: 0 9px;
            vertical-align: baseline;
            width: 100%;
            box-sizing: border-box;
        }
        .content button{
            background: #3399cc;
            color: #fff;
            height:30px;
            border: 0;
            border-color: #3399cc;
            padding: 0 17px;
            margin-right: 20px;
            margin-bottom: 10px;
        }
        .modal-header{
            background: #3399cc;
            color: #fff;
        }
        .modal-header h4{
            text-transform: uppercase;
            font-size: 20px;
        }
        .modal-body{
            padding: 20px;
        }
        .required{
            color:red;
        }
        .block-title{
            padding-bottom: 10px;
            border-bottom: 1px #ddd solid;
            margin-bottom: 10px;
        }
        .btn-danger{
            background: #ac2925 !important;
        }
</style>
<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
				</div>

				<span class="topbar-child1">
					Free shipping for standard order over 100.000 đ
				</span>

				<div class="topbar-child2">
					<span class="topbar-email">
						saunt@mageplaza.com
					</span>

					<div class="topbar-language rs1-select2">
						<select class="selection-1" name="time">
							<option>VND</option>
							<option>EUR</option>
						</select>
					</div>
				</div>
			</div>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="index.html" class="logo">
					<img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="/" class="active">Home</a>
							</li>

							<li>
								<a href="product.html">Shop</a>
								<ul class="sub_menu">
									@foreach($categories as $key => $value)
									<li><a href="{{ url('type/'. $value['slug'] ) }}"><?php echo $value['name']?></a></li>
									@endforeach
								</ul>
							</li>

						

							<li>
								<a href="brands">Brands</a>
								<ul class="sub_menu">
									@foreach($brands as $key => $value)
									<li><a href="{{ url('/brand/' . $value['name']) }}"><?php echo $value['name']?></a></li>
									@endforeach
								</ul>
							</li>
							<li>
								<a href="#">About</a>
							</li>
							<li>
								<a href="#">Contact</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				
<!-- Modal -->

				<div class="header-icons">
					
						<?php if(Session::get('user')): ?>
							
							<a href="/customer/account" class="header-wrapicon1 dis-block"><img src="{{Session::get('user')->image}}" class="header-icon1" alt="ICON" style="-webkit-border-radius: 50%"></a>
						<?php else: ?>
							<a href="#" class="header-wrapicon1 dis-block" data-toggle="modal" data-target="#myModal">
								<img src="{{asset('images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
							</a>
						<?php endif
						?>
					
					
					<span class="linedivide1"></span>

					<div class="header-wrapicon2">	
						 <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON" >		
							<span class="header-icons-noti">{{ Cart::count() }}</span>
						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
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
											{{$product->qty}} x {{$product->price}} đ
										</span>
									</div>
								</li>	
								<?php $total  += $product->qty * $product->price?>
								@endforeach
							</ul>

							<div class="header-cart-total">
								Total: <?php echo $total ?> đ
								
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="/cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="/checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="gridSystemModalLabel">Sign In</h4>
						</div>
						<div class="modal-body row">
							<div class="col-md-6">
								<div class="block-title">
									<span>Sign In</span>
								</div>
								<div class="content">
									<!-- <form class="form-customer-login" id="social-form-login" method="POST" > -->
										<span class="message"></span>
										<label>Username:</label> <span class="required"> *</span></br>
										<input type="text" name="username" id="email" required style="border: 1px solid #3399cc !important"/> </br>
										<label>Password</label><span class="required"> *</span></br>
										<input type="password" name="password" required id="pass" style="border: 1px solid #3399cc !important">
										<button type="submit" id="bnt-social-login-authentication" class="action login primary">Login</button>
										<a href="#" id="forgot-popup">Forgot your password?</a>
										<a href="#" id="create-popup" class="create">Create new account?</a>
								<!--    </form> -->
								</div> 
							</div>
							<div class="col-md-6">
								<div class="block-title">
									<span>Or Sign In With</span>
									
								</div>
								<div class="content">
									<a href="auth/google"><button  style="background: red !important;color: #fff;">Login with google </button></a>
								</div>
							</div>
						</div>
						
					</div>
					
					</div>
				</div>
				<div>
							
				</div>

				
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="{{ asset('images/icons/logo.png')}}" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="{{ asset('images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<img src="{{ asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">0</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								@foreach($cart as $product)
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{ asset('upload/' .$product->options->image)}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											{{$product->name}}
										</a>

										<span class="header-cart-item-info">
											{{$product->qty}} x {{$product->price}} đ
										</span>
									</div>
								</li>

								@endforeach
							</ul>

							<div class="header-cart-total">
								Total: $75.00
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="/cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								fashe@example.com
							</span>

							<div class="topbar-language rs1-select2">
								<select class="selection-1" name="time">
									<option>USD</option>
									<option>EUR</option>
								</select>
							</div>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="index.html">Home</a>
						<ul class="sub-menu">
							<li><a href="index.html">Homepage V1</a></li>
							<li><a href="home-02.html">Homepage V2</a></li>
							<li><a href="home-03.html">Homepage V3</a></li>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>

					<li class="item-menu-mobile">
						<a href="product.html">Shop</a>
					</li>
				</ul>
			</nav>
		</div>
		
		<script type="text/javascript">
  
			function PopupCenter(pageURL, title,w,h) {
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);
			var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
			return targetWin;
			} 
			$('.alert').fadeOut(5000);
</script>
</div>
	</header>

<script>
	// $(".dis-block").click(function(){
	// 	$(".social-login ").show();
	// })
</script>