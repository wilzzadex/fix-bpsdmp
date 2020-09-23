<?php

namespace App\Http\Controllers;
use Session;
use App\Matra;
use App\Sekolah;
use App\Galeri;
use LogCreate;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class AdminSekolahController extends Controller
{
    public function index()
    {
        if(auth()->user()->role != 'superadmin'){
            $sekolah = Sekolah::where('user_id',auth()->user()->id)->orderBy('nama','ASC')->get();
        }else{
            $sekolah = Sekolah::orderBy('nama','ASC')->get();
        }
        
        $data['sekolah'] = $sekolah;
        // dd($data);
        return view('back.pages.sekolah.sekolah',$data);
    }

    public function sekolahAdd()
    {
        $matra = Matra::all();
        $data['matra'] = $matra;
        return view('back.pages.sekolah.sekolah_add',$data);
    }

    public function sekolahStore(Request $request)
    {
        // dd($request->all());

        

        $cek = Sekolah::where('slug',str_slug($request->nama))->count();
        // dd($cek);
        
        if($cek == 0){
            if(!file_exists('file_app/galeri/galeri_sekolah')){
                mkdir('file_app/galeri/galeri_sekolah', 0777 , true);
            }
            if(!file_exists('file_app/logo_sekolah/')){
                mkdir('file_app/logo_sekolah/', 0777 , true);
            }
    
            $sekolah = new Sekolah();
            $sekolah->nama = $request->nama;
            $sekolah->id_matra = $request->id_matra;
            $sekolah->slug = str_slug($request->nama);
            $sekolah->singkatan = strtoupper($request->singkatan);
            $sekolah->alamat = $request->alamat;
            $sekolah->email = $request->email;
            $sekolah->no_telp = $request->no_tlp;
            $sekolah->website = $request->url;
            $sekolah->deskripsi_id = $request->deskripsi_id;
            $sekolah->deskripsi_en = $request->deskripsi_en;
            $sekolah->user_id = auth()->user()->id;
    
            if($request->hasFile('logo')){
                $logo = $request->file('logo');
                $logo_name = str_slug($sekolah->singkatan) . "-" . time() . "." . $logo->getClientOriginalExtension();
                $target = 'file_app/logo_sekolah/' . $logo_name;
                Image::make($logo->getRealPath())->fit(1000, 1000)->save($target);
                $sekolah->logo = $logo_name;
            }else{
                $sekolah->img = 'dummy.png';
            }
    
            $sekolah->save();

            LogCreate::createLog(auth()->user()->id,'Menambah data Sekolah : ' . $sekolah->nama,'Sekolah');

                if(isset($request->img)){
                    $galeri_sekolah = $request->file('img');
        
                    foreach($request->img as $key => $row){
                        $galeri = new Galeri();
                        $galeri->relasi = 2;
                        $galeri->relasi_id = $sekolah->id;
                        $galeri->judul_id = $request->judul_foto_id[$key];
                        $galeri->judul_en = $request->judul_foto_en[$key];
            
                        $file = $galeri_sekolah[$key];
                        if ($file->isValid()) {
                            $file_name = str_slug($sekolah->singkatan) . "-" . str_slug($request->judul_foto_id[$key]) . "-" . time() . "." . $file->getClientOriginalExtension();
                            $target = 'file_app/galeri/galeri_sekolah/' . $file_name;
                            Image::make($file->getRealPath())->fit(1000,563)->save($target);
                            $galeri->img = $file_name;
                            $galeri->save();
                        } else {
                            // handle error here
                        }
                
                }
            }
            
            return redirect(route('admin.sekolah'))->with('sukses','Data Berhasil di simpan !');
        }else{
            return redirect()->back()->with('gagal','Nama Sekolah tersebut sudah ada !');     
        }
        
        

    }

    public function sekolahDestroy(Request $request)
    {
        $sekolah = Sekolah::find($request->id);
        $logo_ex = 'file_app/logo_sekolah/'.$sekolah->logo;
        LogCreate::createLog(auth()->user()->id,'Menghapus data Sekolah : ' . $sekolah->nama,'Sekolah');
        if(is_file($logo_ex)){
            unlink($logo_ex);
        }
        $sekolah->delete();
        $cek = Galeri::where('relasi',2)->where('relasi_id',$sekolah->id)->count();
        if($cek > 0){
            $galeri = Galeri::where('relasi',2)->where('relasi_id',$sekolah->id)->get();
            foreach($galeri as $galeri)
            {
                $file = 'file_app/galeri/galeri_sekolah/'.$galeri->img;
                if(is_file($file)){
                    unlink($file);
                }
            }
            $galeri = Galeri::where('relasi',2)->where('relasi_id',$sekolah->id)->delete();
        }
        return response()->json($cek);
    }
    public function sekolahEdit($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $cek = Galeri::where('relasi',2)->where('relasi_id',$sekolah->id)->count();
        $matra = Matra::all();

        if($cek > 0){
            $galeri = Galeri::where('relasi',2)->where('relasi_id',$sekolah->id)->get();
        }else{
            $galeri = 'no';
        }

        $data['matra'] = $matra;
        $data['galeri'] = $galeri;
        $data['sekolah'] = $sekolah;

        // dd($data);
        return view('back.pages.sekolah.sekolah_edit',$data);
    }

    public function sekolahUpdate($id,Request $request)
    {
        // dd($request->all(),$id);
        $sekolah = Sekolah::findOrFail($id);
       
        $sekolah->nama = $request->nama;
        $sekolah->id_matra = $request->id_matra;
        $sekolah->slug = str_slug($request->nama);
        $sekolah->singkatan = strtoupper($request->singkatan);
        $sekolah->alamat = $request->alamat;
        $sekolah->email = $request->email;
        $sekolah->no_telp = $request->no_tlp;
        $sekolah->website = $request->url;
        $sekolah->deskripsi_id = $request->deskripsi_id;
        $sekolah->deskripsi_en = $request->deskripsi_en;
        if($request->hasFile('logo')){
            $logo_ex = 'file_app/logo_sekolah/'.$sekolah->logo;
            if(is_file($logo_ex)){
                unlink($logo_ex);
            }
            $logo = $request->file('logo');
            $logo_name = str_slug($sekolah->singkatan) . "-" . time() . "." . $logo->getClientOriginalExtension();
            $target = 'file_app/logo_sekolah/' . $logo_name;
            Image::make($logo->getRealPath())->fit(1000, 1000)->save($target);
            $sekolah->logo = $logo_name;
        }
        $sekolah->save();

        LogCreate::createLog(auth()->user()->id,'Mengubah data Sekolah : ' . $sekolah->nama,'Sekolah');


        $path = 'file_app/galeri/galeri_sekolah/';
        $image = $request->file('img'); 
    	if(isset($request->idg)){
            foreach ($request->idg as $key => $idg) {
                if($idg == 'no-db'){
                    $galeri = new Galeri();
                    $galeri->relasi = 2;
                    $galeri->relasi_id = $sekolah->id;
                    $galeri->judul_id = $request->judul_foto_id[$key];
                    $galeri->judul_en = $request->judul_foto_en[$key];
                    if($request->hasFile('img.'.$key)){
                        $file = $image[$key];
                        $file_name = str_slug($sekolah->judul_id) . "-". str_slug($request->judul_foto_id[$key]) . time() . "." . $file->getClientOriginalExtension();
                        $target = 'file_app/galeri/galeri_sekolah/' . $file_name;
                        Image::make($file->getRealPath())->fit(1000,563)->save($target);
                        $galeri->img = $file_name;
                        // $galeri->save();
                    }else{
                        $galeri->img = 'default.png';
                    }
                    $galeri->save();
                }else{
                    $galeri = Galeri::find($idg);
                    $galeri->judul_id = $request->judul_foto_id[$key];
                    $galeri->judul_en = $request->judul_foto_en[$key];
    
                    if($request->hasFile('img.'.$key)){ 
                        $img_ex = 'file_app/galeri/galeri_sekolah/'.$request->gambar_db[$key];
                        if(is_file($img_ex)){
                            unlink($img_ex);
                        }
                        $file = $image[$key];
                        $file_name = str_slug($sekolah->judul_id) . "-". str_slug($request->judul_foto_id[$key]) . time() . "." . $file->getClientOriginalExtension();
                        $target = 'file_app/galeri/galeri_sekolah/' . $file_name;
                        Image::make($file->getRealPath())->fit(1000,563)->save($target);
                        $galeri->img = $file_name;
                        $galeri->save();
                    }
                    $galeri->save();
                }
            }
        }
        return redirect(route('admin.sekolah'))->with('sukses','Data Berhasil di ubah !');
    }

    public function sekolahDestroyFoto(Request $request)
    {
        $foto = Galeri::find($request->id);
        $file_ex = 'file_app/galeri/galeri_sekolah/'.$foto->img;
        if(is_file($file_ex)){
            unlink($file_ex);
        }
        $foto->delete();
        return response()->json($request->all());
    }
}
