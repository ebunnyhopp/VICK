<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\LCategory;
use App\Models\Item;
use App\Models\Request as Req;
use Hash;
use App\Models\User;
use App\Models\UserToken;
use Mail;
use App\Mail\ActivationMail;

class HomeController extends Controller
{
    public function home() {
      if (Auth::user()){
          if (Auth::user()->role==1){
              return redirect('/dashboard');
          }else {
              return redirect('/admin/dashboard');
          }
        }
        return redirect('login');
    }
    
    public function login() {
        return view('login');
    }
    
    public function postlogin(Request $request) {
        if(auth()->attempt($request->only('email','password'))){
            if(Auth::user()->flag==0){
                Auth::logout();
                return [
                    'status'=>'error',
                    'message'=>'Your account has been deleted. Please contact admin'
                ];
            }
            
            if(Auth::user()->email_verified_at==null){
                Auth::logout();
                return [
                    'status'=>'error',
                    'message'=>'Your account is inactive. Please check your email for verification'
                ];
            }
            
            return [
                'status'=>'success',
            ];
            
        } else {
            return [
                    'status'=>'error',
                    'message'=>'Invalid creditial'
                ];
        }  
    }
    
    public function success(){
        return view('success');
    }
    
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
    
    public function clientdashboard(){
        return view('clientdashboard');
    }
    
    public function admindashboard(){
        return view('admindashboard');
    }
    
    public function category(){
        $category= LCategory::where('flag',1)->get();
        return view('category', compact('category'));
        
    }
    
    public function item(){
        $item=Item::where('flag',1)->get();
        return view('item', compact('item'));
    }
    
    public function userrequest(){
        return view('userrequest');
    }
    
    public function addcategory(){
        return view('addcategory');
    }
    
    public function storecategory(Request $request){
        $category=new LCategory;
        $category->category=$request->category;
        if($category->save()){
            return redirect('admin/setting/category');
        }         
    }
    
    public function deletecategory($id){
        $category=LCategory::find($id);
        $category->flag=0;
        if($category->save()){
            return redirect('admin/setting/category');
        }
    }
    
    public function additem(){
        $category= LCategory::where('flag',1)->get();
        return view('additem', compact('category')); 
    }
    
    public function storeitem(Request $request){
        $item=new Item;
        $item->item=$request->itemname;
        $item->category_id=$request->category;
        $item->place_found=$request->location;
        $item->date_found=date('Y-m-d', strtotime($request->date));
        $item->description=$request->description;
        $item->color=$request->color;
        $item->serial_num=$request->serialnum;
        $item->user_id=Auth::user()->id;

        if($item->save()){
            return redirect('admin/item');
        }
    }
    
    public function deleteitem($id){
        $item=Item::find($id);
        $item->flag=0;
        if($item->save()){
            return redirect('admin/item');
        }
    }
    
    public function returnitem($id){
        $item=Item::find($id);
        $item->status=2;
        if($item->save()){
            return redirect('admin/item');
        }
    }
    
    public function clientreport(){
        $item=Item::where('flag',1)->where('user_id',Auth::user()->id)->get();
        return view('clientreport', compact('item'));
    }
    
    public function addreport(){
        $category=LCategory::where('flag',1)->get();
        return view('addreport', compact('category'));
    }
    
    public function storereport(Request $request){
        $item=new Item;
        $item->item=$request->itemname;
        $item->category_id=$request->category;
        $item->place_found=$request->location;
        $item->date_found=date('Y-m-d', strtotime($request->date));
        $item->description=$request->description;
        $item->color=$request->color;
        $item->serial_num=$request->serialnum;
        $item->user_id=Auth::user()->id;

        if($item->save()){
            return redirect('clientreport');
        }
    }
    
    public function lostitem(){
        $item=Item::where('flag',1)->where('status',1)->where('user_id','!=',Auth::user()->id)->whereNotIn('id',Req::where('user_id',Auth::user()->id)->pluck('item_id'))->get();
        return view ('lostitem', compact('item'));
    }
    
    public function adminrequest(){
        $req=Req::where('flag',1)->whereNotIn('item_id',Item::where('status',2)->pluck('id'))->get();
        return view('adminrequest', compact('req'));
    }
    
    public function clientrequest(){
        $req=Req::where('flag',1)->get();
        return view('clientrequest', compact('req'));
    }
    
    public function addclientrequest(){
        return view ('addclientrequest');
    }
    
    public function requestitem($id){
        $item=Item::find($id);
        return view('requestitem', compact('item'));
    }
    
    public function storerequest(Request $request, $id){
        $req=new Req;
        $req->user_id=Auth::user()->id;
        $req->item_id=$id;
        $req->description=$request->description;

        
        if($req->save()){
            return redirect('clientrequest');
        }
    }
    
    public function reviewrequest($id){
    $req= Req::find($id);
    if(isset($_GET['action'])){
        if($_GET['action']=='approve'){
            $req->status=2;
        } else if($_GET['action']=='return'){
            $item=Item::find($req->item_id);
            $item->status=2;
            if($item->save()){
                return redirect('admin/request');
            }
        } else {
            $req->status=0;
        }
        if($req->save()){
            return redirect('admin/request');
        }
    }
        
        return view('reviewrequest', compact('req'));
    }
    
    public function register(){
        return view ('register');
    }
    
    public function storeregister(Request $request){
        if(User::where('email', $request->email)->first()){
            return [
                'status' => 'error',
                'message' => 'E-mail address already existed.'
            ];
        }
        
        if($request->password != $request->password_confirm){
            return [
                'status' => 'error',
                'message' => 'The password confirmation is not the same as password.'
            ];
        }
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password_confirm);
        
        if($user->save()){
            $token= new UserToken;
            $token->user_id=$user->id;
            $token->token=md5(uniqid());
            
            if ($token->save()){
                Mail::to($user)->send(new ActivationMail($token));
                return [
                'status' => 'success',
                'message' => 'The user has been registered succesfully. Please check your email for verification link'
            ];    
            }
        }
    }
    
    public function checkuser(){
        $user=User::where('flag',1)->get();
    
        return view('checkuser', compact('user'));
    }
    
    public function deleteuser($id){
        $user=User::find($id);
        $user->flag=0;
        if($user->save()){
            return redirect('admin/checkuser');
        }
        
    }
    
    public function resetpassword(Request $request){
        $user=User::find($request->user_id);
        $user->password=Hash::make(123456);
        if($user->save()){
            return [
                'status' => 'success',
                'message' => 'The password has been reset'
            ];
        }
    }
    
    public function mailactivation(){
        if(isset($_GET['token'])){
            $token= UserToken::where('token',$_GET['token'])->first();
            if($token){
                $user=User::findorfail($token->user_id);
                if($user->email_verified_at!=null){
                    return 'this account has been activated';
                } else {
                    $user->email_verified_at=date('Y-m-d H:i:s');
                if($user->save()){
                    return view('mailactivation');
                }
                }  
            }
        }
    }
    
    public function forgotpass(){
        return view ('forgotpass');
    }
}
