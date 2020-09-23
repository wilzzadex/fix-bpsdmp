<?php

namespace App\Http\Controllers;
use DB;
use App\Sejarah;
use App\Visi_misi;
use App\Tugas_fungsi;
use App\Struktur_org;
use App\Satker;
use App\Regulasi;
use App\Kerja_sama;
use LogCreate;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class AdminProfilController extends Controller
{
    public function indexSejarah()
    {
        $sejarah = Sejarah::orderBy('id','DESC')->first();
        
        $data['sejarah'] = $sejarah;
        return view('back.pages.profil.sejarah',$data);
    }

    public function sejarahStore(Request $request)
    {
        $sejarah = DB::table('sejarah')->update([
            'deskripsi_id' => $request->sejarah_id,
            'deskripsi_en' => $request->sejarah_en
            ]);
        LogCreate::createLog(auth()->user()->id,'Mengubah Konten Sejarah','Profil - Sejarah');
        return redirect()->back()->with('sukses','Berhasil Menyimpan Perubahan !');
    }

    public function indexVisi()
    {
        $visi = Visi_misi::where('flag','visi')->first();
        $misi_id = Visi_misi::where('flag','misi-id')->get();
        $misi_en = Visi_misi::where('flag','misi-en')->get();

        // dd($misi);

        $data['visi'] = $visi;
        $data['misi_id'] = $misi_id;
        $data['misi_en'] = $misi_en;
        return view('back.pages.profil.visi',$data);
    }

    public function visiUpdate(Request $request)
    {

        $visi = Visi_misi::where('flag','visi')->update([
            'deskripsi_id' => $request->visi_id,
            'deskripsi_en' => $request->visi_en,
            ]);

        if($request->misi_id != null){
            $del_misi_id = Visi_misi::where('flag','misi-id')->delete();
            foreach($request->misi_id as $val){
                $new_misi_id = new Visi_misi();
                $new_misi_id->flag = 'misi-id';
                $new_misi_id->deskripsi_id = $val;
                $new_misi_id->save();
            }
        }

        if($request->misi_en != null){
            $del_misi_en = Visi_misi::where('flag','misi-en')->delete();
            foreach($request->misi_en as $val){
                $new_misi_en = new Visi_misi();
                $new_misi_en->flag = 'misi-en';
                $new_misi_en->deskripsi_en = $val;
                $new_misi_en->save();
            }
        }
        LogCreate::createLog(auth()->user()->id,'Mengubah Konten Visi & Misi ','Profil : Visi & Misi');
        return redirect()->back()->with('sukses','Berhasil Menyimpan Perubahan !');
       
    }

    public function indexTugas()
    {
        $tugas = Tugas_fungsi::where('flag','tugas')->first();
        $fungsi = Tugas_fungsi::where('flag','fungsi')->first();
        $data['tugas'] = $tugas;
        $data['fungsi'] = $fungsi;
        return view('back.pages.profil.tugas',$data);
    }

    public function tugasUpdate(Request $request)
    {
        $update_tugas = Tugas_fungsi::where('flag','tugas')->update([
            'deskripsi_id' => $request->tugas_id,
            'deskripsi_en' => $request->tugas_en,
        ]);
        $update_fungsi = Tugas_fungsi::where('flag','fungsi')->update([
            'deskripsi_id' => $request->fungsi_id,
            'deskripsi_en' => $request->fungsi_en,
        ]);
        LogCreate::createLog(auth()->user()->id,'Mengubah Konten Tugas & Fungsi ','Proful - Tugas $ Fungsi');
        return redirect()->back()->with('sukses','Berhasil Menyimpan Perubahan !');

    }

    public function indexStruktur()
    {
        $parent = Struktur_org::where('id_parent',0)->get();
        $single = Struktur_org::where('id_parent',100)->get();
        $data['parent'] = $parent;
        $data['single'] = $single;
        // dd($data);
        return view('back.pages.profil.struktur_organisasi.struktur',$data);
    }

    public function strukturdataChild(Request $request)
    {
        $id = $request->id;
        $child = Struktur_org::where('id_parent',$id)->get();
        // return $child;
        return response()->json($child);
    }

    public function strukturEdit($name)
    {
        // dd($name);
        $struktur = Struktur_org::where('slug',$name)->first();
        $data['struktur'] = $struktur;
        // dd($data);
        return view('back.pages.profil.struktur_organisasi.struktur_edit',$data);
    }

    public function strukturUpdate($id,Request $request)
    {
        // dd($id , $request->all());
        $struktur = Struktur_org::findOrFail($id);
        $file = 'file_app/struktur_image/'.$struktur->img;
        if($request->hasFile('img')){
            if($struktur->img != 'default.png'){
                if(is_file($file)){
                    unlink($file);
                }
            }
            $file_img = Input::file('img');
            $file_name = 'struktur-' . $struktur->slug . "-" . time() . "." . $file_img->getClientOriginalExtension();
            if(!file_exists('file_app/struktur_image')){
                mkdir('file_app/struktur_image', 0777 , true);
            }
            $target = 'file_app/struktur_image/' . $file_name;
            Image::make($file_img->getRealPath())->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($target);
            $struktur->img = $file_name;
            $struktur->save();
            LogCreate::createLog(auth()->user()->id,'Mengubah Struktur ' . $struktur->nama,'Profil - Struktur Organisasi');
        }

        return redirect()->back()->with('sukses','Berhasil menyimpan Perubahan !');
    }

    public function indexSatuan()
    {
        $parent = Satker::where('id_parent',0)->get();
        $single = Satker::where('id_parent',100)->get();
        $data['parent'] = $parent;
        $data['single'] = $single;
        // dd($data);
        return view('back.pages.profil.satker.satker',$data);
    }

    public function satuanDatachild(Request $request)
    {
        $id = $request->id;
        $child = Satker::where('id_parent',$id)->get();
        // return $child;
        return response()->json($child);
    }

    public function satuanEdit($name)
    {
        $satker = Satker::where('slug',$name)->first();
        $data['satker'] = $satker;
        // dd($data);
        return view('back.pages.profil.satker.satker_edit',$data);
    }

    public function satuanUpdate($id, Request $request)
    {
        // dd($request->all(),$id);
        $satker = Satker::findOrFail($id);
        // dd($satker);
        $satker->deskripsi_id = $request->deskripsi_id;
        $satker->deskripsi_en = $request->deskripsi_en;
        $satker->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah Konten Satuan Kerja ' . $satker->nama,'Profil - Satuan Kerja');
        return redirect()->back()->with('sukses','Berhasil menyimpan Perubahan !');
    }

    public function indexRegulasi()
    {
        if(auth()->user()->role != 'superadmin'){
            $regulasi = Regulasi::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $regulasi = Regulasi::orderBy('id','DESC')->get();
        }
        $data['regulasi'] = $regulasi;
        return view('back.pages.profil.regulasi.regulasi',$data);
    }

    public function regulasiDestroy(Request $request)
    {
        $regulasi = Regulasi::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Mengapus Regulasi Tentang : ' . $regulasi->tentang,'Homepage - Regulasi & Kebijakan');
        $file = 'file_app/regulasi_file/'.$regulasi->file;
        if(is_file($file)){
            unlink($file);
        }
        $regulasi->delete();
        return response()->json($request->all());
    }

    public function regulasiEdit($id)
    {
        $regulasi = Regulasi::find($id);
        $data['regulasi'] = $regulasi;
        return view('back.pages.profil.regulasi.regulasi_edit',$data);
    }

    public function regulasiAdd()
    {
        return view('back.pages.profil.regulasi.regulasi_add');
    }

    public function regulasiUpdate($id,Request $request)
    {
        $regulasi = Regulasi::find($id);
        if($request->hasFile('file')){
            $file_ex = 'file_app/regulasi_file/'.$regulasi->file;
            if(is_file($file_ex)){
                unlink($file_ex);
            }
            $file = $request->file('file');
            $file_name = 'Regulasi-'.time().'-'. $file->getClientOriginalName();
            if(!file_exists('file_app/regulasi_file')){
                mkdir('file_app/regulasi_file', 0777 , true);
            }
            $file->move('file_app/regulasi_file', $file_name);
            $regulasi->file =  $file_name;
        }   
        $regulasi->tahun = $request->tahun;
        $regulasi->tipe_peraturan = $request->tipe;
        $regulasi->nomor_peraturan = $request->nomor_peraturan;
        $regulasi->tentang = $request->tentang;
        $regulasi->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah Regulasi Tentang : ' . $regulasi->tentang,'Homepage - Regulasi & Kebijakan');
        return redirect(route('admin.regulasi.index'))->with('sukses','Berhasil mengubah data !');
    }

    public function regulasiStore(Request $request)
    {
        $regulasi = new Regulasi();
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = 'Regulasi-'.time().'-'. $file->getClientOriginalName();
            if(!file_exists('file_app/regulasi_file')){
                mkdir('file_app/regulasi_file', 0777 , true);
            }
            $file->move('file_app/regulasi_file', $file_name);
            $regulasi->file =  $file_name;
        }   
        $regulasi->tahun = $request->tahun;
        $regulasi->tipe_peraturan = $request->tipe;
        $regulasi->nomor_peraturan = $request->nomor_peraturan;
        $regulasi->tentang = $request->tentang;
        $regulasi->user_id = auth()->user()->id;
        $regulasi->save();
        LogCreate::createLog(auth()->user()->id,'Menambah Regulasi Tentang:' . $regulasi->tentang,'Homepage - Regulasi & Kebijakan');
        return redirect(route('admin.regulasi.index'))->with('sukses','Berhasil menyimpan data !');

    }

    public function indexKerja()
    {
        if(auth()->user()->role != 'superadmin'){
            $kerja_sama = Kerja_sama::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $kerja_sama = Kerja_sama::orderBy('id','DESC')->get();
        }

        $data['kerja_sama'] = $kerja_sama;
        return view('back.pages.profil.kerja.kerja',$data);
    }

    public function kerjaAdd()
    {
        return view('back.pages.profil.kerja.kerja_add');
    }

    public function kerjaStore(Request $request)
    {
        // dd($request->file('file'));
        $tanggal = date('Y-m-d',strtotime($request->tanggal));
        $kerja_sama = new Kerja_sama();
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = 'KerjaSama-'.time().'-'. $file->getClientOriginalName();
            if(!file_exists('file_app/kerjasama_file')){
                mkdir('file_app/kerjasama_file', 0777 , true);
            }
            $file->move('file_app/kerjasama_file', $file_name);
            $kerja_sama->file =  $file_name;
        }  
        $kerja_sama->nomor = $request->nomor;
        $kerja_sama->tanggal_kerjasama = $tanggal;
        $kerja_sama->uraian = $request->uraian;
        $kerja_sama->institusi = $request->institusi;
        $kerja_sama->user_id = auth()->user()->id;
        $kerja_sama->save();
        LogCreate::createLog(auth()->user()->id,'Menambah data Kerja Sama Nomor : ' . $kerja_sama->nomor,'Homepage - Kerja Sama');
        return redirect(route('admin.kerja.index'))->with('sukses','Berhasil menyimpan Data !');
    }

    public function kerjaEdit($id)
    {
        $kerja_sama = Kerja_sama::find($id);
        $data['kerja_sama'] = $kerja_sama;
        return view('back.pages.profil.kerja.kerja_edit',$data);
    }

    public function kerjaUpdate($id, Request $request)
    {
        $tanggal = date('Y-m-d',strtotime($request->tanggal));
        $kerja_sama = Kerja_sama::find($id);
        if($request->hasFile('file')){
            $file_ex = 'file_app/kerjasama_file/'.$kerja_sama->file;
            if(is_file($file_ex)){
                unlink($file_ex);
            }
            $file = $request->file('file');
            $file_name = 'Kerjasama-'.time().'-'. $file->getClientOriginalName();
            if(!file_exists('file_app/kerjasama_file')){
                mkdir('file_app/kerjasama_file', 0777 , true);
            }
            $file->move('file_app/kerjasama_file', $file_name);
            $kerja_sama->file =  $file_name;
        }   
        $kerja_sama->nomor = $request->nomor;
        $kerja_sama->tanggal_kerjasama = $tanggal;
        $kerja_sama->uraian = $request->uraian;
        $kerja_sama->institusi = $request->institusi;
        $kerja_sama->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah data Kerja Sama Nomor : ' . $kerja_sama->nomor,'Homepage - Kerja Sama');
        return redirect(route('admin.kerja.index'))->with('sukses','Berhasil mengubah data !');
    }

    public function kerjaDestroy(Request $request)
    {
        $kerja = Kerja_sama::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus data Kerja Sama Nomor : ' . $kerja->nomor,'Homepage - Kerja Sama');
        $file = 'file_app/kerjasama_file/'.$kerja->file;
        if(is_file($file)){
            unlink($file);
        }
        $kerja->delete();
        return response()->json();
    }

    
}
