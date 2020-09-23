<!DOCTYPE html>

<html class="no-js">

<head>
    <title>ADMIN BPSDMP @yield('title')</title>
    @include('back.include._vendor-css')
    @include('back.include.mycss')
    @yield('vendor-css')
</head>

<body>

    @include('back.include._navbar')
    <div class="main-container">
        <div class="navbar-content">
            <!-- start: SIDEBAR -->
            @include('back.include._sidebar')
            <!-- end: SIDEBAR -->
        </div>

        <!-- start: PAGE -->
        <div class="main-content">
           
            <!-- CONTENT -->
            @yield('content')

            <!-- END CONTENT -->
            

            <div class="modal fade" id="detil" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="" id="gambar_modal" width="100%" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: PAGE -->
    </div>
    <!-- end: MAIN CONTAINER -->
    <!-- start: FOOTER -->
    <div class="footer clearfix">
        <div class="footer-inner">
            <script>
                document.write(new Date().getFullYear())
            </script> &copy; clip-one by cliptheme.
        </div>
        <div class="footer-items">
            <span class="go-top"><i class="clip-chevron-up"></i></span>
        </div>
    </div>
    <!-- end: FOOTER -->
   
    @include('back.include._vendor-script')

    <script>
          function customSwal(icon,title,text){
                swal({
                    icon : icon,
                    title : title,
                    text : text,
                })
            }
    </script>
    
    @yield('custom-script')
    
    @include('back.include.myscript')


  

</body>

</html>