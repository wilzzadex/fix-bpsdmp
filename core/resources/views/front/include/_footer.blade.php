@php
    
    $alamat = DB::table('alamat')->orderBy('id','DESC')->first();
        
@endphp
<footer id="footer" class="dark">

    <div class="container">

        <div class="footer-widgets-wrap clearfix">

            <div class="col_full">
                <div class="row">
                    <div class="col-md-3">
                        <div class="widget clearfix">
                            <h4 class="ftitle">@lang('homepage.kontak')</h4>
                            <div class="clearfix"
                                style="padding: 10px 0; background: url('{{ asset('front/images/world-map.png') }}') no-repeat center center;">

                                <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $alamat->alamat }}
                                <br>
                                <i class="fa fa-phone" aria-hidden="true"></i> {{ $alamat->no_telp }} <br>
                                <i class="fa fa-envelope" aria-hidden="true"></i> {{ $alamat->email }}




                            </div>

                            <img src="{{ asset('front/gambar/bpsdm.png') }}" alt="" class="footer-logo">



                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget clearfix">
                            <h4 class="ftitle">@lang('homepage.kalender')</h4>

                            <div id="my-calendar"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget widget_links clearfix">

                            <h4 class="ftitle">Menu</h4>

                            <ul>
                                <li><a href="{{ route('homepage') }}">Home</a></li>
                                <li><a href="{{ route('profil.sejarah') }}">@lang('homepage.profile')</a></li>
                                <li><a href="{{ route('publikasi.berita') }}">@lang('homepage.publish')</a></li>
                                <li><a href="{{ route('sekolah') }}">@lang('homepage.sekolah')</a></li>
                                <li><a href="{{ route('galeri.foto') }}">@lang('homepage.galeri')</a></li>
                                <li><a href="{{ route('kontak') }}">@lang('homepage.kontak')</a></li>
                                <li><a href="https://sipencatar.dephub.go.id/">@lang('homepage.penerimaan')</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget quick-contact-widget form-widget clearfix">

                            <h4 class="ftitle">@lang('homepage.sosial')</h4>

                            @foreach ($social_media as $smf)
                            <a href="{{ $smf->url }}" target="_blank" class="social-icon si-small si-rounded topmargin-sm si-{{ $smf->flag }}">
                                <i class="icon-{{ $smf->flag }}"></i>
                                <i class="icon-{{ $smf->flag }}"></i>
                            </a>
                            @endforeach

                           

                            


                        </div>
                    </div>
                </div>


            </div>



        </div>
    </div>


    <div id="copyrights">

        <div class="container clearfix">

            <div class="col_full nobottommargin center">
            
                Copyrights &copy; 2020
            </div>

        </div>

    </div>

</footer>