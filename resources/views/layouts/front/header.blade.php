<?php
use App\Section;
use App\Cart;
use Illuminate\Support\Facades\Auth;

$sections = Section::section();
if(Auth::check()) {
    $countCarts = Cart::where('user_id', Auth::user()->id)->count();
} else {
    $countCarts = Cart::where('session_id', \Illuminate\Support\Facades\Session::get('session_id'))->count();
}

?>

<div id="header">
	<div class="container">
		<div id="welcomeLine" class="row">
			@if(Auth::check())
				<div class="span6">Welcome<strong> {{ Auth::user()->name }}</strong></div>
			@endif
			<div class="span6">
				<div class="pull-right">
					<a href="{{ url('cart') }}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ {{ $countCarts }} ] Items in your cart </span> </a>
				</div>
			</div>
		</div>
		<!-- Navbar ================================================== -->
		<section id="navbar">
		  <div class="navbar">
		    <div class="navbar-inner">
		      <div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </a>
		        <a class="brand" href="{{url('/')}}">Amar Store</a>
		        <div class="nav-collapse">
		          <ul class="nav">
                    <li class="@if(Request::is('/')) active @endif"><a href="{{ url('/') }}">Home</a></li>

                    @foreach($sections as $section)
                        @if(count($section['categories']) > 0)
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $section['name'] }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @foreach($section['categories'] as $category)
                                    <li class="divider"></li>
                                    <li class="nav-header"><a href="{{ url($category['url']) }}">{{ $category['category_name'] }}</a></li>
                                    @foreach($category['sub_categories'] as $subCategories)
                                        <li><a href="{{ url($subCategories['url']) }}">{{$subCategories['category_name']}}</a></li>
                                    @endforeach
                                @endforeach
                            </ul>
                            </li>
                        @endif
                    @endforeach

		            <li><a href="#">About</a></li>
		          </ul>
		          <form class="navbar-search pull-left" action="#">
		            <input type="text" class="search-query span2" placeholder="Search"/>
		          </form>
		          <ul class="nav pull-right">
		            <li><a href="#">Contact</a></li>
		            <li class="divider-vertical"></li>
					@if(Auth::check())
						<li><a href="{{ url('account') }}">My Account</a></li>
						<li><a href="{{ url('logout') }}">Logout</a></li>
					@else
						<li><a href="{{ url('login-register') }}">Login / Register</a></li>
					@endif
		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div><!-- /navbar -->
		</section>
	</div>
</div>
