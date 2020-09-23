<?php

namespace App\Http\Controllers\PWA;
use App\Slider;
use App\Galeri;
use App\Galeri_video;
use App\Publikasi;
use App\Popup;
use App\Album;
use App\Social_media;
use Session;
use Lang;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PWAController extends Controller
{
    public function slider()
    {
        $slider = Slider::orderBy('id','DESC')->get();
        return response()->json($slider, 200);
    }

    public function popup()
    {
        $popup = Popup::where('is_active',1)->first();
        $popup_null = Popup::orderBy('id','DESC')->first();
        if($popup == null){
            $data = $popup_null;
        }else{
            $data = $popup;
        }

        return response()->json($data, 200);
    }

    public function foto()
    {
        $album = Album::select('album.id','album.judul_id','album.slug','album.judul_en','gallery.img')
                        ->join('gallery','gallery.relasi_id','=','album.id')
                        ->groupBy('album.id')
                        ->orderBy('album.created_at','DESC')
                        ->take(2)
                        ->get();
        return response()->json($album, 200);
    }

    public function video()
    {
        $video = Galeri_video::orderBy('created_at','DESC')->take(2)->get();
        return response()->json($video, 200);
    }

    public function smedia()
    {
        $smedia = Social_media::all();
        return response()->json($smedia, 200);
    }

    public function berita()
    {
        $berita = Publikasi::where('kategori','berita')->where('is_draft',0)->orderBy('tanggal_awal','DESC')->take(3)->get();
        return response()->json($berita, 200);
    }

    public function pers()
    {
        $pers = Publikasi::where('kategori','pers')->where('is_draft',0)->orderBy('tanggal_awal','DESC')->take(3)->get();
        return response()->json($pers,200);
    }

    public function infografis()
    {
        $infografis = Publikasi::where('kategori','infografis')->where('is_draft',0)->orderBy('tanggal_awal','DESC')->take(3)->get();
        return response()->json($infografis, 200);
    }

    function struktur_single()
    {
       $struktur = DB::table('struktur_org')->where('id_parent',100)->orwhere('id_parent',0)->get();
       return response()->json($struktur, 200);
    }

    function struktur_parent()
    {
       $struktur = DB::table('struktur_org')->where('id_parent',0)->get();
       return response()->json($struktur, 200);
    }

    function struktur_child(Request $request){
       $struktur = DB::table('struktur_org')->where('id_parent',$request->id)->get();
       return response()->json($struktur);
    }
    public function getEvent(Request $request)
    {
        $tanggal = $request->tanggal;
        $tmp = Publikasi::where('kategori','event')
                            ->where('is_draft',0)
                            ->where(function($q) use ($tanggal){
                                $q->where('tanggal_awal',$tanggal)
                                ->orWhere('tanggal_akhir',$tanggal);
                            })
                            ->orderBy('tanggal_awal','ASC')
                            ->get();

        if(count($tmp) < 1){
            $cek = Publikasi::where('kategori','event')->where('is_draft',0)->get();
            // $data = [];
            $pub = [];
            foreach($cek as $key => $val){
                $currentDate = $tanggal;                
                $startDate = date('Y-m-d', strtotime($val->tanggal_awal));
                $endDate = date('Y-m-d', strtotime($val->tanggal_akhir));
                
                // dd($startDate);
                if (($currentDate >= $startDate) && ($currentDate <= $endDate)){
                    // echo "Current date is between two dates";
                    $pub[] = Publikasi::where('kategori','event')
                    ->where('is_draft',0)
                    ->where(function($q) use ($startDate,$endDate){
                        $q->whereBetween('tanggal_awal',[$startDate,$endDate])
                        ->orWhereBetween('tanggal_akhir',[$startDate,$endDate]);
                    })
                    ->orderBy('tanggal_awal','ASC')
                    ->first();
                    // $tes .= $pub->id;
                   
                }else{
                    $data = $tmp;  
                }
            }
            // return response()->json($data);
        }else{
            $data=$tmp;
            return response()->json($data);
        }
        return response()->json($pub);
    }

    public function getDate()
    {
        $dates = [];
        $data = '';
        $semuaTanggal = [];
        $q = Publikasi::select('tanggal_awal','tanggal_akhir')
                        ->where('kategori','event')
                        ->where('is_draft',0)
                        // ->groupBy('tanggal_awal')
                        ->get();

        foreach($q as $key => $tmp){
            $st_date = $tmp->tanggal_awal;
            $ed_date = $tmp->tanggal_akhir;
            $dates[] = range(strtotime($st_date), strtotime($ed_date),86400);
        }

    
        foreach($dates as $key => $val){
            foreach($val as $item){
                $semuaTanggal[] .= date('Y-m-d',$item);
            }
        }
       
        return response()->json($semuaTanggal);
    }

    public function satker_single()
    {
       $satker = DB::table('satker')->where('id_parent',100)->orwhere('id_parent',0)->get();
       return response()->json($satker, 200);
    }

    function satker_child(Request $request){
        $satker = DB::table('satker')->where('id_parent',$request->id)->get();
        return response()->json($satker);
     }

}
