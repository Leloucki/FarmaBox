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
												<input type="text" class="form-control w-50 searchTable" id="nomeSearch" name="nomeSearch" placeholder="Nome Produto" aria-label="search" aria-describedby="search">									
												<span class="btn ml-auto p-0 mr-5">
													<a href="{{url('admin/produtos/cadastrar')}}">
														<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
															<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
														</svg>
													</a>
												</span>
											</div>
										</form>
										<p class="card-title mb-0">Produtos</p>										
										<div class="table-responsive mb-4">
											<table class="table table-striped table-borderless">
												<thead>
													<tr>
														<th>Nome</th>
														<th>Valor</th>
														<th>Descrição</th>
														<th>Laboratório</th>
														<th>Editar</th>
														<th>Excluir</th>
													</tr>
												</thead>
												<tbody>														
													@forelse($produtos as $produto)
													<tr>
														<td>{{$produto->nome}}</td>
														<td class="font-weight-bold">{{'R$' . number_format($produto->valor, 2, ',', '.'); }}</td>
														<td class="w-25 text-break container-scroller">{{Str::limit($produto->desc ?? "", 30)}}</td>
														<td class="font-weight-medium">
															<div class="font-weight-bold">{{$produto->laboratorio()->first()->nome}}</div>
														</td>
														<td class="font-weight-bold">
															<a href="{{url('admin/produtos/editar/'.$produto->id)}}">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
																	<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
																	<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
																</svg>
															</a>
														</td>
														<td class="font-weight-bold">
															<form action="{{url('admin/produtos/deletar')}}" method="post">
															@csrf
																<input type="text" style="display: none;" value="{{$produto->id}}" name="idProduto">
																<button style="border: none; background-color: unset;">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
																		<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
																	</svg>
																</button>
															</form>
														</td>
													</tr>
													@empty
													Nenhum produto encontrado!												
													@endforelse
													
													{{-- <tr>
														<td>Search Engine Optimization</td>
														<td class="font-weight-bold">$116</td>
														<td>13 Jun 2018</td>
														<td class="font-weight-medium">
															<div class="badge badge-success">Completed</div>
														</td>
													</tr>
													<tr>
														<td>Display Advertising</td>
														<td class="font-weight-bold">$551</td>
														<td>28 Sep 2018</td>
														<td class="font-weight-medium">
															<div class="badge badge-warning">Pending</div>
														</td>
													</tr>
													<tr>
														<td>Pay Per Click Advertising</td>
														<td class="font-weight-bold">$523</td>
														<td>30 Jun 2018</td>
														<td class="font-weight-medium">
															<div class="badge badge-warning">Pending</div>
														</td>
													</tr>
													<tr>
														<td>E-Mail Marketing</td>
														<td class="font-weight-bold">$781</td>
														<td>01 Nov 2018</td>
														<td class="font-weight-medium">
															<div class="badge badge-danger">Cancelled</div>
														</td>
													</tr>
													<tr>
														<td>Referral Marketing</td>
														<td class="font-weight-bold">$283</td>
														<td>20 Mar 2018</td>
														<td class="font-weight-medium">
															<div class="badge badge-warning">Pending</div>
														</td>
													</tr>
													<tr>
														<td>Social media marketing</td>
														<td class="font-weight-bold">$897</td>
														<td>26 Oct 2018</td>
														<td class="font-weight-medium">
															<div class="badge badge-success">Completed</div>
														</td>
													</tr> --}}
												</tbody>
											</table>											
										</div>	
										{{ $produtos->appends(Request::all())->links('vendor.pagination.bootstrap-5') }}						
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