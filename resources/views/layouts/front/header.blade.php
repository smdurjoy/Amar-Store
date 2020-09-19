<?php 
use App\Section;
$sections = Section::section();
?>

<div id="header">
	<div class="container">
		<div id="welcomeLine" class="row">
			<div class="span6">Welcome!<strong> User</strong></div>
			<div class="span6">
				<div class="pull-right">
					<a href="product_summary.html"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 3 ] Items in your cart </span> </a>
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
                    <li class="active"><a href="#">Home</a></li>

                    @foreach($sections as $section)
                        @if(count($section['categories']) > 0)
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $section['name'] }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @foreach($section['categories'] as $category)
                                    <li class="divider"></li>
                                    <li class="nav-header"><a href="#">{{ $category['category_name'] }}</a></li>
                                    @foreach($category['sub_categories'] as $subCategories)
                                        <li><a href="#">{{$subCategories['category_name']}}</a></li>
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
		            <li><a href="#">Login</a></li>
		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div><!-- /navbar -->
		</section>
	</div>
</div>