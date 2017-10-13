@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->




 <!-- Header -->
 <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <!-- <div class="intro-lead-in">Inspired from travelling Enthusisats</div>
          <img class="" src="site-content/img/logo2.png" width="400" height="400" alt=""> -->
          <!-- <div class="intro-heading">WELCOME</div> -->
          <!-- <a class="btn btn-xl js-scroll-trigger" href="#services">Tell Me More</a> -->

<div class="container">
  <div class="row">
        <div class="well well bs-component">
          <form class="form-horizontal" method="post" id="formid">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <fieldset>
                        <legend>Upload</legend>
                        <div class="form-group">
                          <label for="title" class="col-lg-2 control-label">Enter Destination</label>
                          <div class="col-lg-10">
                              <input type="text" class="form-control" id="destination" name="destination">
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="mediaurl" name="mediaurl" hidden/ >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="type" name="type" hidden/ >
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" id="update" class="btn btn-primary" hidden>Save</button>
                            </div>
                        </div>

                    </fieldset>
          </form>
                <div class="main">

    <input type="file" class="btn btn-xl" id="upload_file" size="50" name="icon" onchange="loadFile(this);" >
    <div id="myProgress">
        <div id="myBar"></div>
    </div>
</div>
            
            
            
        </div>
      
      
      </div>
    
    
    
    </div>
  </div>
</div>


</header>



 


<script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBp6KtcJjdn3eGfLUIkEdnNqprDgZUdN8g",
    authDomain: "touron-2d89b.firebaseapp.com",
    databaseURL: "https://touron-2d89b.firebaseio.com",
    projectId: "touron-2d89b",
    storageBucket: "touron-2d89b.appspot.com",
    messagingSenderId: "249584416865"
  };
  firebase.initializeApp(config);
</script>
<script>
    function loadFile(input) {
    

            //Step 1 : Defining element to show the progress
            var elem = document.getElementById("myBar");    
            var filetoUpload=input.files[0];
            var str =filetoUpload.name; 
            var ext = str.charAt(str.length-1)


            //Step 2 : Initializing the reference of database with the filename
            var storageRef = firebase.storage().ref(filetoUpload.name);
            //Step 3 : Uploading file
             var task = storageRef.put(filetoUpload);
            
            //Step 4 : sata_changed Event
             // state_changed events occures when file is getting uploaded 
             //(Note : when we want to show the progress what's the uploading status that time we will use this function.)
             task.on('state_changed',
                function progress(snapshot){
                    var percentage = snapshot.bytesTransferred / snapshot.totalBytes * 100;
                    //uploader.value = percentage;
                     elem.style.width = parseInt(percentage) + '%'; 
                     elem.innerHTML=parseInt(percentage)+'%';
                },
                function error(err){
    
                },
                function complete(){
                    document.getElementById("update").hidden = false;
                    var downloadURL = task.snapshot.downloadURL;
                    document.getElementById('mediaurl').value = downloadURL;
                    document.getElementById('type').value = ext.toString();


                }
            ); 
    }


    </script>
   

@endsection
