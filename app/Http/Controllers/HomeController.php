<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\College;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $user = Auth::user()->user_type;
        switch ($user) {
            case 'superadmin':
                return redirect('/Admin/Dashboard');
                break;

            case 'coordinator':
                    return redirect('/Coordinator/Dashboard');
              break;

            case 'student':
                return redirect('/MyAccount/Dashboard');
          break;

          case 'ecoordinator':
            return redirect('/Event/Dashboard');
      break;


        }
    }


  
}
