<?php

namespace App\Http\Controllers;
use App\Models\College;
use App\Models\Announcement;
use App\Models\Participant;
use App\Models\Sportevent;
use App\Models\User;
use App\Models\Blacklist;
use App\Models\Videolink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class CoordinatorCOntroller extends Controller
{   
    public function Profile(){
        $collegeid = Auth::user()->CollegeId;
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get();  
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $count=count($participants);
        return view('Coordinator.profile',compact('count','college'));
    }

    public function updatecoordinator($id,$name){
    
        $data = User::where('id',$id)->get();
    
        if($name == 'Student'){
            $college = College::all();
            $default_college =DB::select('select id,name from colleges where id in (select CollegeId from users where id = ? )  ',[$id]);
    
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
    
        return view('Coordinator.action.edit',compact('data','name','college','default_college','count','college'));
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
        return redirect(route('Admin.students'))->with('Success','Account Updated Successfully!');
    
    }else if($usertype =='coordinator'){
    
        return redirect(route('coordinator.coordinators'))->with('Success','Account Updated Successfully!');
    
    }else {
        return redirect(route('coordinator.profile'))->with('Success','Account Updated Successfully!');
    
    }
    

   
}
    public function dashboard(){
        $collegeid = Auth::user()->CollegeId;
     
        $coordinator = User::where('user_type','ecoordinator')->get();
        $students = User::where('user_type','student')->where('CollegeId',$collegeid)->get();
    
        $sport = Sportevent::where('CollegeId',$collegeid)->get();
        $allparticipants = DB::select('select * from users where id in (select user_id from participants where CollegeId='.$collegeid.' and batch ='.session()->get('batch').' )');

        $nop = DB::select('select sports_id,COUNT(sports_id) as nop from participants where batch ='.session()->get('batch').' group by sports_id ');

        $collegewevent = DB::select('select * from colleges where id in (select CollegeId from participants)  ');

        $vlinks = Videolink::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();
        $pts = Participant::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();

      
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 
     
        
       
        $college = College::where('id',Auth::user()->CollegeId)->get();
       
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get();  

        $count=count($participants);
        
       return view('Coordinator.dashboard',compact('college','count','coordinator','students','user','sport','participants','collegewevent','allparticipants','vlinks','pts','nop'));  
    }
    public function announcement(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

        $count=count($participants);
        $announcement = Announcement::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get()->SortByDesc('date_added');
        $counts = count($announcement);
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.announcement',compact('college','announcement','count','counts'));
    }
   /*  public function media(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $count=count($participants);
        $sportsdata = Sportevent::where('CollegeId',$collegeid)->get();
        
        $video = Videolink::all();

        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

       
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.media',compact('college','count','college','sportsdata','video'));
    } */



    public function participants(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('batch',session()->get('batch'));  

        $user =DB::select('select * from users where id in (select user_id from participants where batch ='.session()->get('batch').' and  isverified = 2  or isverified=1  ) and CollegeId = '.$collegeid.' '); 

        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
        $count=count($counting_participants);
       

        $sportevent= Sportevent::where('batch',session()->get('batch')); 
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.participants',compact('college','participants','user','sportevent','count'));
    }





    public function newparticipants(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
        $count=count($counting_participants);
       
        $participants = Participant::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 
       
        $sportevent= Sportevent::where('batch',session()->get('batch')); 
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.newparticipants',compact('college','participants','user','sportevent','count'));
    }

    

    public function add_announcement(Request $request){


       Announcement::create([
        'announcement' => $request->input('announce'),
        'CollegeId' => Auth::user()->CollegeId,
        'sports_id'=>0,
        'date_added' => now(),
        'batch'=>session()->get('batch')
       ]);

       return redirect()->back()->with('Success','Announcement Posted Successfully!');

    }


    public function delete_announcement($id){
       Announcement::where('id',$id)->delete();
       return redirect()->back()->with('Success','Announcement Deleted Successfully!');
    }

    public function update_announcement(Request $request){
     $id = $request->input('aid');

     Announcement::where('id',$id)->update([
            'announcement' => $request->input('e_announce'),
        ]);
       return redirect()->back()->with('Success','Announcement Updated Successfully!'); 
    }






 
    public function students(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();  

        $user =DB::select('select * from users where id in (select user_id from participants where batch = '.session()->get('batch').' and  isverified = 2  or isverified=1  ) and CollegeId = '.$collegeid.' '); 

        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
        $count=count($counting_participants);
       

        $sportevent= Sportevent::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get(); 
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $data = User::where('CollegeId',$collegeid)->get();
       
        return view('Coordinator.students',compact('college','participants','user','sportevent','count','data'));


    }
  

    public function verify($id){
        Participant::where('id',$id)->update([
            'isverified'=>1,
        ]);

        return redirect('Coordinator/New/Participants')->with('Success','Verified Successfully!'); 

    }

    public function delete_participants($id){

        $files =  Participant::where('id',$id)->get();

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
     
        Participant::where('id',$id)->delete();

        return redirect()->back()->with('Success','Deleted Successfully!'); 
    }

    public function add_participants(){
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
        $count=count($counting_participants);
      $college = College::where('id',Auth::user()->CollegeId)->get();
      $sportsdata = Sportevent::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();
      $data = User::where('CollegeId',$collegeid)->where('user_type','student')->get();
    
      $nop = DB::select('select sports_id,COUNT(sports_id) as nop from participants where batch ='.session()->get('batch').' group by sports_id');
    
        return view('Coordinator.action.add_partcipants',compact('college','count','data','sportsdata','nop'));
    }

    public function addParticipants(Request $request){
       
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
          $count=count($counting_participants);
          $college = College::where('id',Auth::user()->CollegeId)->get();
          $sportsdata = Sportevent::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();
          $sportevent =  $request->input('sportsevent');
        
          $data = DB::select('select * from users where id not in (select user_id from participants where sports_id='.$sportevent.' and CollegeId ='.$collegeid.' and user_type="student" and batch ='.session()->get('batch').') and id not in (select user_id from blacklists where sports_id='.$sportevent.' and batch ='.session()->get('batch').') and CollegeId = '.$collegeid.'');
        $selected = $request->input('selected_ids');

        $sportevent =  $request->input('sportsevent');
        $eventname = DB::select('select name,nop from sportevents where id ='.$sportevent.' and batch = '.session()->get('batch').' ');
 
        $numofparticipants = DB::select('select * from participants where sports_id ='.$sportevent.' and batch ='.session()->get('batch').' ');

        foreach ($eventname as $key => $value) {
            $ename= $value->name;
            $maxparticipants = $value->nop; 
           }
    
           $available_slots = $maxparticipants - count($numofparticipants);
        
           
            if($sportevent){
      
                if($selected){
                
                    foreach ($selected as $key => $value) {
                       
                       
                        Participant::create([
                'sports_id' => $sportevent,
               'user_id'=> $value,
               'CollegeId' => Auth::user()->CollegeId,
               'date_added'=>now(),
               'submitted_req'=>'',
               'isverified'=>1,
               'status'=>0,
               'batch'=>session()->get('batch')
                        ]); 
        
                        }
                        return redirect()->route('coordinator.participants')->with('Success','Participants Added Successfully!');  
                   }else {
              
                    return view('coordinator.action.add_participants2',compact('data','college','count','sportevent','ename','available_slots'));
                  
                 
                 
                   } 
        
               }else {
               return redirect()->back()->with('Error','Please Select Sports/Events.');
               echo 'please select sport';
               }  

        

    
    }

    public function blacklist(){
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
        $count=count($counting_participants);
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $sports = Sportevent::where('batch',session()->get('batch'));

        $data = User::all();

        $blacklisted = Blacklist::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();

        return view('Coordinator.blacklist',compact('college','count','data','sports','blacklisted'));
    }

    public function addblacklist($id,$name){
       
      $collegeid = Auth::user()->CollegeId;
        $data = DB::select('select * from users where id not in (select user_id from blacklists where sports_id ='.$id.' and batch='.session()->get('batch').') and id not in (select user_id from participants where sports_id ='.$id.' and batch ='.session()->get('batch').') and CollegeId='.$collegeid.' ');
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
        $count=count($counting_participants);
        $college = College::where('id',Auth::user()->CollegeId)->get();

        return view('Coordinator.action.add_blacklist',compact('college','id','data','count','name')); 

    }

    public function addlist_blacklist(Request $request){
        $event = $request->input('event');
        $select = $request->input('selected_ids');
        $collegeid = Auth::user()->CollegeId;
        foreach ($select as $key => $value) {
        
          Blacklist::create([
            'sports_id'=>$event,
            'user_id'=>$value,
            'CollegeId'=>$collegeid,
            'batch'=>session()->get('batch')
          ]);
        }
       

        return redirect()->route('coordinator.blacklist');
    }

    public function removefrom_blacklist($id,$event){
        Blacklist::where('sports_id',$event)->where('user_id',$id)->delete();
        return redirect()->route('coordinator.blacklist');
    }
    
    public function addvideolinks($id,$name){
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
        $count=count($counting_participants);
        $college = College::where('id',Auth::user()->CollegeId)->get();

        $videos = Videolink::where('event',$id)->where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();

    
        return view('coordinator.action.addvideolinks',compact('college','count','name','videos','id'));
    }

    public function savelink(Request $request){
     
        $eventid = $request->event;
        $collegeid = Auth::user()->CollegeId;
        $event = Videolink::where('event',$eventid)->where('batch',session()->get('batch'))->get();

        if(count($event)>=1){
            Videolink::where('event',$eventid)->update([

                'video' => $request->link,
                'videotype' => $request->vtype,
            
            ]);

        }else{
            Videolink::create([

                'video' => $request->link,
                'videotype' => $request->vtype,
                'priority' =>0,
                'event' => $eventid,
                'CollegeId'=>$collegeid,
                'date_added'=>now(),
                'batch'=>session()->get('batch')
            
            ]);

        }


      /*   Videolink::where('id',1)->update([
        'video' => $request->link,
        'videotype' => $request->vtype,
    
    ]);  */
    }


    
    public function firslogin(Request $request){
        $id = Auth::user()->id;

        User::where('id',$id)->update([
            'fl'=>1,
            'password'=>Hash::make($request->newpass),
        ]);
       
    }



}
