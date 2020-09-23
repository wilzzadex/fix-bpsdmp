var base_url = window.location.origin + '/bpsdmp/home/'

var mySwiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    // spaceBetween: 30,
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
});

var _urlApi = '//kabayanconsulting.co.id/bpsdmp/api/pwa/'
var _urlPublic = '//kabayanconsulting.co.id/bpsdmp/file_app/'
var _urlGlobal = '//kabayanconsulting.co.id/bpsdmp/'

$(document).ready(function (){
    
    $( window ).on("load", function() {
        var _url_popup = _urlApi + 'popup'
        $.get(_url_popup, function(data){
            var img_popup_url = _urlPublic + 'popup_image/' + data.file
            $(".bs-example-modal-lg2").html(`
                <div class="modal-dialog modal-lg">
                    <div class="modal-body">
                        <center><img style='border-radius:10px;width:80%' src="`+img_popup_url+`" alt=""><center>
                    </div>
                </div>
            `);
            $(".bs-example-modal-lg2").modal('show');
        })
        
        setTimeout(function () {
            $(".bs-example-modal-lg2").modal('hide');
        },  5000);
    });

    function myBlock2()
    {
        $.blockUI({
            message: '<img width="30%" src="gif/13.gif"/>', 
            css: {
                backgroundColor: 'transparent',
                border: '0'
                }
        
        });
    }

    var listDate = []
		$.ajax({
			url : _urlApi + 'getDate',
			type: 'get',
			success:function(res){
				if(res.length != 0){
					Kalender(res)
				}else{
					Kalender(res)
				}
			}
        })
        

     // INI AWAL YANG BARU

     jQuery.ajaxQueue({
        url : _urlApi + 'struktur_single',
        type : 'get',
    }).done(function( res ) {
        var data = '';
            $.each(res, function(key,item){
                // console.log(item)
                if(item.id_parent == 0){
                    data += `<li>
                                <a href="#" id="getChildStruktur" data-id="`+item.id+`">
                                <div>`+item.nama+`</div>
                                </a>
                                <ul id="isi_struktur_menu_`+item.id+`">
                                </ul>
                            </li>`
                }else{
                    data += `<li>
                                <a href="`+_urlGlobal+'profil/struktur-organisasi/'+item.slug+`">
                                <div>`+item.nama+`</div>
                                </a>
                            </li>`
                }
               
                $('#strukturMenu').html(data)
                // $('#isi_struktur_menu').html(isiMenu)
            })
            
    });

    $('#strukturMenu').on('click','#getChildStruktur',function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url : _urlApi + 'struktur_child',
            type : 'get',
            data : {
                id : id
            },
            success: function(res){
                var isi_child = '';
                $.each(res, function(key,item){
                    isi_child += `<li>
                                        <a href="`+_urlGlobal+'profil/struktur-organisasi/'+item.slug+`">
                                            <div>`+item.nama+`</div>
                                        </a>
                                    </li>`
                    });
                $('#isi_struktur_menu_'+id).html(isi_child)
            }
        });
    })

    $('#strukturMenu').on('mouseover','#getChildStruktur',function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url : _urlApi + 'struktur_child',
            type : 'get',
            data : {
                id : id
            },
            success: function(res){
                var isi_child = '';
                $.each(res, function(key,item){
                    isi_child += `<li>
                                        <a href="`+_urlGlobal+'profil/struktur-organisasi/'+item.slug+`">
                                            <div>`+item.nama+`</div>
                                        </a>
                                    </li>`
                    });
                $('#isi_struktur_menu_'+id).html(isi_child)
            }
        });
    })

    jQuery.ajaxQueue({
        url : _urlApi + 'satker_single',
        type : 'get',
    }).done(function( res ) {
        var data = '';
            $.each(res, function(key,item){
                if(item.id_parent == 0){
                    data += `<li>
                                <a href="#" id="getChildSatker" data-id="`+item.id+`">
                                <div>`+item.nama+`</div>
                                </a>
                                <ul id="isi_satker_menu_`+item.id+`">
                                </ul>
                            </li>`
                }else{
                    data += `<li>
                                <a href="`+_urlGlobal+'profil/satuan-kerja/'+item.slug+`">
                                <div>`+item.nama+`</div>
                                </a>
                            </li>`
                }
               
                $('#satkerMenu').html(data)
                // $('#isi_struktur_menu').html(isiMenu)
            })
            
    });

    $('#satkerMenu').on('click','#getChildSatker',function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url : _urlApi + 'satker_child',
            type : 'get',
            data : {
                id : id
            },
            success: function(res){
                var isi_child = '';
                $.each(res, function(key,item){
                    isi_child += `<li>
                                        <a href="`+_urlGlobal+'profil/satuan-kerja/'+item.slug+`">
                                            <div>`+item.nama+`</div>
                                        </a>
                                    </li>`
                    });
                $('#isi_satker_menu_'+id).html(isi_child)
            }
        });
    })

    $('#satkerMenu').on('mouseover','#getChildSatker',function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url : _urlApi + 'satker_child',
            type : 'get',
            data : {
                id : id
            },
            success: function(res){
                var isi_child = '';
                $.each(res, function(key,item){
                    isi_child += `<li>
                                        <a href="`+_urlGlobal+'profil/satuan-kerja/'+item.slug+`">
                                            <div>`+item.nama+`</div>
                                        </a>
                                    </li>`
                    });
                $('#isi_satker_menu_'+id).html(isi_child)
            }
        });
    })


    
    // INI AKHIR YANG BARU 

    function Kalender(data){
        const calendar_el = document.querySelector('#my-calendar');

        const my_calendar = new TavoCalendar(calendar_el, {
            highlight_sunday: false,
            
            highlight: data,
            // multi_select: true,
            past_select: true,
        })

        calendar_el.addEventListener('calendar-select', (ev) => {
            var _tanggalSelect = my_calendar.getSelected()
            $.ajax({
                url : _urlApi + 'getEvent',
                type: 'get',
                data: {
                    tanggal:_tanggalSelect
                },
                beforeSend: function(){
                    myBlock2()
                },
                success:function(res){
                    $.unblockUI()
                    if(res.length == 0){
                        $('.modal-title').html('Kegiatan tanggal '+formatTanggal(_tanggalSelect))
                        $('.isi-modal').html('<center><h3>Tidak Ada kegiatan di tanggal Ini</h3></center>')
                        $('#myModal').modal('show')
                    }else{
                        var _isiModal = ''
                        
                        // console.log(base)
                        $.each(res,function(key,row){
                            var url = '{{ route("publikasi.event.detail", ":id") }}';
                            url = url.replace(':id', row.slug);
                            _isiModal += `
                                            <li><a href="`+url+`">`+row.judul_id+`</a></li>
                                            <li><i class="icon-calendar3"></i> `+formatTanggal(row.tanggal_awal)+` s/d `+formatTanggal(row.tanggal_akhir)+`</li>
                                            <li>`+row.jam+`</li>
                                            <hr>
                                            `
                        })
                        $('.modal-title').html('Kegiatan tanggal '+formatTanggal(_tanggalSelect))
                        $('.isi-modal').html(_isiModal)
                        $('#myModal').modal('show')
                    }
                    
                }
            })
            // $('#myModal').modal('show')
        })

    }

    

    
        var isi = ''
        $.ajax({
            url : _urlApi + 'slider',
            type: 'get',
            success:function(res)
            {
                $.each(res,function(key,data){
                    var imageSrc = _urlPublic + 'slider_image/'+data.img
                    mySwiper.addSlide(key, `<div class="swiper-slide dark" style="background-image: url(`+imageSrc+`);"></div>`)
                })  
               
            },
            error: function(err){
                mySwiper.addSlide(0, `<div class="swiper-slide dark" style="background-image: url('gambar/slide7.JPG');">
                                <div class="container clearfix">
                                    <div class="slider-caption text-white">
                                        <h2 data-animate="fadeInUp" class="text-white"> Taruna</h2>
                                    </div>
                                </div>
                            </div>`)
            }

        })
        
    var _urlAlbum = _urlApi + 'foto'
    var kontenFoto = '';
    $.ajax({
        url : _urlAlbum,
        type: 'get',
        success:function(data)
        {
            $.each(data, function(key,row){
                var _url_foto = _urlPublic + 'galeri/galeri_foto/' + row.img
                kontenFoto += `<div class="col-md-6">
                                    <div class="konten">
                                        <a href="javascript:void(0)" onclick="toAlbum('`+row.slug+`')">
                                            <center><img class="custom-img" src="`+_url_foto+`"></center>
                                        </a>
                                        <div>
                                            <h4><a class="custom-a" href="javascript:void(0)" onclick="toAlbum('`+row.slug+`')">`+row.judul_id+`</a></h4>
                                        </div>
                                    </div>
                                </div>`
            })
       
            $('.renderFoto').html(kontenFoto)
        },
        error: function (err){
            kontenFoto += `<div class="col-md-6">
                                    <div class="konten">
                                        <a href="javascript:void(0)" onclick="swalOffline()">
                                            <center><img class="custom-img" src="gambar/offline/offline1.jpg"></center>
                                        </a>
                                        <div>
                                            <h4><a class="custom-a" href="javascript:void(0)" onclick="swalOffline()">kegiatan Focus Group Discussion Analisis Lingkungan dan Isu Strategis</a></h4>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="konten">
                                    <a href="javascript:void(0)" onclick="swalOffline()">
                                        <center><img class="custom-img" src="gambar/offline/offline2.jpg"></center>
                                    </a>
                                    <div>
                                        <h4><a class="custom-a" href="javascript:void(0)" onclick="swalOffline()">Pelantikan 374 Perwira Pelayaran Niaga Politeknik Pelayaran Banten</a></h4>
                                    </div>
                                </div>
                            </div>`
            $('.renderFoto').html(kontenFoto)
        }
   
    })

    var _urlMedia = _urlApi + 'smedia'
    $.ajax({
        url : _urlMedia,
        type: 'get',
        success:function(data)
        {
            $.each(data, function(key,row){
                $('#renderMedia').append(`<li><a href="`+row.url+`" target="_blank"
                class="si-`+row.flag+` text-white" data-hover-width="108.625" style="width: 40px;"><span
                    class="ts-icon"><i class="icon-`+row.flag+`"></i></span><span
                    class="ts-text">`+row.flag+`</span></a></li>`)
                $('#renderMediaFooter').append(`<a href="`+row.url+`"
                    target="_blank" class="social-icon si-small si-rounded topmargin-sm si-`+row.flag+`">
                    <i class="icon-`+row.flag+`"></i>
                    <i class="icon-`+row.flag+`"></i>
                </a>`)
            })
            $('#renderMedia').append(`<li><a href="javascript:void(0)" onclick="toFaq()" class="text-white" style="width: 40px;"><img width="90%"
            src="gambar/faq.png" alt=""></a></li>`)
        },
        error: function(err){
            $('#renderMedia').append(`
            <ul>
                <li><a onclick="swalOffline()" target="_blank" class="si-facebook text-white" data-hover-width="108.625"
                        style="width: 40px;"><span class="ts-icon"><i class="icon-facebook"></i></span><span
                            class="ts-text">Facebook</span></a></li>
                <li><a onclick="swalOffline()" target="_blank" class="si-twitter text-white" data-hover-width="94.9625"
                        style="width: 40px;"><span class="ts-icon"><i class="icon-twitter"></i></span><span
                            class="ts-text">Twitter</span></a>
                </li>
                <li><a onclick="swalOffline()" target="_blank" class="si-instagram text-white" data-hover-width="110.6"
                        style="width: 40px;"><span class="ts-icon"><i
                                class="icon-instagram2"></i></span><span
                            class="ts-text">Instagram</span></a></li>
                <li><a onclick="swalOffline()" target="_blank" class="si-youtube text-white" data-hover-width="110.6"
                        style="width: 40px;"><span class="ts-icon"><i class="icon-youtube"></i></span><span
                            class="ts-text">Youtube</span></a></li>
                <li><a onclick="swalOffline()" class="text-white"
                        style="width: 40px;"><img width="90%" src="gambar/faq.png" alt=""></a></li>
            </ul>
            `)
            $('#renderMediaFooter').append(`
            <a onclick="swalOffline()" target="_blank"
                class="social-icon si-small si-rounded topmargin-sm si-facebook">
                <i class="icon-facebook"></i>
                <i class="icon-facebook"></i>
            </a>

            <a onclick="swalOffline()"
                target="_blank" class="social-icon si-small si-rounded topmargin-sm si-twitter">
                <i class="icon-twitter"></i>
                <i class="icon-twitter"></i>
            </a>

            <a onclick="swalOffline()" target="_blank"
                class="social-icon si-small si-rounded topmargin-sm si-instagram">
                <i class="icon-instagram"></i>
                <i class="icon-instagram"></i>
            </a>
            <a onclick="swalOffline()" target="_blank"
                class="social-icon si-small si-rounded topmargin-sm si-youtube">
                <i class="icon-youtube"></i>
                <i class="icon-youtube"></i>
            </a>
            `)
        }
    })

    var kontenVideo = ''
    var _urlVideo = _urlApi + 'video'
    $.ajax({
        url : _urlVideo,
        type: 'get',
        success:function(data)
        {
            $.each(data,function(key,row){
                var input = row.url_video;
                var fields = input.split('watch?v=');
                var _url_video = fields[1];
                kontenVideo += `<div class="col-md-6">
                                    <div class="konten">
                                    <iframe class="custom-img" width="270px" src="//www.youtube.com/embed/`+_url_video+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <div>
                                            <h4><a class="custom-a" href="javascript:void(0)" onclick="toVideo('`+row.slug+`')">`+row.judul_id+`</a></h4>
                                        </div>
                                    </div>
                                </div>`
            })
            $('.renderVideo').html(kontenVideo)
        },
        error:function(err){
            kontenVideo += `<div class="col-md-6">
                                <div class="konten">
                                <iframe class="custom-img" width="270px" src="//www.youtube.com/watch?v=TvAz5yZopqw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <div>
                                        <h4><a class="custom-a" href="javascript:void(0)" onclick="swalOffline()">Selamat hari perhubungan nasional</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="konten">
                                <iframe class="custom-img" width="270px" src="//www.youtube.com/watch?v=6H7_Z-DsjFs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <div>
                                        <h4><a class="custom-a" href="javascript:void(0)" onclick="swalOffline()">Sipencatar 2020</a></h4>
                                    </div>
                                </div>
                            </div>`
            $('.renderVideo').html(kontenVideo)
        }
    })

    var _urlBerita = _urlApi + 'berita'
    $.ajax({
        url : _urlBerita,
        type: 'get',
        success:function(data)
        {
            $.each(data, function(key,row){
                var strBerita = row.deskripsi_id;
                var des_id = strBerita.substr(0, 100);
                var strJudulBerita = row.judul_id;
                var jud_id = strJudulBerita.substr(0,60)
                // console.log(row)
                if(row.is_youtube == 1){
                    var input = row.media;
                    var fields = input.split('watch?v=');
                    var _url_video_berita = fields[1];
                    $('#renderBerita').append(` <div class="col-md-4">
                        <article class="entry entry-custom">
                            <div class="ipost clearfix">
                                <div class="entry-image">
                                    <iframe class="custom-img" width="350px" src="https://www.youtube.com/embed/`+_url_video_berita+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="entry-title">
                                    <h3><a href="javascript:void(0)" onclick="toBerita('`+row.slug+`')">`+jud_id+`
                                    ...</a></h3>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i>`+formatTanggal(row.tanggal_awal)+`</li>
                                
                                </ul>
                                <div class="entry-content">
                                    <p class="text-justify">`+des_id+`...</p>
                                </div>
                                <a href="javascript:void(0)" onclick="toBerita('`+row.slug+`')" class="more-link mt-3" style="color: #007dc2;">Selengkapnya</a>
                            </div>
                        </article>
                    </div>`)
                }else{
                    var _image_berita_src = _urlPublic + 'berita_image/'+ row.media
                    $('#renderBerita').append(` <div class="col-md-4">
                        <article class="entry entry-custom">
                            <div class="ipost clearfix">
                                <div class="entry-image">
                                    <a href="javascript:void(0)" onclick="toBerita('`+row.slug+`')"
                                    data-lightbox="image"><img class="image_fade custom-img"
                                        src="`+_image_berita_src+`"></a>
                                </div>
                                <div class="entry-title">
                                    <h3><a href="javascript:void(0)" onclick="toBerita('`+row.slug+`')">`+jud_id+`
                                    ...</a></h3>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i>`+formatTanggal(row.tanggal_awal)+`</li>
                                
                                </ul>
                                <div class="entry-content">
                                    <p class="text-justify">`+des_id+`...</p>
                                </div>
                                <a href="javascript:void(0)" onclick="toBerita('`+row.slug+`')" class="more-link mt-3" style="color: #007dc2;">Selengkapnya</a>
                            </div>
                        </article>
                    </div>`)
                }            
            })
        },
        error:function(err){
            $('#renderBerita').append(`
            <div class="col-md-4">
                <article class="entry entry-custom">
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            <a onclick="swalOffline()"
                            data-lightbox="image"><img class="image_fade custom-img"
                                src="gambar/offline/offline3.jpg"></a>
                        </div>
                        <div class="entry-title">
                            <h3><a onclick="swalOffline()">Bapak Sugihardjo melantik 59 Perwira Transportasi D III Prog
                            ...</a></h3>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i>26 Aug 2020</li>
                        
                        </ul>
                        <div class="entry-content">
                            <p class="text-justify">Hari ini (26/8) Kepala Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP), Bapak Sugihar...</p>
                        </div>
                        <a  onclick="swalOffline()" class="more-link mt-3" style="color: #007dc2;">Selengkapnya</a>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="entry entry-custom">
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            <a onclick="swalOffline()"
                            data-lightbox="image"><img class="image_fade custom-img"
                                src="gambar/offline/offline4.jpg"></a>
                        </div>
                        <div class="entry-title">
                            <h3><a onclick="swalOffline()">Kepala BPSDMP mengikuti Upacara Pengibaran Bendera yang terp ...</a></h3>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i>17 Aug 2020</li>
                        
                        </ul>
                        <div class="entry-content">
                            <p class="text-justify">Hari ini Kepala Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP), Bapak Sugihardjo ber...</p>
                        </div>
                        <a  onclick="swalOffline()" class="more-link mt-3" style="color: #007dc2;">Selengkapnya</a>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="entry entry-custom">
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            <a onclick="swalOffline()"
                            data-lightbox="image"><img class="image_fade custom-img"
                                src="gambar/offline/offline5.jpg"></a>
                        </div>
                        <div class="entry-title">
                            <h3><a onclick="swalOffline()">Kepala BPSDMP, Bapak Sugihardjo membuka kegiatan Focus Group ...</a></h3>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i>13 Aug 2020</li>
                        
                        </ul>
                        <div class="entry-content">
                            <p class="text-justify">Hari ini Kepala BPSDMP, Bapak Sugihardjo membuka kegiatan Focus Group Discussion Analisis Lingkun...</p>
                        </div>
                        <a  onclick="swalOffline()" class="more-link mt-3" style="color: #007dc2;">Selengkapnya</a>
                    </div>
                </article>
            </div>
            `)
        }
        
    })

    var _urlPers = _urlApi + 'pers'
    $.get(_urlPers, function(data){
        $.each(data, function(key,row){
            var strPers = row.deskripsi_id;
            var des_id = strPers.substr(0, 100);
            // console.log(row)
            if(row.is_youtube == 1){
                var input = row.media;
                var fields = input.split('watch?v=');
                var _url_video_pers = fields[1];
                $('#renderPers').append(` <div class="col-md-4">
                    <article class="entry entry-custom">
                        <div class="ipost clearfix">
                            <div class="entry-image">
                                <iframe class="custom-img" width="350px" src="https://www.youtube.com/embed/`+_url_video_pers+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="entry-title">
                                <h3><a href="javascript:void(0)" onclick="toPers('`+row.slug+`')">`+row.judul_id+`
                                </a></h3>
                            </div>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-calendar3"></i>`+formatTanggal(row.tanggal_awal)+`</li>
                            
                            </ul>
                            <div class="entry-content">
                                <p class="text-justify">`+des_id+`...</p>
                            </div>
                            <a href="javascript:void(0)" class="more-link mt-3" style="color: #007dc2;">Selengkapnya</a>
                        </div>
                    </article>
                </div>`)
            }else{
                var _image_pers_src = _urlPublic + 'pers_image/'+ row.media
                $('#renderPers').append(` <div class="col-md-4">
                    <article class="entry entry-custom">
                        <div class="ipost clearfix">
                            <div class="entry-image">
                                <a href="javascript:void(0)" onclick="toPers('`+row.slug+`')"
                                data-lightbox="image"><img class="image_fade custom-img"
                                    src="`+_image_pers_src+`"></a>
                            </div>
                            <div class="entry-title">
                                <h3><a href="javascript:void(0)" onclick="toPers('`+row.slug+`')">`+row.judul_id+`
                                </a></h3>
                            </div>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-calendar3"></i>`+formatTanggal(row.tanggal_awal)+`</li>
                            
                            </ul>
                            <div class="entry-content">
                                <p class="text-justify">`+des_id+`...</p>
                            </div>
                            <a href="javascript:void(0)" onclick="toPers('`+row.slug+`')" class="more-link mt-3" style="color: #007dc2;">Selengkapnya</a>
                        </div>
                    </article>
                </div>`)
            }

        })
    })

    
    var _urlInfografis = _urlApi + 'infografis'
    $.get(_urlInfografis, function(data){
        $.each(data,function(key,row){
            $("#renderInfografis").append(`
            <div class="col-md-4">
                <div class="oc-item">
                    <div class="iportfolio">
                        <div class="portfolio-image">
                            <a href="#">
                                <img width="" class="custom-img" src="`+_urlPublic+'infografis_image/'+row.media+`">
                            </a>
                            <div class="portfolio-overlay">
                                <a target="_blank" href="`+_urlPublic+'infografis_image/'+row.media+`" class="left-icon" data-lightbox="image"><i
                                        class="icon-eye"></i></a>
                                <a target="_blank" href="`+_urlPublic+'infografis_image/'+row.media+`" class="right-icon" download><i
                                        class="icon-download"></i></a>
                            </div>
                        </div>
                        <div class="portfolio-desc">
                            <h3><a href="javascript:void(0)">`+row.judul_id+`</a></h3>
                            <!-- <span><a href="#">UI Elements</a>, <a href="#">Media</a></span> -->
                        </div>
                    </div>
                </div>
            </div>
            `)
        })
    })

    


})


function swalOffline(){
    swal({
        icon : 'error',
        text : 'Anda Sedang Offline !',
    })
}
// BUTTON

function changeLang(data)
{
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'language/'+data
    }else{
       swalOffline()
    }
}

function toAlbum(data){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'galeri/foto/'+data
    }else{
        swalOffline()
    }
}

function toVideo(data){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'galeri/video/'+data
        // alert('ini video')
    }else{
        swalOffline()
    }
}

function toBerita(data){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'publikasi/berita/'+data
        // alert(data)
    }else{
        swalOffline()
    }
}

function toSejarah(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'profil/sejarah'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toVisi(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'profil/visi-misi'
        // alert(data)
    }else{
        swalOffline()
    }
}


function toTugas(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'profil/tugas-fungsi'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toDBerita(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'publikasi/berita'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toDPers(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'publikasi/siaran-pers'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toDEvent(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'publikasi/event'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toDinfografis(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'publikasi/infografis'
        // alert(data)
    }else{
        swalOffline()
    }
}


function toSekolah(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'sekolah-kedinasan'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toGFoto(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'galeri/foto'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toGVideo(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'galeri/video'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toKontak(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'kontak'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toFaq(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'kontak/faq'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toRegulasi(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'profil/regulasi'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toKerjaSama(){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'profil/kerja-sama'
        // alert(data)
    }else{
        swalOffline()
    }
}

function toMatra(data){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'sekolah-kedinasan/matra/'+data
        // alert(data)
    }else{
        swalOffline()
    }
}

function toPers(data){
    if (navigator.onLine) {
        window.location.href = _urlGlobal+'publikasi/siaran-pers/'+data
        // alert(data)
    }else{
        swalOffline()
    }
}

// ============
function formatTanggal(tanggal)
{
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    let dateObj = new Date(tanggal);
    let month = monthNames[dateObj.getMonth()];
    let day = String(dateObj.getDate()).padStart(2, '0');
    let year = dateObj.getFullYear();
    let output = day + ' ' + month  + ' ' + year;
    return output;
}




// console.log('ini abase url ' + base_url )




if('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register(base_url + 'sw.js').then(function(registration) {
        // Registration was successful
        // console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
        // registration failed :(
        // console.log('ServiceWorker registration failed: ', err);
        });
    });
}