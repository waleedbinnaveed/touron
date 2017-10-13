<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\comments;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::all(); 
        return view('welcome')->with('media',$media);
    }

    public function storeComment()
    { 
        $media = Media::all();         
        $newcom = new comments
        (
          array(
            'mediaid' =>  $_POST['mediaid'],
             'nameofuser' => $_POST['nameofuser'],
             'userid' => 0,
             'comment' => $_POST['comment'],
    
           )
    
        );
    
        $newcom->save();
        return view('welcome')->with('status', 'comment posted')->with('media',$media);
    }
}
