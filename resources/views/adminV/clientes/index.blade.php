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
												<input type="text" class="form-control w-50 searchTable" id="nomeSearch" name="cpfSearch" placeholder="CPF Cliente" aria-label="search" aria-describedby="search">									
											</div>
										</form>
										<p class="card-title mb-0">Clientes</p>										
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
														<th>Nascimento</th>
														<th>Ativado</th>
														<th>Alterar</th>				
														<th>Ativar/Desativar</th>
													</tr>
												</thead>
												<tbody>														
													@forelse($clientes as $cliente)
													<tr>
														<td>{{$cliente->usuario->nome}}</td>
														<td>{{$cliente->usuario->email}}</td>													
														<td>
															@if ($cliente->clienteAssinatura()->first() != null){{$cliente->clienteAssinatura->assinatura->nome}} 
															@else
															Nenhuma
															@endif
														</td>						
														<td>{{$cliente->cpf}}</td>
														<td>{{$cliente->celular}}</td>
														<td>{{$cliente->endereco->cep}}</td>
														<td>							
															@if ($cliente->dtNasc != null)
															{{date_format(date_create($cliente->dtNasc),"d/m/Y")}}
															@endif
														</td>
														<td>{{$cliente->usuario->ativado ? 'Sim' : 'Não'}}</td>
														<td class="font-weight-bold">
															<a href="{{url('admin/editar/clientes?id='.$cliente->id)}}">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
																	<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
																	<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
																</svg>
															</a>
														</td>
														<td class="font-weight-bold">
															@if ($cliente->usuario->ativado)
																<form action="{{url('admin/desativar/clientes')}}" method="post">
																@csrf
																	<input type="text" style="display: none;" value="{{$cliente->id}}" name="idCliente">
																	<button style="border: none; background-color: unset;">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
																			<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
																			<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
																		</svg>
																	</button>
																</form>
															@else
																<form action="{{url('admin/ativar/clientes')}}" method="post">
																@csrf
																	<input type="text" style="display: none;" value="{{$cliente->id}}" name="idCliente">
																	<button style="border: none; background-color: unset;">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
																			<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
																			<path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
																		</svg>
																	</button>
																</form>
															@endif															
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