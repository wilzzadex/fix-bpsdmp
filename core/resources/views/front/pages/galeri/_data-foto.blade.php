@if(count($foto) < 1)
    <div class="style-msg errormsg mt-5">
        <div class="sb-msg text-center">@lang('homepage.no-data')</div>
    </div>
    <script>
        $('#container-show').hide();
    </script>
@else
<script>
    $('#container-show').show();
</script>
@endif

<div id="portfolio" class="portfolio grid-container portfolio-3 portfolio-masonry clearfix"
style="position: relative;">

<div class="row container-clearfix">
    @foreach ($foto as $fotos)
     
    <div class="col-md-4">
        <article style="width : 400px" class="portfolio-item pf-media pf-icons" style="position: absolute; left: 0px; top: 0px;">
            <div class="portfolio-image custom-img">
                @php
                   $d_foto = DB::table('gallery')->where('relasi',1)->where('relasi_id',$fotos->id)->first();
                @endphp
                <a href="#">
                    <img src="{{ asset('file_app/galeri/galeri_foto/'.$d_foto->img) }}" alt="Open Imagination">
                </a>
                {{-- <a href=""> --}}
                    <div class="portfolio-overlay show-image">
                        <a href="{{ route('galeri.foto.detail',$fotos->slug) }}" class="center-icon"><i
                                class="fa fa-th-large"></i></a>
                    </div>
                {{-- </a> --}}
            </div>
            <div class="portfolio-desc">
                <h3><a href="{{ route('galeri.foto.detail',$fotos->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $fotos->judul_id : ( (!empty($fotos->judul_en)) ? $fotos->judul_en : $fotos->judul_id ) : $fotos->judul_id }}</a></h3>
                <!-- <span><a href="#">Media</a>, <a href="#">Icons</a></span> -->
            </div>
        </article>
    </div>
       
    @endforeach
</div>

{{-- id="{{ $fotos->id }}" data-toggle="modal" data-target="#myModal --}}



</div>     

<!-- Pagging 
============================================= -->
{{$foto->links('pagination.limit_links')}}

