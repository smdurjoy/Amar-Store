<?php 
    use App\Banner;
    $banners = Banner::getBanners();
    $bannerCount = count($banners);
?>

@if(isset($page_name) && $page_name == 'index')
<div class="slider-with-banner">
	<div class="container">
		<div class="row">
			<!-- Begin Slider Area -->
			<div class="col-lg-8 col-md-8">
				<div class="slider-area">
					<div class="slider-active owl-carousel">
						<!-- Begin Single Slide Area -->
						<div class="single-slide align-center-left  animation-style-01 bg-1">
							<div class="slider-progress"></div>
							<div class="slider-content">
								<h5>Select your item for special <span>-20% Off</span> This Week</h5>
								<h2>Mens T-shirts</h2>
								<h3>Starting at <span>Tk 690</span></h3>
								<div class="default-btn slide-btn">
									<a class="links" href="{{ url('t-shirts') }}">Shopping Now</a>
								</div>
							</div>
						</div>
						<!-- Single Slide Area End Here -->
						<!-- Begin Single Slide Area -->
						<div class="single-slide align-center-left animation-style-02 bg-2">
							<div class="slider-progress"></div>
							<div class="slider-content">
								<h5>Sale Offer <span>Black Friday</span> This Week</h5>
								<h2>Woman Tops</h2>
								<h3>Starting at <span>Tk 990</span></h3>
								<div class="default-btn slide-btn">
									<a class="links" href="{{ url('w-tops') }}">Shopping Now</a>
								</div>
							</div>
						</div>
						<!-- Single Slide Area End Here -->
						<!-- Begin Single Slide Area -->
						<div class="single-slide align-center-left animation-style-01 bg-3">
							<div class="slider-progress"></div>
							<div class="slider-content">
								<h5>Sale Offer <span>-10% Off</span> This Week</h5>
								<h2>Kids fashion</h2>
								<h3>Starting at <span>1090</span></h3>
								<div class="default-btn slide-btn">
									<a class="links" href="{{ url('kids-shirts') }}">Shopping Now</a>
								</div>
							</div>
						</div>
						<!-- Single Slide Area End Here -->
					</div>
				</div>
			</div>
			<!-- Slider Area End Here -->
			<!-- Begin Li Banner Area -->
			<div class="col-lg-4 col-md-4 text-center pt-xs-30">
				<div class="li-banner">
					<a href="#">
						<img src="{{ asset('utils-front/images/banner/1_1.jpg') }}" alt="">
					</a>
				</div>
				<div class="li-banner mt-15 mt-sm-30 mt-xs-30">
					<a href="#">
						<img src="{{ asset('utils-front/images/banner/1_2.jpg') }}" alt="">
					</a>
				</div>
			</div>
			<!-- Li Banner Area End Here -->
		</div>
	</div>
</div>
@endif
