<!DOCTYPE html>
<html lang="en">
<head>
    <style>.card {
        border:none;
        padding: 10px 50px;
      }
  
      .card::after {
        position: absolute;
        z-index: -1;
        opacity: 0;
        -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
      }
  
      .card:hover {
  
  
        transform: scale(1.02, 1.02);
        -webkit-transform: scale(1.02, 1.02);
        backface-visibility: hidden; 
        will-change: transform;
        box-shadow: 0 1rem 3rem rgba(0,0,0,.75) !important;
      }
  
      .card:hover::after {
        opacity: 1;
      }
  
      .card:hover .btn-outline-primary{
        color:white;
        background:#007bff;
      }

      .margin{
          margin: 5%;
      }
      </style>
	@include('costumer.layout.head')
</head>
<body class="home-page home-01 ">
	<!--header-->
	@include('costumer.layout.header')

	<!--main area-->
    <main id="main">
        <div class="container">
          <div class="wrap-breadcrumb">
            <ul>
              <li class="item-link"><a href="#" class="link">home</a></li>
              <li class="item-link"><span>assinaturas</span></li>
            </ul>
          </div>
          <div class="row margin">

            @forelse ($assinaturas as $assinatura)
            <div class="col-lg-6 col-md-12 mb-4">
              <div class="card h-100 shadow-lg">
                <div class="card-body">
                  <div class="text-center p-3">
                    <h5 class="card-title">{{$assinatura->nome}}</h5>
                    <small>Individual</small>
                    <br><br>
                    <span class="h2">{{'R$' . number_format($assinatura->valor, 2, ',', '.'); }}@if ($assinatura->nome == 'Personalizado') + produtos @endif</span>/mês 
                    <br><br>
                  </div>
                  @if($assinatura->nome == 'Basico')
                    <p class="card-text">Produtos selecionados baseado no formulário preenchido por você</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                      </svg>Simples</li>
                      <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                      </svg>Econômico</li>
                    </ul>
                    <div class="card-body text-center">
                      <a href="{{url("/assinatura/cadastro/$assinatura->nome")}}">
                      <button class="btn btn-outline-primary btn-lg" style="border-radius:30px" href="{{url('/assinatura/cadastro/1')}}">Assinar</button>
                      </a>
                    </div>
                  @else
                    <p class="card-text">Produtos selecionados por você</p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>Costumizável</li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>Tenha somente o essencial</li>
                  </ul>
                  <div class="card-body text-center">
                    <a href="{{url("/assinatura/cadastro/$assinatura->nome")}}">
                    <button class="btn btn-outline-primary btn-lg" style="border-radius:30px" href="{{url('/assinatura/cadastro/1')}}">Assinar</button>
                    </a>
                  </div>
                  @endif                                                  
              </div>
            </div>
            @empty
              
            @endforelse
          </div>    
        </div>
    </main>
	<!--main area-->

	<!--footer area-->
	@include('costumer.layout.footer')
	<!--footer area-->
</body>
</html>