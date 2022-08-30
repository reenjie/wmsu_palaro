<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\College;
use App\Models\Carousel;
use App\Models\Videolink;
use App\Models\Sportevent;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{   
    //profile
    public function Profile(){
        return view('Admin.profile');
    }


    // dashboard
    public function dashboard(){

        $coordinator = User::where('user_type','coordinator')->get();
        $students = User::where('user_type','student')->get();
        $college = College::all();
        $user = User::all();
        $sport = DB::select('select * from sportevents where id in (select sports_id from participants)');

       
        $participants = DB::select('select * from participants where sports_id in (select id from sportevents  )');
        
        $graph = DB::select('select (select count(sports_id) from participants where sports_id = sportevents.id ) as totalcount,id, name from sportevents where id  in (select sports_id from participants) ;');

     

        $collegewevent = DB::select('select * from colleges where id in (select CollegeId from participants)');
        return view('Admin.dashboard',compact('coordinator','students','college','user','sport','participants','collegewevent','graph'));
    }

    //Homepage 
    public function homepage(){
        $data = Carousel::where('sports_id',null)->get();
        $count = count($data);
        $videos = Videolink::all();
        return view('Admin.homepage',compact('data','count','videos'));
    }

    //Saving images to carousel

    public function storeimage(Request $request){


       $typeof_action = $request->input('action');

     if($typeof_action == 'add'){

        if($request->file('imgfile')){
            $imageName = time().'.'.$request->file('imgfile')->getClientOriginalExtension();
            $request->file('imgfile')->move(public_path('assets/img'), $imageName);
            Carousel::create([
                'images' => $imageName,
                'priority' => 0,
                'date_added' => now(),
            ]);
    
          }
    
          return redirect(route('admin.homepage'))->with('Success_image','Carousel Image Added Successfully!'); 
    
        
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

          return redirect(route('admin.homepage'))->with('Success_image','Carousel Image Updated Successfully!');  
    
         
      

     }




     
    }

    public function removeimage($id,$img){
        $carousel_image = Carousel::findOrFail($id);
        $image_path =   public_path('assets/img/' . $carousel_image->images);
        
        if(file_exists($image_path)){
         unlink($image_path);
        }

       $carousel_image->delete();
       return redirect(route('admin.homepage'))->with('Success_image','Carousel Image Removed Successfully!');

    }

    //end images to carousel

    //colleges
    public function colleges(){
        $wcoordinator = DB::select('select colleges.id,colleges.name,users.name as username,users.CollegeId,users.email from users inner join colleges on users.CollegeId = colleges.id and users.user_type="coordinator" ');
        $nocoordinator = DB::select('select * from colleges where id not in (select CollegeId from users);');
        return view('Admin.colleges',compact('wcoordinator','nocoordinator'));
    }

    public function addcollege(){
        return view('Admin.action.add_college');
    }
    
    public function updatecollege($id){
       $data= College::where('id',$id)->get();
       return view('admin.action.edit_college',compact('data'));
    }

    public function add_College(Request $request){
        $request->validate([
            'name' => 'required|unique:colleges',
            
        ]);

        College::create([
            'name' => $request->input('name'),
            'coordinator' => 0,
            'date_register' => now(),
        ]);

        return redirect(route('admin.colleges'))->with('Success','College Added Successfully!');

}

public function update_college(Request $request){
    $id = $request->input('id');

    College::where('id',$id)->update([
        'name' => $request->input('name'),
    ]);


    return redirect(route('admin.colleges'))->with('Success','College Updated Successfully!');

}


public function deletecollage($id){
    College::where('id',$id)->delete();
    User::where('CollegeId',$id)->delete();
    return redirect(route('admin.colleges'))->with('Success','College and Coordinator`s data has been Deleted Successfully!');
}
//End of colleges


//Coordinators and Students
    
    public function coordinators(){
        $data = User::all();
        $college = College::all();
        $checking_availability = DB::select('select * from colleges where id not in (select CollegeId from users where user_type ="coordinator")');
        $count = count($checking_availability);
        return view('Admin.coordinator',compact('data','college','count'));
    }

    
    public function ecoordinators(){
        $collegeid = Auth::user()->CollegeId;
        
        $user = User::where('user_type','ecoordinator')->get();
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $sport = Sportevent::all();
       
        $count=count($participants);

        $sportevent = Sportevent::all();

        $events = DB::select('select * from sportevents where id not in (select sports_id from users where CollegeId ='.$collegeid.' )');

       return view('Admin.ecoordinators',compact('user','count','college','sport','events','sportevent'));
    }

    
    public function add_ecoordinator(){
        $collegeid = Auth::user()->CollegeId;
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $events = DB::select('select * from sportevents where id not in (select sports_id from users)');
        $count=count($participants);

        return view('Admin.action.add_ecoordinator',compact('count','college','events'));
    }

    public function addcoordinator(Request $request){
        $request -> validate([
            'email' => 'required|unique:users',
            'name'  => 'required',
            'address' => 'required',
            'contactno' => 'required|min:11|numeric',
          ]
       );
    
     
       $default_password = $request->input('email');
       $collegeId = $request->input('college');
      User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'address'=> $request->input('address'),
        'contactno'=> $request->input('contactno'),
        'password' => Hash::make($default_password),
        'date_register' =>now(),
        'user_type' => 'ecoordinator',
        'CollegeId' =>0,
        'fl'=>0,
        'sports_id'=>$request->input('sportsid'),
    ]); 
    
    $usertype='ecoordinator';
    
    return redirect()->route('mail.sendCredentials',['email'=>$request->input('email'),'name'=>$request->input('name'),'usertype'=>$usertype]);


    
    
    
    
    }
    public function edit_coordinator(Request $request){
        $userid = $request->id;
        $collegeid = Auth::user()->CollegeId;
        $college = College::where('id',Auth::user()->CollegeId)->get();
        $participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get();  
        $events = DB::select('select * from sportevents where id not in (select sports_id from users where CollegeId ='.$collegeid.' )');
        $count=count($participants);
        
        $data = User::where('id',$userid)->get();

        return view('Admin.action.edit_coordinator',compact('college','count','events','data'));

    }

    public function editcoordinator(Request $request){
      
        User::where('id',$request->userid)->update([
            'name'=>$request->input('name'),
            'address'=>$request->input('address'),
            'contactno'=>$request->input('contactno'),
        ]);
       

       return redirect(route('admin.ecoordinators'))->with('Success','Account Updated Successfully!');
    }

    public function deleteecoordinator(Request $request){
      $id = $request->id ;
     User::where('id',$id)->delete();
     return redirect()->route('admin.ecoordinators')->with('Success','Account Deleted Successfully!');
    }



    public function students(){
        $data = User::all();
        $college = College::all();
        return view('Admin.students',compact('data','college'));
    }

    public function add($name){
    switch ($name) {
        case 'student':
            $data = College::all();
            break;

        case 'coordinator':
            $data = DB::select('select * from colleges where id not in (select CollegeId from users  where user_type ="coordinator" )');  
            break;
       
    }
      
        return view('Admin.action.add',compact('name','data'));
    }


