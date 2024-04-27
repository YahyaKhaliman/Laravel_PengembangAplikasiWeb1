<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function home(){
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
}

