{{-- @php
    dd(count($berita))
@endphp --}}
@if(count($berita) < 1)
    <div class="style-msg errormsg">
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

    <div class="row mt-3 clearfix">
        @foreach ($berita as $beritas)
        @php
            $tmp_id = strip_tags($beritas->deskripsi_id);
            $tmp_en = strip_tags($beritas->deskripsi_en);
        @endphp
            @if ($beritas->is_youtube == 1)
            <div class="col-md-4">
                <article class="entry entry-custom">
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            @php
                                $video = explode("watch?v=",$beritas->media);
                                $video_url = $video[1];
                                // dd($video);
                            @endphp
                            <iframe width="100%" height="190px" src="https://www.youtube.com/embed/{{ $video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="entry-title">
                            <h3><a href="{{ route('publikasi.pers.detail',$beritas->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $beritas->judul_id : ( (!empty($beritas->judul_en)) ? $beritas->judul_en : $beritas->judul_id ) : $beritas->judul_id }}
                            </a></h3>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($beritas->tanggal_awal)) }}</li>
                            <!-- <li><a href="detail_berita.php#comments"><i class="icon-comments"></i> 53</a></li> -->
                        </ul>
                        <div class="entry-content">
                            <p class="text-justify">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .') : (empty($tmp_en) ? 'No Descripstion.' : substr($tmp_en,0,100).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .')  }}</p>
                        </div>
                        <a href="{{ route('publikasi.pers.detail',$beritas->slug) }}" class="more-link mt-3" style="color: #007dc2;">Read More</a>
                    </div>
                </article>
            </div>  
            @else 
            <div class="col-md-4">
                <article class="entry entry-custom">
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            <a href="{{ asset('file_app/pers_image/'.$beritas->media) }}"
                            data-lightbox="image"><img class="image_fade custom-img"
                                src="{{ asset('file_app/pers_image/'.$beritas->media) }}"></a>
                        </div>
                        <div class="entry-title">
                            <h3><a href="{{ route('publikasi.pers.detail',$beritas->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $beritas->judul_id : ( (!empty($beritas->judul_en)) ? $beritas->judul_en : $beritas->judul_id ) : $beritas->judul_id }}
                            </a></h3>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($beritas->tanggal_awal)) }}</li>
                            <!-- <li><a href="detail_berita.php#comments"><i class="icon-comments"></i> 53</a></li> -->
                        </ul>
                        <div class="entry-content">
                            <p class="text-justify">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,120).' . . .') : (empty($tmp_en) ? 'No Descripstion.' : substr($tmp_en,0,120).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,120).' . . .')  }}</p>
                        </div>
                        <a href="{{ route('publikasi.pers.detail',$beritas->slug) }}" class="more-link mt-3" style="color: #007dc2;">Read More</a>
                    </div>
                </article>
            </div>
            @endif
       
        @endforeach
        
    </div>      

<!-- Pagging 
============================================= -->
{{$berita->links('pagination.limit_links')}}