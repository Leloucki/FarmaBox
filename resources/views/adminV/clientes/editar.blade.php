<!DOCTYPE html>
<html lang="en">
@include('adminV.layout.head')
	<body>
		<div class="container-scroller">
			<!-- partial:partials/_navbar.html -->
			@include('adminV.layout.header')
			<!-- partial -->
			<div class="container-fluid page-body-wrapper">
				<!-- partial:partials/_settings-panel.html -->
				@include('adminV.layout.menu')
				<!-- partial -->
				<div class="main-panel">
					<div class="content-wrapper">
						<div class="row m-auto">
							<div class="col-12 grid-margin stretch-card">
								<div class="card">
									<div class="card-body p-5">
										<h4 class="card-title text-center">Editar</h4>
										<p class="card-description text-center">
											Cliente
										</p>
										<div class="row justify-content-center text-center">
											<div class="col">
												<h3 class="col border-bottom w-25 mx-auto">
													<small class="text-secondary">
													  Dados Pessoais
													</small>
												</h3>
											</div>
										</div>
										<form class="form-sample text-end" method="POST" action="{{url('admin/editar/clientes')}}">
											@csrf
											<input type="number" style="display: none" name="id_cliente" value="{{$cliente->id}}">
											<div class="row">
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label pe-0">Nome</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="nome" id="nome" value="{{$cliente->usuario->nome}}" required>
												  </div>
												</div>
											  </div>
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label pe-0">E-mail</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="email" id="email" value="{{$cliente->usuario->email}}" required>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label pe-0">Celular</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="celular" id="celular" value="{{$cliente->celular}}" required>
												  </div>
												</div>
											  </div>
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label pe-0">Data de Nascimento</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="dtNasc" id="dtNasc" value="@if($cliente->dtNasc != null){{date_format(date_create($cliente->dtNasc),"d/m/Y")}}@endif" required>
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">
												<div class="col-md-6">
												  <div class="form-group row">
													<label class="col-sm-3 col-form-label pe-0">CPF</label>
													<div class="col-sm-9">
													  <input type="text" class="form-control" name="cpf" id="cpf" value="{{$cliente->cpf}}" required>
													</div>
												  </div>
												</div>
												<div class="col-md-6">
												  <div class="form-group row">
													<label class="col-sm-3 col-form-label pe-0">Assinatura</label>
													<div class="col-sm-9">
													  <input type="text" class="form-control" name="assinatura" id="assinatura" value="@if ($cliente->clienteAssinatura()->first() != null){{$cliente->clienteAssinatura->assinatura->nome}}@else Nenhuma @endif" disabled>
													</div>
												  </div>
												</div>
											</div>
											<div class="row justify-content-center text-center">
												<div class="col">
													<h3 class="col border-bottom w-25 mx-auto">
														<small class="text-secondary">
														  Endereço
														</small>
													</h3>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
												  <div class="form-group row">
													<label class="col-sm-3 col-form-label pe-0">Logradouro</label>
													<div class="col-sm-9">
													  <input type="text" class="form-control" name="logradouro" id="logradouro" value="{{$cliente->endereco->logradouro}}" required>
													</div>
												  </div>
												</div>
												<div class="col-md-6">
												  <div class="form-group row">
													<label class="col-sm-3 col-form-label pe-0">Numero</label>
													<div class="col-sm-9">
													  <input type="text" class="form-control" name="numero" id="numero" value="{{$cliente->endereco->numero}}">
													</div>
												  </div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
												  <div class="form-group row">
													<label class="col-sm-3 col-form-label pe-0">Bairro</label>
													<div class="col-sm-9">
													  <input type="text" class="form-control" name="bairro" id="bairro" value="{{$cliente->endereco->bairro}}" required>
													</div>
												  </div>
												</div>
												<div class="col-md-6">
												  <div class="form-group row">
													<label class="col-sm-3 col-form-label pe-0">Cidade</label>
													<div class="col-sm-9">
													  <input type="text" class="form-control" name="cidade" id="cidade" value="{{$cliente->endereco->cidade}}">
													</div>
												  </div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
												  <div class="form-group row">
													<label class="col-sm-3 col-form-label pe-0">País</label>
													<div class="col-sm-9">
													  <input type="text" class="form-control" name="pais" id="pais" value="{{$cliente->endereco->pais}}" required>
													</div>
												  </div>
												</div>
												<div class="col-md-6">
												  <div class="form-group row">
													<label class="col-sm-3 col-form-label pe-0">CEP</label>
													<div class="col-sm-9">
													  <input type="text" class="form-control" name="cep" id="cep" value="{{$cliente->endereco->cep}}">
													</div>
												  </div>
												</div>
											</div>
											<button type="submit" class="btn btn-primary m-auto d-flex justify-content-evenly">Editar</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- content-wrapper ends -->
					<!-- partial:partials/_footer.html -->
					@include('adminV.layout.footer')
					<!-- partial -->
				</div>
				<!-- main-panel ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>

	</body>
</html>