@if(count($video) < 1)
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



<div class="row mt-3 clearfix">

    @foreach ($video as $videos)

    @php
        $tmp_id = strip_tags($videos->deskripsi_id);
        $tmp_en = strip_tags($videos->deskripsi_en);
        $url = explode("watch?v=",$videos->url_video);
        $url_video = $url[1];
    @endphp
    <div class="col-md-4">
        <article class="entry entry-custom">
            <div class="ipost clearfix">
                <div class="entry-image">
                    <div class="fluid-width-video-wrapper" style="padding-top: 56.25%;"><iframe src="//www.youtube.com/embed/{{ $url_video }}" frameborder="0" allowfullscreen="" id="fitvid1"></iframe></div>
                </div>
                <div class="entry-title">
                    <h3><a href="{{ route('galeri.video.preview',$videos->slug) }}">
                        {{ Session::has('locale') ? Session::get('locale') == 'id' ? $videos->judul_id : ( (!empty($videos->judul_en)) ? $videos->judul_en : $videos->judul_id ) : $videos->judul_id }}

                    </a></h3>
                </div>
                <div class="entry-content">
                    <p class="text-justify">{{ Session::has('locale') ? Session::get('locale') == 'id' ? (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .') : (empty($tmp_en) ? 'No Descripstion.' : substr($tmp_en,0,100).' . . .') : (empty($tmp_id) ? 'Belum ada deskripsi.' : substr($tmp_id,0,100).' . . .')  }}</p>
                </div>
                <ul class="entry-meta clearfix">
                    <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($videos->created_at)) }}</li>
                </ul>
            </div>
        </article>
    </div>
    @endforeach

    
    
    


</div>



</div>     

<!-- Pagging 
============================================= -->
{{$video->links('pagination.limit_links')}}



