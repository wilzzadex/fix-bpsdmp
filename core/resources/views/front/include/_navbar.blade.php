<header id="header" class="transparent-header full-header" data-sticky-class="not-dark">


    <div id="header-wrap">

        <div class="container clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <!-- Logo
            ============================================= -->
            <div id="logo" style="border-bottom:none !important;">
                <a href="{{ route('homepage') }}" class="standard-logo" data-dark-logo="{{ asset('front/gambar/bpsdm2.PNG') }}"><img
                        src="{{ asset('front/gambar/bpsdm2.PNG') }}" alt="BPSDMP Logo"></a>
                <a href="{{ route('homepage') }}" class="retina-logo" data-dark-logo="{{ asset('front/gambar/bpsdm2.PNG') }}"><img
                        src="{{ asset('front/gambar/bpsdm2.PNG') }}" alt="BPSDMP Logo"></a>
            </div><!-- #logo end -->

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" style="border-bottom:none !important;">

                <ul>
                    <li><a href="{{ route('homepage') }}">
                            <div>Home</div>
                        </a>
                    </li>
                    <li><a href="#">
                            <div>@lang('homepage.profile')<i class="icon-angle-down"></i></div>
                        </a>
                        <ul>
                            <li><a href="{{ route('profil.sejarah') }}">
                                    <div>@lang('homepage.sejarah')</div>
                                </a>
                            </li>
                            <li><a href="{{ route('profil.visi') }}">
                                    <div>@lang('homepage.visi')</div>
                                </a>
                            </li>
                            <li><a href="{{ route('profil.tugas') }}">
                                    <div>@lang('homepage.tugas')</div>
                                </a>
                            </li>
                            <li><a href="#">
                                    <div>@lang('homepage.struktur_organisasi')
                                    </div>
                                </a>
                                <ul>
                                    @php
                                        $struktur_single = DB::table('struktur_org')->where('id_parent',100)->get();
                                    @endphp
                                    @foreach ($struktur_single as $struktur_single)
                                        <li>
                                            <a href="{{ route('profil.struktur-organisasi',$struktur_single->slug) }}">
                                                <div>{{ $struktur_single->nama }}</div>
                                            </a>
                                        </li>
                                    @endforeach
                                    @php
                                        $struktur_parent = DB::table('struktur_org')->where('id_parent',0)->get();
                                    @endphp
                                    @foreach ($struktur_parent as $struktur_parent)
                                        <li>
                                            <a href="#">
                                                <div>{{ $struktur_parent->nama }}</div>
                                            </a>
                                            <ul>
                                                @php
                                                    $struktur_child =  DB::table('struktur_org')->where('id_parent',$struktur_parent->id)->get();
                                                @endphp
                                                @foreach ($struktur_child as $struktur_child)
                                                <li>
                                                    <a href="{{ route('profil.struktur-organisasi',$struktur_child->slug) }}">
                                                        <div>{{ $struktur_child->nama }}</div>
                                                    </a>
                                                </li>
                                                @endforeach
                                               
                                            </ul>
                                        </li>   
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <div>@lang('homepage.satuan_kerja')</div>
                                </a>
                                <ul>
                                    @php
                                        $satuan_single = DB::table('satker')->where('id_parent',100)->get();
                                    @endphp
                                    @foreach ($satuan_single as $satuan_single)
                                        <li>
                                            <a href="{{ route('profil.satuan-kerja',$satuan_single->slug) }}">
                                                <div>{{ $satuan_single->nama }}</div>
                                            </a>
                                        </li>
                                    @endforeach
                                    @php
                                        $satuan_parent = DB::table('satker')->where('id_parent',0)->get();
                                    @endphp
                                    @foreach ($satuan_parent as $satuan_parent)
                                        <li>
                                            <a href="#">
                                                <div>{{ $satuan_parent->nama }}</div>
                                            </a>
                                            <ul>
                                                @php
                                                    $satuan_child =  DB::table('satker')->where('id_parent',$satuan_parent->id)->get();
                                                @endphp
                                                @foreach ($satuan_child as $satuan_child)
                                                <li>
                                                    <a href="{{ route('profil.satuan-kerja',$satuan_child->slug) }}">
                                                        <div>{{ $satuan_child->nama }}</div>
                                                    </a>
                                                </li>
                                                @endforeach
                                               
                                            </ul>
                                        </li>   
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">
                            <div>@lang('homepage.publish')<i class="icon-angle-down"></i></div>
                        </a>
                        <ul>
                            <li><a href="{{ route('publikasi.berita') }}">
                                    <div>@lang('homepage.berita')</div>
                                </a></li>
                            <li><a href="{{ route('publikasi.siaran-pers') }}">
                                    <div>@lang('homepage.pers')</div>
                                </a></li>
                            <li><a href="{{ route('publikasi.infografis') }}">
                                    <div>@lang('homepage.infografis')</div>
                                </a></li>
                            <li><a href="{{ route('publikasi.event') }}">
                                    <div>@lang('homepage.agenda')</div>
                                </a></li>
                            <li><a href="{{ route('publikasi.laporan') }}">
                                    <div>@lang('homepage.laporan_diklat')</div>
                                </a></li>
                            <li><a href="#">
                                    <div>@lang('homepage.big_data')</div>
                                </a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('sekolah') }}">
                            <div>@lang('homepage.sekolah')</div>
                        </a>
                    <li><a href="#">
                            <div>@lang('homepage.galeri')<i class="icon-angle-down"></i></div>
                        </a>
                        <ul>
                            <li><a href="{{ route('galeri.foto') }}">
                                    <div>@lang('homepage.foto')</div>
                                </a></li>
                            <li><a href="{{ route('galeri.video') }}">
                                    <div>@lang('homepage.vidio')</div>
                                </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('kontak') }}">
                            <div>@lang('homepage.kontak')</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://sipencatar.dephub.go.id/" target="_blank">
                            <div>@lang('homepage.penerimaan')</div>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="icon-search3"></i></a>
                    </li>
{{-- 
                    <div id="top-search">
                       

                    </div> --}}

                </ul>

            </nav><!-- #primary-menu end -->


        </div>

    </div>

</header>

