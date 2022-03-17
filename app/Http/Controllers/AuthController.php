<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Login;
use App\Models\Biodata;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Auth;
use Validator;

class AuthController extends Controller{
    public function indexSignIn(){
        if(Auth::guard('admin')->check() || Auth::guard('user')->check()){
            return redirect('dashboard');
        }else{
            $username = session('username');
            return view('sign-in', compact('username'));
        }
    }

    public function indexDashboard(){
        return view('dashboard');
    }

    public function indexWelcome(Request $request){
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome']
        );

        return view('pages/welcome', compact('breadcrumb'));
    }

    public function actionSignIn(Request $request){
        $validator = Validator::make($request->all(), [
            'nip' => 'required:nip',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        if ($login = Login::where(['nip' => $request->nip])->first()) {
            if ($request->password == $login->PASSWORD) {
                session(['nip' => $request->nip]);
                Auth::guard('admin')->login($login);
                return success_response('Login Berhasil');
            }else{
                return error_response('Password Anda salah');
            }
        }else{
            return error_response('Akun anda tidak ditemukan');
        }
    }

    public function actionSignFromOther(Request $request){
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            // 'password' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        if ($biodata = Biodata::where(['nik' => $request->nik])->first()) {
            Auth::guard('user')->login($biodata);

            return redirect('dashboard#evaluation');
        }else{
            return error_response('Akun anda tidak ditemukan');
        }
    }

    public function actionChangePassword(Request $request){
        if($request->new_password == $request->new_confirm_password){
            $login = auth_data();
            if ($request->old_password == $login->PASSWORD) {
                $login->PASSWORD = $request->new_password;
                $login->save();

                return success_response('Sukses mengganti password');
            }else{
                return error_response('Password lama Anda salah');
            }
        }else{
            return error_response('Ketikkan lagi password baru Anda');
        }
    }

    public function actionSignOut(Request $request){
        Auth::guard('admin')->logout();
        Auth::guard('user')->logout();
        return redirect('/');
    }
}