<!DOCTYPE html>
<html lang="en">
@include('costumer.layout.head')
<body class="home-page home-01 ">

	<!--header-->
	@include('costumer.layout.header')

	<main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					<div class="item-slide">
						<img src="costumer/images/main-slider-1-1.jpg" alt="" class="img-slide">
						<div class="slide-info slide-1">
							<h2 class="f-title">Receba em sua <b>Casa</b></h2>
							<span class="subtitle">Assine já!</span>
							<p class="sale-info">Por apenas: <span class="price">{{'R$' . number_format($assinaturaB->valor, 2, ',', '.'); }}</span></p>
							<a href="{{url('/assinatura')}}" class="btn-link">Assinar</a>
						</div>
					</div>
					<div class="item-slide">
						<img src="costumer/images/main-slider-1-2.jpg" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">25% de DESCONTO</h2>
							<span class="f-subtitle">Na primeira mensalidade</span>
						</div>
					</div>
					<div class="item-slide">
						<img src="costumer/images/main-slider-1-3.jpg" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title">Grandes variedades de remédios feitos especialmente para <b>você</b></h2>
							<p class="sale-info">A partir de: <b class="price">{{'R$' . number_format($assinaturaB->valor, 2, ',', '.'); }}</b></p>
							<a href="{{url('/assinatura')}}" class="btn-link">Assine agora!</a>
						</div>
					</div>
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="{{url('/produtos')}}" class="link-banner banner-effect-1">
						<figure><img src="costumer/images/home-1-banner-1.jpg" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="{{url('/produtos')}}" class="link-banner banner-effect-1">
						<figure><img src="costumer/images/home-1-banner-2.jpg" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>
	</main>

	@include('costumer.layout.footer')
</body>
</html>