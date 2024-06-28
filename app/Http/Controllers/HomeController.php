<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\LCategory;
use App\Models\Item;
use App\Models\Request as Req;
use Hash;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserToken;
use Mail;
use App\Mail\ActivationMail;
use App\Models\LLocation;
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
        $items=Item::where('flag',1)->get();
        $req=Req::where('flag',1)->where('status',2)->get();
        return view('admindashboard', compact('items','req'));
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
    
//    public function addcategory(){
//        return view('addcategory');
//    }
    
    public function storeCategory(Request $request){
        $category=LCategory::where('category',strtoupper($request->category))->first();
        if($category){
            if($category->flag == 1){
                return [
                    'status' => 'error',
                    'message' => 'Category already exist'
                ];
            } else {
                $category->flag = 1;
            }  
        } else {
            $category = isset($request->id) ? LCategory::findorfail($request->id) : new LCategory;
            $category->category=$request->category;
        }
        
        if($category->save()){
            return [
               'status' => 'success',
                'message' => 'Category has been saved'
            ];
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
        $location = LLocation::where('flag',1)->get();
        $category = LCategory::where('flag',1)->get();
        $admins = User::whereIn('role', [2,3])->get();
        return view('additem', compact('category','location', 'admins')); 
    }
    
    public function storeitem(Request $request){
        $item= isset($request->id) ? Item::findorfail($request->id) : new Item;
        if(isset($request->attachment)){
            if(in_array($request->attachment->extension(), ['png','jpg','jpeg','bmp','pdf'])){
                if($request->attachment->getSize()<3000000){
                    $attachment = uniqid().'.'.$request->attachment->extension();
                    $request->attachment->move(public_path('uploads'), $attachment);
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'Maximum file size is 3MB.'
                    ];
                }
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Only image files are allowed.'
                ];
            }
        } else{
            $attachment = $item->attachment;
        }
        $item->item=$request->itemname;
        $item->category_id=$request->category;
        $item->location_id=$request->location;
        $item->date_found=date('Y-m-d', strtotime($request->date));
        $item->description=$request->description;
        $item->color=$request->color;
        $item->serial_num=$request->serialnum;
        $item->user_id=Auth::user()->id;
        $item->receiver_id=$request->receiver_id;
        $item->attachment = $attachment;
        if($item->save()){
            return redirect('admin/item');
        }
    }
    
    public function reviewitem($id){
        $item= Item::find($id);
        $location = LLocation::where('flag',1)->get();
        $category=LCategory::where('flag',1)->get();
        $admins = User::whereIn('role', [2,3])->get();
        return view('reviewitem', compact('item','location','category','admins'));
    }
    
    public function reviewlostitem($id){
        $item= Item::find($id);
        return view('reviewlostitem', compact('item'));
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
        $location = LLocation::where('flag',1)->get();
        $category=LCategory::where('flag',1)->get();
        $admins = User::whereIn('role', [2,3])->get();
        return view('addreport', compact('category','location', 'admins'));
    }
    
    public function storereport(Request $request){
        $item= isset($request->id) ? Item::findorfail($request->id) : new Item;
        if(isset($request->attachment)){
            if(in_array($request->attachment->extension(), ['png','jpg','jpeg','bmp','pdf'])){
                if($request->attachment->getSize()<3000000){
                    $attachment = uniqid().'.'.$request->attachment->extension();
                    $request->attachment->move(public_path('uploads'), $attachment);
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'Maximum file size is 3MB.'
                    ];
                }
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Only image files are allowed.'
                ];
            }
        } else{
            $attachment = $item->attachment;
        }
        $item->item=$request->itemname;
        $item->category_id=$request->category;
        $item->location_id=$request->location;
        $item->date_found=date('Y-m-d', strtotime($request->date));
        $item->description=$request->description;
        $item->color=$request->color;
        $item->serial_num=$request->serialnum;
        $item->user_id=Auth::user()->id;
        $item->receiver_id=$request->receiver_id;
        $item->attachment=$attachment;
        if($item->save()){
            return redirect('clientreport');
        }
    }
    
    public function reviewreport($id){
        $item= Item::find($id);
        $location = LLocation::where('flag',1)->get();
        $category=LCategory::where('flag',1)->get();
        $admins = User::whereIn('role', [2,3])->get();
        return view('reviewreport', compact('item', 'category' , 'location' , 'admins'));
    }
    
    public function deletereport($id){
        $item=Item::find($id);
        $item->flag=0;
        if($item->save()){
            return redirect('clientreport');
        } 
    }
    
    public function lostitem(){
        $item=Item::where('flag',1)->where('status',1)->where('user_id','!=',Auth::user()->id)->whereNotIn('id',Req::where('user_id',Auth::user()->id)->pluck('item_id'))->get();
        return view ('lostitem', compact('item'));
    }
    
