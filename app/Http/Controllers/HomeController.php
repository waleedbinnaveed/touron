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
        $comments = comments::all();
        return view('welcome')->with('media',$media)->with('comments',$comments);
    }

    public function storeComment()
    {
        $media = Media::all();
        $comments = comments::all();
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
        return redirect('/')->with('status', 'POST COMMENT')->with('media',$media)->with('comments',$comments);
    }
}
