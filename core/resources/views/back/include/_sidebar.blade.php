<div class="main-navigation navbar-collapse collapse">
    <!-- start: MAIN MENU TOGGLER BUTTON -->
    <!-- <div class="navigation-toggler">
        <i class="clip-chevron-left"></i>
        <i class="clip-chevron-right"></i>
    </div> -->
    <!-- end: MAIN MENU TOGGLER BUTTON -->
    <!-- start: MAIN NAVIGATION MENU -->
    <ul class="main-navigation-menu">
        <li style="margin-top: 30px; margin-bottom: 20px;">
            <center><img src="{{ asset('back/gambar/13.png') }}" style="height:100px"><br><br>
                BPSDM PERHUBUNGAN
            </center>
        </li>
        <li class="{{Request::is('admin/dashboard*') ? 'active' : ''}}">
            <!--active open-->
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-tachometer"></i>
                <span class="title"> Dashboard </span><span class="selected"></span>
            </a>
        </li>

        <!-- HOMEPAGE -->
        <li class="{{Request::is('admin/homepage*') ? 'active' : ''}}">
            <a href="javascript:void(0)">
                <i class="fa fa-home" aria-hidden="true"></i>
                <span class="title"> Homepage </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li class="{{Request::is('admin/homepage/slider*') ? 'active' : ''}}">
                    <a href="{{ route('admin.slider.index') }}">
                        <span class="title"> Slider </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/homepage/social-media*') ? 'active' : ''}}">
                    <a href="{{ route('admin.sm.index') }}">
                        <span class="title"> Sosial Media </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/homepage/alamat*') ? 'active' : ''}}">
                    <a href="{{ route('admin.alamat.index') }}">
                        <span class="title"> Alamat </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/homepage/master-popup*') ? 'active' : ''}}">
                    <a href="{{ route('admin.popup.index') }}">
                        <span class="title"> Master Popup </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/homepage/regulasi*') ? 'active' : ''}}">
                    <a href="{{ route('admin.regulasi.index') }}">
                        <span class="title"> Regulasi & Kebijakan </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/homepage/kerja-sama*') ? 'active' : ''}}">
                    <a href="{{ route('admin.kerja.index') }}">
                        <span class="title"> Kerja Sama </span>
                    </a>
                </li>
               
            </ul>
        </li>

        <!-- PROFILE -->
        <li class="{{Request::is('admin/profil*') ? 'active' : ''}}">
            <a href="javascript:void(0)">
                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                <span class="title"> Profil </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li class="{{Request::is('admin/profil/sejarah*') ? 'active' : ''}}">
                    <a href="{{ route('admin.profil.sejarah') }}">
                        <span class="title"> Sejarah </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/profil/visi-misi*') ? 'active' : ''}}">
                    <a href="{{ route('admin.profil.visi') }}">
                        <span class="title"> Visi Misi </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/profil/tugas-fungsi*') ? 'active' : ''}}">
                    <a href="{{ route('admin.profil.tugas') }}">
                        <span class="title"> Tugas & Fungsi</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/profil/struktur-organisasi*') ? 'active' : ''}}">
                    <a href="{{ route('admin.profil.struktur') }}">
                        <span class="title"> Struktur Organisasi</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/profil/satuan-kerja*') ? 'active' : ''}}">
                    <a href="{{ route('admin.profil.satuan') }}">
                        <span class="title"> Satuan Kerja</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- PUBLIKASI -->
        <li class="{{Request::is('admin/publikasi*') ? 'active' : ''}}">
            <a href="javascript:void(0)">
                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                <span class="title"> Publikasi </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
                <li class="{{Request::is('admin/publikasi/berita*') ? 'active' : ''}}">
                    <a href="{{ route('admin.publikasi.berita') }}">
                        <span class="title"> Berita </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/publikasi/siaran-pers*') ? 'active' : ''}}">
                    <a href="{{ route('admin.publikasi.pers') }}">
                        <span class="title"> Siaran Pers </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/publikasi/infografis*') ? 'active' : ''}}">
                    <a href="{{ route('admin.publikasi.infografis') }}">
                        <span class="title"> Infografis </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/publikasi/event*') ? 'active' : ''}}">
                    <a href="{{ route('admin.publikasi.event') }}">
                        <span class="title"> Event </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{Request::is('admin/sekolah-kedinasan*') ? 'active' : ''}}">
            <!--active open-->
            <a href="{{ route('admin.sekolah') }}">
                <i class="fa fa-bank"></i>
                <span class="title"> Sekolah </span><span class="selected"></span>
            </a>
        </li>
        <li class="{{Request::is('admin/kontak*') ? 'active' : ''}}">
            <!--active open-->
            <a href="{{ route('admin.kontak') }}">
                <i class="fa fa-phone"></i>
                <span class="title"> Kontak </span><span class="selected"></span>
            </a>
        </li>
        <!-- MASTER DATA -->
        <li class="{{Request::is('admin/galeri*') ? 'active' : ''}}">
            <a href="javascript:void(0)">
                <i class="fa fa-camera" aria-hidden="true"></i>
                <span class="title"> Galeri </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
               
                <li class="{{Request::is('admin/galeri/foto*') ? 'active' : ''}}">
                    <a href="{{ route('admin.galeri.foto') }}">
                        <span class="title"> Foto </span>
                    </a>
                </li>
                <li class="{{Request::is('admin/galeri/video*') ? 'active' : ''}}">
                    <a href="{{ route('admin.galeri.video') }}">
                        <span class="title"> Video </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{Request::is('admin/faq*') ? 'active' : ''}}">
            <!--active open-->
            <a href="{{ route('admin.faq') }}">
                <i class="fa fa-question"></i>
                <span class="title"> Faq </span><span class="selected"></span>
            </a>
        </li>

        @if (auth()->user()->role == 'superadmin')
        <li class="{{Request::is('admin/user*') ? 'active' : ''}}">
            <a href="javascript:void(0)">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="title"> User </span><i class="icon-arrow"></i>
                <span class="selected"></span>
            </a>
            <ul class="sub-menu">
               
                <li class="{{Request::is('admin/user*') ? 'active' : ''}}">
                    <a href="{{ route('admin.user') }}">
                        <span class="title"> Manajemen User </span>
                    </a>
                </li>
                <!-- <li>
                    <a href="?menu=u_mrole">
                        <span class="title"> Manajemen Role </span>
                    </a>
                </li> -->
            </ul>
        </li>
        <li class="{{Request::is('admin/log*') ? 'active' : ''}}">
            <!--active open-->
            <a href="{{ route('admin.log') }}">
                <i class="fa fa-history"></i>
                <span class="title"> Log </span><span class="selected"></span>
            </a>
        </li>
        @endif
        
    </ul>
    <!-- end: MAIN NAVIGATION MENU -->
</div>