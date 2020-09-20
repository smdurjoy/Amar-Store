<?php 
    use App\Banner;
    $banners = Banner::getBanners();
    $bannerCount = count($banners);
?>

@if(isset($page_name) && $page_name == 'index')
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
        @foreach($banners as $key => $banner)
			<div class="item @if($key == 0) active @endif">
				<div class="container">
					<a @if(!empty($banner['link'])) href="{{ url($banner['link']) }}" @else href="javascript:void(0)" @endif><img style="width:100%" src="{{asset('images/bannerImages/'.$banner['image'])}}" alt="{{ $banner['alt'] }}" title="{{ $banner['title'] }}"/></a>
					<div class="carousel-caption">
					</div>
				</div>
			</div>
        @endforeach
		</div>
        @if($bannerCount > 1)
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        @endif
	</div>
</div>
@endif
