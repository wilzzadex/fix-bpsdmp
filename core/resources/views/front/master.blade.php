@php
   
    $locale = Config::get('app.locale');
    $social_media = DB::table('social_media')->get();
@endphp
<!DOCTYPE html>
<html dir="ltr" lang="{{ $locale }}">
{{-- {{ Config::get('app.locale') }} --}}
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
	============================================= -->
    @include('front.include._vendorcss')
    @yield('custom-css')

    <!-- Document Titlephp
	============================================= -->
    <title>BPSDM @yield('title')</title>
    <style>
        .text-yellow{
            color: #FCDB00 !important;
        }
        /* .modalCari {
            position: absolute;
            top: 10px;
            right: 100px;
            bottom: 0;
            left: 0;
            z-index: 10040;
            overflow: auto;
            overflow-y: auto;
        } */
    </style>
       {{-- @laravelPWA --}}


</head>
<body class="stretched">

    <!-- Document Wrapper
	============================================= -->
    <div id="wrapper" class="clearfix">


        {{-- TOP BAR --}}
        @include('front.include._top_bar')
        {{-- END TOP BAR --}}

        {{-- NAVBAR --}}
        @include('front.include._navbar')
        {{-- END NAVBAR --}}

        {{-- CONTENT --}}
        @yield('content')
        {{-- END CONTENT --}}


        @include('front.include._footer')
        

    </div><!-- #wrapper end -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-body">
                <div class="modal-content">
                    <div class="modal-header" style="margin: 0px !important;">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ul style="list-style-type: none;" class="isi-modal mb-3">
                            {{-- <li><a href="detail_event.php">UKP PRA PRALA TARUNA DIKLAT PEMBENTUKAN III</a></li>
                            <li>12.00 - 15.00</li>
                            <hr>
                            <li><a href="detail_event.php">UKP PRA PRALA TARUNA DIKLAT PEMBENTUKAN III</a></li>
                            <li>12.00 - 15.00</li> --}}
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-secondary " data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modalCari" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <br>
            <br>
          <div class="modal-content">
              <div class="modal-body">
                <form action="{{ route('pencarian') }}" style="margin-bottom: -3px" method="GET">
                    <div class="input-group input-group-custom">
                        <input type="text" name="q" class="form-control rounded" placeholder="Kata Kunci . . ." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn" type="submit"><i class="icon-line-search t500"></i> Cari</button>
                        </div>
                    </div>
                </form>
              </div>
               
          </div>
        </div>
      </div>
    {{-- <div class="modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
                <div class="modal-body">
                    <div class="input-group input-group-lg mt-1 input-group-custom">
                        <input type="text" name="q" class="form-control rounded noborder" placeholder="Kata Kunci . . ." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn" type="submit"><i class="icon-line-search t700"></i> Cari</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div> --}}
    <!-- Go To Top
	============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>


    @include('front.include._vendorscript')
    @include('front.include._myscript')
    @yield('custom-script')


   

</body>

</html>