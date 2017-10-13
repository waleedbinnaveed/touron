<?php

namespace App\Http\Controllers;
use Auth;
use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
  public function index()
  {
      return view('upload');
  }

  public function uploadMedia()
  {
    $newmedia = new Media
    (
      array(
        'userid' =>  Auth::User()->id,
         'userName' => Auth::User()->name,
         'destination' => $_POST['destination'],
         'mediaURL' => $_POST['mediaurl'],
         'mediaType' => $_POST['type'],

       )

    );

    $newmedia->save();
    return redirect('/upload')->with('status', 'Your media has been uploaded!');

  }
}
