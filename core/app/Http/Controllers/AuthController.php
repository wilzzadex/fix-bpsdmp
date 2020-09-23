<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use LogCreate;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('back.pages.auth.index');
    }

    public function loginpost(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        
        if(Auth::attempt($request->only('username','password'))){
            if(auth()->user()->status != 0){
                Session::put('attempt_'.$request->username,0);
                LogCreate::createLog(auth()->user()->id,'Berhasil Melakukan Login','Login');
                return redirect(route('admin.dashboard'));
            }
            LogCreate::createLog(auth()->user()->id,'Login Gagal, Akun sudah di blok','Login');
            Auth::logout();
            return redirect(route('login'))->with('gagal',' Akun anda telah di blok, Silahkan hubungi admin untuk mengaktifkan akun Anda !');
        }else{
            $cek_user = User::where('username',$request->username)->count();
            if($cek_user > 0){

                $cek_super = User::where('username',$request->username)->where('role','superadmin')->count();

                // dd($cek_super);
                if($cek_super == 0){
                    if(Session::has('attempt_'.$request->username)){
                        $attemp = Session::get('attempt_'.$request->username);
                    }else{
                        $attemp = 0;
                    }
                    if($attemp >= 10){
                        $cs = User::where('username',$request->username)->first();
                        LogCreate::createLog($cs->id,'Gagal Login,Akun di blok karena 10x salah masukan password','Login');
                        $cs->status = 0;
                        $cs->save();
                        return redirect(route('login'))->with('blok','Akun anda di blok, karena 10x salah Memasukan Password, Silahkan hubungi admin untuk memulihkan kembali akun anda');
                    }else{
                        $fix_a = $attemp + 1;
                        $cs = User::where('username',$request->username)->first();
                        LogCreate::createLog($cs->id,'Gagal Login, Percobaan login ke - '.$fix_a,'Login');
                        Session::put('attempt_'.$request->username,$attemp+1);
                        return redirect(route('login'))->with('pass',$request->username);
                    }
                    
                }else{
                    $cs = User::where('username',$request->username)->first();
                    LogCreate::createLog($cs->id,'Gagal Login, Username atau password salah','Login');
                    return redirect(route('login'))->with('gagal','Password Salah !');
                }
                
               
            }else{
                // Session::put('attempt_'.$request->username,0);
                LogCreate::createLog(0,'Gagal Login, Username atau password salah','Login');
                return redirect(route('login'))->with('gagal','Username Atau Password Salah !');
            }
            
        }
    }

    public function logout()
    {
        LogCreate::createLog(auth()->user()->id,'Berhasil Melakukan Logout','Login');
        Auth::logout();
        return redirect(route('login'));
    }
}
