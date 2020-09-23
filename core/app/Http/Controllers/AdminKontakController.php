<?php

namespace App\Http\Controllers;
use App\Faq;
use App\Kontak;
use LogCreate;
use Illuminate\Http\Request;

class AdminKontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::orderBy('created_at','DESC')->get();
        $data['kontak'] = $kontak;
        return view('back.pages.kontak.kontak',$data);
    }

    public function indexFaq()
    {
        $faq = Faq::orderBy('created_at','DESC')->get();
        $data['faq'] = $faq;
        return view('back.pages.kontak.faq',$data);
    }

    public function faqAdd()
    {
        return view('back.pages.kontak.faq_add');
    }

    public function faqStore(Request $request)
    {
       $faq = new Faq();
       $faq->pertanyaan_id = $request->pertanyaan_id;
       $faq->pertanyaan_en = $request->pertanyaan_en;
       $faq->jawaban_id = $request->jawaban_id;
       $faq->jawaban_en = $request->jawaban_en;
       $faq->save();
       LogCreate::createLog(auth()->user()->id,'Menambah data Faq : ' . $faq->pertanyaan_id,'Faq');
       return redirect(route('admin.faq'))->with('sukses','Data Berhasil Disimpan !');
    }

    public function faqEdit($id)
    {
        $faq = Faq::find($id);
        $data['faq'] = $faq;
        return view('back.pages.kontak.faq_edit',$data);
    }

    public function faqUpdate($id,Request $request)
    {
       $faq = Faq::find($id);
       $faq->pertanyaan_id = $request->pertanyaan_id;
       $faq->pertanyaan_en = $request->pertanyaan_en;
       $faq->jawaban_id = $request->jawaban_id;
       $faq->jawaban_en = $request->jawaban_en;
       $faq->save();
       LogCreate::createLog(auth()->user()->id,'Mengubah data Faq : ' . $faq->pertanyaan_id,'Faq');

       return redirect(route('admin.faq'))->with('sukses','Data Berhasil Diubah !');
    }

    public function faqDestroy(Request $request)
    {
        $faq = Faq::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus data Faq : ' . $faq->pertanyaan_id,'Faq');
        $faq->delete();
 
        return response()->json($request->all());
    }

    public function kontakShow(Request $request)
    {
        $kontak = Kontak::find($request->id);
        $kontak->is_read = 1;
        $kontak->save();
        LogCreate::createLog(auth()->user()->id,'Membaca Pesan dari : ' . $kontak->nama,'Kontak');
        $data['kontak'] = $kontak;
        return view('back.pages.kontak.show',$data);
    }
}
