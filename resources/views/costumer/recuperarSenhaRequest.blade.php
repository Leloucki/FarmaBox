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
					<li class="item-link"><span>recuperar senha</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col">							
					<div class="sitebar container">
						<div class="wrap-login-item center">							
							<div class="register-form form-item">
									@if (session()->has('status'))
									<div class="alert alert-success">
										{{ session('status') }}
									</div>
									@endif
									@if (session()->has('emailStatus'))
									<div class="alert alert-danger">
										{{ session('emailStatus') }}
									</div>
									@endif
								<form class="form-stl" action="{{url('/recuperar-senha')}}" name="frm-login" method="post" >@csrf							
									<h3 class="form-title">Recuperar senha</h3>
									<fieldset class="wrap-input">
										<label for="email">E-mail</label>
										<input type="email" id="emailR" name="emailR" placeholder="exemplo@exemplo.com.br" required>
									</fieldset>
									<input type="submit" class="btn btn-sign" value="Enviar" name="send">
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