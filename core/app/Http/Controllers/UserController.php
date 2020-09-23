<?php

namespace App\Http\Controllers;
use App\Log;
use App\User;
use LogCreate;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role','!=','superadmin')->where('id','!=',0)->orderBy('id','DESC')->get();
        $data['user'] = $user;
        return view('back.pages.user.user',$data);
    }

    public function add()
    {
        return view('back.pages.user.user_add');
    }

    public function store(Request $request)
    {
        $customMsg = [
            'unique'=> 'Username tersbut sudah terdaftar !',
        ];
        $this->validate($request,[
            'username'=>'unique:users',
            'nama' =>'required',
            'password' => 'required',
        ],$customMsg);
        // dd($request->all());
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->nama;
        $user->role = 'admin';
        $user->password = bcrypt($request->password);
        $user->avatar = 'default.png';
        $user->save();
        LogCreate::createLog(auth()->user()->id,'Menambah data User ' . $user->username,'User - Managemen User');
        return redirect(route('admin.user'))->with('sukses','Data Berhasil di Simpan !');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        LogCreate::createLog(auth()->user()->id,'Menghapus data User ' . $user->username,'User - Managemen User');
        $file = 'file_app/user_avatar/'.$user->avatar;
        if(is_file($file)){
            unlink($file);
        }
        $user->delete();
        return response()->json();
    }
    public function edit($id)
    {
        $user = User::find($id);
        $data['users'] = $user;
        // dd($data);
        return view('back.pages.user.user_edit',$data);
    }

    public function active(Request $request)
    {
        $user = User::find($request->id);
        if($user->status ==1){
            $user->status = 0;
            LogCreate::createLog(auth()->user()->id,'Mengubah Status Akun ' . $user->username .' Menjadi Tidak Aktif','User - Managemen User');
        }else{
            $user->status = 1;
            LogCreate::createLog(auth()->user()->id,'Mengubah Status Akun ' . $user->username .' Menjadi Aktif','User - Managemen User');
        }
        $user->save();
        return response()->json();
    }

    public function update($id,Request $request)
    {
        // dd($request->all());
        $customMsg = [
            'unique'=> 'Username tersbut sudah terdaftar !',
        ];
        $this->validate($request,[
            'username'=>'unique:users,username,'.$id,
            'nama' =>'required',
            // 'password' => 'required',
        ],$customMsg);
        $user = User::find($id);
        $user->username = $request->username;
        $user->name = $request->nama;
        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah data User ' . $user->username,'User - Managemen User');
        return redirect(route('admin.user'))->with('sukses','Data Berhasil di Ubah !');
    }

    public function profilIndex()
    {
        return view('back.pages.user.profil');
    }

    public function profilUpdate(Request $request,$id)
    {
        // dd($request->all());
        $customMsg = [
            'unique'=> 'Username tersbut sudah terdaftar !',
        ];
        $this->validate($request,[
            'username'=>'unique:users,username,'.$id,
            'nama' =>'required',
            // 'password' => 'required',
        ],$customMsg);
        $user = User::find($id);
        if($request->hasFile('img')){
            if($user->avatar != 'default.png'){
                $file_ex = 'file_app/user_avatar/'.$user->avatar;
                if(is_file($file_ex)){
                    unlink($file_ex);
                }
            }
            $file = Input::file('img');
            $file_name = str_slug($request->nama) . "-" . time() . "." . $file->getClientOriginalExtension();
            if(!file_exists('file_app/user_avatar')){
                mkdir('file_app/user_avatar', 0777 , true);
            }
            $target = 'file_app/user_avatar/' . $file_name;
            Image::make($file->getRealPath())->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($target);
            $user->avatar = $file_name;
        }
        $user->username = $request->username;
        $user->name = $request->nama;
        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        LogCreate::createLog(auth()->user()->id,'Mengubah Profil','Profil');
        return redirect()->back()->with('sukses','Profil Berhasil di Ubah !');
    }

    public function logIndex()
    {
        $query = Log::select('log.action','users.name','users.username','log.created_at','log.page')
                    ->join('users','users.id','=','log.user_id')
                    ->orderBy('log.id','DESC')
                    ->paginate(10);
        $data['log'] = $query;
        // dd($query);
        return view('back.pages.log.log',$data);
    }

    
}