public function add_new_coordinator(Request $request){
    $request -> validate([
        'email' => 'required|unique:users',
        'name'  => 'required',
        'address' => 'required',
        'contactno' => 'required|min:11|numeric',
      ]
   );

   $usertype =$request->input('usertype');
   $default_password = $request->input('email');
   $collegeId = $request->input('college');
  User::create([
    'name' => $request->input('name'),
    'email' => $request->input('email'),
    'address'=> $request->input('address'),
    'contactno'=> $request->input('contactno'),
    'password' => Hash::make($default_password),
    'date_register' =>now(),
    'user_type' => $usertype,
    'CollegeId' =>$collegeId,
    'fl'=>0,
    'sports_id'=>0,
]); 

return redirect()->route('mail.sendCredentials',['email'=>$request->input('email'),'name'=>$request->input('name'),'usertype'=>$usertype]);





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
  
   

    return view('admin.action.edit',compact('data','name','college','default_college'));
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
    
        return redirect(route('admin.coordinators'))->with('Success','Account Updated Successfully!');
    
    }else {
        return redirect(route('admin.profile'))->with('Success','Account Updated Successfully!');
    
    }
    

   
}


public function deletecoordinator($id){
   
    User::where('id',$id)->delete();
    return redirect()->back()->with('Success','Account Deleted Successfully!');



}

