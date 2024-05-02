<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use Illuminate\support\facades\hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function dashboard(){
        return view('home');
    }

    public function tentang(){
        $isi_tentang='Saya adalah mahasiswa STMIK AMIKOM SURAKARTA';
        return view('tentang',compact('isi_tentang'));
        // Perintah compact digunakan untuk melemparkan nilai variable ke resource=>views
    }

    public function kontak(){
        return view('kontak');
    }

    public function form(){
        return view('form');
    }

    public function add_form(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required'
        ],[
            'nama.required' => 'Nama Wajib Diisi',
            'telp.required' => 'Telp Wajib Diisi',
        ]);
        if($validator->fails()){
            // return back()->withError(['error' => $validator]) -> withInput();
            return redirect('form')
                ->withErrors($validator)
                ->withInput();
        }else{
            $nama=$request->nama;
            $telp=$request->telp;
            return redirect('form')->with(['success' => "Data Berhasil Disimpan!", 'nama'=>$nama, "telp"=>$telp]);
        }
    }

    public function register(){
        return view ("register");
    }

    public function save_register(Request $request){
		$validator = Validator::make($request->all(), [
			'emailaddress' => 'required|email|unique:user,email',
			'nama' => 'required',
			'password' => 'required',
			'hak_akses' => 'required',
        ],[
			'emailaddress.required' => 'Email Wajib Diisi.',
			'emailaddress.email' => 'Format Email Tidak tepat.',
			'emailaddress.unique' => 'Email Pernah Digunakan',
			'nama.required' => 'Nama Wajib Diisi.',
			'password.required' => 'Password Wajib Diisi.',
			'hak_akses.required' => 'Hak Akses Wajib Diisi.',
							
		]);
		if ($validator->fails()) {
		return redirect('register')
        ->withErrors($validator)
        ->withInput();
        }else{
			$email=$request->emailaddress;
			$nama=$request->nama;
			$password=$request->password;
			$hak_akses=$request->hak_akses;
			$user=new UserModel;
			$user->email=$request->emailaddress;
			$user->nama=$request->nama;
			$user->password=Hash::make($request->password);
			$user->hak_akses=$request->hak_akses;
			$user->save();
			return redirect('register')->with(['success' => 'Data Berhasil Disimpan!']);
		}
	}
    
    public function form_login(){
        return view ("form_login");
    }

    public function action_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_text' => 'required',
            'password_text' => 'required',
        ],[
            'email_text.required' => 'Username  Wajib Diisi.',
            'password_text.required' => 'Passsword Wajib Diisi.',
                
        ]);
        if ($validator->fails()) {
        
            return back()->withErrors($validator);
        }
        if (Auth::attempt(['email' => $request->email_text, 'password' => $request->password_text])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
            return back()->withErrors("User/Password Tidak tepat");
    }
}

