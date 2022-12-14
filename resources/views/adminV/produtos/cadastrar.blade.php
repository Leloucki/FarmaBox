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
							<div class="col-12 grid-margin stretch-card">
								<div class="card">
									<div class="card-body p-5">
										<h4 class="card-title text-center">Cadastro</h4>
										<p class="card-description text-center">
											Produto
										</p>
										
										<form class="forms-sample" method="POST" action="{{url('admin/cadastrar/produtos')}}" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
												<label for="exampleInputName1">Nome</label>
												<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do produto" required>
											</div>
											<div class="form-group">
											  <label for="valor">Valor</label>
											  <input type="text" class="form-control real" name="valor" id="valor" placeholder="R$" required>
											</div>
											<div class="form-group">
												<label for="laboratorio">Laboratório</label>
												<select class="form-control form-control-sm" id="laboratorio" name="laboratorio">
													@forelse ($laboratorios as $laboratorio)
														<option value="{{$laboratorio->id}}">{{$laboratorio->nome}}</option>
													@empty
														<option value="0">Nenhum laboratório cadastrado</option>
													@endforelse												  
												</select>
											</div>
											<div class="form-group">
												<label>Categoria</label>	
												<div class="row">
																																
												@forelse ($categorias as $categoria)
												<div class="col-md-3">
													<div class="form-check form-check-flat form-check-primary">
														<label class="form-check-label">
															<input type="checkbox" class="form-check-input" name="categorias[]" value="{{$categoria->id}}">
															{{$categoria->nome}}
															<i class="input-helper"></i>
														</label>
													</div>
												</div>
												@empty
												<div class="form-check form-check-flat form-check-primary">
													<label class="form-check-label">
														Nenhuma categoria cadastrada.
													</label>
												</div>
												@endforelse
												</div>																							
											</div>
											<div class="form-group">
												<label>Imagem</label>
												<p class="text-secondary">
													Tipo: jpg,png,jpeg,webp &nbsp; Minimo: 200x200 &nbsp; Máximo: 1000x1000 &nbsp; Proporção: 1:1
												</p>
												<input type="file" class="file-upload-default" name="imagem" id="imagem">
												<div class="input-group col-xs-12">
													<input type="text" class="form-control file-upload-info" disabled placeholder="Enviar imagem" required>
													<span class="input-group-append">
														<button class="file-upload-browse btn btn-primary" type="button">Enviar</button>
													</span>
												</div>
											</div>
											<div class="form-group">
												<label for="descricao">Descrição</label>
												<textarea class="form-control" id="descricao" name="descricao" rows="4"></textarea>
											</div>
											<button type="submit" class="btn btn-primary m-auto d-flex justify-content-evenly">Cadastrar</button>
											{{-- <button class="btn btn-light">Cancel</button> --}}
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