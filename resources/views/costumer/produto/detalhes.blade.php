<!DOCTYPE html>
<html lang="en">
@include('costumer.layout.head')
<body class="home-page home-01 ">

	<!--header-->
	@include('costumer.layout.header')

	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>produtos</span></li>
					<li class="item-link"><span>{{$produto->nome}}</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-content-area">
					<div class="wrap-product-detail">
						<div class="detail-media">
							<div class="product-gallery">
							  <ul class="slides">
							    {{-- <li data-thumb="{{asset("storage/img/produtos/$produto->nomeP")}}"> --}}
							    	<img src="{{asset("storage/img/produtos/$produto->nomeP")}}" alt="product thumbnail" style="    width: 500px;"/>
							    {{-- </li> --}}
							  </ul>
							</div>
						</div>
						<div class="detail-info">
                            <h2 class="product-name">{{$produto->nome}}</h2>
                            <div class="short-desc">
                                <ul>
                                    <li>{{$produto->laboratorio->nome}}</li>
									@forelse ($produto->categoriaProduto()->get() as $catProduto)
									<li>{{$catProduto->categoria->nome}}</li>
									@empty
										
									@endforelse                                    
                                </ul>
                            </div>
                            <div class="wrap-price"><span class="product-price">{{'R$' . number_format($produto->valor, 2, ',', '.'); }}</span></div>
							<form action="{{url('produto/inserirClienteProduto')}}" method="post">
							@csrf
							<input name="id_produto" value="{{$produto->id}}" style="display: none;">
								<div class="quantity">
									<span>Quantidade:</span>
									<div class="quantity-input">
										<input id="quantidade" type="text" name="quantidade" value="1" data-max="10" pattern="[0-9]*"  readonly>									
										<a class="btn btn-reduce" href="#"></a>
										<a class="btn btn-increase" href="#"></a>
									</div>
								</div>
								<div class="wrap-butons">
									<button class="btn add-to-cart">Adicionar a Assinatura</button>
								</div>
							</form>
						</div>
						<div class="advance-info">
							<div class="tab-control normal">
								<a href="#description" class="tab-control-item active">descrição</a>
								{{-- <a href="#add_infomation" class="tab-control-item">Addtional Infomation</a> --}}
								{{-- <a href="#review" class="tab-control-item">Reviews</a> --}}
							</div>
							<div class="tab-contents">
								<div class="tab-content-item active" id="description">
									<p>{{$produto->desc}}</p>
								</div>
								{{-- <div class="tab-content-item " id="add_infomation">
									<table class="shop_attributes">
										<tbody>
											<tr>
												<th>Weight</th><td class="product_weight">1 kg</td>
											</tr>
											<tr>
												<th>Dimensions</th><td class="product_dimensions">12 x 15 x 23 cm</td>
											</tr>
											<tr>
												<th>Color</th><td><p>Black, Blue, Grey, Violet, Yellow</p></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-content-item " id="review">
									
									<div class="wrap-review-form">
										
										<div id="comments">
											<h2 class="woocommerce-Reviews-title">01 review for <span>Radiant-360 R6 Chainsaw Omnidirectional [Orage]</span></h2>
											<ol class="commentlist">
												<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
													<div id="comment-20" class="comment_container"> 
														<img alt="" src="assets/images/author-avata.jpg" height="80" width="80">
														<div class="comment-text">
															<div class="star-rating">
																<span class="width-80-percent">Rated <strong class="rating">5</strong> out of 5</span>
															</div>
															<p class="meta"> 
																<strong class="woocommerce-review__author">admin</strong> 
																<span class="woocommerce-review__dash">–</span>
																<time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >Tue, Aug 15,  2017</time>
															</p>
															<div class="description">
																<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
															</div>
														</div>
													</div>
												</li>
											</ol>
										</div><!-- #comments -->

										<div id="review_form_wrapper">
											<div id="review_form">
												<div id="respond" class="comment-respond"> 

													<form action="#" method="post" id="commentform" class="comment-form" novalidate="">
														<p class="comment-notes">
															<span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
														</p>
														<div class="comment-form-rating">
															<span>Your rating</span>
															<p class="stars">
																
																<label for="rated-1"></label>
																<input type="radio" id="rated-1" name="rating" value="1">
																<label for="rated-2"></label>
																<input type="radio" id="rated-2" name="rating" value="2">
																<label for="rated-3"></label>
																<input type="radio" id="rated-3" name="rating" value="3">
																<label for="rated-4"></label>
																<input type="radio" id="rated-4" name="rating" value="4">
																<label for="rated-5"></label>
																<input type="radio" id="rated-5" name="rating" value="5" checked="checked">
															</p>
														</div>
														<p class="comment-form-author">
															<label for="author">Name <span class="required">*</span></label> 
															<input id="author" name="author" type="text" value="">
														</p>
														<p class="comment-form-email">
															<label for="email">Email <span class="required">*</span></label> 
															<input id="email" name="email" type="email" value="" >
														</p>
														<p class="comment-form-comment">
															<label for="comment">Your review <span class="required">*</span>
															</label>
															<textarea id="comment" name="comment" cols="45" rows="8"></textarea>
														</p>
														<p class="form-submit">
															<input name="submit" type="submit" id="submit" class="submit" value="Submit">
														</p>
													</form>

												</div><!-- .comment-respond-->
											</div><!-- #review_form -->
										</div><!-- #review_form_wrapper -->

									</div>
								</div> --}}
							</div>
						</div>
					</div>
				</div><!--end main products area-->				
				@if(!empty($produtos[0]))
				<div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="wrap-show-advance-info-box style-1 box-in-site" style="width: 100%;">
						<h3 class="title-box">Produtos Relacionados</h3>
						<div class="wrap-products">
							{{-- <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
								@forelse ($produtos as $prod)								
								<div class="product product-style-2 equal-elem">
									<div class="product-thumnail">
										<a href="{{url("produto/$prod->id")}}" title="{{$prod->nome}}">
											<figure><img src="{{asset("storage/img/produtos/$prod->nomeP")}}" width="214" height="214" alt="{{$prod->nome}}"></figure>
										</a>
										<div class="group-flash">
											<span class="flash-item new-label">new</span>
										</div>
										<div class="wrap-btn">
											<a href="#" class="function-link">quick view</a>
										</div>
									</div>
									<div class="product-info">
										<a href="#" class="product-name"><span>{{$prod->nome}}</span></a>
										<div class="wrap-price"><span class="product-price">{{'R$' . number_format($produto->valor, 2, ',', '.'); }}</span></div>
									</div>
								</div>
								@empty
								
								@endforelse	
							</div>							 --}}
							<section class="product"> 
								<button class="pre-btn"><img src="{{asset("costumer/images/arrow.png")}}" alt=""></button>
								<button class="nxt-btn"><img src="{{asset("costumer/images/arrow.png")}}" alt=""></button>
								<div class="product-container">
									@foreach ($produtos as $prod)
									<div class="product-card @if(!$loop->first)ml @endif">
										<div class="product-image">
											<a href="{{url("produto/$prod->id")}}">
												<img src="{{asset("storage/img/produtos/$prod->nomeP")}}" class="product-thumb" alt="">
											</a>
										</div>
										<div class="product-info">
											<h4 class="product-brand">{{$prod->nome}}</h4>
											<span class="price">{{'R$' . number_format($prod->valor, 2, ',', '.'); }}</span>
										</div>
									</div>
									@endforeach																		
								</div>
							</section>
						</div><!--End wrap-products-->
					</div>
				</div>
				@endif
			</div><!--end row-->

		</div><!--end container-->

	</main>

	@include('costumer.layout.footer')
	<style>
		/* HEADER */



