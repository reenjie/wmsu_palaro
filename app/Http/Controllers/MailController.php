<?php

namespace App\Http\Controllers;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
/* composer require phpmailer/phpmailer */
use Illuminate\Http\Request;

class MailController extends Controller
{
    
    private $email;
    private $name;
    private $client_id;
    private $client_secret;
    private $token;
    private $provider;

   
    public function __construct()
    {
       
     
        $this->client_id        = env('GOOGLE_API_CLIENT_ID');
        $this->client_secret    = env('GOOGLE_API_CLIENT_SECRET');
        $this->provider         = new Google(
            [
                'clientId'      => $this->client_id,
                'clientSecret'  => $this->client_secret
            ]
        );

    }


 


    
    public function resetlink(Request $request){
    
       $receiver= $request->input('email'); 
       echo $receiver;
       $user = User::where('email',$receiver)->get();
        if(count($user)>=1){
            $name = 'Wmsu Accounts';
          
           $url =  'http://'.request()->getHttpHost().'/ResetPassword?token='.$user[0]['id'].'&code='.$user[0]['password'];
    
            
    
           $this->token = session()->get('token');
            $mail = new PHPMailer(true);
    
           try {
               $mail->isSMTP();
               $mail->SMTPDebug = SMTP::DEBUG_OFF;
               $mail->Host = 'smtp.gmail.com';
               $mail->Port = 465;
               $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
               $mail->SMTPAuth = true;
               $mail->AuthType = 'XOAUTH2';
               $mail->setOAuth(
                   new OAuth(
                       [
                           'provider'          => $this->provider,
                           'clientId'          => $this->client_id,
                           'clientSecret'      => $this->client_secret,
                           'refreshToken'      => $this->token,
                           'userName'          => session()->get('email')
                       ]
                   )
               );
    
               $mail->setFrom(session()->get('email'),session()->get('e_name'));
               $mail->addAddress($receiver, $name);
               $mail->Subject = 'RESET LINK';
               $mail->CharSet = PHPMailer::CHARSET_UTF8;
               $body = '<!DOCTYPE html>
               <html lang="en">
               
               <head>
                   <meta charset="UTF-8">
                   <meta name="viewport" content="width=device-width, initial-scale=1.0">
                   <meta http-equiv="X-UA-Compatible" content="ie=edge">
                   <title></title>
               </head>
               
               <body style="background-color: #6f0a00;text-align:center;color:white">
               <p><br><br><br></p>
                <img src="https://th.bing.com/th/id/R.fa94935c12dc88843937372f4aed78e4?rik=CNOgSDSkJxlh1A&riu=http%3a%2f%2fwww.wmsu.edu.ph%2fresearch_journal%2fimages%2fwmsulogo.png&ehk=%2bS7ZaIRlUteCMyZimDqnGA%2fBd%2bcTrJX56HKetXeOHNw%3d&risl=&pid=ImgRaw&r=0" style="width:300px">
                   <h2>WMSU PALARO</h2>
               
                  
                       <h3><a href="'.$url.'">Click Here</a> To reset your password .</h3>
               
                     
                       <br>
                       <h5>
                       If this wasnt you. Please Login and Change your password.
                       <br>
                           Do not share this to anyone.
                           <br>
               
                           All rights Reserved &middot; 2022
               
                       </h5>
                       <p><br><br><br></p>
               
               </body>
               
               </html>
               
               ';
               $mail->msgHTML($body);
               $mail->AltBody = 'This is a plain text message body';
               if( $mail->send() ) {
                return redirect()->route('password.request')->with('Success','We have Emailed your Reset Link Please Check your Inbox or Spam Folder.'); 
               } else {
                   return redirect()->back()->with('error', 'Unable to send email.');
               }
           } catch(Exception $e) {
               return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
           }
        }else {
            return redirect()->back()->with('error',$receiver.' is not registered in our database');
        }

     
   
    }

