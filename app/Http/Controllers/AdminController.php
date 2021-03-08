<?php

namespace App\Http\Controllers;

use App\SiteDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as MakeImage;

class AdminController extends Controller
{

    public function listUser(){
        $users = User::orderBy('created_at','DESC')->get();
        return view('admin.users.users')->with(compact('users'));
    }
    public function delete($id=null){
        User::where(['id'=>$id])->delete();
        return redirect()->back();
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }

    public function siteSettings(){
        $details = SiteDetail::first();
        return view('admin.site_settings')->with(compact('details'));
    }

    public function updateLogo(Request $request){
        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $filename = 'SiteLogo-'. time(). '.' . $logo->getClientOriginalExtension();
            $image_path = 'images/websiteImage/'.$filename;
            ini_set('memory_limit','256M');
            MakeImage::make($logo)->save($image_path);
            SiteDetail::where('id',1)->update(['website_image'=>$filename]);
        }
        return redirect()->back()->with('flash_message_success','Updated Successfully');
    }

    public function updateOthers(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            SiteDetail::where(['id'=>1])->update([
                'title'=>$data['title'],
                'link'=>$data['link']
            ]);
        }
        return redirect()->back()->with('flash_message_success','Updated Successfully');
    }

    public function checkAdminPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::find(Auth::user()->id);
        if (Hash::check($current_password,$check_password->password)) {
            echo "true"; die;
        } else {
            echo "false"; die;
        }
    }

    public function updateAdminPassword(Request $request){
        if($request ->isMethod('post')){
            $data = $request->all();
            $password = bcrypt($data['new_pwd']);
            User::find(Auth::user()->id)->update(['password'=>$password]);
            return redirect()->back()->with('flash_message_success','Password updated Successfully');
        }
    }

    public function updateAdminAvatar(Request $request){
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = 'Admin-'. time(). '.' . $avatar->getClientOriginalExtension();
            $image_path = 'images/userImages/'.$filename;
            ini_set('memory_limit','256M');
            MakeImage::make($avatar)->save($image_path);
            User::where('id',Auth::user()->id)->update(['avatar'=>$filename]);
        }
        return redirect()->back()->with('flash_message_success','Updated Successfully');
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            User::where(['id'=>Auth::user()->id])->update([
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'email'=>$data['email'],
            ]);
        }
        return redirect()->back()->with('flash_message_success','Updated Successfully');
    }
}
