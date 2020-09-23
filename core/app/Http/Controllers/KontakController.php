<?php

namespace App\Http\Controllers;
use App\Faq;
use App\Kontak;
use App\Social_media;
use App\Alamat;
use Validator;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $smedia = Social_media::all();
        $alamat = Alamat::find(1);
        $data['smedia'] = $smedia;
        $data['alamat'] = $alamat;
        return view('front.pages.kontak.kontak',$data);
    }

    public function faq()
    {
        $faq = Faq::orderBy('created_at','DESC')->get();
        $data['faq'] = $faq;
        return view('front.pages.kontak.faq',$data);
    }

    public function kontakStore(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'no_tlp' => 'required',
            'subjek' => 'required',
            'pesan' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $kontak = new Kontak();
        $kontak->nama = $request->nama;
        $kontak->email = $request->email;
        $kontak->no_telp = $request->no_tlp;
        $kontak->subject = $request->subjek;
        $kontak->is_read = 0;
        $kontak->isi_pesan = $request->pesan;
        $kontak->save();
        return redirect()->back()->with('sukses','dmsjahdgsadsadsadh');
    }

    
}
