<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LoggingController;
use Illuminate\Http\Request;
use App\EventUser;
use App\MatterEvent;
use App\Communication;
use App\User;
use App\Client;
class StatuteController extends Controller
{
    public function show($id){
        $read_Client = Client::find($id);
        $title = "Statute Limitation Report for ".$read_Client->name;

        $save_log=new LoggingController();
        $save_log->userlog($id,"Client","Showing comprehessive client content ".$_SERVER['REQUEST_URI']);

        return view('matter.statute')->with(compact('read_Client','title'));
   
    }
}
