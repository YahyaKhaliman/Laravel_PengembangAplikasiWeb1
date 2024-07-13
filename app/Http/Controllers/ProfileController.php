<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use Illuminate\support\facades\hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            $name = null;
            if ($request->hasFile('image')) {
                $name = $request->image->hashName();
                $path = $request->file('image')->storeAs('public/image', $name);
            }
        }
        $user = new UserModel;
        $user->email = $request->emailaddress;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->hak_akses = $request->hak_akses;
        $user->foto = $name;
        $user->save();
        return redirect('register')->with(['success' => 'Data Berhasil Disimpan!']);
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

    public function data(){
        $data = UserModel::all();
        return view('view_data', compact('data'));
    }

    public function hapus($id){
        UserModel::find($id)->delete();
        return redirect('/')->with('success','Data berhasil dihapus');
    }

    public function page_data(){
        $data=UserModel::paginate(2);
        return view('view_page_data', compact('data'));
    }

    public function form_update($siswa_id){
        $detail_data = UserModel::find($siswa_id);
        return view('register_update', compact('detail_data'));
    }

    public function save_update(Request $request){
        $validator = Validator::make($request->all(), [
            'emailaddress' => 'required|email|unique:user,email,'.$request->user_id.',user_id',
            'nama' => 'required',
            'hak_akses' => 'required',
        ],[
        'emailaddress.required' => 'Email Wajib Diisi.',
        'emailaddress.email' => 'Format Email Tidak tepat.',
        'emailaddress.unique' => 'Email Pernah Digunakan',
        'nama.required' => 'Nama Wajib Diisi.',
        'hak_akses.required' => 'Hak Akses Wajib Diisi.',
                        
        ]);
        if ($validator->fails()) {
                return redirect('form_update/'.$request->user_id)
                        ->withErrors($validator)
                        ->withInput();
        }else{   
        $name=$request->foto_old;
        $password=$request->password;
        if (request()->hasFile('image')){
            $name=$request->image->hashName();
            $path = $request->file('image')->storeAs('/public/image/'.$name);
            Storage::delete('/public/image/'.$request->foto_old);
        }     
        
        $user_id=$request->user_id;
        $user = UserModel::find($user_id);
        if($password!=""){
            $user->password = $request->password;
        }
        $user->email = $request->emailaddress;
        $user->nama = $request->nama;
        $user->hak_akses = $request->hak_akses;
        $user->foto = $name;
        $user->save();
        return redirect('view_data')->with(['success' => 'Data Berhasil Diupdate!']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil.');
    }
}