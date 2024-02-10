<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $auth_user = Auth::user();
       if($auth_user->status != 'guest'){
        $users = User::get();        
        return view('home', compact('users'));
         }
         else{
            return view('welcome');
         }
    }

    public function updateUserAvailability(Request $request){
        try{
            
            $id=$request->id;
            $status = $request->status;
    
            $is_active="0";
    
            if($status == "true" ){
                $is_active="1";
            }else{
                $is_active="0";
            }
         
           $user = User::where('id',$id)->update(array('is_active'=>$is_active));
           return response()->json($user);
     
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