    public function resetpassword(Request $request){
      
        $request->validate([
            'password'=>['confirmed'],
        ]);

        $id = $request->input('id');
        $password = Hash::make($request->input('password'));

        User::where('id',$id)->update([
            'password' => $password,
        ]);
        
        
        $time = date('h:i a  F j,Y');
       
        $user = User::where('id',$id)->get();

        $receiver= $user[0]['email']; 
        $name = $user[0]['name'];


       $this->token = session()->get('token');
        $mail = new PHPMailer(true);

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => $this->token,
                       'userName'          => session()->get('email')
                   ]
               )
           );

           $mail->setFrom(session()->get('email'),session()->get('e_name'));
           $mail->addAddress($receiver, $name);
           $mail->Subject = 'RESET SUCCESSFULLY';
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '

           <!DOCTYPE html>
               <html lang="en">
               
               <head>
                   <meta charset="UTF-8">
                   <meta name="viewport" content="width=device-width, initial-scale=1.0">
                   <meta http-equiv="X-UA-Compatible" content="ie=edge">
                   <title></title>
               </head>
               
               <body style="background-color: #6f0a00;text-align:center;color:white">
               <p><br><br><br></p>
               <img src="https://th.bing.com/th/id/R.fa94935c12dc88843937372f4aed78e4?rik=CNOgSDSkJxlh1A&riu=http%3a%2f%2fwww.wmsu.edu.ph%2fresearch_journal%2fimages%2fwmsulogo.png&ehk=%2bS7ZaIRlUteCMyZimDqnGA%2fBd%2bcTrJX56HKetXeOHNw%3d&risl=&pid=ImgRaw&r=0" style="width:300px">
               <h2>WMSU PALARO</h2>
           
               <h3 style="color:white">Hi '.$name.'!
           
            
                   </h3>
                   <h4>Your Password has changed. <br> DateTime: '.$time.'</h4>


                   <br>
                   <h5>
                  
                   
                       <br>
           
                       All rights Reserved &middot; 2022
           
                   </h5>
                   <p><br><br><br></p>
           
               </body>
               
               </html>
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
            return redirect('/login')->with('Success','New Password Saved!'); 
           } else {
               return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
           return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }   
    }


    public function sendcredentials(Request $request){
        $receiver = $request->email;
        $name = $request->name;
        $this->token = session()->get('token');

        $usertype= $request->usertype;

        echo $receiver.' '.$name.' '.$usertype;
      
       $mail = new PHPMailer(true);

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => $this->token,
                       'userName'          => session()->get('email')
                   ]
               )
           );

           $mail->setFrom(session()->get('email'),session()->get('e_name'));
           $mail->addAddress($receiver, $name);
           $mail->Subject = 'Login Credentials to WMSU PALARO CMS System';
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '

           <!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title></title>
           </head>
           
           <body style="background-color: #6f0a00;text-align:center;color:white">
           <p><br><br><br></p>
           <img src="https://th.bing.com/th/id/R.fa94935c12dc88843937372f4aed78e4?rik=CNOgSDSkJxlh1A&riu=http%3a%2f%2fwww.wmsu.edu.ph%2fresearch_journal%2fimages%2fwmsulogo.png&ehk=%2bS7ZaIRlUteCMyZimDqnGA%2fBd%2bcTrJX56HKetXeOHNw%3d&risl=&pid=ImgRaw&r=0" style="width:300px">
           <h2>WMSU PALARO</h2>
       
           
           <h4>Welcome to WMSU Palaro CMS System. You are registered and Here are your Login Credentials,</h4>
           
           
           
           
           <h4>Email: <span style="font-weight:bold">'.$receiver.'</span>
               <br>
               Password: <span style="font-weight:bold">'.$receiver.'</span>
   
           </h4>
   
         


               <br>
               <h5>
              
               Dont share this to anyone.
                   <br>
                
                   All rights Reserved &middot; 2022
       
               </h5>
               <p><br><br><br></p>
       
           </body>
           
           </html>
       
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
           if($usertype =='student'){
            return redirect(route('admin.students'))->with('Success','Account Added Successfully!');
        
        }else if($usertype =='coordinator'){
        
            return redirect(route('admin.coordinators'))->with('Success','Account Added Successfully!');
        
        }else if ($usertype=='ecoordinator'){
            return redirect(route('admin.ecoordinators'))->with('Success','Account Added Successfully!');
        }
           } else {
               return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
           return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }  

    }

}