//    public function reviewlostitem($id){
//        $id= Item::find($id);
//        return view('reviewlostitem', compact('item'));
//    }
    
    public function adminrequest(){
        $req=Req::where('flag',1)->whereNotIn('item_id',Item::where('status',2)->pluck('id'))->get();
        return view('adminrequest', compact('req'));
    }
    
    public function clientrequest(){
        $req=Req::where('flag',1)->get();
        return view('clientrequest', compact('req'));
    }
    
//    public function addclientrequest(){
//        return view ('addclientrequest');
//    }

    public function requestitem($id){
        $item=Item::find($id);
        return view('requestitem', compact('item'));
    }
    
    public function storerequest(Request $request, $id){
        $req=new Req();
        $req->user_id=Auth::user()->id;
        $req->item_id=$id;
        $req->description=$request->description;
            if($req->save()){
                return redirect('clientrequest');
            }
    }
    
    public function viewrequest($id){
        $req=Req::find($id);
        return view('clientviewrequest', compact('req'));
    }
    
    public function deleterequest($id){
        $req=Req::find($id);
        $req->flag=0;
        if($req->save()){
            return redirect('clientrequest');
        } 
    }
    
    public function reviewrequest($id){
    $req=Req::find($id);
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
        $user->email_verified_at = date('Y-m-d H:i:s'); // Uncomment this to activate email.
        
        if($user->save()){
            $token= new UserToken;
            $token->user_id=$user->id;
            $token->token=md5(uniqid());
            
            if ($token->save()){
//                Mail::to($user)->send(new ActivationMail($token));
                return [
                'status' => 'success',
                'message' => 'The user has been registered succesfully.'
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
    
    public function changerole(Request $request){
        $user = User::findorfail($request->user_id);
        $user->role = $request->role_id;
        
        if($user->save()){
            return [
                'status' => 'success',
                'message' => 'The user role has been changed.'
            ];
        }
    }
    
    public function modalCategory(Request $request){
        $category = isset($request->id) ? LCategory::findorfail($request->id) : new LCategory;
        return view('modals.modal-category', compact('category'));
    }
    
    public function location(){
        $location= LLocation::where('flag',1)->get();
        return view('location', compact('location'));
    }
    
    public function storeLocation(Request $request){
        $location=LLocation::where('location',strtoupper($request->location))->first();
        if($location){
            if($location->flag == 1){
                return [
                    'status' => 'error',
                    'message' => 'Location is already exist'
                ];
            } else {
                $location->flag = 1;
            }  
        } else {
            $location = isset($request->id) ? Llocation::findorfail($request->id) : new LLocation;
            $location->location=$request->location;
        }
        
        if($location->save()){
            return [
                'status' => 'success',
                'message' => 'Location has been saved'
            ];
        } 
    }
    
    public function modalLocation(Request $request){
        $location = isset($request->id) ? LLocation::findorfail($request->id) : new LLocation;
        return view('modals.modal-location', compact('location'));
    }
    
    public function deletelocation($id){
        $location=LLocation::find($id);
        $location->flag=0;
        if($location->save()){
            return redirect('admin/setting/location');
        }
    }
    
//    public function modalProfile(Request $request){
//        $user = User::findorfail($request->id);
//        return view('modals.modal-profile', compact('user'));
//    }

    public function storeProfile(Request $request){
        $user = User::findorfail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($user->save()){
            $details = UserDetail::where('user_id', auth()->user()->id)->first() ?? new UserDetail;
            $details->idnum = $request->idnum;
            $details->address = $request->address;
            $details->tel_num = $request->tel_num;
            $details->user_id = $user->id;
            
            if($details->save()){
                return [
                    'status' => 'success',
                    'message' => 'Profile has been saved'
                ];
            }
        } 
    }
    
    public function profile(){
        return view ('profile');
    }
    
    public function addprofile(){
        return view('addprofile');
    }
    
    public function deleteprofile(){
        return view('deleteprofile');
    }
}
