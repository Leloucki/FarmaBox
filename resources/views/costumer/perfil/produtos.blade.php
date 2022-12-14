<!DOCTYPE html>
<html lang="en">
@include('costumer.layout.head')
<body class="home-page home-01 ">

	<!--header-->
	@include('costumer.layout.header')

	<main id="main" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>perfil</span></li>
				</ul>
			</div>

			<div class="row">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                    <div class="row">
                        <div class="wrap-address-billing">                                                 
                                <h3 class="box-title">pagamento</h3>
                                <div class="wrap-iten-in-cart" id="meusProdutos">
                                    <div class="assinaturaPerfil">
                                        <p>{{$clienteAssin->assinatura->nome}}
                                            <form action="{{url('/perfil/cancelar/assinatura')}}" method="post">
                                            @csrf                                            
                                            <button class="btn btn-sign" >Cancelar</button>
                                            </form>
                                        </p>                                        
                                    </div> 
                                    <form action="/perfil/salvarProdutos" method="POST" id="formPerfil">@csrf                                                   
                                    <ul class="products-cart">
                                        @forelse ($pedidos as $pedido)
                                            @if($clienteAssin->assinatura->nome == "Personalizado")
                                            <li class="pr-cart-item">
                                                <input type="number" value="{{$pedido->produto->id ?? ''}}" name="produtos[{{$loop->index}}][id]" hidden>
                                                <div class="product-image">
                                                    <figure><img src="{{asset("storage/img/produtos/".$pedido->produto->nomeP."") ?? ''}}" alt="{{$pedido->produto->nome ?? ''}}"></figure>
                                                </div>
                                                <div class="product-name">
                                                    <a class="link-to-product" href="#">{{$pedido->produto->nome}}</a>
                                                </div>
                                                <div class="price-field product-price"><p class="price">{{'R$' . number_format($pedido->produto->valor, 2, ',', '.'); }}</p></div>
                                                <div class="quantity">
                                                    <div class="quantity-input">
                                                        <input type="text" name="produtos[{{$loop->index}}][quantidade]"  value="{{$pedido->quantidade ?? ''}}" id="quantidade" data-max="10" pattern="[0-9]*" readonly>									
                                                        <a class="btn btn-increase" href="#"></a>
                                                        <a class="btn btn-reduce" href="#"></a>
                                                    </div>
                                                </div>
                                                <div class="price-field sub-total"><p class="price">{{'R$' . number_format($pedido->produto->valor * $pedido->quantidade, 2, ',', '.'); }}</p></div>
                                                <div class="delete">
                                                    <a href="#" class="btn btn-delete" title="">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            @else
                                            <li class="pr-cart-item">
                                                <div class="product-image">
                                                    <figure><img src="{{asset("storage/img/produtos/".$pedido->produto->nomeP."") ?? ''}}" alt="{{$pedido->produto->nome ?? ''}}"></figure>
                                                </div>
                                                <div class="product-name">
                                                    <a class="link-to-product" href="#">{{$pedido->produto->nome}}</a>
                                                </div>
                                                <div class="price-field product-price"><p class="price">Quantidade: {{$pedido->quantidade}}</p></div>
                                            </li>
                                            @endif
                                        @empty
                                            <li class="pr-cart-item">
                                                <p>Nenhum produto cadastrado</p>
                                            </li>
                                        @endforelse
                                        											
                                    </ul>
                                    <div class="order-summary">
                                        <h4 class="title-box">Sum??rio</h4>
                                        @if($clienteAssin->assinatura->nome == "Personalizado")
                                        <p class="summary-info"><span class="title">Subtotal</span><b id="subtotalPerfil" class="index">R$0,00</b></p>
                                        @endif
                                        <p class="summary-info"><span class="title">Assinatura</span><b id="valorAssinaturaPerfil" class="index">{{'R$' . number_format($clienteAssin->assinatura->valor, 2, ',', '.'); }}</b></p>
                                        <p class="summary-info"><span class="title">Frete</span><b id="fretePerfil"  class="index">Frete Gr??tis</b></p>
                                        @if($clienteAssin->assinatura->nome == "Personalizado")
                                        <p class="summary-info total-info "><span class="title">Total</span><b id="totalPerfil" class="index">R$0,00</b></p>
                                        @endif
                                    </div>                   
                                </div>
                                @if($clienteAssin->assinatura->nome == "Personalizado")
                                <div class="col">
                                    <div class="row-in-form">
                                        <input type="submit" class="btn btn-sign" value="Salvar" name="register">
                                    </div>
                                </div>
                                @endif                               
                            </form>
                        </div>
                    </div>
                    
                </div>

                @include('costumer.perfil.layout.side')

            </div><!--end row-->

		</div><!--end container-->

	</main>
	@include('costumer.layout.footer')
</body>
</html>