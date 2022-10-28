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
              <h4>Reset de Senha</h4>
              <form class="pt-3" action="{{url('admin/resetar-senha')}}" method="POST">@csrf
                <input type="hidden" name="token" value="{{$token}}">                             
                <input type="hidden" name="email" value="{{$email}}">   
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Senha" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Senha" required>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Enviar</button>
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
  @include('adminV.layout.footer')

</body>

</html>
