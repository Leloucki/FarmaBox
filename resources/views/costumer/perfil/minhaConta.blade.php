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
                            <form action="/perfil/salvarConta" method="POST" id="formPerfil">@csrf
                                <h3 class="box-title">minha conta</h3>
                                <div id="minhaConta" class="row">                                                                    
                                    <p class="row-in-form" style="width: 97%;">
                                        <label for="nomeP">Nome</label>
                                        <input id="nomeP" type="text" name="nomeP" value="{{$cliente->usuario->nome}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="emailP">E-mail</label>
                                        <input id="emailP" type="email" name="emailP" value="{{$cliente->usuario->email}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="celularP">Celular</label>
                                        <input id="celularP" type="text" name="celularP" value="{{$cliente->celular ?? ''}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="cpfP">CPF</label>
                                        <input id="cpfP" type="text" name="cpfP" value="{{$cliente->cpf ?? ''}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="dtNasc">Data de Nascimento</label>                                        
                                        <input id="dtNasc" type="text" name="dtNasc" value="@if ($cliente->dtNasc != null)
                                        {{date_format(date_create($cliente->dtNasc),"d/m/Y")}}
                                        @endif" required>
                                    </p>                                    
                                    <div class='col'>
                                        <p class="wrap-title">
                                            <h4 class="form-subtitle">Endereço</h4>
                                            <hr>
                                        </p>
                                    </div>
                                    {{-- Maximiza largura input --}}
                                    <div class='col'>
                                        <p class="row-in-form" style="width: 97%;">
                                            <label for="country">Logradouro</label>
                                            <input id="logradouro" type="text" name="lougradouro" value="{{$endereco->logradouro ?? ''}}" required>
                                        </p>
                                    </div>
                                    <p class="row-in-form">
                                        <label for="cep">CEP</label>
                                        <input id="cep" type="text" name="cep" value="{{$endereco->cep ?? ''}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="numero">Número</label>
                                        <input id="numero" type="number" name="numero" value="{{$endereco->numero ?? ''}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="cidade">Cidade</label>
                                        <input id="cidade" type="text" name="cidade" value="{{$endereco->cidade ?? ''}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="estado">Estado</label>
                                        <input id="estado" type="text" name="estado" value="{{$endereco->estado ?? ''}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="pais">País</label>
                                        <input id="pais" type="text" name="pais" value="{{$endereco->pais ?? ''}}" required>
                                    </p>
                                    {{-- <p class="row-in-form fill-wife">
                                        <label class="checkbox-field">
                                            <input name="create-account" id="create-account" value="forever" type="checkbox">
                                            <span>Create an account?</span>
                                        </label>
                                        <label class="checkbox-field">
                                            <input name="different-add" id="different-add" value="forever" type="checkbox">
                                            <span>Ship to a different address?</span>
                                        </label>
                                    </p> --}}                 
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