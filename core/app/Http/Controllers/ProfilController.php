<?php

namespace App\Http\Controllers;
use App\Sejarah;
use App\Tugas_fungsi;
use App\Visi_misi;
use App\Struktur_org;
use App\Satker;
use App\Kerja_sama;
use App\Regulasi;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function indexSejarah()
    {
        $sejarah = Sejarah::orderBy('id','DESC')->first();
        $data['sejarah'] = $sejarah;
        return view('front.pages.profil.sejarah',$data);
    }

    public function indexVisi()
    {
        $visi = Visi_misi::where('flag','visi')->first();
        $misi_id = Visi_misi::where('flag','misi-id')->get();
        $misi_en = Visi_misi::where('flag','misi-en')->get();

        $data['visi'] = $visi;
        $data['misi_id'] = $misi_id;
        $data['misi_en'] = $misi_en;

        return view('front.pages.profil.visi-misi',$data);
    }

    public function indexTugas()
    {
        $tugas = Tugas_fungsi::where('flag','tugas')->first();
        $fungsi = Tugas_fungsi::where('flag','fungsi')->first();
        $data['tugas'] = $tugas;
        $data['fungsi'] = $fungsi;
        return view('front.pages.profil.tugas-fungsi',$data);
    }

    public function indexStruktur($slug)
    {
        $cek = Struktur_org::where('slug',$slug)->count();
        if($cek > 0){
            $struktur = Struktur_org::where('slug',$slug)->first();
            $data['struktur'] = $struktur;
            return view('front.pages.profil.struktur',$data);
        }else{
            return view('errors.404');
        }
        
        // dd($struktur->slug);
    }

    public function indexSatuan($slug)
    {
        $cek = Satker::where('slug',$slug)->count();
        if($cek > 0){
            $Satker = Satker::where('slug',$slug)->first();
            $data['satker'] = $Satker;
            return view('front.pages.profil.satuan',$data);
        }else{
            return view('errors.404');
        }
        
    }

    public function indexRegulasi()
    {
        $regulasi = Regulasi::orderBy('id','DESC')->get();
        $data['regulasi'] = $regulasi;
        return view('front.pages.profil.regulasi',$data);
    }

    public function indexKerja()
    {
        $kerja = Kerja_sama::orderBy('id','DESC')->get();
        $data['kerja'] = $kerja;
        return view('front.pages.profil.kerja_sama',$data);
    }
}
