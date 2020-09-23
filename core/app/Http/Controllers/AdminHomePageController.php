<?php

namespace App\Http\Controllers;
use App\Slider;
use App\Social_media;
use App\Alamat;
use App\Popup;
use LogCreate;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class AdminHomePageController extends Controller
{
    public function indexSlider()
    {
        $slider = Slider::orderBy('id','DESC')->get();
        $data['slider'] = $slider;
        return view('back.pages.homepage.slider.slider',$data);
    }

    public function sliderpost(Request $request)
    {
        if($request->hasFile('img')){
            $file = Input::file('img');
            $file_name = 'Slider_img-' . str_slug($request->judul_id) . "-" . time() . "." . $file->getClientOriginalExtension();
            if(!file_exists('file_app/slider_image')){
                mkdir('file_app/slider_image', 0777 , true);
            }
            $target = 'file_app/slider_image/' . $file_name;
            Image::make($file->getRealPath())->resize(1000, 570)->save($target);

            $slider = new Slider();
            $slider->judul_id = $request->judul_id;
            $slider->judul_en = $request->judul_en;
            $slider->img = $file_name;
            $slider->save();
            LogCreate::createLog(auth()->user()->id,'Menambah Slider : '.$request->judul_id,'Homepage - Slider');
            return redirect(route('admin.slider.index'))->with('sukses','Slider Berhasil di Simpan !');
        }
        
        // dd($target);
    }

    public function sliderdelete(Request $request){
        $slider = Slider::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus Slider : '.$slider->judul_id,'Homepage - Slider');
        $file = 'file_app/slider_image/'.$slider->img;
        if(is_file($file)){
            unlink($file);
        }
        $slider->delete();
        return response()->json(); 
    }

    public function viewEdit($id)
    {
        $slider = Slider::find($id);
        $data['slider'] = $slider;
        return view('back.pages.homepage.slider.slider_edit_view',$data);
    }

    public function editPost(Request $request,$id)
    {
        $slider = Slider::find($id);
        $file = 'file_app/slider_image/'.$slider->img;
        if($request->hasFile('img')){
            if(is_file($file)){
                unlink($file);
            }
            $file_img = Input::file('img');
            $file_name = str_slug($request->judul_id) . "-" . time() . "." . $file_img->getClientOriginalExtension();
            if(!file_exists('file_app/slider_image')){
                mkdir('file_app/slider_image', 0777 , true);
            }
            $target = 'file_app/slider_image/' . $file_name;
            Image::make($file_img->getRealPath())->resize(1000, 570)->save($target);

            $slider->img = $file_name;
        }

        $slider->judul_id = $request->judul_id;
        $slider->judul_en = $request->judul_en;
        $slider->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah Slider : '.$request->judul_id ,'Homepage - Slider');
        return redirect(route('admin.slider.index'))->with('sukses','Data berhasil di ubah !');
    }

    public function sliderAdd()
    {
        return view('back.pages.homepage.slider.slider_add');
    }

    public function indexSocial()
    {
        $smedia = Social_media::all();
        $data['smedia'] = $smedia;
        return view('back.pages.homepage.smedia.smedia',$data);
    }

    public function smediaedit($id){
        $smedia = Social_media::find($id);
        $data['smedia'] = $smedia;
        return view('back.pages.homepage.smedia.smedia_edit',$data);
    }

    public function smediaepost(Request $request,$id)
    {
        $smedia = Social_media::find($id);
        $smedia->url = $request->url;
        $smedia->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah Url ' . $smedia->flag,'Homepage - Sosial Media');
        return redirect()->back()->with('sukses','Url berhasil di ubah !');
    }

    public function indexAlamat()
    {
        $alamat = Alamat::where('id',1)->first();
        $data['alamat'] = $alamat;
        return view('back.pages.homepage.alamat.alamat',$data);
    }

    public function alamatpost(Request $request)
    {
        $alamat = Alamat::find(1);
        $alamat->alamat = $request->alamat;
        $alamat->email = $request->email;
        $alamat->no_telp = $request->no_telp;
        $alamat->fax = $request->fax;
        $alamat->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah Data Alamat','Homepage - Alamat');
        return redirect()->back()->with('sukses','Berhasil menyimpan Perubahan !');
    }

    public function indexPopup()
    {
        $popup = Popup::orderBy('id','DESC')->get();
        $data['popup'] = $popup;
        return view('back.pages.homepage.master_popup.popup',$data);
    }

    public function popupStore(Request $request)
    {
        if($request->hasFile('img')){
            $file = Input::file('img');
            $file_name = 'Popup_img-' . str_slug($request->nama_file) . "-" . time() . "." . $file->getClientOriginalExtension();
            if(!file_exists('file_app/popup_image')){
                mkdir('file_app/popup_image', 0777 , true);
            }
            $target = 'file_app/popup_image/' . $file_name;
            Image::make($file->getRealPath())->resize(null, 900, function ($constraint) {
                $constraint->aspectRatio();
            })->save($target);

            $popup = new Popup();
            $popup->nama_file = $request->nama_file;
            $popup->file = $file_name;
            $popup->is_active = 0;
            $popup->save();
            LogCreate::createLog(auth()->user()->id,'Menambah Popup : ' . $popup->nama_file,'Homepage - Master Popup');

            return redirect(route('admin.popup.index'))->with('sukses','Popup Berhasil di Simpan !');
        }
    }

    public function popupDestroy(Request $request)
    {
        $popup = Popup::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus Popup ' . $popup->nama_file,'Homepage - Master Popup');
        $file = 'file_app/popup_image/'.$popup->file;
        if(is_file($file)){
            unlink($file);
        }
        $popup->delete();
        return response()->json();
    }

    public function popupEdit($id)
    {
        $popup = Popup::find($id);
        $data['popup'] = $popup;
        return view('back.pages.homepage.master_popup.popup_edit',$data);
    }

    public function popupUpdate(Request $request,$id)
    {
        $popup = Popup::find($id);
        $file = 'file_app/popup_image/'.$popup->file;
        if($request->hasFile('img')){
            if(is_file($file)){
                unlink($file);
            }
            $file_img = Input::file('img');
            $file_name = str_slug($request->nama_file) . "-" . time() . "." . $file_img->getClientOriginalExtension();
            if(!file_exists('file_app/popup_image')){
                mkdir('file_app/popup_image', 0777 , true);
            }
            $target = 'file_app/popup_image/' . $file_name;
            Image::make($file_img->getRealPath())->resize(null, 900, function ($constraint) {
                $constraint->aspectRatio();
            })->save($target);

            $popup->file = $file_name;
        }
        $popup->nama_file = $request->nama_file;
        $popup->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah Popup ' . $popup->nama_file,'Homepage - Master Popup');
        return redirect(route('admin.popup.index'))->with('sukses','Data berhasil di ubah !');
    }

    public function popupAdd()
    {
        return view('back.pages.homepage.master_popup.popup_add');
    }

    public function popupIsactive(Request $request)
    {
        $popup = Popup::find($request->id);
        $status = $popup->is_active;
        if($status == 1){
            $popup->is_active = 0;
            LogCreate::createLog(auth()->user()->id,'Mengubah Status Popup : ' . $popup->nama_file . ' Menjadi Tidak Aktif','Homepage - Master Popup');
        }else{
            $affected = \DB::table('master_popup')->update(['is_active' => 0]);
            $popup->is_active = 1;
            LogCreate::createLog(auth()->user()->id,'Mengubah Status Popup : ' . $popup->nama_file . ' Menjadi Aktif','Homepage - Master Popup');
        }
        $popup->save();
        return response()->json();
    }

    
}
