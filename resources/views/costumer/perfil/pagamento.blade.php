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
                            <form action="/perfil/salvarPagamento" method="POST" id="formPerfil">@csrf
                                <h3 class="box-title">pagamento</h3>                             
                                <div id="pagamentoPerfil">
									<p class="row-in-form">
										<label for="nomeC">Nome no cartão</label>
										<input type="text" id="nome" name="nome" value="{{$cartao->nome ?? ''}}" placeholder="" required>
                                    </p>
									<p class="row-in-form">
										<label for="cep">Número do cartão de crédito</label>
										<input type="text" id="numero" name="numero" value="{{$cartao->numero ?? ''}}" placeholder="" required>
                                    </p>
									<p class="row-in-form">
										<label for="cep">Data de expiração</label>
										<input type="text" id="dataExp" name="dataExp" value="{{$cartao->dataExp ?? ''}}" placeholder="" required>
                                    </p>							
									<p class="row-in-form">
										<label for="cep">CVV</label>
										<input type="text" id="cvv" name="cvv" value="{{$cartao->cvv ?? ''}}" placeholder="" required>
                                    </p>
                                </div>
                                <div class="col">
                                    <div class="row-in-form">
                                        <input type="submit" class="btn btn-sign" value="Salvar" name="register">
                                    </div>
                                </div>                                
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