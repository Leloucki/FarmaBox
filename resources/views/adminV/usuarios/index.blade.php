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
						<div class="row">
							<div class="col-md grid-margin stretch-card">
								<div class="card">
									<div class="card-body">
										<form action="" method="GET">
											<div class="input-group mb-3">
												<div class="input-group-prepend hover-cursor" id="navbar-search-icon">
												<button type="submit" class="input-group-text" id="search">
												<i class="icon-search"></i>
												</button>									   
												</div>
												<input type="text" class="form-control w-50 searchTable" id="nomeSearch" name="nomeSearch" placeholder="Nome categoria" aria-label="search" aria-describedby="search">									
												<span class="btn ml-auto p-0 mr-5">
													<a href="{{url('admin/cadastrar/categorias')}}">
														<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
															<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
														</svg>
													</a>
												</span>
											</div>
										</form>
										<p class="card-title mb-0">Produtos</p>										
										<div class="table-responsive mb-4">
											<table class="table table-striped table-borderless text-center">
												<thead>
													<tr>
														<th>Nome</th>
														<th>E-mail</th>
														<th>Assinatura</th>
														<th>CPF</th>
														<th>Celular</th>
														<th>CEP</th>
														<th>Ativado</th>
														<th>Alterar</th>								
													</tr>
												</thead>
												<tbody>														
													@forelse($clientes as $cliente)
													<tr>
														<td>{{$cliente->nome}}</td>
														<td>{{$cliente->usuario()->first()->email}}</td>
														<td>{{$cliente->clienteAssinatura()->assinatura()->first()->nome}}</td>
														<td>{{$cliente->cpf}}</td>
														<td>{{$cliente->celular}}</td>
														<td>{{$cliente->endereco()->first()->cep}}</td>
														<td>{{$cliente->usuario()->first()->ativado ? 'Sim' : 'Não'}}</td>
														<td class="font-weight-bold">
															<a href="{{url('admin/editar/clientes?id='.$cliente->id)}}">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
																	<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
																	<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
																</svg>
															</a>
														</td>														
													</tr>
													@empty
													Nenhum usuario encontrado!												
													@endforelse
													
												</tbody>
											</table>											
										</div>	
										{{ $clientes->appends(Request::all())->links('vendor.pagination.bootstrap-5') }}						
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