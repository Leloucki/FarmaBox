<!DOCTYPE html>
<html lang="en">

@include('adminV.layout.head')

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <a href="{{url('admin')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            </a>
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">              
              <div class="brand-logo">
                <h1>FarmaBox</h1>
              </div>
              <h4>Reset de Senha</h4>
              <form class="pt-3" action="{{url('admin/recuperar-senha')}}" method="POST">@csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="E-Mail" required>
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
