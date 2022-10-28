<!DOCTYPE html>
<html lang="en">

@include('adminV.layout.head')

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h1>FarmaBox</h1>
              </div>
              <h4>Acesso Restrito</h4>
              <h6 class="font-weight-light">Realize o login para continuar.</h6>
              <form class="pt-3" action='{{url('admin/login')}}' method="POST">@csrf
                @if (session()->has('success'))
								<div class="alert alert-success">
									{{ session('success') }}
								</div>
								@endif
                @if ($errors->any())
								<div class="alert alert-danger">
										@foreach ($errors->all() as $error)
											{{ $error }}
										@endforeach
								</div>
                @endif
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="E-Mail" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Senha" required>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Logar</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="{{url('admin/recuperar-senha')}}" class="auth-link text-black">Esqueceu a senha?</a>
                </div>
                {{-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

</body>

</html>
