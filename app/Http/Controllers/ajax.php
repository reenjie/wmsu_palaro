<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\College;
use App\Models\Sportevent;
use App\Models\Videolink;
use Illuminate\Http\Request;

class ajax extends Controller
{
   public function validate_email(Request $request){
    $email =  $request->val;
    $eventid =  $request->id;
    try {
        $user = User::where('email',$email)->where('user_type','student')->get();
    $sport = Sportevent::where('id',$eventid)->get();

    foreach($sport as $row){
        $sports_col = $row->CollegeId;
    }

    foreach($user as $row){
        $col =  $row->CollegeId;
    }

    if($sports_col == $col){
        echo "join";
    }else {
        echo "cantjoin";
    }
    } catch (\Throwable $th) {
       echo "error";
    }
  

   }

   public function change_video(Request $request){
   $vlink =  $request->id;

   $mlink = Videolink::where('id',$vlink)->get();

   foreach($mlink as $row){
  $link = $row->video;
  $vtype = $row->videotype;
   }

   if($vtype == 'youtube'){
    echo ' <iframe id="ycvideo"  width="400" height="315" src="'.$link.'" frameborder="0" allowfullscreen></iframe> ';
   }else if ($vtype=='facebook'){
    echo $link;
   }


   }
}
