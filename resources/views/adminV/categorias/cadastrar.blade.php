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
										<h4 class="card-title text-center">Cadastro</h4>
										<p class="card-description text-center">
											Categoria
										</p>								
										<form class="forms-sample" method="POST" action="{{url('admin/cadastrar/categorias')}}">
											@csrf
											<div class="form-group">
												<label for="exampleInputName1">Nome</label>
												<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da categoria" required>
											</div>
											<button type="submit" class="btn btn-primary m-auto d-flex justify-content-evenly">Cadastrar</button>
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