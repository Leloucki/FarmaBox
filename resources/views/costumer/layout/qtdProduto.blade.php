@isset($qtdPC)                                           
<div class="wrap-icon right-section" id="qtdPC">
    <div class="wrap-icon-section minicart">
        <a href="{{url('perfil/assinatura')}}" class="link-direction">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-prescription2" viewBox="0 0 16 16">
                <path d="M7 6h2v2h2v2H9v2H7v-2H5V8h2V6Z"/>
                <path fill-rule="evenodd" d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v10.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 14.5V4a1 1 0 0 1-1-1V1Zm2 3h8v10.5a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5V4ZM3 3V1h10v2H3Z"/>
            </svg>
            <div class="left-info">
                @if ($qtdPC > 1)
                <span class="index">{{$qtdPC}} produtos</span>
                @else
                <span class="index">{{$qtdPC}} produto</span>
                @endif
                
                <span class="title">Minha assinatura</span>
            </div>
        </a>
    </div>
    <div class="wrap-icon-section show-up-after-1024">
        <a href="" class="mobile-navigation">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
</div>
@endisset