<?php
use App\Section;
use Illuminate\Support\Facades\Auth;

$sections = Section::section();
?>

<!-- Begin Header Top Area -->
<div class="header-top">
	<div class="container">
		<div class="row">
			<!-- Begin Header Top Left Area -->
			<div class="col-lg-3 col-md-4">
				<div class="header-top-left">
					<ul class="phone-wrap">
						<li><span>Telephone Enquiry:</span><a href="#">(+880) 178 499 6428</a></li>
					</ul>
				</div>
			</div>
			<!-- Header Top Left Area End Here -->
			<!-- Begin Header Top Right Area -->
			<div class="col-lg-9 col-md-8">
				<div class="header-top-right">
					<ul class="ht-menu">
						<!-- Begin Setting Area -->
						@if(Auth::check())
							<li>
								<div class="ht-setting-trigger"><span>{{ Auth::user()->name }}</span></div>
								<div class="setting ht-setting">
									<ul class="ht-setting-list">
										<li><a href="{{ url('account') }}">My Account</a></li>
										<li><a href="{{ url('orders') }}">My Orders</a></li>
										<li><a href="{{ url('logout') }}">Sign Out</a></li>
									</ul>
								</div>
							</li>
						@else
							<li>
								<ul class="phone-wrap">
									<li><a href="{{ url('login-register') }}">Sign In</a></li>
								</ul>
							</li>
							<li>
								<ul class="phone-wrap">
									<li><a href="{{ url('login-register') }}">Register</a></li>
								</ul>
							</li>
						@endif
						<!-- Begin Language Area -->
						<li>
							<span class="language-selector-wrapper">Language :</span>
							<div class="ht-language-trigger"><span>English</span></div>
							<div class="language ht-language">
								<ul class="ht-setting-list">
									<li class="active"><a href="#"><img src="{{ asset('utils-front/images/menu/flag-icon/1.jpg') }}" alt="">English</a></li>
									<li><a href="#"><img src="{{ asset('utils-front/images/menu/flag-icon/2.jpg') }}" alt="">Français</a></li>
								</ul>
							</div>
						</li>
						<!-- Language Area End Here -->
					</ul>
				</div>
			</div>
			<!-- Header Top Right Area End Here -->
		</div>
	</div>
