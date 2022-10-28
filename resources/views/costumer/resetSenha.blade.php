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
		</div>
		<div class="row">
			<div class="col">							
				<div class="sitebar container">
						<div class="wrap-login-item center">							
							<div class="register-form form-item ">
								@if (session()->has('success'))
								<div class="alert alert-success">
									{{ session('success') }}
								</div>
								@endif
								@if ($errors->any())
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
								@endif
								<form class="form-stl" action="{{url('/resetar-senha')}}" name="frm-login" method="post">@csrf
									<h3 class="form-title">Resetar senha</h3>                          
                                    <input type="hidden" name="token" value="{{$token}}">                             
                                    <input type="hidden" name="emailR" value="{{$email}}">                             
									<fieldset class="wrap-input">
										<label for="password">Nova senha</label>
										<input type="password" id="password" name="password" placeholder="Senha" required>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="cpassword">Confirmar senha</label>
										<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha" required>
									</fieldset>
									<input type="submit" class="btn btn-sign" value="Resetar" name="reset">
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