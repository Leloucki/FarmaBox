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
						<div class="row m-auto" style="max-width: 50em">
							<div class="col-12 grid-margin stretch-card">
								<div class="card">
									<div class="card-body p-5">
										<h4 class="card-title text-center">Editar</h4>
										<p class="card-description text-center">
											Assinatura
										</p>										
										<form class="forms-sample" method="POST" action="{{url('admin/editar/assinaturas')}}">
											@csrf
											<div class="form-group">
												<input type="number" style="display: none" name="id_assinatura" value="{{$assinatura->id}}">
												<label for="nome">Nome</label>
												<input type="text" class="form-control" id="nome" placeholder="Nome da assinatura" value="{{$assinatura->nome}}" disabled>
												<br>
												<label for="valor">Preço</label>
												<input type="text" class="form-control real" name="valor" id="valor" placeholder="Valor da assinatura" value="{{number_format($assinatura->valor, 2, ',', '.'); }}" required>
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