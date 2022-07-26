<?php

use Illuminate\Support\Facades\Route;
use App\Models\Carousel;
use App\Models\Videolink;

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

Route::get('/', function () {
    $carousel = Carousel::all();
    $videos = Videolink::all();
    return view('homepage',compact('carousel','videos'));
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* Route::prefix('Admin')->name('user.')->group(function(){ 

 


}); */

/* Admin Controller */
Route::controller(App\Http\Controllers\AdminController::class)->group(function(){
    Route::prefix('Admin')->name('admin.')->group(function(){ 
       
      
        Route::get('Dashboard','dashboard')->name('dashboard');
        Route::get('Colleges','colleges')->name('colleges');
        Route::get('Coordinators','coordinators')->name('coordinators');
        Route::get('Students','students')->name('students');
        Route::get('MyProfile','Profile')->name('profile');
        Route::get('Logout','logout')->name('logout');
       

      

        Route::get('add-new-coordinator/{name}','add')->name('add_coordinator_route');

        Route::get('add-new-Student/{name}','add')->name('add_student_route');

         Route::get('update-account/{id}/{name}','updatecoordinator');

         Route::get('add-college','addcollege')->name('addcollege');

         Route::get('update-college/{id}/Colleges','updatecollege');

         Route::get('Manage-Homepage','homepage')->name('homepage');



        /* Actions */
        //add
        Route::post('addcoordinator','add_new_coordinator')->name('addcoordinator');

        Route::post('form_addcollege','add_College')->name('form_addcollege');

        Route::post('saving_image','storeimage')->name('saveimage');

        Route::get('save-link','savelink')->name('savevideolink');
        
        //update
        Route::post('update_coordinator','update_coordinator')->name('update_coordinator');
        Route::post('update-college','update_college')->name('form_editcollege');
       
        //delete
        Route::get('deletecoordinator/{id}','deletecoordinator');
        Route::get('deletecollage/{id}','deletecollage');
        Route::get('removeimage/{id}/{img}','removeimage');
      


    });

   
});


/* Coordinator */
Route::controller(App\Http\Controllers\CoordinatorController::class)->group(function(){
    Route::prefix('Coordinator')->name('coordinator.')->group(function(){ 

        Route::get('Dashboard','dashboard')->name('dashboard');
        Route::get('Announcement','announcement')->name('announcement');
        Route::get('Media','media')->name('media');
        Route::get('Sport-Events','sportevents')->name('sportevents');
        Route::get('Participants','participants')->name('participants');
        Route::get('New/Participants','newparticipants');

        Route::get('Add-Sport-Event','add_sports_events')->name('add_sports_events');

        Route::get('verify{id}','verify')->name('verify');


        Route::post('add_announcement','add_announcement')->name('add_announcement');

        Route::get('deleteannouncement/{id}','delete_announcement');
        Route::post('edit_announcement','update_announcement')->name('edit_announcement');

        Route::post('add_sports','add_sports')->name('add_sports');
        Route::post('edit_sports','edit_sports')->name('edit_sports');

        Route::get('delete_sports/{id}','delete_sportevents');
        Route::get('delete_participants/{id}','delete_participants');
        Route::get('Edit/Sport-Events/{id}/{data}','edit_sportevents');

        Route::get('Add/Participants','add_participants')->name('add_participants');

        Route::post('Add/Participants','addParticipants')->name('addParticipants');

    });

});