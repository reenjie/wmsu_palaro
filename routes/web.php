<?php

use Illuminate\Support\Facades\Route;
use App\Models\Carousel;
use App\Models\Videolink;
use App\Models\College;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Models\Participant;
use App\Models\Sportevent;
use App\Models\Team;
use App\Models\Game;
use App\Models\Tally;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* For Results. TEam Table

1= 1st runner up
2 = 2nd runner up
3 = Champion


*/

Route::get('/', function () {
    /**Email Sessions */
    $batchactive = DB::select('SELECT * FROM `batches` where status = 1 ');
    //session()->get('batch')
    session(['batch' => $batchactive[0]->id]);
    session(['e_name' => 'WMSU Palaro']);
    session(['email' => 'noreplywmsupalaro@gmail.com']);
    session(['token' => '1//0eLcBmdoQpT4RCgYIARAAGA4SNwF-L9IrBUtf0UgqM_3w6wGXn4cc_S1YGL1qNhXdwzrpHsx21NBI7pwyVpbSfRIdtFwpm803PYY']);


    $carousel = Carousel::where('sports_id', null)->where('batch',$batchactive[0]->id)->get();
    $videos = Videolink::where('batch',$batchactive[0]->id)->get();
    $count = 0;
    $announcement = Announcement::where('batch',$batchactive[0]->id)->orderBy('date_added', 'desc')->get();;
    $college = College::all();
    $sport = Sportevent::where('batch',$batchactive[0]->id)->get();
    $coordinator = User::where('user_type', 'coordinator')->get();
    $ecoordinator = User::where('user_type', 'ecoordinator')->get();
    try {
        $collegeid = Auth::user()->CollegeId;
        $counting_participants = Participant::where('CollegeId', $collegeid)->where('isverified', '0')->get();
        $count = count($counting_participants);
    } catch (\Throwable $th) {
        //throw $th;
    }

    return view('homepage', compact('carousel', 'videos', 'count', 'announcement', 'college', 'sport', 'coordinator', 'ecoordinator'));
});

Route::get('Join', function (Request $request) {
    $id = $request->id;
    $college = College::all();
    $hidenav = '1';

    $sport = Sportevent::where('id', $id)->get();
    return view('join', compact('sport', 'college', 'hidenav'));
})->name('join');

Route::post('View', function (Request $request) {

    $id = $request->input('id');
    $college = College::all();
    $hidenav = '1';
    $coordinator = User::where('sports_id', $id)->get();
    $video = Videolink::where('event', $id)->get();
    $announcement = Announcement::where('sports_id', $id)->orderBy('date_added', 'desc')->get();
    $tally = Tally::where('sports_id', $id)->get();
    $team = Team::where('sports_id', $id)->get();
    $game = DB::select('select * from games where id in (select match_id from tallies where sports_id =' . $id . ')');
    $carousel = Carousel::where('sports_id', $id)->get();
    $sport = Sportevent::where('id', $id)->get();
    $participant = Participant::where('sports_id', $id)->get();
    $independents = DB::select('select * from participants where sports_id =' . $id . ' and  team= 0 ');
    $user = DB::select('select * from users where  id in (select user_id from tallies where sports_id =' . $id . ' )');
    $alluser = User::all();
    return view('view', compact('id', 'college', 'hidenav', 'sport', 'coordinator', 'video', 'announcement', 'carousel', 'team', 'game', 'tally', 'user', 'participant', 'alluser', 'independents'));
})->name('View');

/* Route::get('/register',function(){
    $college = College::all();
    return view('auth.register',compact('college'));
})->name('register');
 */

Route::get('validate', [App\Http\Controllers\ajax::class, 'validate_email'])->name('validate');

Route::get('changevideo', [App\Http\Controllers\ajax::class, 'change_video'])->name('changevideo');

Route::get('allevents', function () {

    $sport = DB::select("select * from sportevents where id in (select sports_id from games) and batch = ".session()->get('batch')." "); /// To do ..
    $game = Game::where('batch',session()->get('batch'))->get();
    $tally = Tally::where('batch',session()->get('batch'))->get();
    $team = Team::where('batch',session()->get('batch'))->get();
    $user = User::all();

    return view('allevent', compact('sport', 'game', 'tally', 'team', 'user'));
})->name('allevents');


Route::get('/Tally', function () {
    $college = College::all();


    return view('Tally', compact('college'));
})->name('Tally');

Auth::routes();

Route::get('fetchtally', [App\Http\Controllers\ajax::class, 'fetchtally'])->name('fetchtally');
Route::get('reset', [App\Http\Controllers\ajax::class, 'reset'])->name('reset');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('savebatch', [App\Http\Controllers\BatchController::class, 'store'])->name('savebatch');
Route::get('fetchbatch', [App\Http\Controllers\BatchController::class, 'fetch'])->name('fetchbatch');
/* Route::prefix('Admin')->name('user.')->group(function(){ 

 


}); */