.content {
  width: 100%;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  text-align: center;
  color: #fff;
}

.content h1 {
  font-size: 70px;
  margin-top: 80px;
}

.content p {
  margin: 20px auto;
  font-weight: 100;
  line-height: 25px;
}

.login-btn {
  width: 200px;
  padding: 15px 0;
  text-align: center;
  margin: 20px 10px;
  border-radius: 25px;
  font-weight: bold;
  border: 2px solid #009688;
  background: transparent;
  color: white;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}

.signup-btn {
  width: 200px;
  padding: 15px 0;
  text-align: center;
  margin: 20px 10px;
  border-radius: 25px;
  font-weight: bold;
  border: 2px solid #009688;
  background: transparent;
  color: white;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}

.cover {
  background: #009688;
  height: 100%;
  width: 0%;
  border-radius: 25px;
  position: absolute;
  left: 0;
  bottom: 0;
  z-index: -1;
  transition: 0.5s;
}

button:hover span {
  width: 100%;
}

button:hover {
  border: none;
}

/* PRODUCTS */
.product {
  position: relative;
  overflow: hidden;
}

.product-category {
  font-size: 30px;
  font-weight: 500;
  margin-bottom: 40px;
  text-transform: capitalize;
}

.product-container {
  display: flex;
  overflow-x: auto;
  scroll-behavior: smooth;
  min-height: 260px;
}

