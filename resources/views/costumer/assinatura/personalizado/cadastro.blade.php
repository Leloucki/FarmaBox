<!DOCTYPE html>
<html lang="en">
<head>
	@include('costumer.layout.head')
</head>
<body class="home-page home-01 ">
	<!--header-->
	@include('costumer.layout.header')

	<!--main area-->
	<main id="main" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>cadastrar</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 col-md-offset-3">							
					<div class=" main-content-area">
						<div class="wrap-login-item ">
							@if (session()->has('success'))
									<div class="alert alert-success">
										{{ session('success') }}
									</div>
									@endif
									@if (session()->has('error'))
									<div class="alert alert-danger">
										{{ session('error') }}
									</div>
									@endif
							<div class="register-form form-item ">
								<form class="form-stl" action="{{url("assinatura/cadastro/$assinatura->id")}}" name="frm-login" method="post" >@csrf
							
                                    <fieldset class="wrap-title">
                                        <h3 class="form-title">Assinatura: {{$assinatura->nome}}</h3>
										<h4 class="form-subtitle"></h4>
									</fieldset>	
									{{-- <fieldset class="wrap-title">										
										<h4 class="form-subtitle">Informações Pessoais</h4>
									</fieldset>									 --}}
									<fieldset class="wrap-input">
                                        {{-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="sexoM" id="sexoM" autocomplete="off" checked>
                                            <label class="btn btn-outline-primary" for="btnradio1">Masculino</label>
                                            <input type="radio" class="btn-check" name="sexoF" id="sexoF" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btnradio3">Feminino</label>
                                        </div> --}}
                                        <div class="form-check wrap-input item-width-in-half left-item">
                                            <input class="form-check-input" type="radio" name="sexo" value="M" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                              Masculino
                                            </label>
                                        </div>
                                        <div class="form-check wrap-input item-width-in-half">
                                            <input class="form-check-input" type="radio" name="sexo" value="F">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                              Feminino
                                            </label>
                                        </div>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="alergia">Alergia</label>
										<input type="text" id="alergia" name="alergia" placeholder="">
									</fieldset>
									<fieldset class="wrap-input">
										<label for="celular">Observação</label>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="" id="observacao" name="observacao" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Comments</label>
                                          </div>
									</fieldset>									
									<fieldset class="wrap-title">
										<h4 class="form-subtitle">Pagamento</h4>
									</fieldset>	
									<fieldset class="wrap-input">
										<label for="nome">Nome no cartão</label>
										<input type="text" id="nome" name="nome" placeholder="" required>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="cep">Número do cartão de crédito</label>
										<input type="text" id="numero" name="numero" placeholder="" required>
									</fieldset>
									<fieldset class="wrap-input item-width-in-half left-item ">
										<label for="cep">Data de expiração</label>
										<input type="text" id="dataExp" name="dataExp" placeholder="" required>
									</fieldset>							
									<fieldset class="wrap-input item-width-in-half">
										<label for="cep">CVV</label>
										<input type="text" id="cvv" name="cvv" placeholder="" required>
									</fieldset>
                                    <fieldset class="wrap-title">
										<h4 class="form-subtitle"></h4>
									</fieldset>						
									<input type="submit" class="btn btn-sign" value="Cadastrar" name="register">
								</form>
							</div>					
						</div>
					</div><!--end main products area-->		
				</div>
			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->

	<!--footer area-->
	@include('costumer.layout.footer')
	<!--footer area-->
</body>
</html>