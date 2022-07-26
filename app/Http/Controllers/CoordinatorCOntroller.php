<?php

namespace App\Http\Controllers;
use App\Models\College;
use App\Models\Announcement;
use App\Models\Participant;
use App\Models\Sportevent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class CoordinatorCOntroller extends Controller
{   
    public function dashboard(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

        $count=count($participants);
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.dashboard',compact('college','count'));
    }
    public function announcement(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

        $count=count($participants);
        $announcement = Announcement::all()->SortByDesc('date_added');
        $counts = count($announcement);
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.announcement',compact('college','announcement','count','counts'));
    }
    public function media(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

        $count=count($participants);
      
       
        
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

       
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.media',compact('college','count'));
    }
    public function sportevents(){
        $id = Auth::user()->CollegeId;
       
       
        $participants = Participant::where('CollegeId',$id)->where('isverified','0')->get();  
        $user = User::where('CollegeId',$id)->where('user_type','student')->get(); 

        $count=count($participants);
        $sportsdata = Sportevent::where('CollegeId',$id)->get();
        //$count = count($sportsdata);
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.sportevents',compact('college','sportsdata','count'));
    }

    public function participants(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
        $count=count($counting_participants);
       
        $sportevent= Sportevent::where('CollegeId',$collegeid)->get(); 
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.participants',compact('college','participants','user','sportevent','count'));
    }

    public function newparticipants(){
        $collegeid = Auth::user()->CollegeId;
       
        $participants = Participant::where('CollegeId',$collegeid)->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 

        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
        $count=count($counting_participants);
       
        $participants = Participant::where('CollegeId',$collegeid)->get();  
        $user = User::where('CollegeId',$collegeid)->where('user_type','student')->get(); 
       
        $sportevent= Sportevent::where('CollegeId',$collegeid)->get(); 
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.newparticipants',compact('college','participants','user','sportevent','count'));
    }

    public function add_sports_events(){
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
        $count=count($counting_participants);
        $college = College::where('id',Auth::user()->CollegeId)->get();
        return view('Coordinator.action.add_sportsevent',compact('college','count'));
    }

    public function add_announcement(Request $request){


       Announcement::create([
        'announcement' => $request->input('announce'),
        'date_added' => now(),
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


    public function add_sports(Request $request){
        $collegeid = Auth::user()->CollegeId;
      
        $request->validate([
            'eventname' => 'required',
            /* 'datestart' => 'required',
            'dateend' =>'required', */
            'description'=>'required',
          /*   'timestart'=>'required',
            'timeend'=>'required', */
            'rulesandregulation'=>'required',
            'requirements'=>'required',
        ],[
            'required' => 'Required *',
        ]);
        $imageName = '';
        if($request->file('imgfile')){
            $imageName = time().'.'.$request->file('imgfile')->getClientOriginalExtension();
            $request->file('imgfile')->move(public_path('assets/img'), $imageName);
          }

          if($imageName){
            $file = $imageName;
          }else{
            $file = '';
          }
        
        Sportevent::create([
            'name' => $request->input('eventname'),
            'datestart'=>$request->input('datestart'),
            'dateend'=>$request->input('dateend'),
            'description'=>$request->input('description'),
            'timestart'=>$request->input('timestart'),
            'timeend'=>$request->input('timeend'),
            'rules_regulation'=> $request->input('rulesandregulation'),
            'requirements'=>$request->input('requirements'),
            'file'=>$file,
            'nop' => $request->input('numofparticipants'),
            'nor' => $request->input('numofrounds'),
            'CollegeId'=>$collegeid,
            'date_added'=>now(),
        ]);

        return redirect()->route('coordinator.sportevents')->with('Success','Sport/Events Added Successfully!');

    }

    public function edit_sports(Request $request){
        $collegeid = Auth::user()->CollegeId;
        $id = $request->input('sid');
       
        
        $request->validate([
          
            /* 'datestart' => 'required',
            'dateend' =>'required', */
            'description'=>'required',
          /*   'timestart'=>'required',
            'timeend'=>'required', */
            'rulesandregulation'=>'required',
            'requirements'=>'required',
        ],[
            'required' => 'This field is Required',
        ]);
      $imageName = '';
        if($request->file('imgfile')){
            $imageName = time().'.'.$request->file('imgfile')->getClientOriginalExtension();
            $request->file('imgfile')->move(public_path('assets/img'), $imageName);

            $filedata =  Sportevent::select('file')->where('id',$id)->get();
            foreach ($filedata as $key => $value) {
                
              
                
               try {
                $myfile = public_path('assets/img/' . $value->file);
                   unlink($myfile);
               } catch (\Throwable $th) {}
    
            }

          }

          if($imageName){
            $file = $imageName;
          }else{
            $filedata =  Sportevent::select('file')->where('id',$id)->get();
            foreach ($filedata as $key => $value) {
                
              
               $file = $value->file;
     
             }
       
          }
        
        Sportevent::where('id',$id)->update([
            'name' => $request->input('eventname'),
            'datestart'=>$request->input('datestart'),
            'dateend'=>$request->input('dateend'),
            'description'=>$request->input('description'),
            'timestart'=>$request->input('timestart'),
            'timeend'=>$request->input('timeend'),
            'rules_regulation'=> $request->input('rulesandregulation'),
            'requirements'=>$request->input('requirements'),
            'file'=>$file,
            'nop' => $request->input('numofparticipants'),
            'nor' => $request->input('numofrounds'),
            'CollegeId'=>$collegeid,
            'date_added'=>now(),
        ]);

        return redirect()->route('coordinator.sportevents')->with('Success','Sport/Events Updated Successfully!'); 

    }

    public function delete_sportevents($id){
        $filedata =  Sportevent::select('file')->where('id',$id)->get();
     foreach ($filedata as $key => $value) {
       
        try {
            unlink($value->file);
        } catch (\Throwable $th) {}
     }
    Sportevent::where('id',$id)->delete();
        return redirect()->route('coordinator.sportevents')->with('Success','Sport/Events and other data connected was Deleted Successfully!'); 

    }

    public function edit_sportevents($id){
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
        $count=count($counting_participants);
      $college = College::where('id',Auth::user()->CollegeId)->get();
       $data =  Sportevent::where('id',$id)->get();
      
        return view('Coordinator.action.edit_sports',compact('college','data','count'));
     

    }

    public function verify($id){
        Participant::where('id',$id)->update([
            'isverified'=>1,
        ]);

        return redirect('Coordinator/New/Participants')->with('Success','Verified Successfully!'); 

    }

    public function delete_participants($id){
     
        Participant::where('id',$id)->delete();

        return redirect()->back()->with('Success','Deleted Successfully!'); 
    }

    public function add_participants(){
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
        $count=count($counting_participants);
      $college = College::where('id',Auth::user()->CollegeId)->get();
      $sportsdata = Sportevent::where('CollegeId',$collegeid)->get();
      $data = User::where('CollegeId',$collegeid)->where('user_type','student')->get();
    
      $nop = DB::select('select sports_id,COUNT(sports_id) as nop from participants group by sports_id');
    
        return view('Coordinator.action.add_partcipants',compact('college','count','data','sportsdata','nop'));
    }

    public function addParticipants(Request $request){
       
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
          $count=count($counting_participants);
          $college = College::where('id',Auth::user()->CollegeId)->get();
          $sportsdata = Sportevent::where('CollegeId',$collegeid)->get();
          $sportevent =  $request->input('sportsevent');
        $data = DB::select('select * from users where id not in (select user_id from participants where sports_id='.$sportevent.' and CollegeId ='.$collegeid.' and user_type="student")');
        $selected = $request->input('selected_ids');

        $sportevent =  $request->input('sportsevent');
        $eventname = DB::select('select name,nop from sportevents where id ='.$sportevent.' ');
 
        $numofparticipants = DB::select('select * from participants where sports_id ='.$sportevent.'');

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

}
