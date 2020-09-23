@extends('front.master')

@section('content')

<section id="page-title">

    <div class="container clearfix">
        <h1>@lang('homepage.pers')</h1>
        <!-- <span>BPSDM COLLABORATES WITH THE EUROPEAN COMMISSION IN ORGANISING VIRTUAL GENERAL LECTURE TO GIVE INTERNATIONAL INSIGHT TO CADETS</span> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.publish')</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('homepage.pers')</a></li>
            <!-- <li class="breadcrumb-item active" aria-current="page">BPSDMP SELENGGARAKAN WISUDA DAN TRADISI BON VOYAGE BAGI LULUSAN MASTER KEPELAUTAN BP3IP -->
            </li>
        </ol>
    </div>

</section>




<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <!-- Post Content
					============================================= -->
            <div class="postcontent nobottommargin clearfix">

                <div class="single-post nobottommargin">

                    <!-- Single Post
							============================================= -->
                    <div class="entry clearfix">

                        <!-- Entry Title
								============================================= -->
                        <div class="entry-title">
                            <h2>{{ Session::has('locale') ? Session::get('locale') == 'id' ? $pers->judul_id : ( (!empty($pers->judul_en)) ? $pers->judul_en : $pers->judul_id ) : $pers->judul_id  }}</h2>
                        </div><!-- .entry-title end -->

                        <!-- Entry Meta
								============================================= -->
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i> {{ date('d M Y',strtotime($pers->tanggal_awal)) }}</li>
                            <!-- <li><a href="#"><i class="icon-user"></i> admin</a></li> -->
                            <!-- <li><i class="icon-folder-open"></i> <a href="#">General</a>, <a href="#">Media</a></li> -->
                            <!-- <li><a href="#"><i class="icon-comments"></i> 43 Comments</a></li> -->
                            <!-- <li><a href="#"><i class="icon-camera-retro"></i></a></li> -->
                        </ul><!-- .entry-meta end -->

                        <!-- Entry Image
								============================================= -->
                        <div class="entry-image bottommargin">
                
                            @if ($pers->is_youtube == 1)
                            @php
                                $video = explode("watch?v=",$pers->media);
                                $video_url = $video[1];
                                // dd($video);
                            @endphp
                            <iframe  height="150px" src="https://www.youtube.com/embed/{{$video_url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else 
                            <img class="image_fade" src="{{ asset('file_app/pers_image/'.$pers->media) }}">
                            @endif
                        </div>

                        <!-- Entry Content
								============================================= -->
                        <div class="entry-content notopmargin">

                            {!! Session::has('locale') ? Session::get('locale') == 'id' ? $pers->deskripsi_id : ( (!empty($pers->deskripsi_en)) ? $pers->deskripsi_en : $pers->deskripsi_id ) : $pers->deskripsi_id  !!}
                            
						{{-- <h4>Attachment</h4>

						<table class="table table-bordered">
						  <thead>
							<tr>
							  <th>No</th>
							  <th style="min-width: 300px;">File</th>
							  <th style="max-width:100px;">Aksi</th>
							</tr>
						  </thead>
						  <tbody>
                             <tr>
                                 <td>1.</td>
                                 <td>Dokumen Pers</td>
                                 <td><a href="attachment/attach1.pdf" class="btn btn-primary float-right" download="">Download</a></td>
                             </tr>
                             
						  </tbody>
						</table> --}}

                            <div class="clear"></div>

                            <!-- Post Single - Share
									============================================= -->
                            <div class="si-share noborder clearfix">
                                <span>Share :</span>
                                <div>
                                    <a href="#" class="social-icon si-borderless si-facebook">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <a href="#" class="social-icon si-borderless si-twitter">
                                        <i class="icon-twitter"></i>
                                        <i class="icon-twitter"></i>
                                    </a>
                                    <a href="#" class="social-icon si-borderless si-instagram">
                                        <i class="icon-instagram"></i>
                                        <i class="icon-instagram"></i>
                                    </a>
                                    <a href="#" class="social-icon si-borderless si-youtube">
                                        <i class="icon-youtube"></i>
                                        <i class="icon-youtube"></i>
                                    </a>

                                </div>
                            </div><!-- Post Single - Share End -->

                        </div>
                    </div><!-- .entry end -->
                    <!-- <div class="line"></div> -->
                </div>

            </div><!-- .postcontent end -->

            <!-- Sidebar
					============================================= -->
            <div class="sidebar nobottommargin col_last clearfix">
                <div class="sidebar-widgets-wrap">
                    <div class="widget clearfix mt-5" style="margin-top: 250px;">
                        
                        <h4>@lang('homepage.latest')</h4>  
                        @foreach ($pers_lain as $item)
                            @if ($item->is_youtube==1)
                                <div id="popular-post-list-sidebar">
                                    <div class="spost clearfix">
                                        <div class="entry-image">
                                            @php
                                                $video = explode("watch?v=",$item->media);
                                                $video_url = $video[1];
                                                // dd($video);
                                            @endphp
                                            <iframe height="300px" src="https://www.youtube.com/embed/{{ $video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                        <div class="entry-c">
                                            <div class="entry-title">
                                                <h4><a href="{{ route('publikasi.pers.detail',$item->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $item->judul_id : ( (!empty($item->judul_en)) ? $item->judul_en : $item->judul_id ) : $item->judul_id  }}</a></h4>
                                            </div>
                                            <ul class="entry-meta">
                                                <li><i class="icon-calendar3"></i> {{  date('d M Y',strtotime($item->tanggal_awal)) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <br>

                            @else
                            <div id="popular-post-list-sidebar">
                                <div class="spost clearfix">
                                    <div class="entry-image">
                                        <a href="{{ asset('file_app/pers_image/'.$item->media) }}" class="nobg"><img class="rounded-circle"
                                                src="{{ asset('file_app/pers_image/'.$item->media) }}" alt=""></a>
                                    </div>
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="{{ route('publikasi.pers.detail',$item->slug) }}">{{ Session::has('locale') ? Session::get('locale') == 'id' ? $item->judul_id : ( (!empty($item->judul_en)) ? $item->judul_en : $item->judul_id ) : $item->judul_id  }}</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li><i class="icon-calendar3"></i> {{  date('d M Y',strtotime($item->tanggal_awal)) }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @endif
                       
                        @endforeach



                    </div>


                    <!-- <div class="widget clearfix">

                        <h4>Attachment</h4>
                        <div class="tagcloud">
                            <a href="attachment/attach1.pdf" download="">Pdf</a>
                            <a href="attachment/attach1.docx" download="">Word</a>
                            <a href="attachment/attach1.mp4" download="">Video</a>
                           
                        </div>

                    </div> -->

                </div>

            </div><!-- .sidebar end -->

        </div>

    </div>

</section>
@endsection