</div>
<!-- Header Top Area End Here -->
<!-- Begin Header Middle Area -->
<div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
	<div class="container">
		<div class="row">
			<!-- Begin Header Logo Area -->
			<div class="col-lg-3">
				<div class="logo pb-sm-30 pb-xs-30">
				<a href="{{ url('/') }}">
						<img src="{{ asset('utils-front/images/menu/logo/1.jpg') }}" alt="">
					</a>
				</div>
			</div>
			<!-- Header Logo Area End Here -->
			<!-- Begin Header Middle Right Area -->
			<div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
				<!-- Begin Header Middle Searchbox Area -->
				<form action="#" class="hm-searchbox">
					<select class="nice-select select-search-category">
						<option value="0">All</option>                         
						<option value="10">Men</option>                     
						<option value="17">- -  T-shirts</option>                    
						<option value="20">- - - -  Formal T-shirts</option>                     
						<option value="21">- - - -  Casual T-shirts</option>                                                    
						<option value="11">Woman</option>                  
						<option value="42">- -  Tops</option>                        
						<option value="45">- - - -  Boxy top</option>                     
						<option value="47">- - - -  Batwing top</option>                                                                  
						<option value="42">- -  Salwar</option>                                                                
						<option value="42">- -  T-shirts</option>                                                                
						<option value="12">Kids</option>                  
						<option value="66">- -  Shirt</option>                     
						<option value="66">- -  Pants</option>                     
						<option value="66">- -  Shoes</option>                     
					</select>
					<input type="text" placeholder="Enter your search key ...">
					<button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
				</form>
				<!-- Header Middle Searchbox Area End Here -->
				<!-- Begin Header Middle Right Area -->
				<div class="header-middle-right">
					<ul class="hm-menu">
						<!-- Begin Header Middle Wishlist Area -->
						<!-- <li class="hm-wishlist">
							<a href="wishlist.html">
								<span class="cart-item-count wishlist-item-count">0</span>
								<i class="fa fa-heart-o"></i>
							</a>
						</li> -->
						<!-- Header Middle Wishlist Area End Here -->
						<!-- Begin Header Mini Cart Area -->
						<li class="hm-minicart">
							<div class="hm-minicart-trigger">
								<span class="item-icon"></span>
								<span class="item-text">Tk 0.00
									<span class="cart-item-count">{{ totalCartItems() }}</span>
								</span>
							</div>
							<span></span>
							<div class="minicart">
								<!-- <ul class="minicart-product-list">
									<li>
										<a href="single-product.html" class="minicart-product-image">
											<img src="{{ asset('utils-front/images/product/small-size/5.jpg') }}" alt="cart products">
										</a>
										<div class="minicart-product-details">
											<h6><a href="single-product.html">Aenean eu tristique</a></h6>
											<span>£40 x 1</span>
										</div>
										<button class="close" title="Remove">
											<i class="fa fa-close"></i>
										</button>
									</li>
									<li>
										<a href="single-product.html" class="minicart-product-image">
											<img src="{{ asset('utils-front/images/product/small-size/6.jpg') }}" alt="cart products">
										</a>
										<div class="minicart-product-details">
											<h6><a href="single-product.html">Aenean eu tristique</a></h6>
											<span>£40 x 1</span>
										</div>
										<button class="close" title="Remove">
											<i class="fa fa-close"></i>
										</button>
									</li>
								</ul> -->
								<p class="minicart-total">SUBTOTAL: <span>Tk 0.00</span></p>
								<div class="minicart-button">
									<a href="{{ url('cart') }}" class="li-button li-button-fullwidth li-button-dark">
										<span>View Full Cart</span>
									</a>
									<!-- <a href="{{ url('checkout') }}" class="li-button li-button-fullwidth">
										<span>Checkout</span>
									</a> -->
								</div>
							</div>
						</li>
						<!-- Header Mini Cart Area End Here -->
					</ul>
				</div>
				<!-- Header Middle Right Area End Here -->
			</div>
			<!-- Header Middle Right Area End Here -->
		</div>
	</div>
</div>
<!-- Header Middle Area End Here -->
<!-- Begin Header Bottom Area -->
<div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- Begin Header Bottom Menu Area -->
				<div class="hb-menu">
					<nav>
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							@foreach($sections as $section)
								@if(count($section['categories']) > 0)
									<li class="dropdown-holder dropdownItem"><a href="blog-left-sidebar.html">{{ $section['name'] }}</a>
										<ul class="hb-dropdown">
											@foreach($section['categories'] as $category)
												<li class="@if(!empty($category['sub_categories'])) sub-dropdown-holder @endif"><a href="{{ url($category['url']) }}">{{ $category['category_name'] }}</a>
												@if(!empty($category['sub_categories']))
													<ul class="hb-dropdown hb-sub-dropdown">
														@foreach($category['sub_categories'] as $subCategories)
															<li><a href="{{ url($subCategories['url']) }}">{{$subCategories['category_name']}}</a></li>
														@endforeach
													</ul>
												@endif
												</li>
											@endforeach
										</ul>
									</li>
								@endif
							@endforeach
							<li style="margin-left:1.8rem"><a href="#">About Us</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</nav>
				</div>
				<!-- Header Bottom Menu Area End Here -->
			</div>
		</div>
	</div>
</div>
<!-- Header Bottom Area End Here -->
<!-- Begin Mobile Menu Area -->
<div class="mobile-menu-area d-lg-none d-xl-none col-12">
	<div class="container"> 
		<div class="row">
			<div class="mobile-menu">
			</div>
		</div>
	</div>
</div>
<!-- Mobile Menu Area End Here -->
