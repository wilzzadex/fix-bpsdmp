<?php

namespace App\Http\Controllers;
use App\Sekolah;
use App\Galeri;
use App\Matra;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::orderBy('nama','ASC')->get();
        $matra = Matra::all();
        $data['matra'] = $matra;
        $data['sekolah'] = $sekolah;

        // dd($sekolah);
        return view('front.pages.sekolah.sekolah',$data);
    }

    public function sekolahDetail($slug){
        $cek_sekolah = Sekolah::where('slug',$slug)->count();
        if($cek_sekolah > 0){
            $sekolah = Sekolah::where('slug',$slug)->first();

            $cek = Galeri::where('relasi',2)->where('relasi_id',$sekolah->id)->count();
            if($cek > 0){
                $galeri = Galeri::where('relasi',2)->where('relasi_id',$sekolah->id)->get();
            }else{
                $galeri = 'no';
            }

            $data['galeri'] = $galeri;
            $data['sekolah'] = $sekolah;

            return view('front.pages.sekolah.sekolah_detail',$data);
        }else{
            return view('errors.404');
        }
        
    }

    public function sekolahMatra($matra)
    {
        $cek_matra = Matra::where('slug',$matra)->count();
        if($cek_matra > 0)
        {
            $sekolah = Sekolah::orderBy('nama','ASC')->get();
            $matraa = Matra::all();
            $data['matra'] = $matraa;
            $data['sekolah'] = $sekolah;
            $data['matra_slug'] = $matra;
            // dd($data);
            return view('front.pages.sekolah.sekolah_matra',$data);
        }else{
            return view('errors.404');
        }
        
    }
}
