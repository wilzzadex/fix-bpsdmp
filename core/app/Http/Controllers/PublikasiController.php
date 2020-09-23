<?php

namespace App\Http\Controllers;
use App\Publikasi;
use Illuminate\Http\Request;
use App\Carbon\Carbon;

class PublikasiController extends Controller
{
    public function indexBerita()
    {
        return view('front.pages.publikasi.berita');
    }

    public function indexPers()
    {
        return view('front.pages.publikasi.pers');
    }

    public function indexInfografis()
    {
        return view('front.pages.publikasi.infografis');
    }

    public function indexEvent()
    {
        return view('front.pages.publikasi.event');
    }

    public function indexLaporan()
    {
        return view('front.pages.publikasi.laporan-diklat');
    }

    public function dataBerita(Request $request)
    {
        $data = [];
        $data['berita'] = Publikasi::where('kategori','berita')->where('is_draft',0)->orderBy('tanggal_awal','desc')->paginate($request->show);
        // return response()->json($data);
        return view('front.pages.publikasi._data-berita',$data);
    }

    public function detailBerita($slug,Request $request)
    {

        $berita_cek = Publikasi::where('kategori','berita')->where('slug',$slug)->count();

        if($berita_cek > 0){
            $berita = Publikasi::where('kategori','berita')->where('slug',$slug)->first();
            $berita->hit = $berita->hit + 1;
            $berita->save();
            $berita_lain = Publikasi::where('kategori','berita')
                        ->where('id','!=',$berita->id)
                        ->where('is_draft',0)
                        ->orderBy('tanggal_awal','DESC')
                        ->take(5)
                        ->get(); 


            $data['berita'] = $berita;
            $data['berita_lain'] = $berita_lain;

            // dd($berita_lain);
            return view('front.pages.publikasi.detail_berita',$data);
        }else{
            return view('errors.404');
        }
        
        
    }

    public function dataPers(Request $request)
    {
        $data = [];
        $data['berita'] = Publikasi::where('kategori','pers')->where('is_draft',0)->orderBy('tanggal_awal','desc')->paginate($request->show);
        return view('front.pages.publikasi._data-pers',$data);
    }

    public function detailPers($slug)
    {
        $cek = Publikasi::where('kategori','pers')->where('slug',$slug)->count();
        if($cek > 0){
            $pers = Publikasi::where('kategori','pers')->where('slug',$slug)->first();
            $pers->hit = $pers->hit + 1;
            $pers->save();
            $pers_lain = Publikasi::where('kategori','pers')
                        ->where('is_draft',0)
                        ->where('id','!=',$pers->id)
                        ->orderBy('tanggal_awal','DESC')
                        ->take(5)
                        ->get(); 


            $data['pers'] = $pers;
            $data['pers_lain'] = $pers_lain;

            // dd($berita_lain);
            return view('front.pages.publikasi.detail_pers',$data);
        }else{
            return view('errors.404');
        }
        
    }

    public function dataInfo(Request $request)
    {
        $data = [];
        $data['info'] = Publikasi::where('kategori','infografis')->where('is_draft',0)->orderBy('id','desc')->paginate($request->show);
        return view('front.pages.publikasi._data-infografis',$data);
    }

    public function dataEvent(Request $request)
    {
        $data = [];
        $data['berita'] = Publikasi::where('kategori','event')->where('is_draft',0)->orderBy('tanggal_awal','desc')->paginate($request->show);
        return view('front.pages.publikasi._data-event',$data);
    }

