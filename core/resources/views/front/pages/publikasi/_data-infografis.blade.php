{{-- @php
    dd(count($berita))
@endphp --}}
@if(count($info) < 1) <div class="style-msg errormsg">
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
            <div class="row mt-3">
                @foreach ($info as $infos)
                <div class="col-md-4">
                    <article style="width : 400px" class="portfolio-item pf-icons" style="position: absolute; left: 0px; top: 0px;">
                        <div class="portfolio-image custom-info">
                            <a href="#">
                                <img width="" src="{{ asset('file_app/infografis_image/'.$infos->media) }}" alt="Open Imagination">
                            </a>
                            <div class="portfolio-overlay">
                                <a href="{{ asset('file_app/infografis_image/'.$infos->media) }}" class="left-icon" data-lightbox="image"><i
                                        class="icon-eye"></i></a>
                                <a target="_blank" href="{{ asset('file_app/infografis_image/'.$infos->media) }}" class="right-icon" download><i
                                        class="icon-download"></i></a>
                            </div>
                        </div>
                        <div class="portfolio-desc">
                            <h3><a href="#">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $infos->judul_id : ( (!empty($infos->judul_en)) ? $infos->judul_en : $infos->judul_id ) : $infos->judul_id  }}</a></h3>
                            <!-- <span><a href="#">Media</a>, <a href="#">Icons</a></span> -->
                        </div>
                    </article>
        
                </div>  
                @endforeach
                
               
            </div>
        </div>
    
    <!-- Pagging 
============================================= -->
    {{$info->links('pagination.limit_links')}}