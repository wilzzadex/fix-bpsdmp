<?php

namespace App\Http\Controllers;
use App\Publikasi;
use DB;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jml_publikasi = Publikasi::all()->count();
        $jml_publish = Publikasi::where('is_draft',0)->count();
        $jml_draft = Publikasi::where('is_draft',1)->count();
        $berita_top = Publikasi::where('kategori','berita')->orderBy('hit','DESC')->take(5)->get();

        $data['jml_draft'] = $jml_draft;
        $data['jml_publikasi'] = $jml_publikasi;
        $data['jml_publish'] = $jml_publish;
        $data['berita_top'] = $berita_top;
        

        // dd($data);
        return view('back.pages.dashboard',$data);
    }
}
