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
										<h4 class="card-title text-center">{{$cliente->usuario->nome}}</h4>
                                        @if ($cliente->clienteAssinatura != null)
                                        <p class="card-description text-center">
											{{$cliente->clienteAssinatura->assinatura->nome}}
										</p>  
                                        @else
                                        <p class="card-description text-center">
											Nenhuma
										</p>  
                                        @endif									
										<div class="card">
                                            <div class="card-body">
                                            <h4 class="card-title">Total: {{'R$' . number_format($totalPedido, 2, ',', '.'); }}</h4>
                                              <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Produto</th>
                                                            <th>Valor</th>
                                                            <th>Quantidade</th>
                                                            <th>Laboratório</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>														
                                                        @forelse($pedidos as $pedido)
                                                        <tr>
                                                            <td><img src="{{asset("storage/img/produtos/".$pedido->produto->nomeP)}}"></td>
                                                            <td>{{$pedido->produto->nome}}</td>
                                                            <td>{{'R$' . number_format($pedido->produto->valor, 2, ',', '.'); }}</td>
                                                            <td>{{$pedido->quantidade}}</td>
                                                            <td>{{$pedido->produto->laboratorio->nome}}</td>
                                                        </tr>
                                                        @empty
                                                        Nenhum pedido encontrado!												
                                                        @endforelse                                                        
                                                    </tbody>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
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