<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\College;
use App\Models\Carousel;
use App\Models\Videolink;
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
        return view('Admin.dashboard');
    }

    //Homepage 
    public function homepage(){
        $data = Carousel::all();
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
]); 

if($usertype =='student'){
    return redirect(route('admin.students'))->with('Success','Account Added Successfully!');

}else if($usertype =='coordinator'){

    return redirect(route('admin.coordinators'))->with('Success','Account Added Successfully!');

}



}

public function updatecoordinator($id,$name){
    
    $data = User::where('id',$id)->get();

    if($name == 'Student'){
        $college =  College::all();
        $default_college =DB::select('select id,name from colleges where id in (select CollegeId from users where id = ? ) ',[$id]);

    }else if ($name =='Coordinator'){
        $college =  DB::select('select * from colleges where id not in (select CollegeId from users  where user_type ="coordinator" )');  
        $default_college =DB::select('select id,name from colleges where id in (select CollegeId from users where id = ? ) ',[$id]);
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

//Logout//
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}

/* 
   $user =DB::select('select * from accounts where id =? ',[$id]);
*/