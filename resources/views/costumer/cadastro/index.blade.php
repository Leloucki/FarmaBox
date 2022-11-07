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
									<div class="alert alert-success TAC">
										{!! session('success') !!}
									</div>
									@endif
									@if (session()->has('error'))
									<div class="alert alert-danger TAC">
										{!! session('error') !!}
									</div>
									@endif
							<div class="register-form form-item ">
								<form class="form-stl" action="{{url('/cadastro/cliente')}}" name="frm-login" method="post" >@csrf
									<h3 class="form-title">Criar uma conta</h3>
									<fieldset class="wrap-title">										
										<h4 class="form-subtitle">Informações Pessoais</h4>
									</fieldset>									
									<fieldset class="wrap-input">
										<label for="nome">Nome</label>
										<input type="text" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Nome" required>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="email">E-mail</label>
										<input type="email" id="emailC" name="emailC" value="{{ old('emailC') }}" placeholder="exemplo@exemplo.com.br" required>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="celular">Celular</label>
										<input type="text" id="celular" name="celular" value="{{ old('celular') }}"  placeholder="(XX) 9XXXX-XXXX" >
									</fieldset>
									<fieldset class="wrap-input">
										<label for="cpf">CPF</label>
										<input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" placeholder="CPF" required>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="dtNasc">Data de nascimentos</label>
										<input type="text" id="dtNasc" name="dtNasc" value="{{ old('dtNasc') }}" required>
									</fieldset>
									<fieldset class="wrap-title">
										<h4 class="form-subtitle">Endereço</h4>
									</fieldset>	
									<fieldset class="wrap-input">
										<label for="logradouro">Logradouro</label>
										<input type="text" id="logradouro" name="logradouro" value="{{ old('logradouro') }}"  placeholder="Rua...">
									</fieldset>
									<fieldset class="wrap-input item-width-in-half left-item ">
										<label for="cep">CEP</label>
										<input type="text" id="cep" name="cep" value="{{ old('cep') }}" placeholder="CEP">
									</fieldset>
									<fieldset class="wrap-input item-width-in-half">
										<label for="numero">Número</label>
										<input type="text" id="numero" name="numero" value="{{ old('numero') }}" placeholder="Número">
									</fieldset>	
									<fieldset class="wrap-input">
										<label for="bairro">Bairro</label>
										<input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}" placeholder="Bairro">
									</fieldset>
									<fieldset class="wrap-input">
										<label for="cidade">Cidade</label>
										<input type="text" id="cidade" name="cidade" value="{{ old('cidade') }}" placeholder="Cidade">
									</fieldset>
									<fieldset class="wrap-input">
										<label for="estado">Estado</label>
										<input type="text" id="estado" name="estado" value="{{ old('estado') }}"  placeholder="Estado">
									</fieldset>
									<fieldset class="wrap-input">
										<label for="pais">País</label>
										<input type="text" id="pais" name="pais" value="{{ old('pais') }}"  placeholder="País">
									</fieldset>																
									{{-- <fieldset class="wrap-functions ">
										<label class="remember-field">
											<input name="newletter" id="new-letter" value="forever" type="checkbox"><span>Deseja receber promoções por e-mail?</span>
										</label>
									</fieldset> --}}
									<fieldset class="wrap-title">
										<h4 class="form-subtitle"></h4>
									</fieldset>									
									<fieldset class="wrap-input item-width-in-half left-item ">
										<label for="password">Senha</label>
										<input type="password" id="passwordC" name="passwordC" placeholder="Senha" required>
									</fieldset>
									<fieldset class="wrap-input item-width-in-half ">
										<label for="cpassword">Confirmar senha</label>
										<input type="password" id="passwordC_confirmation" name="passwordC_confirmation" placeholder="Confirmar senha" required>
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