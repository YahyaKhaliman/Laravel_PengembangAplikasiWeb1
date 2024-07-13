<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use GuzzleHttp\Psr7\Message;
use Illuminate\support\facades\hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ApiProfileController extends Controller
{
    public function page_data_pengguna(){
        $data = UserModel::all();
        if(count($data)>0){
            return response()->json([
                'succes' => true,
                'message' => 'List Semua Pengguna',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'succes' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 400);
        }
    }

    public function save_pengguna(Request $request){
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
            return response()->json(['error'=>$validator->errors(), 'success'=>false], 422);
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
        return response()->json(['error'=>'','success'=>'Data Berhasil Disimpan'], 200);
	}

    public function save_update_pengguna(Request $request){
        $validator = Validator::make($request->all(), [
            'emailaddress' => 'required|email|unique:user,email,'.$request->user_id.',user_id',
            'nama' => 'required',
            'hak_akses' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
        'emailaddress.required' => 'Email Wajib Diisi.',
        'emailaddress.email' => 'Format Email Tidak tepat.',
        'emailaddress.unique' => 'Email Pernah Digunakan',
        'nama.required' => 'Nama Wajib Diisi.',
        'hak_akses.required' => 'Hak Akses Wajib Diisi.',
                        
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors(), 'sucess'=>false], 422);
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
        return response()->json(['error'=>'', 'succes'=>'Data Berhasil Diupdate'], 200);
        }
    }

    public function delete($id){
        $user_id=(int)$id;
        $detail_data = UserModel::find($user_id);
        if($detail_data){
            UserModel::find($user_id)->delete();
                return response()->json(['error'=>'', 'success'=>"Data Berhasil Dihapus"], 200);
        }else{
            return response()->json(['error'=>'Data Tidak Ditemukan', 'success'=>false], 422);
        }
    }
}
