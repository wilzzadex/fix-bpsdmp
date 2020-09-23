<?php

namespace App\Http\Controllers;
use App;
use Session;
use App\Alamat;
use App\Galeri;
use App\Album;
use App\Popup;
use App\Slider;
use App\Galeri_video;
use App\Publikasi;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function lang($lang)
    {
        Session::put('locale',$lang);
         return redirect()->back();
    }
    public function index()
    {
        return redirect('home/');
        
        // $popup = Popup::where('is_active',1)->first();
        // $popup_null = Popup::orderBy('id','DESC')->first();
        // if($popup == null){
        //     $data['popup'] = $popup_null;
        // }else{
        //     $data['popup'] = $popup;
        // }
        // $slider = Slider::orderBy('id','DESC')->take(5)->get();
        // $galeri = Album::orderBy('created_at','DESC')->take(2)->get();
        // $video = Galeri_video::orderBy('created_at','DESC')->take(2)->get();

        // $berita = Publikasi::where('kategori','berita')->where('is_draft',0)->orderBy('created_at','DESC')->take(3)->get();
        // $pers = Publikasi::where('kategori','pers')->where('is_draft',0)->orderBy('created_at','DESC')->take(3)->get();
        // $infografis = Publikasi::where('kategori','infografis')->where('is_draft',0)->orderBy('created_at','DESC')->take(3)->get();

        // $data['galeri'] = $galeri;
        // $data['slider'] = $slider;
        // $data['video'] = $video;
        // $data['berita'] = $berita;
        // $data['pers'] = $pers;
        // $data['infografis'] = $infografis;
        // // dd($data);
        // return view('front.pages.homepage',$data);
    }

    public function adminIndex()
    {
        
        return view('back.pages.dashboard');
    }

    public function index404()
    {
        return view('errors.404');
    }

    public function pencarian()
    {
        return view('front.pencarian');
    }
}