    public function detailEvent($slug)
    {

        $cek = Publikasi::where('kategori','event')->where('slug',$slug)->count();

        if($cek > 0){
            $event = Publikasi::where('kategori','event')->where('slug',$slug)->first();
            $event->hit = $event->hit + 1;
            $event->save();
            $event_lain = Publikasi::where('kategori','event')
                    ->where('id','!=',$event->id)
                    ->where('is_draft',0)
                    ->orderBy('tanggal_awal','DESC')
                    ->take(5)
                    ->get(); 

            $data['event'] = $event;
            $data['event_lain'] = $event_lain;

            // dd($berita_lain);
            return view('front.pages.publikasi.detail_event',$data);
        }else{
            return view('errors.404');
        }
        
       
        
    }
    public function infografisCari(Request $request)
    {   
        if($request->has('cari') && $request->cari !=null){
            $cari = $request->cari;
            $data['info'] = Publikasi::where('is_draft',0)->where('kategori','infografis')
                            ->where(function($q) use ($cari) {
                                $q->where('judul_id', 'like', "%{$cari}%")
                                  ->orWhere('judul_en', 'like', "%{$cari}%");
                            })
                            ->orderBy('tanggal_awal','desc')
                            ->paginate($request->show);    
        }else{
            $data['info'] = Publikasi::where('kategori','infografis')->where('is_draft',0)->orderBy('tanggal_awal','desc')->paginate($request->show);
        }
        return view('front.pages.publikasi._data-infografis',$data); 
    }

    public function beritaCari(Request $request)
    {   
        if($request->has('cari') && $request->cari !=null){
            $cari = $request->cari;
            $data['berita'] = Publikasi::where('is_draft',0)->where('kategori','berita')
                            ->where(function($q) use ($cari) {
                                $q->where('judul_id', 'like', "%{$cari}%")
                                  ->orWhere('judul_en', 'like', "%{$cari}%")
                                  ->orWhere('deskripsi_id', 'like', "%{$cari}%")
                                  ->orWhere('deskripsi_en', 'like', "%{$cari}%")
                                  ->orWhere('tanggal_awal', 'like', "%{$cari}%");
                            })
                            ->orderBy('tanggal_awal','desc')
                            ->paginate($request->show);    
        }else{
            $data['berita'] = Publikasi::where('kategori','berita')->where('is_draft',0)->orderBy('tanggal_awal','desc')->paginate($request->show);
        }
        return view('front.pages.publikasi._data-berita',$data); 
    }

    public function persCari(Request $request)
    {   
        if($request->has('cari') && $request->cari !=null){
            $cari = $request->cari;
            $data['berita'] = Publikasi::where('is_draft',0)->where('kategori','pers')
                            ->where(function($q) use ($cari) {
                                $q->where('judul_id', 'like', "%{$cari}%")
                                  ->orWhere('judul_en', 'like', "%{$cari}%")
                                  ->orWhere('deskripsi_id', 'like', "%{$cari}%")
                                  ->orWhere('deskripsi_en', 'like', "%{$cari}%")
                                  ->orWhere('tanggal_awal', 'like', "%{$cari}%");
                            })
                            ->orderBy('tanggal_awal','desc')
                            ->paginate($request->show);    
        }else{
            $data['berita'] = Publikasi::where('kategori','pers')->where('is_draft',0)->orderBy('tanggal_awal','desc')->paginate($request->show);
        }
        return view('front.pages.publikasi._data-pers',$data); 
    }

    public function eventCari(Request $request)
    {   
        if($request->has('cari') && $request->cari !=null){
            $cari = $request->cari;
            $data['berita'] = Publikasi::where('is_draft',0)->where('kategori','event')
                            ->where(function($q) use ($cari) {
                                $q->where('judul_id', 'like', "%{$cari}%")
                                  ->orWhere('judul_en', 'like', "%{$cari}%")
                                  ->orWhere('deskripsi_id', 'like', "%{$cari}%")
                                  ->orWhere('deskripsi_en', 'like', "%{$cari}%")
                                  ->orWhere('lokasi', 'like', "%{$cari}%")
                                  ->orWhere('tanggal_awal', 'like', "%{$cari}%");
                            })
                            ->orderBy('tanggal_awal','desc')
                            ->paginate($request->show);    
        }else{
            $data['berita'] = Publikasi::where('kategori','event')->where('is_draft',0)->orderBy('tanggal_awal','desc')->paginate($request->show);
        }
        return view('front.pages.publikasi._data-event',$data); 
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

    
}
