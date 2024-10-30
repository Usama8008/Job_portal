<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\TooManyRedirectsException;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function users(){
        $users= User::orderBy('created_at','DESC')->paginate(10);
        return view('admin.users.users', compact('users'));
    }

    public function editUser($id){
        $user= User::findorfail($id);
        return view('admin.users.edit_user',compact('user'));
    }

    public function updateUser(Request $request, $id){
        $validator= Validator::make($request->all(),[
            'name'=> 'required|min:3|max:20',
            'email'=> 'required|email|unique:users,email,'.$id.',id',
            ]);
           
            if($validator->passes()){
                User::findorfail($id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'designation'=>$request->designation,
                    'mobile'=>$request->mobile,
                ]);
                return redirect()->route('admin.users')->with('msg','User Updated successfully');
                
            }else {
                return redirect()->route('admin.user.edit',$id)->withErrors($validator);
            }
    }

    public function destroy($id){
       $user= User::findorfail($id);
       if($user==null){
        return redirect()->route('admin.users')->with('error','User not Found');
       }
       $user->delete();
       return redirect()->route('admin.users')->with('msg','User deleted successfullly ');
    }
}
