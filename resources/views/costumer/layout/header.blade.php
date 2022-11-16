<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="{{url('/')}}" class="link-to-home"> <img src="{{asset('costumer/images/logo-top-1.png')}}" width="100%"></a>
                    </div>

                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form action="/produtos" id="form-search-top" name="form-search-top" method="GET">
                                <input type="text" name="search" id="search" value="" placeholder="Procurar...">
                                <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                <div class="wrap-list-cate">
                                    <input type="hidden" name="categoria" id="categoria" value="0" id="product-cate">
                                    <a href="" class="link-control">Categorias</a>
                                    <ul class="list-cate" id="categoriaSearch">
                                        <li class="level-0" value="0">Todas as categorias</li>
                                        @forelse ($categorias as $categoria)
                                            <li class="level-1" value="{{$categoria->id}}">{{$categoria->nome}}</li>
                                        @empty
                                            
                                        @endforelse                                        
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    @include('costumer.layout.qtdProduto')
                    
                </div>
            </div>

                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                            <li class="menu-item home-icon">
                                <a href="/" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('assinatura')}}" class="link-term mercado-item-title">Assinaturas</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('produtos')}}" class="link-term mercado-item-title">Produtos</a>
                            </li>
                            @if(Auth::check())
                                <li class="menu-item menu-right">
                                    <div class="navbar-nav ml-auto action-buttons">
                                        <div class="nav-item dropdown">
                                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4 menu-login" aria-expanded="false">Olá, {{Auth::user()->nome}}!</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="/perfil">Minha Conta</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="{{url('/logout')}}">Logout</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="menu-item menu-right">
                                    <a href="{{url('cadastro')}}" class="link-term mercado-item-title">Cadastrar-se</a>
                                </li>
                                <li class="menu-item menu-right" >    
                                    <div class="navbar-nav ml-auto action-buttons">
                                        <div class="nav-item dropdown">
                                            <a href="" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4 menu-login" aria-expanded="false">Login</a>
                                            <div class="dropdown-menu action-form">
                                                <form action="{{url('/login/cliente')}}" method="post">@csrf                                 
                                                    <div class="form-group">
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                                                    </div>
                                                    <input class="form-check-input" type="checkbox" value="1" name="remember" id="remember">
                                                    <label class="form-check-label" for="remember">
                                                        Lembrar de mim?
                                                      </label>
                                                    <input type="submit" class="btn btn-success btn-block" value="Login">
                                                    <div class="text-center mt-2">
                                                        <a href="/recuperar-senha">Esqueceu a senha?</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>	
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
