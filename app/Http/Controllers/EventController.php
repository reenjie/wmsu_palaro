<?php

namespace App\Http\Controllers;
use App\Models\College;
use App\Models\Announcement;
use App\Models\Participant;
use App\Models\Sportevent;
use App\Models\User;
use App\Models\Blacklist;
use App\Models\Videolink;
use App\Models\Carousel;
use App\Models\Team;
use App\Models\Game;
use App\Models\Tally;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{

    public function Profile(){
        $sportsid = Auth::user()->sports_id;
     //  
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $college = College::all();

          $eventname = DB::select('select name,nop from sportevents where id ='.$sportsid.' and batch ='.session()->get('batch').'  ');
 
        $collegeid = Auth::user()->CollegeId;
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get();  
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $count=count($participants);
        return view('Event.profile',compact('count','college','myevent'));
    }

    public function updatecoordinator($id,$name){
        $sportsid = Auth::user()->sports_id;
     //  
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $college = College::all();

          $eventname = DB::select('select name,nop from sportevents where id ='.$sportsid.'  and batch = '.session()->get('batch').' ');
 
        $data = User::where('id',$id)->get();
    
        if($name == 'Student'){
            $college =  College::all();
            $default_college =DB::select('select id,name from colleges where id in (select CollegeId from users where id = ? )  ',[$id]);
    
        }else if ($name =='Coordinator'){
            $college =  DB::select('select * from colleges where id not in (select CollegeId from users  where user_type ="coordinator" ) ');  
            $default_college =DB::select('select id,name from colleges where id in (select CollegeId from users where id = ? ) ',[$id]);
        }else{
            $college = '';
            $default_college ='';
        }
      
        $collegeid = Auth::user()->CollegeId;
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get();  
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $count=count($participants);
    
        return view('Event.action.edit',compact('data','name','college','default_college','count','college','myevent'));
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
        return redirect(route('e.profile'))->with('Success','Account Updated Successfully!');
    
    }
    

   
}

    public function dashboard(){
        $sportsid = Auth::user()->sports_id;
     //  
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $college = College::all();

          $eventname = DB::select('select name,nop from sportevents where id ='.$sportsid.'  and batch = '.session()->get('batch').' ');
 
        $numofparticipants = DB::select('select * from participants where sports_id ='.$sportsid.' and isverified = 2 and batch ='.session()->get('batch').'');

        foreach ($eventname as $key => $value) {
            $ename= $value->name;
            $maxparticipants = $value->nop; 
           }
    
           $available_slots = $maxparticipants - count($numofparticipants);
        
           


        $coordinator = User::where('user_type','ecoordinator')->get();
     /*    $students = User::where('user_type','student')->where('CollegeId',$collegeid)->get();
     */
        $sport = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $allparticipants = DB::select('select * from users where id in (select user_id from participants where  sports_id ='.$sportsid.' and batch ='.session()->get('batch').')');

        $nop = DB::select('select sports_id,COUNT(sports_id) as nop from participants where batch ='.session()->get('batch').'  group by sports_id ');

        $collegewevent = DB::select('select * from colleges where id in (select CollegeId from participants) ');

          
        $participants =  DB::select('select * from participants where sports_id = '.$sportsid.' and isverified in (0,1) and batch ='.session()->get('batch').';');
       

        $user = User::where('user_type','student')->get(); 

      /*   $vlinks = Videolink::where('CollegeId',$collegeid)->get();
        $pts = Participant::where('CollegeId',$collegeid)->get();

        
    
     
      
  
        
       
         */
        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->where('batch',session()->get('batch'))->get();
        $count=count($kunta);
        $sportevent= Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get(); 


     

        $team = Team::where('sports_id',$sportsid)->where('batch',session()->get('batch'))->get();

      return view('Event.dashboard',compact('myevent','coordinator','sport','allparticipants','nop','participants','user','college','sportevent','count','available_slots','team'));
    }

    public function announcement(){
        $sportsid = Auth::user()->sports_id;
        $collegeid = Auth::user()->CollegeId;
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();


      
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->where('batch',session()->get('batch'))->get();
        $count=count($kunta);
        $announcement = Announcement::where('sports_id',$sportsid)->where('batch',session()->get('batch'))->get()->SortByDesc('date_added');
        $counts = count($announcement);
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Event.announcement',compact('college','announcement','count','counts','myevent','college'));
    }

    public function add_announcement(Request $request){


        Announcement::create([
         'announcement' => $request->input('announce'),
         'CollegeId' => Auth::user()->CollegeId,
         'sports_id'=>Auth::user()->sports_id,
         'date_added' => now(),
         'batch'=>session()->get('batch')
        ]);
 
        return redirect()->back()->with('Success','Announcement Posted Successfully!');
 
     }

     public function update_announcement(Request $request){
        $id = $request->input('aid');
   
        Announcement::where('id',$id)->update([
               'announcement' => $request->input('e_announce'),
           ]);
          return redirect()->back()->with('Success','Announcement Updated Successfully!'); 
       }

       public function delete_announcement($id){
        Announcement::where('id',$id)->delete();
        return redirect()->back()->with('Success','Announcement Deleted Successfully!');
     }

     public function media(){
        $sportsid = Auth::user()->sports_id;
        $collegeid = Auth::user()->CollegeId;
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->batch('batch',session()->get('batch'))->get();
        $count=count($kunta);
        $videos = Videolink::where('event',$sportsid)->where('batch',session()->get('batch'))->get();
        return view('Event.media',compact('videos','college','myevent','count'));
    }

    public function savelink(Request $request){

        $check = Videolink::where('event',Auth::user()->sports_id)->where('batch',session()->get('batch'))->get();

        if(count($check)>=1){
            Videolink::where('event',Auth::user()->sports_id)->update([
                'video' => $request->link,
                'videotype' => $request->vtype,
            
            ]); 
        }else{
          Videolink::create([
            'video'=>$request->link,
            'videotype'=>$request->vtype,
            'priority'=>0,
            'event' =>Auth::user()->sports_id,
            'CollegeId'=> Auth::user()->CollegeId,
            'date_added'=>now(),
            'batch'=>session()->get('batch')
          ]);
        }
    
      
    }

    public function sportevents(){
        $sportsid = Auth::user()->sports_id;
        $collegeid = Auth::user()->CollegeId;
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->where('batch',session()->get('batch'))->get();
        $count=count($kunta);

        return view('Event.sportevents',compact('college','myevent','count'));
    }

    public function updateevent(Request $request){
        $id = $request->id;
        $name = $request->name;
        $val = $request->newval;

        Sportevent::where('id',$id)->update([
            $name => $val,
        ]);


    }
    
    public function savelogo(Request $request){
      //  dd($request);
     
         $id = $request->input('id');
        $checkfile =Sportevent::where('id',$id)->get();
        try {
            foreach($checkfile as $row){
               
                $myfile = public_path('assets/img/' . $row->file);
                unlink($myfile);
               
            }

        } catch (\Throwable $th) {
            //throw $th;
        }
           
        if($request->file('imgfile')){
         $imageName =$request->file('imgfile')->getClientOriginalName();
            $request->file('imgfile')->move(public_path('assets/img'), $imageName);

            Sportevent::where('id',$id)->update([
                'file'=> $imageName,
            ]);

          }
          return redirect()->back()->with('Success','Announcement Updated Successfully!'); 
    }

    public function participants(){
        $sportsid = Auth::user()->sports_id;
        $collegeid = Auth::user()->CollegeId;
        $college =College::all();
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('sports_id',$sportsid)->where('batch',session()->get('batch'))->get(); 
       
        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->where('batch',session()->get('batch'))->get();
        $count=count($kunta);


        $team = Team::where('sports_id',$sportsid)->where('batch',session()->get('batch'))->get();
        $eventname = DB::select('select name,nop from sportevents where id ='.$sportsid.'  and batch='.session()->get('batch').' ');
 
        // $numofparticipants = DB::select('select * from participants where sports_id ='.$sportsid.' and isverified=2');

        
        $numofparticipants = DB::select('select * from teams where id in (select team from participants where sports_id = '.$sportsid.' and isverified=2 and batch ='.session()->get('batch').' ) and batch = '.session()->get('batch').'');

        foreach ($eventname as $key => $value) {
            $ename= $value->name;
            $maxparticipants = $value->nop; 
           }
    
           $available_slots = $maxparticipants - count($numofparticipants);
          
        $participants = Participant::where('sports_id',$sportsid)->where('batch',session()->get('batch'))->get(); 

        $sportevent= Sportevent::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get(); 
       
       
        $user =DB::select('select * from users where id in (select user_id from participants where  isverified = 2 and sports_id ='.$sportsid.' and batch = '.session()->get('batch').' )  '); 
        $allteam = Team::where('sports_id',$sportsid)->get();
        return view('Event.participants',compact('college','myevent','count','user','participants','sportevent','available_slots','team','allteam'));
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
 /*    public function add_participants(){
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
        $count=count($counting_participants);
      $college = College::where('id',Auth::user()->CollegeId)->get();
      $sportsdata = Sportevent::where('CollegeId',$collegeid)->get();
      $data = User::where('CollegeId',$collegeid)->where('user_type','student')->get();
    
      $nop = DB::select('select sports_id,COUNT(sports_id) as nop from participants group by sports_id');
    
        return view('Event.action.add_partcipants',compact('college','count','data','sportsdata','nop'));
    } */

    public function addParticipants(Request $request){
 
        $collegeid = Auth::user()->CollegeId;
        $sportsid = Auth::user()->sports_id;
        $team = $request->input('team');
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();

        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 

          $count=count($counting_participants);

          $college = College::all();

          $sportsdata = Sportevent::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();

          $sportevent = Auth::user()->sports_id;
        
          $data = DB::select('select * from users where id not in (select user_id from participants where sports_id='.$sportevent.' and team != null or team != ""  and batch ='.session()->get('batch').') and id not in (select user_id from blacklists where sports_id='.$sportevent.' and batch ='.session()->get('batch').' ) and user_type="student" ');

        $selected = $request->input('selected_ids');

        $eventname = DB::select('select name,nop from sportevents where id ='.$sportevent.' and batch ='.session()->get('batch').'  ');
 
        // $numofparticipants = DB::select('select * from participants where sports_id ='.$sportevent.' and isverified = 2');

        $numofparticipants = DB::select('select * from teams where batch ='.session()->get('batch').' and  id in (select team from participants where sports_id = '.$sportevent.' and isverified = 2  and batch ='.session()->get('batch').')');


        
        foreach ($eventname as $key => $value) {
            $ename= $value->name;
            $maxparticipants = $value->nop; 
           }
          
        
           $available_slots = $maxparticipants - count($numofparticipants);

           if($available_slots >=1){
            $allteam = Team::where('sports_id',$sportsid)->where('batch',session()->get('batch'))->get();
           }else {
            $allteam = DB::select('select * from teams where id in (SELECT team FROM `participants` where sports_id='.$sportsid.' and batch ='.session()->get('batch').') and batch ='.session()->get('batch').'');
           }
         
            if($sportevent){
      
                if($selected){

                   $userselection =  count($selected);
                   $existingP = DB::select('select * from participants where team ='.$team.' and sports_id ='.$sportsid.' and batch ='.session()->get('batch').' ');

                   $totalEntry = count($existingP) + $userselection;

                   $defaultcount = Team::findorFail($team)->maxcount;

                    $teamname =Team::findorFail($team)->name;
                   /* Check if the team matches the maximum participant counts */
                    echo $defaultcount.' => '.$totalEntry;
                   if($totalEntry > $defaultcount){
                    //maximum limit reached
                    echo 'Maximum limit reached';
                    return redirect()->back()->with('error','Maximum limit has been reached. Team :'.$teamname.' | Maximum Participants Allowed : '.$defaultcount.' | Existing Participants and Selection Total : '.$totalEntry);
                   }else if($totalEntry <= $defaultcount){

                    foreach ($selected as $key => $value) {
                      
                        //Validate first.  if user already exist in a team
                       $validating =  Participant::where('user_id',$value)->where('team',null)->where('sports_id',$sportevent)->where('batch',session()->get('batch'))->get();

                       if(count($validating) >= 1){
                    
                        $ppid = $validating[0]['id'];
                        Participant::where('id',$ppid)->update([
                            'team'=>$team,
                        ]);
                       }else {
                  Participant::create([
                'sports_id' => $sportevent,
               'user_id'=> $value,
               'CollegeId' => Auth::user()->CollegeId,
               'date_added'=>now(),
               'submitted_req'=>'',
               'isverified'=>2,
               'team'=>$team,
               'status'=>0,
               'batch'=>session()->get('batch')
                        ]); 
                       }

                       
           
        
                        }
                      return redirect()->route('e.participants')->with('Success','Participants Added Successfully!');  

                   }
                
            
                   }else {
              
         return view('Event.action.add_participants',compact('data','college','count','sportevent','ename','available_slots','myevent','allteam'));
                  
                 
                 
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
        $data = User::all();

        $sportsid = Auth::user()->sports_id;
     

      
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();


        $blacklisted = Blacklist::where('CollegeId',$collegeid)->where('batch',session()->get('batch'))->get();

        return view('Event.blacklist',compact('college','count','data','blacklisted','myevent'));
    }

    public function addblacklist($id,$name){
        $sportsid = Auth::user()->sports_id;
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $collegeid = Auth::user()->CollegeId;

          $data = DB::select('select * from users where id not in (select user_id from blacklists where sports_id ='.$id.' and batch ='.session()->get('batch').') and id not in (select user_id from participants where sports_id ='.$id.' and batch ='.session()->get('batch').')  ');

          $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('batch',session()->get('batch'))->get(); 
          $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->where('batch',session()->get('batch'))->get();
        $count=count($kunta);
          $college = College::all();
  
          return view('Event.action.add_blacklist',compact('college','id','data','count','name','myevent')); 
  
      }

      public function removefrom_blacklist($id,$event){
        Blacklist::where('sports_id',$event)->where('user_id',$id)->delete();
        return redirect()->route('e.blacklist');
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
       

        return redirect()->route('e.blacklist');
    }

    public function verify($id){
        Participant::where('id',$id)->update([
            'isverified'=>2,
        ]);

        return redirect()->route('e.dashboard')->with('Success','Verified Successfully!'); 

    }

    public function homepage(){
        $sportsid = Auth::user()->sports_id;
        $collegeid = Auth::user()->CollegeId;
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $myevent = Sportevent::where('id',$sportsid)->where('batch',session()->get('batch'))->get();
        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->where('batch',session()->get('batch'))->get();
        $count=count($kunta);
        $data = Carousel::where('sports_id',$sportsid)->where('batch',session()->get('batch'))->get();

        return view('Event.homepage',compact('myevent','college','data','count'));
    }

    
    public function storeimage(Request $request){

      
        $typeof_action = $request->input('action');
        $sportsid = Auth::user()->sports_id;
      
       
      if($typeof_action == 'add'){

         if($request->file('imgfile')){
             $imageName = time().'.'.$request->file('imgfile')->getClientOriginalExtension();
             $request->file('imgfile')->move(public_path('assets/img'), $imageName);
               
             $check = Carousel::where('isactive',1)->where('sports_id',$sportsid)->get();

             if(count($check)>=1){
                Carousel::create([
                    'images' => $imageName,
                    'priority' => 0,
                    'sports_id'=> $sportsid,
                    'isactive'=>0,
                    'date_added' => now(),
                ]);
             }else {
                Carousel::create([
                    'images' => $imageName,
                    'priority' => 0,
                    'sports_id'=> $sportsid,
                    'isactive'=>1,
                    'date_added' => now(),
                    'batch'=>session()->get('batch')
                ]);
             }
         
     
           }
     
           return redirect(route('e.homepage'))->with('Success_image','Carousel Image Added Successfully!'); 
     
         
      }else if($typeof_action == 'change'){
         $id = $request->input('id');
         $carousel_image = Carousel::findorFail($id);
         $image_path =   public_path('assets/img/' . $carousel_image->images);
 
         if(file_exists($image_path)){
            unlink($image_path);
          }
 
          if($request->file('imgfile')){
             $imageName = time().'.'.$request->file('imgfile')->getClientOriginalExtension();
             $request->file('imgfile')->move(public_path('assets/img'), $imageName);
             Carousel::where('id',$id)->update([
                 'images' => $imageName,
             ]);
     
           }
 
           return redirect(route('e.homepage'))->with('Success_image','Carousel Image Updated Successfully!');  
     
          
       
 
      } 
  
 
 
 
      
     }
     public function removeimage($id,$img){
        $carousel_image = Carousel::findOrFail($id);
        $image_path =   public_path('assets/img/' . $carousel_image->images);
        
        if(file_exists($image_path)){
         unlink($image_path);
        }

       $carousel_image->delete();
       return redirect(route('e.homepage'))->with('Success_image','Carousel Image Removed Successfully!');

    }

    public function removeallimage(){
        $sportsid = Auth::user()->sports_id;
        $carousel = Carousel::where('sports_id',$sportsid)->where('batch',session()->get('batch'))->get();
        try {
            foreach($carousel as $img){
        
                $link = public_path('assets/img/' . $img->images);
    
                unlink($link);
              
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
     

        Carousel::where('sports_id',$sportsid)->where('batch',session()->get('batch'))->delete();
        return redirect(route('e.homepage'))->with('Success_image','Carousel Image Removed Successfully!');

    }

    public function team(){
        $sportsid = Auth::user()->sports_id;
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $myevent = Sportevent::where('id',$sportsid)->get();
        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->get();
        $count=count($kunta);
        $data = Carousel::where('sports_id',$sportsid)->get();

        $allteam = Team::where('sports_id',$sportsid)->get()->SortByDesc('id');;
        $pt = Participant::where('sports_id',$sportsid)->where('isverified',2)->get();
        $user = User::all();
        
        $delete = DB::select('select * from teams where id not in (select team from participants where sports_id ='.$sportsid.' and batch = '.session()->get('batch').') and batch = '.session()->get('batch').' ');
        return view('Event.team',compact('myevent','college','data','count','allteam','pt','user','delete'));
    }

    public function savenewteam(Request $request){
        $sportsid = Auth::user()->sports_id;
        Team::create([
            'sports_id'=>$sportsid,
            'name'=>$request->input('teamname'),
            'status'=>0,
            'maxcount'=>$request->input('max'),
            'result'=>0,
        ]);
        
        return redirect(route('e.team'))->with('Success','Added Successfully!');
        
    }

    public function move(Request $request){
        $moveto = $request->moveto;
        $id =$request->id;
        $sportevent = Auth::user()->sports_id;

        $existingP = DB::select('select * from participants where team ='.$moveto.' and sports_id ='.$sportevent.' and batch = '.session()->get('batch').' ');

        $defaultcount = Team::findorFail($moveto)->maxcount;
        $totalEntry = count($existingP) + 1;
       
        if($totalEntry <= $defaultcount){
            //echo 'can add';

        Participant::where('id',$id)->update([
            'team'=>$moveto,
        ]);

        return redirect(route('e.team'))->with('Success','Moved Successfully!');
        }else if($totalEntry > $defaultcount){
           // echo 'false';

       return redirect(route('e.team'))->with('error','Moving Failed. Maximum limit has been reached!');
        }

    
        // 
    }

    public function deleteteam(Request $request){
        $id =$request->id;
        Team::where('id',$id)->delete(); 
        return redirect(route('e.team'))->with('Success','Team Deleted Successfully!');
    }

    public function sortby(Request $request){
        $id = $request->id;
        $name = $request->name;

        $sportsid = Auth::user()->sports_id;
        $collegeid = Auth::user()->CollegeId;
        $college = College::all();
        $myevent = Sportevent::where('id',$sportsid)->get();
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('sports_id',$sportsid)->get(); 
       
        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->get();
        $count=count($kunta);


        $team = Team::where('sports_id',$sportsid)->get();
        $eventname = DB::select('select name,nop from sportevents where id ='.$sportsid.' ');
 
        $numofparticipants = DB::select('select * from participants where sports_id ='.$sportsid.' and isverified=2');

        foreach ($eventname as $key => $value) {
            $ename= $value->name;
            $maxparticipants = $value->nop; 
           }
    
           $available_slots = $maxparticipants - count($numofparticipants);
          
        $participants = Participant::where('sports_id',$sportsid)->get(); 

        $sportevent= Sportevent::where('CollegeId',$collegeid)->get(); 
       
       
        $user =DB::select('select * from users where id in (select user_id from participants where  isverified = 2 and sports_id ='.$sportsid.' and team='.$id.'  and batch = '.session()->get('batch').' )  '); 
        $allteam = Team::where('sports_id',$sportsid)->get();
        return view('Event.sortparticipants',compact('college','myevent','count','user','participants','sportevent','available_slots','team','allteam'));
    }

    public function tally(){
       

        $sportsid = Auth::user()->sports_id;
        $collegeid = Auth::user()->CollegeId;
        $college = College::all();
        $myevent = Sportevent::where('id',$sportsid)->get();
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->where('sports_id',$sportsid)->get(); 
       
        $kunta = Participant::where('sports_id',$sportsid)->where('isverified',1)->get();
        $count=count($kunta);

     
        $match = Game::where('sports_id',$sportsid)->get();
        $tally = Tally::where('sports_id',$sportsid)->get();    
        $team = Team::where('sports_id',$sportsid)->get();  
        $gameparticipants = Participant::where('sports_id',$sportsid)->where('isverified',2)->get();
        $indi = User::all();
        return view('Event.tally',compact('college','myevent','count','match','tally','team','gameparticipants','indi'));

    }

    public function savegame(Request $request){
        $sportsid = Auth::user()->sports_id;
        $name = $request->input('matchname');

        Game::create([
            'name'=>$name,
            'sports_id'=>$sportsid,
            'status'=>0,
        ]);

        return redirect(route('e.tally'))->with('Success','Match Successfully!');
    }

    public function setmatch(Request $request){

        $sportsid = Auth::user()->sports_id;
        $team = $request->input('team');
        $myevent = Sportevent::where('id',$sportsid)->get();

        $matchid = $request->matchid;
        
     /*    $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
          $count=count($counting_participants); */
          $college = College::all();
       /*    $sportsdata = Sportevent::where('CollegeId',$collegeid)->get(); */
          $sportevent = Auth::user()->sports_id;
        
          $data = DB::select('select * from teams where  batch = '.session()->get('batch').' and  sports_id ='.$sportevent.' and id in (select team from participants where sports_id ='.$sportevent.' and isverified = 2 and batch = '.session()->get('batch').' ) and id not in (select team from tallies where batch = '.session()->get('batch').' and sports_id ='.$sportevent.' and match_id in (select id from games where status in (0,1) )); ');

        $individual = DB::select('select * from users where user_type ="student" and id in (select user_id from participants where sports_id ='.$sportevent.' and isverified = 2  and team= 0 and batch = '.session()->get('batch').') and id not in (select user_id from tallies where sports_id ='.$sportevent.')  ');
          
        $selected = $request->input('selected_ids');

       
        $eventname = DB::select('select name,nop from sportevents where id ='.$sportevent.' and batch = '.session()->get('batch').'  ');
 
        $numofparticipants = DB::select('select * from participants where sports_id ='.$sportevent.' and isverified = 2 and batch = '.session()->get('batch').'');

        foreach ($eventname as $key => $value) {
            $ename= $value->name;
            $maxparticipants = $value->nop; 
           }
           $allteam = Team::all();

           $available_slots = 2;
        
      

        return view('Event.action.set_match',compact('data','college','sportevent','ename','available_slots','myevent','allteam','individual','matchid'));
                  
    }

    public function setmatchselected(Request $request){
        $matchid = $request->input('matchid');
        $mtype = $request->input('mtype');
        $event = $request->input('sportsevent');

        if($mtype== 'team'){
            $team =  $request->input('selected_ids');
            foreach($team as $key){
               Tally::create([
                'team' =>$key, 
                'sports_id'=>$event,
                'user_id' => 0,
                'match_id'=>$matchid,
                'isofficial'=>0,
                'tally'=>0,
                'batch'=>session()->get('batch')
               ]);
            }
            return redirect(route('e.tally'))->with('Success','Match Set Successfully!');
        }else if ($mtype=='individual'){
            
            $user = $request->input('selected_id_individual');
            foreach($user as $key){
                Tally::create([
                    'team' =>0, 
                    'sports_id'=>$event,
                    'user_id' => $key,
                    'match_id'=>$matchid,
                    'isofficial'=>0,
                    'tally'=>0,
                    'batch'=>session()->get('batch')
                   ]);
            }
            return redirect(route('e.tally'))->with('Success','Match Set Successfully!');
        }

    }
    public function forfeitmatch(Request $request){
        $id = $request->id;

        Game::where('id',$id)->delete();
        Tally::where('match_id',$id)->delete();
        return redirect(route('e.tally'))->with('Success','Match Deleted Successfully!');
    }

    public function resetmatch(Request $request){
        $id = $request->id;
        Tally::where('match_id',$id)->delete();
        Game::where('id',$id)->update([
            'status'=>0,
        ]);
        return redirect(route('e.tally'))->with('Success','Selection Reset Successfully!');
    }

    public function setstatus(Request $request){
        $id = $request->id;
        $val = $request->val;

        Game::where('id',$id)->update([
            'status'=>$val,
        ]);
      
    }
    public function settally(Request $request){
        $id = $request->id;
        $tally = $request->tally;
        $offi = $request->offi;
        Tally::where('id',$id)->update([
            'isofficial'=>$offi,
            'tally'=>$tally,
        ]);

    }

    public function firslogin(Request $request){
        $id = Auth::user()->id;

        User::where('id',$id)->update([
            'fl'=>1,
            'password'=>Hash::make($request->newpass),
        ]);
       
    }

    public function updateteam(Request $request){
        $id = $request->input('id');
        $team = $request->input('teamname');
        Team::where('id',$id)->update([
            'name'=>$team,
            'maxcount'=>$request->input('max'),
        ]);

        return redirect()->back()->with('Success','Team Name Updated Successfully!');

    }

    public function setresult(Request $request){
        $id = $request->id;
        $val = $request->val;
        Team::where('id',$id)->update([
            'result'=>$val,
        ]);

    }
}
