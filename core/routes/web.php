<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//DATA FOR PWA 
Route::group(['middleware' => ['language']], function () {  
	Route::get('language/{lang}','HomeController@lang');
	Route::get('/',['as' => 'homepage','uses'=>'HomeController@index']);
	Route::get('404',['as' => '404','uses'=>'HomeController@index404']);

	
// Halaman Depan / FRONTEND
	Route::prefix('profil')->group(function (){
		Route::get('sejarah',['as' => 'profil.sejarah','uses' => 'ProfilController@indexSejarah']);
		Route::get('visi-misi',['as' => 'profil.visi','uses' => 'ProfilController@indexVisi']);
		Route::get('tugas-fungsi',['as' => 'profil.tugas','uses' => 'ProfilController@indexTugas']);
		Route::get('satuan-kerja/{slug}',['as' => 'profil.satuan-kerja','uses' => 'ProfilController@indexSatuan']);
		Route::get('struktur-organisasi/{slug}',['as' => 'profil.struktur-organisasi','uses' => 'ProfilController@indexStruktur']);
		Route::get('regulasi',['as' => 'profil.regulasi','uses' => 'ProfilController@indexRegulasi']);
		Route::get('kerja-sama',['as' => 'profil.kerja','uses' => 'ProfilController@indexKerja']);
	});

	Route::prefix('publikasi')->group(function (){
		Route::get('berita',['as' => 'publikasi.berita','uses' => 'PublikasiController@indexBerita']);
		Route::get('berita/{slug}',['as' => 'publikasi.berita.detail','uses' => 'PublikasiController@detailBerita']);
		Route::get('siaran-pers',['as' => 'publikasi.siaran-pers','uses' => 'PublikasiController@indexPers']);
		Route::get('siaran-pers/{slug}',['as' => 'publikasi.pers.detail','uses' => 'PublikasiController@detailPers']);
		Route::get('infografis',['as' => 'publikasi.infografis','uses' => 'PublikasiController@indexInfografis']);
		Route::get('event',['as' => 'publikasi.event','uses' => 'PublikasiController@indexEvent']);
		Route::get('event/{slug}',['as' => 'publikasi.event.detail','uses' => 'PublikasiController@detailEvent']);
		Route::get('laporan-diklat',['as' => 'publikasi.laporan','uses' => 'PublikasiController@indexLaporan']);


		Route::prefix('data')->group(function (){
			Route::get('berita',['as' => 'publikasi.berita.data','uses' => 'PublikasiController@dataBerita']);
			Route::get('pers',['as' => 'publikasi.pers.data','uses' => 'PublikasiController@dataPers']);
			Route::get('infografis',['as' => 'publikasi.infografis.data','uses' => 'PublikasiController@dataInfo']);
			Route::get('event',['as' => 'publikasi.event.data','uses' => 'PublikasiController@dataEvent']);
			Route::get('getEvent',['as' => 'get.event','uses' => 'PublikasiController@getEvent']);
			Route::get('getDate',['as' => 'get.Date','uses' => 'PublikasiController@getDate']);
		});

		Route::prefix('cari')->group(function (){
			Route::get('infografis',['as' => 'publikasi.infografis.cari','uses' => 'PublikasiController@infografisCari']);
			Route::get('berita',['as' => 'publikasi.berita.cari','uses' => 'PublikasiController@beritaCari']);
			Route::get('pers',['as' => 'publikasi.pers.cari','uses' => 'PublikasiController@persCari']);
			Route::get('event',['as' => 'publikasi.event.cari','uses' => 'PublikasiController@eventCari']);
			Route::get('all',['as' => 'pencarian','uses' => 'HomeController@pencarian']);
		});

	});

	Route::prefix('sekolah-kedinasan')->group(function (){
		Route::get('/',['as' => 'sekolah','uses' => 'SekolahController@index']);
		Route::get('/{slug}',['as' => 'sekolah.detail','uses' => 'SekolahController@sekolahDetail']);
		Route::get('matra/{matra}',['as' => 'sekolah.matra','uses' => 'SekolahController@sekolahMatra']);
	});

	Route::prefix('galeri')->group(function (){
		Route::get('foto',['as' => 'galeri.foto','uses' => 'GaleriController@indexFoto']);
		Route::get('foto/{slug}',['as' => 'galeri.foto.detail','uses' => 'GaleriController@detailFoto']);
		Route::get('video/{slug}',['as' => 'galeri.video.preview','uses' => 'GaleriController@videoPreview']);
		Route::get('foto/preview',['as' => 'galeri.foto.preview','uses' => 'GaleriController@fotoPreview']);
		Route::get('video',['as' => 'galeri.video','uses' => 'GaleriController@indexVideo']);

		Route::prefix('data')->group(function (){
			Route::get('foto',['as' => 'galeri.foto.data','uses' => 'GaleriController@dataFoto']);
			Route::get('video',['as' => 'galeri.video.data','uses' => 'GaleriController@dataVideo']);
		});
			
		Route::prefix('cari')->group(function (){
			Route::get('foto',['as' => 'galeri.foto.cari','uses' => 'GaleriController@fotoCari']);
			Route::get('video',['as' => 'galeri.video.cari','uses' => 'GaleriController@videoCari']);
		});
	});

	Route::prefix('kontak')->group(function (){
		Route::get('/',['as' => 'kontak','uses' => 'KontakController@index']);
		Route::get('faq',['as' => 'kontak.faq','uses' => 'KontakController@faq']);
		Route::post('store',['as' => 'kontak.store','uses' => 'KontakController@kontakStore']);
	});
});




	// Halaman Admin/BACKEND
	Route::prefix('admin')->group(function () {

		Route::get('/',['as' => 'login','uses'=>'AuthController@index']);
		Route::post('loginpost',['as'=> 'loginpost','uses' => 'AuthController@loginpost']);
		Route::get('logout',['as'=> 'logout','uses' => 'AuthController@logout']);

		Route::group(['middleware' => ['auth','checkRole:superadmin']], function () {
			Route::prefix('user')->group(function (){
				Route::get('/',['as' => 'admin.user','uses'=>'UserController@index']);
				Route::get('add',['as' => 'admin.user.add','uses'=>'UserController@add']);
				Route::post('store',['as' => 'admin.user.store','uses'=>'UserController@store']);
				Route::get('{id}/edit',['as' => 'admin.user.edit','uses'=>'UserController@edit']);
				Route::get('destroy',['as' => 'admin.user.destroy','uses'=>'UserController@destroy']);
				Route::get('active',['as' => 'admin.user.active','uses'=>'UserController@active']);
				Route::post('{id}/update',['as' => 'admin.user.update','uses'=>'UserController@update']);
			});
		});

		// =========== ADMIN =======
		Route::group(['middleware' => ['auth','checkRole:superadmin,admin']], function () {

			Route::get('dashboard',['as' => 'admin.dashboard','uses'=>'AdminDashboardController@index']);

			// MENU HOMEPAGE
			Route::prefix('homepage')->group(function (){
				// Halaman Slider
				Route::prefix('slider')->group(function (){
					Route::get('/',['as' => 'admin.slider.index','uses'=>'AdminHomePageController@indexSlider']);
					Route::get('add',['as' => 'admin.slider.add','uses'=>'AdminHomePageController@sliderAdd']);
					Route::post('sliderpost',['as' => 'admin.slider.post','uses'=>'AdminHomePageController@sliderpost']);
					Route::get('delete',['as' => 'admin.slider.delete','uses'=>'AdminHomePageController@sliderdelete']);
					Route::get('viewedit/{id}',['as' => 'admin.slider.vedit','uses'=>'AdminHomePageController@viewEdit']);
					Route::post('editpost/{id}',['as' => 'admin.slider.epost','uses'=>'AdminHomePageController@editPost']);
				});

				// Halaman Social media
				Route::prefix('social-media')->group(function (){
					Route::get('/',['as' => 'admin.sm.index','uses'=>'AdminHomePageController@indexSocial']);
					Route::get('{id}/edit',['as' => 'admin.sm.edit','uses'=>'AdminHomePageController@smediaedit']);
					Route::post('{id}/edit',['as' => 'admin.sm.epost','uses'=>'AdminHomePageController@smediaepost']);
				});

				// Halaman Social media
				Route::prefix('alamat')->group(function (){
					Route::get('/',['as' => 'admin.alamat.index','uses'=>'AdminHomePageController@indexAlamat']);
					Route::post('alamatpost',['as' => 'admin.alamat.post','uses'=>'AdminHomePageController@alamatpost']);
				});

				// Halaman Master-popup
				Route::prefix('master-popup')->group(function (){
					Route::get('/',['as' => 'admin.popup.index','uses'=>'AdminHomePageController@indexPopup']);
					Route::get('/add',['as' => 'admin.popup.add','uses'=>'AdminHomePageController@popupAdd']);
					Route::post('store',['as' => 'admin.popup.store','uses'=>'AdminHomePageController@popupStore']);
					Route::get('delete',['as' => 'admin.popup.destroy','uses'=>'AdminHomePageController@popupDestroy']);
					Route::get('{id}/edit',['as' => 'admin.popup.edit','uses'=>'AdminHomePageController@popupEdit']);
					Route::post('{id}/update',['as' => 'admin.popup.update','uses'=>'AdminHomePageController@popupUpdate']);
					Route::get('isactive',['as' => 'admin.popup.isactive','uses'=>'AdminHomePageController@popupIsactive']);
				});

				Route::prefix('regulasi')->group(function (){
					Route::get('/',['as' => 'admin.regulasi.index','uses'=>'AdminProfilController@indexRegulasi']);
					Route::get('add',['as' => 'admin.regulasi.add','uses'=>'AdminProfilController@regulasiAdd']);
					Route::post('store',['as' => 'admin.regulasi.store','uses'=>'AdminProfilController@regulasiStore']);
					Route::get('destroy',['as' => 'admin.regulasi.destroy','uses'=>'AdminProfilController@regulasiDestroy']);
					Route::get('{id}/edit',['as' => 'admin.regulasi.edit','uses'=>'AdminProfilController@regulasiEdit']);
					Route::post('{id}/update',['as' => 'admin.regulasi.update','uses'=>'AdminProfilController@regulasiUpdate']);
				});

				Route::prefix('kerja-sama')->group(function (){
					Route::get('/',['as' => 'admin.kerja.index','uses'=>'AdminProfilController@indexKerja']);
					Route::get('add',['as' => 'admin.kerja.add','uses'=>'AdminProfilController@kerjaAdd']);
					Route::post('store',['as' => 'admin.kerja.store','uses'=>'AdminProfilController@kerjaStore']);
					Route::get('{id}/edit',['as' => 'admin.kerja.edit','uses'=>'AdminProfilController@kerjaEdit']);
					Route::post('{id}/update',['as' => 'admin.kerja.update','uses'=>'AdminProfilController@kerjaUpdate']);
					Route::get('destroy',['as' => 'admin.kerja.destroy','uses'=>'AdminProfilController@kerjaDestroy']);
				});



			});

			// MENU PROFIL
			Route::prefix('profil')->group(function (){

				// Halaman Sejarah
				Route::prefix('sejarah')->group(function (){
					Route::get('/',['as' => 'admin.profil.sejarah','uses'=>'AdminProfilController@indexSejarah']);
					Route::post('store',['as' => 'admin.profil.sejarah.store','uses'=>'AdminProfilController@sejarahStore']);
				});

				Route::prefix('visi-misi')->group(function (){
					Route::get('/',['as' => 'admin.profil.visi','uses'=>'AdminProfilController@indexVisi']);
					Route::post('update',['as' => 'admin.profil.visi.update','uses'=>'AdminProfilController@visiUpdate']);
				});

				Route::prefix('tugas-fungsi')->group(function (){
					Route::get('/',['as' => 'admin.profil.tugas','uses'=>'AdminProfilController@indexTugas']);
					Route::post('update',['as' => 'admin.profil.tugas.update','uses'=>'AdminProfilController@tugasUpdate']);
				});

				Route::prefix('struktur-organisasi')->group(function (){
					Route::get('/',['as' => 'admin.profil.struktur','uses'=>'AdminProfilController@indexStruktur']);
					Route::get('{name}/edit',['as' => 'admin.profil.struktur.edit','uses'=>'AdminProfilController@strukturEdit']);
					Route::post('{id}/update',['as' => 'admin.profil.struktur.update','uses'=>'AdminProfilController@strukturUpdate']);
					Route::post('store',['as' => 'admin.profil.struktur.store','uses'=>'AdminProfilController@strukturStore']);
					Route::get('datachild',['as' => 'admin.profil.struktur.child','uses'=>'AdminProfilController@strukturDatachild']);
				});

				Route::prefix('satuan-kerja')->group(function (){
					Route::get('/',['as' => 'admin.profil.satuan','uses'=>'AdminProfilController@indexSatuan']);
					Route::get('{name}/edit',['as' => 'admin.profil.satuan.edit','uses'=>'AdminProfilController@satuanEdit']);
					Route::post('{id}/update',['as' => 'admin.profil.satuan.update','uses'=>'AdminProfilController@satuanUpdate']);
					Route::get('datachild',['as' => 'admin.profil.satuan.child','uses'=>'AdminProfilController@satuanDatachild']);
				});

			});

			// MENU PUBLIKASI
			Route::prefix('publikasi')->group(function(){

				// Halaman berita
				Route::prefix('berita')->group(function (){
					Route::get('/',['as' => 'admin.publikasi.berita','uses'=>'AdminPublikasiController@indexBerita']);
					Route::get('add',['as' => 'admin.publikasi.berita.add','uses'=>'AdminPublikasiController@beritaAdd']);
					Route::post('store',['as' => 'admin.publikasi.berita.store','uses'=>'AdminPublikasiController@beritaStore']);
					Route::get('{id}/edit',['as' => 'admin.publikasi.berita.edit','uses'=>'AdminPublikasiController@beritaEdit']);
					Route::post('{id}/update',['as' => 'admin.publikasi.berita.update','uses'=>'AdminPublikasiController@beritaUpdate']);
					Route::get('destroy',['as' => 'admin.publikasi.berita.destroy','uses'=>'AdminPublikasiController@beritaDestroy']);
				});

				Route::prefix('siaran-pers')->group(function (){
					Route::get('/',['as' => 'admin.publikasi.pers','uses'=>'AdminPublikasiController@indexPers']);
					Route::get('add',['as' => 'admin.publikasi.pers.add','uses'=>'AdminPublikasiController@persAdd']);
					Route::post('store',['as' => 'admin.publikasi.pers.store','uses'=>'AdminPublikasiController@persStore']);
					Route::get('{id}/edit',['as' => 'admin.publikasi.pers.edit','uses'=>'AdminPublikasiController@persEdit']);
					Route::post('{id}/update',['as' => 'admin.publikasi.pers.update','uses'=>'AdminPublikasiController@persUpdate']);
					Route::get('destroy',['as' => 'admin.publikasi.pers.destroy','uses'=>'AdminPublikasiController@persDestroy']);
				});

				Route::prefix('infografis')->group(function (){
					Route::get('/',['as' => 'admin.publikasi.infografis','uses'=>'AdminPublikasiController@indexInfografis']);
					Route::get('add',['as' => 'admin.publikasi.infografis.add','uses'=>'AdminPublikasiController@infografisAdd']);
					Route::post('store',['as' => 'admin.publikasi.infografis.store','uses'=>'AdminPublikasiController@infografisStore']);
					Route::get('{id}/edit',['as' => 'admin.publikasi.infografis.edit','uses'=>'AdminPublikasiController@infografisEdit']);
					Route::post('{id}/update',['as' => 'admin.publikasi.infografis.update','uses'=>'AdminPublikasiController@infografisUpdate']);
					Route::get('destroy',['as' => 'admin.publikasi.infografis.destroy','uses'=>'AdminPublikasiController@infografisDestroy']);
				});

				Route::prefix('event')->group(function (){
					Route::get('/',['as' => 'admin.publikasi.event','uses'=>'AdminPublikasiController@indexEvent']);
					Route::get('add',['as' => 'admin.publikasi.event.add','uses'=>'AdminPublikasiController@eventAdd']);
					Route::post('store',['as' => 'admin.publikasi.event.store','uses'=>'AdminPublikasiController@eventStore']);
					Route::get('{id}/edit',['as' => 'admin.publikasi.event.edit','uses'=>'AdminPublikasiController@eventEdit']);
					Route::post('{id}/update',['as' => 'admin.publikasi.event.update','uses'=>'AdminPublikasiController@eventUpdate']);
					Route::get('destroy',['as' => 'admin.publikasi.event.destroy','uses'=>'AdminPublikasiController@eventDestroy']);

				});

			});

			// MENU SEKOLAH 
			Route::prefix('sekolah-kedinasan')->group(function (){
				Route::get('/',['as' => 'admin.sekolah','uses'=>'AdminSekolahController@index']);
				Route::get('add',['as' => 'admin.sekolah.add','uses'=>'AdminSekolahController@sekolahAdd']);
				Route::post('store',['as' => 'admin.sekolah.store','uses'=>'AdminSekolahController@sekolahStore']);
				Route::get('destroy',['as' => 'admin.sekolah.destroy','uses'=>'AdminSekolahController@sekolahDestroy']);
				Route::get('{id}/edit',['as' => 'admin.sekolah.edit','uses'=>'AdminSekolahController@sekolahEdit']);
				Route::post('{id}/update',['as' => 'admin.sekolah.update','uses'=>'AdminSekolahController@sekolahUpdate']);
				Route::get('destroyfoto',['as' => 'admin.sekolah.destroy_foto','uses'=>'AdminSekolahController@sekolahDestroyFoto']);
			});

			// MENU KONTAK
			Route::prefix('kontak')->group(function (){
				Route::get('/',['as' => 'admin.kontak','uses'=>'AdminKontakController@index']);
				Route::get('show',['as' => 'admin.kontak.show','uses'=>'AdminKontakController@kontakShow']);
				
			});

			// MENU GALERI
			Route::prefix('galeri')->group(function (){
				
				Route::prefix('foto')->group(function (){
					Route::get('/',['as' => 'admin.galeri.foto','uses'=>'AdminGaleriController@indexFoto']);
					Route::get('add',['as' => 'admin.galeri.foto.add','uses'=>'AdminGaleriController@fotoAdd']);
					Route::post('store',['as' => 'admin.galeri.foto.store','uses'=>'AdminGaleriController@fotoStore']);
					Route::get('{id}/edit',['as' => 'admin.galeri.foto.edit','uses'=>'AdminGaleriController@fotoEdit']);
					Route::post('{id}/update',['as' => 'admin.galeri.foto.update','uses'=>'AdminGaleriController@fotoUpdate']);
					Route::get('destroy',['as' => 'admin.galeri.foto.destroy','uses'=>'AdminGaleriController@fotoDestroy']);
					Route::get('destroyfoto',['as' => 'admin.galeri.destroy_foto','uses'=>'AdminGaleriController@foto_detailDestroy']);
				});

				Route::prefix('video')->group(function (){
					Route::get('/',['as' => 'admin.galeri.video','uses'=>'AdminGaleriController@indexVideo']);
					Route::get('add',['as' => 'admin.galeri.video.add','uses'=>'AdminGaleriController@videoAdd']);
					Route::post('store',['as' => 'admin.galeri.video.store','uses'=>'AdminGaleriController@videoStore']);
					Route::get('{id}/edit',['as' => 'admin.galeri.video.edit','uses'=>'AdminGaleriController@videoEdit']);
					Route::post('{id}/update',['as' => 'admin.galeri.video.update','uses'=>'AdminGaleriController@videoUpdate']);
					Route::get('destroy',['as' => 'admin.galeri.video.destroy','uses'=>'AdminGaleriController@videoDestroy']);
				});

			});

			Route::prefix('faq')->group(function (){
				Route::get('/',['as' => 'admin.faq','uses'=>'AdminKontakController@indexFaq']);
				Route::get('add',['as' => 'admin.faq.add','uses'=>'AdminKontakController@faqAdd']);
				Route::post('store',['as' => 'admin.faq.store','uses'=>'AdminKontakController@faqStore']);
				Route::get('{id}/edit',['as' => 'admin.faq.edit','uses'=>'AdminKontakController@faqEdit']);
				Route::post('{id}/update',['as' => 'admin.faq.update','uses'=>'AdminKontakController@faqUpdate']);
				Route::get('destroy',['as' => 'admin.faq.destroy','uses'=>'AdminKontakController@faqDestroy']);
			});

			Route::prefix('profil')->group(function (){
				Route::get('/',['as' => 'profil.edit','uses'=>'UserController@profilIndex']);
				Route::post('{id}/update',['as' => 'profil.update','uses'=>'UserController@profilUpdate']);
			});

			Route::prefix('log')->group(function (){
				Route::get('/',['as' => 'admin.log','uses'=>'UserController@logIndex']);
			});
			
		});

		

	});
