<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
    </div>    
</footer>
<script src="{{asset('adminP/vendors/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminP/vendors/js/vendor.bundle.base.js')}}"></script>

<!-- inject:js -->
<script src="{{asset('adminP/js/off-canvas.js')}}"></script>
<script src="{{asset('adminP/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('adminP/js/template.js')}}"></script>
<script src="{{asset('adminP/js/settings.js')}}"></script>
<script src="{{asset('adminP/js/todolist.js')}}"></script>
<script src="{{asset('adminP/js/file-upload.js')}}"></script>
<!-- endinject -->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
<script src="{{asset('js/jquery.maskMoney.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/sweetalertToast.js')}}"></script>
<script src="{{asset('adminP/js/functions/mascaras.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
</script>
@if($errors->any())
    <style>
        .swal2-popup{
            min-width:25em !important;
            min-height:25em !important;
            font-size: 1rem !important;
            font-family: Georgia, serif;
        }
    </style>
    <script>
        Swal.fire({
            icon: "warning",
            html:
            @foreach ($errors->all() as $error)
            "<h3>{{ $error }}</h3>" +
            @endforeach
            ""
        });
    </script>
@endif

@if(session()->has('message'))
    <script>
        Swal.fire({
            icon: "{{session()->get('messageIcon')}}",
            title: "{{session()->get('messageTitle')}}",
            text: "{{session()->get('message')}}"
        });
    </script>
@endif

{{-- <span>{{dd($errors->all())}}</span> --}}