/* Admin Controller */
Route::controller(App\Http\Controllers\AdminController::class)->group(function () {
    Route::prefix('Admin')->name('admin.')->group(function () {


        Route::get('Dashboard', 'dashboard')->name('dashboard');
        Route::get('Colleges', 'colleges')->name('colleges');
        Route::get('Coordinators', 'coordinators')->name('coordinators');
        Route::get('Event/Coordinator', 'ecoordinators')->name('ecoordinators');
        Route::get('Students', 'students')->name('students');
        Route::get('MyProfile', 'Profile')->name('profile');
        Route::get('Logout', 'logout')->name('logout');




        Route::get('add-new-coordinator/{name}', 'add')->name('add_coordinator_route');

        Route::get('add-new-Student/{name}', 'add')->name('add_student_route');

        Route::get('update-account/{id}/{name}', 'updatecoordinator');

        Route::get('add-college', 'addcollege')->name('addcollege');

        Route::get('update-college/{id}/Colleges', 'updatecollege');

        Route::get('Manage-Homepage', 'homepage')->name('homepage');

        Route::get('Add/Event/Coordinator', 'add_ecoordinator')->name('add_ecoordinator');

        Route::post('addecoordinator', 'addcoordinator')->name('addecoordinator');
        Route::get('Edit/Coordinator', 'edit_coordinator')->name('edit_coordinator');
        Route::post('editcoordinator', 'editcoordinator')->name('editcoordinator');
        Route::get('delete_ecoordinator', 'deleteecoordinator')->name('deleteecoordinator');



        /* Actions */
        //add
        Route::post('addcoordinator', 'add_new_coordinator')->name('addcoordinator');

        Route::post('form_addcollege', 'add_College')->name('form_addcollege');

        Route::post('saving_image', 'storeimage')->name('saveimage');

        Route::get('save-link', 'savelink')->name('savevideolink');

        //update
        Route::post('update_coordinator', 'update_coordinator')->name('update_coordinator');
        Route::post('update-college', 'update_college')->name('form_editcollege');

        //delete
        Route::get('deletecoordinator/{id}', 'deletecoordinator');
        Route::get('deletecollage/{id}', 'deletecollage');
        Route::get('removeimage/{id}/{img}', 'removeimage');



        Route::get('Sport-Events', 'sportevents')->name('sportevents');
        Route::get('delete_sports/{id}', 'delete_sportevents');
        Route::get('Edit/Sport-Events/{id}/{data}', 'edit_sportevents');


        Route::get('Add-Sport-Event', 'add_sports_events')->name('add_sports_events');

        Route::post('add_sports', 'add_sports')->name('add_sports');
        Route::post('edit_sports', 'edit_sports')->name('edit_sports');


        Route::get('firslogin', 'firslogin')->name('firslogin');
    });
});
//end of admin


/* Coordinator */
Route::controller(App\Http\Controllers\CoordinatorCOntroller::class)->group(function () {
    Route::prefix('Coordinator')->name('coordinator.')->group(function () {
        Route::get('MyProfile', 'Profile')->name('profile');
        Route::get('update-account/{id}/{name}', 'updatecoordinator');
        Route::post('update_coordinator', 'update_coordinator')->name('update_coordinator');
        Route::get('Dashboard', 'dashboard')->name('dashboard');
        Route::get('Announcement', 'announcement')->name('announcement');
        Route::get('Media', 'media')->name('media');

        Route::get('Participants', 'participants')->name('participants');
        Route::get('New/Participants', 'newparticipants');


        Route::get('verify{id}', 'verify')->name('verify');


        Route::post('add_announcement', 'add_announcement')->name('add_announcement');

        Route::get('deleteannouncement/{id}', 'delete_announcement');
        Route::post('edit_announcement', 'update_announcement')->name('edit_announcement');

        Route::get('Students', 'students')->name('students');


        Route::get('delete_participants/{id}', 'delete_participants');


        Route::get('Add/Participants', 'add_participants')->name('add_participants');

        Route::post('Add/Participants', 'addParticipants')->name('addParticipants');

        Route::get('List/Blacklisted', 'blacklist')->name('blacklist');
        Route::get('List/Blacklisted/Add/{id}/{name}', 'addblacklist')->name('addblacklist');

        Route::post('Addblacklist', 'addlist_blacklist')->name('addlist_blacklist');


        Route::get('removeList/{id}/{event}', 'removefrom_blacklist')->name('removefrom_blacklist');

        Route::get('Add/videolinks/{id}/{name}', 'addvideolinks')->name('addvideolinks');


        Route::get('save-link', 'savelink')->name('savevideolink');


        Route::get('firslogin', 'firslogin')->name('firslogin');
    });
});


