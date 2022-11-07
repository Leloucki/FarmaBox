<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
    <div class="widget mercado-widget categories-widget">
        <div class="widget-content">
            <ul class="list-category">
                <li class="category-item has-child-cate">
                    <a class="cate-link" href="{{url('/perfil')}}">Conta</a>
                    @if ($clienteAssin)
                    <a class="cate-link" href="{{url('/perfil/assinatura')}}">Minha Assinatura</a>
                    @endif                
                    <a class="cate-link" href="{{url('/perfil/pagamento')}}">Pagamento</a>
                </li>
            </ul>
        </div>
    </div><!-- Categories widget-->
</div><!--end sitebar-->