//End of Coordinators and Students

public function savelink(Request $request){
    
    Videolink::where('id',1)->update([
    'video' => $request->link,
    'videotype' => $request->vtype,

]); 
}

public function sportevents(){
    $id = Auth::user()->CollegeId;
   
   
    $participants = Participant::where('CollegeId',$id)->where('isverified','0')->get();  
    $user = User::where('CollegeId',$id)->where('user_type','student')->get(); 

    $count=count($participants);
    $sportsdata = Sportevent::all();
    //$count = count($sportsdata);
    $college = College::where('id',Auth::user()->CollegeId)->get();
    return view('Admin.sportevents',compact('college','sportsdata','count'));
}

public function delete_sportevents($id){
    $filedata =  Sportevent::select('file')->where('id',$id)->get();
 foreach ($filedata as $key => $value) {
   
    try {
        unlink($value->file);
    } catch (\Throwable $th) {}
 }
Sportevent::where('id',$id)->delete();
    return redirect()->route('admin.sportevents')->with('Success','Sport/Events and other data connected was Deleted Successfully!'); 

}

public function edit_sportevents($id){
    $collegeid = Auth::user()->CollegeId;
    $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
    $count=count($counting_participants);
  $college = College::where('id',Auth::user()->CollegeId)->get();
   $data =  Sportevent::where('id',$id)->get();
  
    return view('Admin.action.edit_sports',compact('college','data','count'));
 

}

public function add_sports(Request $request){
    $collegeid = Auth::user()->CollegeId;
  
    $request->validate([
        'eventname' => 'required',
        /* 'datestart' => 'required',
        'dateend' =>'required', */
      /*   'description'=>'required',
        'timestart'=>'required',
        'timeend'=>'required', 
        'rulesandregulation'=>'required',
        'requirements'=>'required', */
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
        'CollegeId'=>0,
        'istype'=>$request->input('istype'),
        'date_added'=>now(),
    ]);

    return redirect()->route('admin.sportevents')->with('Success','Sport/Events Added Successfully!');

}

public function add_sports_events(){
    $collegeid = Auth::user()->CollegeId;
    $counting_participants = Participant::where('CollegeId',$collegeid)->where('isverified','0')->get(); 
    $count=count($counting_participants);
    $college = College::where('id',Auth::user()->CollegeId)->get();
    return view('Admin.action.add_sportsevent',compact('college','count'));
}

public function edit_sports(Request $request){
    $collegeid = Auth::user()->CollegeId;
    $id = $request->input('sid');
   
    
    $request->validate([
      
        /* 'datestart' => 'required',
        'dateend' =>'required', */
     //   'description'=>'required',
      /*   'timestart'=>'required',
        'timeend'=>'required', */
       // 'rulesandregulation'=>'required',
      //  'requirements'=>'required',
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
        'CollegeId'=>0,
        'istype'=>$request->input('istype'),
        'date_added'=>now(),
    ]);

    return redirect()->route('admin.sportevents')->with('Success','Sport/Events Updated Successfully!'); 

}

//Logout//
    public function logout(){
        Auth::logout();
        return redirect('/');
    }


    public function firslogin(Request $request){
        $id = Auth::user()->id;

        User::where('id',$id)->update([
            'fl'=>1,
            'password'=>Hash::make($request->newpass),
        ]);
       
    }


    
}

/* 
   $user =DB::select('select * from accounts where id =? ',[$id]);
*/