/* User */
Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    Route::prefix('MyAccount')->name('user.')->group(function () {
        Route::get('MyProfile', 'Profile')->name('profile');
        Route::get('update-account/{id}/{name}', 'updatecoordinator');
        Route::post('update_coordinator', 'update_coordinator')->name('update_coordinator');
        Route::get('Dashboard', 'dashboard')->name('dashboard');
        Route::get('Join', 'join')->name('join');
        Route::get('About', 'about')->name('about');
        Route::get('Join/Events/{id}/Event={name}', 'join_event')->name('join_event');

        Route::post('join_sportevent', 'join_sportevent')->name('join_sportevent');
        Route::get('delete_participants/{id}', 'delete_participants');
        Route::get('Stream', 'stream')->name('stream');
    });
});


/* Event Coordinator */
Route::controller(App\Http\Controllers\EventController::class)->group(function () {
    Route::prefix('Event')->name('e.')->group(function () {
        Route::get('MyProfile', 'Profile')->name('profile');
        Route::get('update-account/{id}/{name}', 'updatecoordinator');
        Route::post('update_coordinator', 'update_coordinator')->name('update_coordinator');
        Route::get('Dashboard', 'dashboard')->name('dashboard');
        Route::get('Announcement', 'announcement')->name('announcement');
        Route::post('add_announcement', 'add_announcement')->name('add_announcement');
        Route::post('edit_announcement', 'update_announcement')->name('edit_announcement');
        Route::get('deleteannouncement/{id}', 'delete_announcement');
        Route::get('Media', 'media')->name('media');
        Route::get('save-link', 'savelink')->name('savevideolink');
        Route::get('Sport-Events', 'sportevents')->name('sportevents');
        Route::get('987aXAsd12joasd', 'updateevent')->name('updateevent');
        Route::post('savelogo', 'savelogo')->name('savelogo');
        Route::get('Participants', 'participants')->name('participants');
        Route::get('delete_participants/{id}', 'delete_participants');

        Route::post('Adding/Participants', 'addParticipants')->name('addParticipants');

        Route::get('Add/Participants', 'addParticipants')->name('add_Participants');

        Route::get('List/Blacklisted', 'blacklist')->name('blacklist');
        Route::get('List/Blacklisted/Add/{id}/{name}', 'addblacklist')->name('addblacklist');
        Route::get('removeList/{id}/{event}', 'removefrom_blacklist')->name('removefrom_blacklist');

        Route::post('Addblacklist', 'addlist_blacklist')->name('addlist_blacklist');


        Route::get('verify{id}', 'verify')->name('verify');
        Route::get('Homepage', 'homepage')->name('homepage');

        Route::post('saving_image', 'storeimage')->name('saveimage');
        Route::get('removeimage/{id}/{img}', 'removeimage');
        Route::get('removeallimage', 'removeallimage');

        Route::get('Team', 'team')->name('team');
        Route::post('savenewteam', 'savenewteam')->name('savenewteam');
        Route::get('move', 'move')->name('move');
        Route::get('deleteteam', 'deleteteam')->name('deleteteam');
        Route::get('SortBy', 'sortby')->name('sortby');

        Route::get('Tally', 'tally')->name('tally');

        Route::post('savegame', 'savegame')->name('savegame');
        Route::get('SetMatch', 'setmatch')->name('setmatch');
        Route::post('setmatchselected', 'setmatchselected')->name('setmatchselected');
        Route::get('forfeitmatch', 'forfeitmatch')->name('forfeitmatch');
        Route::get('resetmatch', 'resetmatch')->name('resetmatch');
        Route::get('setstatus', 'setstatus')->name('setstatus');
        Route::get('settally', 'settally')->name('settally');

        Route::get('firslogin', 'firslogin')->name('firslogin');

        Route::post('updateteam', 'updateteam')->name('updateteam');

        Route::get('setresult', 'setresult')->name('setresult');
    });
});

/**Email SEtting */
Route::post('/get-token', [App\Http\Controllers\OauthController::class, 'doGenerateToken'])->name('generate.token');
Route::get('/get-token', [App\Http\Controllers\OauthController::class, 'doSuccessToken'])->name('token.success');
Route::post('/send', [App\Http\Controllers\MailController::class, 'doSendEmail'])->name('send.email');



Route::controller(App\Http\Controllers\MailController::class)->group(function () {

    Route::prefix('sendingMail')->name('mail.')->group(function () {

        Route::post('resetlink', 'resetlink')->name('resetlink');
        Route::post('resetpassword', 'resetpassword')->name('resetpassword');
        Route::get('sendcredentials', 'sendcredentials')->name('sendCredentials');
    });
});



Route::get('ResetPassword', function (Request $request) {
    $id = $request->token;
    return view('auth.passwords.reset', compact('id'));
});
Route::get('test', function () {

    return view('testmail');
});
