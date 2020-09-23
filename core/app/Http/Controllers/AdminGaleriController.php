<?php

namespace App\Http\Controllers;

use App\Album;
use App\Galeri;
use App\Galeri_video;
use LogCreate;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class AdminGaleriController extends Controller
{
    public function indexFoto()
    {
        if(auth()->user()->role != 'superadmin'){
            $album = Album::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $album = Album::orderBy('id','DESC')->get();
        }
        // dd($album);
        $data['album'] = $album;
        return view('back.pages.galeri.foto',$data);
    }

    public function fotoAdd()
    {
        return view('back.pages.galeri.foto_add');
    }

    public function indexVideo()
    {
        if(auth()->user()->role != 'superadmin'){
            $video = Galeri_video::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $video = Galeri_video::orderBy('id','DESC')->get();
        }
        $data['video'] = $video;
        return view('back.pages.galeri.video', $data);
    }

    public function videoAdd()
    {
        return view('back.pages.galeri.video_add');
    }

    public function fotoStore(Request $request)
    {
        // dd($request->all());

        $album = new Album();
        $album->judul_id = $request->judul_id;
        $album->judul_en = $request->judul_en;
        $album->slug = str_slug($request->judul_id);
        $album->user_id = auth()->user()->id;
        $album->save();
        LogCreate::createLog(auth()->user()->id,'Menambah Album : ' . $album->judul_id,'Galeri - Foto');
        // if($request->hasFile('img')){
            if(!file_exists('file_app/galeri/galeri_foto')){
                mkdir('file_app/galeri/galeri_foto', 0777 , true);
            }
            $count = count($request->img);
            $judul_foto_id = $request->judul_foto_id; 
            $judul_foto_en = $request->judul_foto_en; 
            $image = $request->file('img'); 
            $destinationPath = 'file_app/galeri/galeri_foto/'; 

            for($i = 0; $i < $count; $i++) {

                $galeri_foto = new Galeri();
                $galeri_foto->relasi = 1;
                $galeri_foto->relasi_id = $album->id;
                $galeri_foto->judul_id = $judul_foto_id[$i];
                $galeri_foto->judul_en =  $judul_foto_en[$i];
    
                $file = $image[$i];
    
                if ($file->isValid()) {
                    $file_name = str_slug($album->judul_id) . "-" . str_slug($judul_foto_id[$i]) . "-" . time() . "." . $file->getClientOriginalExtension();
                    $target = 'file_app/galeri/galeri_foto/' . $file_name;
                    Image::make($file->getRealPath())->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($target);
                    $galeri_foto->img = $file_name;
                    $galeri_foto->save();
                } else {
                    // handle error here
                }
    
            }

            return redirect(route('admin.galeri.foto'))->with('sukses','Data Berhasil di simpan !');


        // }else{
            
        // }
    }

    public function fotoEdit($id)
    {
        $album = Album::find($id);
        $foto_album = Galeri::where('relasi',1)->where('relasi_id',$id)->get();
        // dd($album,$foto_album);
        $data['album'] = $album;
        $data['foto_album'] = $foto_album;
        return view('back.pages.galeri.foto_edit',$data);
    }

    public function fotoUpdate($id,Request $request)
    {
        // dd($request->all(),$id);

        $data = Album::findOrFail($id);
    	$data->judul_id = $request->judul_id;
    	$data->judul_en = $request->judul_en;
        $data->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah Album : ' . $data->judul_id,'Galeri - Foto');

        $path = 'file_app/galeri/galeri_foto/';
        $image = $request->file('img'); 
    	foreach ($request->idg as $key => $idg) {
    		if($idg == 'no-db'){
                $galeri = new Galeri();
                $galeri->relasi = 1;
                $galeri->relasi_id = $data->id;
                $galeri->judul_id = $request->judul_foto_id[$key];
                $galeri->judul_en = $request->judul_foto_en[$key];
                if($request->hasFile('img.'.$key)){
                    $file = $image[$key];
                    $file_name = str_slug($data->judul_id) . "-". str_slug($request->judul_foto_id[$key]) . time() . "." . $file->getClientOriginalExtension();
                    $target = 'file_app/galeri/galeri_foto/' . $file_name;
                    Image::make($file->getRealPath())->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($target);
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
                    $img_ex = 'file_app/galeri/galeri_foto/'.$request->gambar_db[$key];
                    if(is_file($img_ex)){
                        unlink($img_ex);
                    }
                    $file = $image[$key];
                    $file_name = str_slug($data->judul_id) . "-". str_slug($request->judul_foto_id[$key]) . time() . "." . $file->getClientOriginalExtension();
                    $target = 'file_app/galeri/galeri_foto/' . $file_name;
                    Image::make($file->getRealPath())->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($target);
                    $galeri->img = $file_name;
                    $galeri->save();
                }
                $galeri->save();
            }
        }
        return redirect(route('admin.galeri.foto'))->with('sukses','Data Berhasil di ubah !');
    }

    public function fotoDestroy(Request $request)
    {
        $album = Album::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus Album : ' . $album->judul_id,'Galeri - Foto');
        $foto_album = Galeri::where('relasi',1)->where('relasi_id',$request->id)->get();
        foreach($foto_album as $foto){
            $file = 'file_app/galeri/galeri_foto/'.$foto->img;
            if(is_file($file)){
                unlink($file);
            }
        }
        $album->delete();
        $foto_album_delete = Galeri::where('relasi',1)->where('relasi_id',$request->id)->delete();
        return response()->json();
    }

    public function videoStore(Request $request)
    {
        $video = new Galeri_video();
        $video->judul_id = $request->judul_id;
        $video->judul_en = $request->judul_en;
        $video->deskripsi_id = $request->deskripsi_id;
        $video->deskripsi_en = $request->deskripsi_en;
        $video->slug = str_slug($request->judul_id);
        $video->url_video = $request->url_video;
        $video->user_id = auth()->user()->id;
        $video->save();
        LogCreate::createLog(auth()->user()->id,'Menambah data Video : ' . $video->judul_id,'Galeri - Video');
        return redirect(route('admin.galeri.video'))->with('sukses','Data Berhasil di simpan !');
    }

    public function videoEdit($id)
    {
        $video = Galeri_video::find($id);
        $data['video'] = $video;
        return view('back.pages.galeri.video_edit',$data);
    }

    public function videoUpdate($id,Request $request)
    {
        $video = Galeri_video::find($id);
        $video->judul_id = $request->judul_id;
        $video->judul_en = $request->judul_en;
        $video->deskripsi_id = $request->deskripsi_id;
        $video->deskripsi_en = $request->deskripsi_en;
        $video->slug = str_slug($request->judul_id);
        $video->url_video = $request->url_video;
        $video->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah data Video : ' . $video->judul_id,'Galeri - Video');
        return redirect(route('admin.galeri.video'))->with('sukses','Data Berhasil di simpan !');

    }

    public function videoDestroy(Request $request)
    {
        $video = Galeri_video::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus Video : ' . $video->judul_id,'Galeri - Video');
        $video->delete();
        return response()->json();
    }

    public function foto_detailDestroy(Request $request)
    {
        $foto = Galeri::find($request->id);
        $file_ex = 'file_app/galeri/galeri_foto/'.$foto->img;
        if(is_file($file_ex)){
            unlink($file_ex);
        }
        $foto->delete();
        return response()->json($request->all());
    }
}
