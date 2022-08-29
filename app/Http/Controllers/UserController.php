<?php

namespace App\Http\Controllers;
use App\Models\Sportevent;
use App\Models\Blacklist;
use App\Models\Participant;
use App\Models\Announcement;
use App\Models\Videolink;
use App\Models\College;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Profile(){
        $collegeid = Auth::user()->CollegeId;
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $count=count($participants);
        return view('User.profile',compact('count','college'));
    }

    public function updatecoordinator($id,$name){
    
        $data = User::where('id',$id)->get();
    
        if($name == 'Student'){
            $college =  College::all();
            $default_college =DB::select('select id,name from colleges where id in (select CollegeId from users where id = ? ) ',[$id]);
    
        }else if ($name =='Coordinator'){
            $college =  DB::select('select * from colleges where id not in (select CollegeId from users  where user_type ="coordinator" )');  
            $default_college =DB::select('select id,name from colleges where id in (select CollegeId from users where id = ? ) ',[$id]);
        }else{
            $college = '';
            $default_college ='';
        }
      
        $collegeid = Auth::user()->CollegeId;
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $count=count($participants);
    
        return view('User.action.edit',compact('data','name','college','default_college','count','college'));
    }

    
public function update_coordinator(Request $request){
    $id = $request->input('id');
    $pass = $request->input('password');
    $usertype =$request->input('usertype');
    if($pass == ''){
     User::where('id',$id)->update([
         'name' => $request->input('name'),
         'email' => $request->input('email'),
         'address'=> $request->input('address'),
         'contactno'=> $request->input('contactno'), 
         'CollegeId' => $request -> input('college'),
         ]);
    }else {

    User::where('id',$id)->update([
     'name' => $request->input('name'),
     'email' => $request->input('email'),
     'address'=> $request->input('address'),
     'contactno'=> $request->input('contactno'),
     'CollegeId' => $request -> input('college'),
     'password' => Hash::make($request->input('password')),
     ]);
    }

    if($usertype =='student'){
        return redirect(route('admin.students'))->with('Success','Account Updated Successfully!');
    
    }else if($usertype =='coordinator'){
    
        return redirect(route('coordinator.coordinators'))->with('Success','Account Updated Successfully!');
    
    }else {
        return redirect(route('user.profile'))->with('Success','Account Updated Successfully!');
    
    }
    

   
}
    public function dashboard(){
        $id = Auth::user()->CollegeId;
        $userid = Auth::user()->id;
        $announcement = Announcement::where('CollegeId',$id)->orderBy('date_added','desc')->get();
        $sport = DB::select('select * from sportevents where id in (select sports_id from participants where user_id ='.$userid.' and isverified = 2 )');

        $events = Sportevent::all();
        return view('User.dashboard',compact('announcement','sport','events'));
    }

    public function join(){
        $collegeid = Auth::user()->CollegeId;
        $userid = Auth::user()->id;
        $blacklist =DB::select('select * from sportevents where CollegeId = '.$collegeid.' and id  in (select sports_id from blacklists where user_id ='.$userid.' ) ');
        $event = DB::select('select * from sportevents where  id not in (select sports_id from blacklists where user_id ='.$userid.' ) and id not in (select sports_id from participants where user_id = '.$userid.' ) ');

        $joinedevent = DB::select('select * from sportevents where id in (select sports_id from participants where user_id = '.$userid.' and isverified in (0,1,2) ) ');

        $isverified = DB::select('select * from participants where user_id = '.$userid.' and isverified in (0,1,2) ');

        return view('User.join',compact('event','blacklist','joinedevent','isverified'));
    }

    public function about(){
        return view('User.about'); 
    }


    public function join_event($id,$name){
        $eventdata = Sportevent::where('id',$id)->get();
        return view('User.action.joinevent',compact('name','eventdata','id'));
    }

    public function join_sportevent(Request $request){
        if($request->file('files')){
            $files = $request->file('files');

            foreach ($files as $key => $value) {
            $imageName = $value->getClientOriginalName ();
               //$imageName =time().$key.'.'.$value->getClientOriginalExtension();
                $all[]=$imageName;
             $value->move(public_path('assets/img'), $imageName);

             
               
            }
          $allfiles =  implode(',',$all);
          $sportsid = $request->input('id');

          Participant::create([
            'sports_id' => $sportsid,
           'user_id'=> Auth::user()->id,
           'CollegeId' => Auth::user()->CollegeId,
           'date_added'=>now(),
           'submitted_req'=>$allfiles,
           'isverified'=>0,
           'status'=>0,
                    ]);  
    
           
           return redirect()->route('user.join');
        }

    }

    public function delete_participants($id){
        $user = Auth::user()->id;
     
       $files =  Participant::where('sports_id',$id)->where('user_id',$user)->get();

       try {
        foreach ($files as $key => $value) {
            $allfiles = $value->submitted_req;
             }
      
            $unsetfiles =  explode(',',$allfiles);
      
            foreach ($unsetfiles as $key => $value) {
             $link = public_path('assets/img/').$value;
             unlink($link);
             
            }
       } catch (\Throwable $th) {
       
       }
    
      Participant::where('sports_id',$id)->where('user_id',$user)->delete();
       
        return redirect()->back()->with('Success','Deleted Successfully!'); 
    }

    public function stream(){
        $videos = Videolink::all();
        $sport = Sportevent::all();
        $college= College::all();
        return view('User.stream',compact('videos','sport','college'));
    }
}
