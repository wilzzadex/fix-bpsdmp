<?php

namespace App\Http\Controllers;
use App\Publikasi;
use Validator;
use LogCreate;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class AdminPublikasiController extends Controller
{
    public function indexBerita()
    {
        if(auth()->user()->role != 'superadmin'){
            $berita = Publikasi::where('kategori','berita')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $berita = Publikasi::where('kategori','berita')->orderBy('id','DESC')->get(); 
        }
        $data['berita'] = $berita;
        return view('back.pages.publikasi.berita.berita',$data);
    }

    public function beritaAdd()
    {
        return view('back.pages.publikasi.berita.berita_add');
    }

    public function indexPers()
    {
        if(auth()->user()->role != 'superadmin'){
            $pers = Publikasi::where('kategori','pers')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $pers = Publikasi::where('kategori','pers')->orderBy('id','DESC')->get();
        }

        $data['pers'] = $pers;
        return view('back.pages.publikasi.pers.pers',$data);
    }

    public function persAdd()
    {
        return view('back.pages.publikasi.pers.pers_add');
    }

    public function indexInfografis()
    {
        if(auth()->user()->role != 'superadmin'){
            $info = Publikasi::where('kategori','infografis')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $info = Publikasi::where('kategori','infografis')->orderBy('id','DESC')->get();
        }

        $data['info'] = $info;
        return view('back.pages.publikasi.infografis.infografis',$data);
    }

    public function infografisAdd()
    {
        return view('back.pages.publikasi.infografis.infografis_add');
    }

    public function indexEvent()
    {
        if(auth()->user()->role != 'superadmin'){
            $event = Publikasi::where('kategori','event')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else{
            $event = Publikasi::where('kategori','event')->orderBy('id','DESC')->get();
        }

        $data['event'] = $event;
        return view('back.pages.publikasi.event.event',$data);
    }

    public function eventAdd()
    {
        return view('back.pages.publikasi.event.event_add');
    }

    public function beritaStore(Request $request)
    {

        // dd($request->all());
        
        $cek = Publikasi::where('kategori','berita')->where('slug',str_slug($request->judul_id))->count();
        if($cek > 0) {
            return redirect()->back()->with('gagal','Berita dengan judul tersebut sudah ada !');
        }else{
            $publikasi = new Publikasi();

            if($request->btn == 'btn-draft'){
                $publikasi->is_draft = 1;
                LogCreate::createLog(auth()->user()->id,'Menambah Berita (Simpan Ke Draft) : ' . $request->judul_id,'Publikasi - Berita');
            }else{
                LogCreate::createLog(auth()->user()->id,'Menambah Berita (Di Publikasikan) : ' . $request->judul_id,'Publikasi - Berita');
                $publikasi->is_draft = 0;
            }

            if($request->videosource == 'yt'){
                $publikasi->is_youtube = 1;
                $publikasi->media = $request->url_youtube;
            }else{
                $publikasi->is_youtube = 0;
                if($request->hasFile('thumbnail')){
                    $file = Input::file('thumbnail');
                    $file_name = 'Berita_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
                    if(!file_exists('file_app/berita_image')){
                        mkdir('file_app/berita_image', 0777 , true);
                    }
                    $target = 'file_app/berita_image/' . $file_name;
                    Image::make($file->getRealPath())->resize(1000, 600)->save($target);
                    $publikasi->media = $file_name;
                }
            }

            $publikasi->judul_id = $request->judul_id;
            $publikasi->judul_en = $request->judul_en;
            $publikasi->deskripsi_id = $request->deskripsi_id;
            $publikasi->deskripsi_en = $request->deskripsi_en;
            $publikasi->slug = str_slug($request->judul_id);
            $publikasi->tanggal_awal = date('Y-m-d',strtotime($request->tanggal));
            $publikasi->kategori = 'berita';
            $publikasi->hit = 0;
            $publikasi->user_id = auth()->user()->id;
            $publikasi->save();

            return redirect(route('admin.publikasi.berita'))->with('sukses','Berhasil menyimpan data !');
        }
    }

    public function beritaEdit($id){
        $berita = Publikasi::find($id);
        $data['berita'] = $berita;
        return view('back.pages.publikasi.berita.berita_edit',$data);
    }

    public function beritaUpdate($id,Request $request)
    {
        $cek = Publikasi::where('kategori','berita')->where('id','!=',$id)->where('slug',str_slug($request->judul_id))->count();
        if($cek > 0) {
            return redirect()->back()->with('gagal','Berita dengan judul tersebut sudah ada !');
        }else{
            $publikasi = Publikasi::find($id);

            if($request->btn == 'btn-draft'){
                $publikasi->is_draft = 1;
                LogCreate::createLog(auth()->user()->id,'Mengubah Berita (Simpan Ke Draft) : ' . $request->judul_id,'Publikasi - Berita');
            }else{
                $publikasi->is_draft = 0;
                LogCreate::createLog(auth()->user()->id,'Mengubah Berita (Di Publikasikan) : ' . $request->judul_id,'Publikasi - Berita');
            }

            if($request->videosource == 'yt'){
                $publikasi->is_youtube = 1;
                $publikasi->media = $request->url_youtube;
            }else{
                $publikasi->is_youtube = 0;
                $file_ex = 'file_app/berita_image/'.$publikasi->media;
                if($request->hasFile('thumbnail')){
                    if(is_file($file_ex)){
                        unlink($file_ex);
                    }
                    $file = Input::file('thumbnail');
                    $file_name = 'Berita_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
                    if(!file_exists('file_app/berita_image')){
                        mkdir('file_app/berita_image', 0777 , true);
                    }
                    $target = 'file_app/berita_image/' . $file_name;
                    Image::make($file->getRealPath())->resize(1000, 600)->save($target);
                    $publikasi->media = $file_name;
                }
            }

            $publikasi->judul_id = $request->judul_id;
            $publikasi->judul_en = $request->judul_en;
            $publikasi->deskripsi_id = $request->deskripsi_id;
            $publikasi->deskripsi_en = $request->deskripsi_en;
            $publikasi->slug = str_slug($request->judul_id);
            $publikasi->tanggal_awal = date('Y-m-d',strtotime($request->tanggal));
            $publikasi->save();

            // LogCreate::createLog(auth()->user()->id,'Mengubah Data Berita');
            return redirect(route('admin.publikasi.berita'))->with('sukses','Berhasil mengubah data !');
        }
    }

    public function beritaDestroy(Request $request)
    {
        $publikasi = Publikasi::find($request->id);
        $file_ex = 'file_app/berita_image/'.$publikasi->media;
        LogCreate::createLog(auth()->user()->id,'Menghapus Berita : ' . $publikasi->judul_id,'Publikasi - Berita');
        if(is_file($file_ex)){
            unlink($file_ex);
        }
        $publikasi->delete();

        return response()->json();
    }

    public function persStore(Request $request)
    {
        // dd($request->all());
        $cek = Publikasi::where('kategori','pers')->where('slug',str_slug($request->judul_id))->count();
        if($cek > 0) {
            return redirect()->back()->with('gagal','Pers dengan judul tersebut sudah ada !');
        }else{
            $publikasi = new Publikasi();

            if($request->btn == 'btn-draft'){
                $publikasi->is_draft = 1;
                LogCreate::createLog(auth()->user()->id,'Menambah Siaran Pers (Simpan ke Draft) : ' . $request->judul_id,'Publikasi - Siaran Pers');
            }else{
                $publikasi->is_draft = 0;
                LogCreate::createLog(auth()->user()->id,'Menambah Siaran Pers (Di Publikasikan) : ' . $request->judul_id,'Publikasi - Siaran Pers');
            }

            if($request->videosource == 'yt'){
                $publikasi->is_youtube = 1;
                $publikasi->media = $request->url_youtube;
            }else{
                $publikasi->is_youtube = 0;
                if($request->hasFile('thumbnail')){
                    $file = Input::file('thumbnail');
                    $file_name = 'Pers_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
                    if(!file_exists('file_app/pers_image')){
                        mkdir('file_app/pers_image', 0777 , true);
                    }
                    $target = 'file_app/pers_image/' . $file_name;
                    Image::make($file->getRealPath())->resize(1000, 600)->save($target);
                    $publikasi->media = $file_name;
                }
            }

            $publikasi->judul_id = $request->judul_id;
            $publikasi->judul_en = $request->judul_en;
            $publikasi->deskripsi_id = $request->deskripsi_id;
            $publikasi->deskripsi_en = $request->deskripsi_en;
            $publikasi->slug = str_slug($request->judul_id);
            $publikasi->tanggal_awal = date('Y-m-d',strtotime($request->tanggal));
            $publikasi->kategori = 'pers';
            $publikasi->hit = 0;
            $publikasi->user_id = auth()->user()->id;
            $publikasi->save();

            return redirect(route('admin.publikasi.pers'))->with('sukses','Berhasil menyimpan data !');
        }
    }

    public function persEdit($id){
        $pers = Publikasi::find($id);
        $data['pers'] = $pers;
        return view('back.pages.publikasi.pers.pers_edit',$data);
    }

    public function persUpdate($id,Request $request)
    {
        // dd($request->all(),$id);
        $cek = Publikasi::where('kategori','pers')->where('id','!=',$id)->where('slug',str_slug($request->judul_id))->count();
        if($cek > 0) {
            return redirect()->back()->with('gagal','Pers dengan judul tersebut sudah ada !');
        }else{
            $publikasi = Publikasi::find($id);

            if($request->btn == 'btn-draft'){
                $publikasi->is_draft = 1;
                LogCreate::createLog(auth()->user()->id,'Mengubah Siaran Pers (Simpan Ke Draft) : ' . $request->judul_id,'Publikasi - Siaran Pers');

            }else{
                $publikasi->is_draft = 0;
                LogCreate::createLog(auth()->user()->id,'Mengubah Siaran Pers (Di Publikasikan) : ' . $request->judul_id,'Publikasi - Siaran Pers');

            }

            if($request->videosource == 'yt'){
                $publikasi->is_youtube = 1;
                $publikasi->media = $request->url_youtube;
            }else{
                $publikasi->is_youtube = 0;
                $file_ex = 'file_app/pers_image/'.$publikasi->media;
                if($request->hasFile('thumbnail')){
                    if(is_file($file_ex)){
                        unlink($file_ex);
                    }
                    $file = Input::file('thumbnail');
                    $file_name = 'Pers_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
                    if(!file_exists('file_app/pers_image')){
                        mkdir('file_app/pers_image', 0777 , true);
                    }
                    $target = 'file_app/pers_image/' . $file_name;
                    Image::make($file->getRealPath())->resize(1000, 600)->save($target);
                    $publikasi->media = $file_name;
                }
            }

            $publikasi->judul_id = $request->judul_id;
            $publikasi->judul_en = $request->judul_en;
            $publikasi->deskripsi_id = $request->deskripsi_id;
            $publikasi->deskripsi_en = $request->deskripsi_en;
            $publikasi->slug = str_slug($request->judul_id);
            $publikasi->tanggal_awal = date('Y-m-d',strtotime($request->tanggal));
            $publikasi->save();

            return redirect(route('admin.publikasi.pers'))->with('sukses','Berhasil mengubah data !');
        }
    }

    public function persDestroy(Request $request)
    {
        $publikasi = Publikasi::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus Siaran Pers : ' . $publikasi->judul_id,'Publikasi - Siaran Pers');
        $file_ex = 'file_app/pers_image/'.$publikasi->media;
        if(is_file($file_ex)){
            unlink($file_ex);
        }
        $publikasi->delete();

        return response()->json();
    }

    public function infografisStore(Request $request)
    {
        $publikasi = new Publikasi();

        if($request->btn == 'btn-draft'){
            $publikasi->is_draft = 1;
            LogCreate::createLog(auth()->user()->id,'Menambah Infografis (Simpan ke Draft) : ' . $request->judul_id,'Publikasi - Infografis');
        }else{
            $publikasi->is_draft = 0;
            LogCreate::createLog(auth()->user()->id,'Menambah Infografis (Di Publikasikan) : ' . $request->judul_id,'Publikasi - Infografis');
        }

        if($request->hasFile('thumbnail')){
            $file = Input::file('thumbnail');
            $file_name = 'Infografis_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
            if(!file_exists('file_app/infografis_image')){
                mkdir('file_app/infografis_image', 0777 , true);
            }
            $target = 'file_app/infografis_image/' . $file_name;
            Image::make($file->getRealPath())->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($target);
            $publikasi->media = $file_name;
        }

        $publikasi->judul_id = $request->judul_id;
        $publikasi->judul_en = $request->judul_en;
        $publikasi->slug = str_slug($request->judul_id);
        $publikasi->kategori = 'infografis';
        $publikasi->hit = 0;
        $publikasi->user_id = auth()->user()->id;
        $publikasi->save();

        return redirect(route('admin.publikasi.infografis'))->with('sukses','Berhasil menyimpan data !');
    
    }

    public function infografisEdit($id)
    {
        $info = Publikasi::find($id);
        $data['info'] = $info;
        return view('back.pages.publikasi.infografis.infografis_edit',$data);
    }

    public function infografisUpdate($id,Request $request)
    {
        $publikasi = Publikasi::find($id);

            if($request->btn == 'btn-draft'){
                $publikasi->is_draft = 1;
                LogCreate::createLog(auth()->user()->id,'Mengubah Infografis (Simpan ke Draft) : ' . $request->judul_id,'Publikasi - Infografis');
            }else{
                $publikasi->is_draft = 0;
                LogCreate::createLog(auth()->user()->id,'Mengubah Infografis (Di Publikasikan) : ' . $request->judul_id,'Publikasi - Infografis');
            }

        
            $file_ex = 'file_app/infografis_image/'.$publikasi->media;
            if($request->hasFile('thumbnail')){
                if(is_file($file_ex)){
                    unlink($file_ex);
                }
                $file = Input::file('thumbnail');
                $file_name = 'Infografis_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
                if(!file_exists('file_app/infografis_image')){
                    mkdir('file_app/infografis_image', 0777 , true);
                }
                $target = 'file_app/infografis_image/' . $file_name;
                Image::make($file->getRealPath())->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($target);
                $publikasi->media = $file_name;
            }
           

            $publikasi->judul_id = $request->judul_id;
            $publikasi->judul_en = $request->judul_en;
            $publikasi->slug = str_slug($request->judul_id);
            $publikasi->save();

            return redirect(route('admin.publikasi.infografis'))->with('sukses','Berhasil mengubah data !');
    }

    public function infografisDestroy(Request $request)
    {

        $publikasi = Publikasi::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus Infografis : ' . $publikasi->judul_id,'Publikasi - Infografis');
        $file_ex = 'file_app/infografis_image/'.$publikasi->media;
        if(is_file($file_ex)){
            unlink($file_ex);
        }
        $publikasi->delete();

        return response()->json();
    }

    public function eventStore(Request $request)
    {
        // dd($request->all());
        $tanggal = explode("-",$request->tanggal);
        $_1 = $tanggal[0];
        $_2 = $tanggal[1];
        $pisah_t_w_1 = explode(" ",$_1); 
        $pisah_t_w_2 = explode(" ",$_2); 
        $tanggal_awal = date('Y-m-d',strtotime($pisah_t_w_1[0]));
        $tanggal_akhir = date('Y-m-d',strtotime( $pisah_t_w_2[1]));
        $waktu = $pisah_t_w_1[1] . " " . $pisah_t_w_1[2]." - ".$pisah_t_w_2[2] . " " . $pisah_t_w_2[3];
        // dd($tanggal_awal);
        $cek = Publikasi::where('kategori','event')->where('slug',str_slug($request->judul_id))->count();
        if($cek > 0) {
            return redirect()->back()->with('gagal','Kegiatan dengan judul tersebut sudah ada !');
        }else{
            $publikasi = new Publikasi();

            if($request->btn == 'btn-draft'){
                $publikasi->is_draft = 1;
                LogCreate::createLog(auth()->user()->id,'Menambah Event (Simpan ke Draft) : ' . $request->judul_id,'Publikasi - Event');
            }else{
                $publikasi->is_draft = 0;
                LogCreate::createLog(auth()->user()->id,'Menambah Event (Di Publikasikan) : ' . $request->judul_id,'Publikasi - Event');
            }

           
            if($request->hasFile('thumbnail')){
                $file = Input::file('thumbnail');
                $file_name = 'Event_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
                if(!file_exists('file_app/event_image')){
                    mkdir('file_app/event_image', 0777 , true);
                }
                $target = 'file_app/event_image/' . $file_name;
                Image::make($file->getRealPath())->resize(1000, 600)->save($target);
                $publikasi->media = $file_name;
            }
            
            $publikasi->judul_id = $request->judul_id;
            $publikasi->judul_en = $request->judul_en;
            $publikasi->deskripsi_id = $request->deskripsi_id;
            $publikasi->deskripsi_en = $request->deskripsi_en;
            $publikasi->slug = str_slug($request->judul_id);
            $publikasi->tanggal_awal = $tanggal_awal;
            $publikasi->tanggal_akhir = $tanggal_akhir;
            $publikasi->lokasi = $request->lokasi;
            $publikasi->jam = $waktu;
            $publikasi->kategori = 'event';
            $publikasi->hit = 0;
            $publikasi->user_id = auth()->user()->id;
            $publikasi->save();

            return redirect(route('admin.publikasi.event'))->with('sukses','Berhasil menyimpan data !');
        }
    }

    public function eventEdit($id)
    {
        $info = Publikasi::find($id);
        $data['event'] = $info;
        return view('back.pages.publikasi.event.event_edit',$data);
    }

    public function eventUpdate(Request $request,$id)
    {
        // dd($request->all(),$id);$publikasi = Publikasi::find($id);
        $tanggal = explode("-",$request->tanggal);
        $_1 = $tanggal[0];
        $_2 = $tanggal[1];
        $pisah_t_w_1 = explode(" ",$_1); 
        $pisah_t_w_2 = explode(" ",$_2); 
        $tanggal_awal = date('Y-m-d',strtotime($pisah_t_w_1[0]));
        $tanggal_akhir = date('Y-m-d',strtotime( $pisah_t_w_2[1]));
        $waktu = $pisah_t_w_1[1] . " " . $pisah_t_w_1[2]." - ".$pisah_t_w_2[2] . " " . $pisah_t_w_2[3];
        $cek = Publikasi::where('kategori','event')->where('id','!=',$id)->where('slug',str_slug($request->judul_id))->count();
        if($cek > 0) {
            return redirect()->back()->with('gagal','Kegiatan dengan judul tersebut sudah ada !');
        }else{
            $publikasi = Publikasi::find($id);

            if($request->btn == 'btn-draft'){
                $publikasi->is_draft = 1;
                LogCreate::createLog(auth()->user()->id,'Mengubah Event (Simpan ke Draft) : ' . $request->judul_id,'Publikasi - Event');
            }else{
                $publikasi->is_draft = 0;
                LogCreate::createLog(auth()->user()->id,'Mengubah Event (Di Publikasikan) : ' . $request->judul_id,'Publikasi - Event');
            }

           
            $file_ex = 'file_app/event_image/'.$publikasi->media;
            if($request->hasFile('thumbnail')){
                if(is_file($file_ex)){
                    unlink($file_ex);
                }
                $file = Input::file('thumbnail');
                $file_name = 'Event_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
                if(!file_exists('file_app/event_image')){
                    mkdir('file_app/event_image', 0777 , true);
                }
                $target = 'file_app/event_image/' . $file_name;
                Image::make($file->getRealPath())->resize(1000, 600)->save($target);
                $publikasi->media = $file_name;
            }
            

            $publikasi->judul_id = $request->judul_id;
            $publikasi->judul_en = $request->judul_en;
            $publikasi->deskripsi_id = $request->deskripsi_id;
            $publikasi->deskripsi_en = $request->deskripsi_en;
            $publikasi->slug = str_slug($request->judul_id);
            $publikasi->tanggal_awal = $tanggal_awal;
            $publikasi->tanggal_akhir = $tanggal_akhir;
            $publikasi->lokasi = $request->lokasi;
            $publikasi->jam = $waktu;
            $publikasi->kategori = 'event';
            // $publikasi->hit = 0;
            $publikasi->save();

            return redirect(route('admin.publikasi.event'))->with('sukses','Berhasil mengubah data !');
        }

    }

    public function eventDestroy(Request $request)
    {
        $publikasi = Publikasi::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus Event : ' . $publikasi->judul_id,'Publikasi - Event');
        $file_ex = 'file_app/event_image/'.$publikasi->media;
        if(is_file($file_ex)){
            unlink($file_ex);
        }
        $publikasi->delete();

        return response()->json();
    }
}