.product-container::-webkit-scrollbar {
  display: none;
}

.product-card {
  flex: 0 0 auto;
  width: 150px;
  height: 250px;
  margin-left: 1%;
}

.ml{
	margin-left: 10%;
}

.product-image {
  position: relative;
  width: 100%;
  height: auto;
  overflow: hidden;
}

.product-thumb {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.discount-tag {
  position: absolute;
  background: #fff;
  padding: 5px;
  border-radius: 5px;
  color: #ff7d7d;
  right: 10px;
  top: 10px;
  text-transform: capitalize;
}

.card-btn {
  position: absolute;
  bottom: 10px;
  left: 50%;
  transform: translateX(-50%);
  padding: 10px;
  width: 90%;
  text-transform: capitalize;
  border: none;
  outline: none;
  background: #fff;
  border-radius: 5px;
  transition: 0.5s;
  cursor: pointer;
  opacity: 0;
}

.product-card:hover .card-btn {
  opacity: 1;
}

.card-btn:hover {
  background: #ff7d7d;
  color: #fff;
}

.product-info {
  width: 100%;
  height: 100px;
  padding-top: 10px;
}

.product-brand {
  text-transform: uppercase;
}

.product-short-description {
  width: 100%;
  height: 20px;
  line-height: 20px;
  overflow: hidden;
  opacity: 0.5;
  text-transform: capitalize;
  margin: 5px 0;
}

.price {
  font-weight: 900;
  font-size: 15px;
}

.actual-price {
  margin-left: 20px;
  opacity: 0.5;
  text-decoration: line-through;
}

.pre-btn,
.nxt-btn {
  border: none;
  max-width: 20px;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.65) 100%);
  cursor: pointer;
  z-index: 8;
}

.pre-btn {
  left: 0;
  transform: rotate(180deg);
}

.nxt-btn {
  right: 0;
}

.pre-btn img,
.nxt-btn img {
  opacity: 0.2;
}

.pre-btn:hover img,
.nxt-btn:hover img {
  opacity: 1;
}

.collection-container {
  width: 100%;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 10px;
}

.collection {
  position: relative;
}

.collection img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.collection p {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: #fff;
  font-size: 50px;
  text-transform: capitalize;
}

.collection:nth-child(3) {
  grid-column: span 2;
  margin-bottom: 10px;
}

	</style>
	<script>
		const productContainers = [...document.querySelectorAll('.product-container')];
		const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
		const preBtn = [...document.querySelectorAll('.pre-btn')];

		productContainers.forEach((item, i) => {
			let containerDimensions = item.getBoundingClientRect();
			let containerWidth = containerDimensions.width;

			nxtBtn[i].addEventListener('click', () => {
				item.scrollLeft += containerWidth;
			})

			preBtn[i].addEventListener('click', () => {
				item.scrollLeft -= containerWidth;
			})
		})
	</script>
</body>
</html>