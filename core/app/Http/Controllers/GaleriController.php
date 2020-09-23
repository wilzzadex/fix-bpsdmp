<?php

namespace App\Http\Controllers;
use App\Album;
use App\Galeri;
use App\Galeri_video;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function indexFoto()
    {
        return view('front.pages.galeri.foto');
    }

    public function indexVideo()
    {
        return view('front.pages.galeri.video');
    }

    public function dataFoto(Request $request)
    {
        // $data = [];
        $foto = Album::orderBy('id','desc')->paginate($request->show);

        $data['foto'] = $foto;
        return view('front.pages.galeri._data-foto',$data);
    }

    public function fotoCari(Request $request)
    {
        if($request->has('cari') && $request->cari !=null){
            $cari = $request->cari;
            $data['foto'] = Album::where('judul_id', 'like', "%{$request->cari}%")
                            ->orWhere('judul_en', 'like', "%{$request->cari}%")
                            ->orderBy('created_at','desc')
                            ->paginate($request->show);    
        }else{
            $data['foto'] = Album::orderBy('created_at','desc')->paginate($request->show);
        }
        return view('front.pages.galeri._data-foto',$data);
    }

    public function dataVideo(Request $request)
    {
        $video = Galeri_video::orderBy('id','desc')->paginate($request->show);

        $data['video'] = $video;
        return view('front.pages.galeri._data-video',$data);
    }

    public function videoCari(Request $request)
    {
        if($request->has('cari') && $request->cari !=null){
            $cari = $request->cari;
            $data['video'] = Galeri_video::where('judul_id', 'like', "%{$request->cari}%")
                            ->orWhere('judul_en', 'like', "%{$request->cari}%")
                            ->orderBy('created_at','desc')
                            ->paginate($request->show);    
        }else{
            $data['video'] = Galeri_video::orderBy('created_at','desc')->paginate($request->show);
        }
        return view('front.pages.galeri._data-video',$data);
    }

    public function detailFoto($slug)
    {
        $cek = Album::where('slug',$slug)->count();
        if($cek > 0){
            $album = Album::where('slug',$slug)->first();
            $foto = Galeri::where('relasi',1)->where('relasi_id',$album->id)->get();
            $data['album'] = $album;
            $data['foto'] = $foto;
            return view('front.pages.galeri.detail_foto',$data);
        }else{
            return view('errors.404');
        }
        
    }

    public function videoPreview($slug)
    {
        $cek = Galeri_video::where('slug',$slug)->count();
        if($cek > 0){
            $video = Galeri_video::where('slug',$slug)->first();
            $video_lain = Galeri_video::where('id','!=',$video->id)->orderBy('created_at','DESC')->get()->take(4);
            $data['video_lain'] = $video_lain;
            $data['video'] = $video;
            // dd($data);/
            return view('front.pages.galeri._data-preview',$data);
        }else{
            return view('errors.404');
        }
    }

    public function fotoPreview(Request $request)
    {
        return response()->json($request->all());
    }
}
