@extends('layouts.app')

@section('content')


 <!-- Header -->
 <header class="masthead">
      <div class="container">
        <div class="intro-text">
         
          <div class="intro-heading">Admin Panel</div> 
          <!-- <a class="btn btn-xl js-scroll-trigger" href="#services">Tell Me More</a> -->
        </div>
      </div>
    </header>


@if ($email == 'valeednaveed@gmail.com')
 <!-- Portfolio Grid -->


                <div class="container"> 
                    
                    <br>
            <div class="col-lg-12 text-center">
            <h2 class="section-heading">Manage Users</h2>
                                @if (session('status'))
                <div class="alert alert-success" style="text-align: center; font-weight: bolder; ">
                 {{ session('status') }}
                                    </div>
                    @endif
          </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Delete</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($users as $user)

                                <tr>
                                    <td>{!! $user->email !!}</td>
                                    <td>{!! $user->id !!} </td>
                                    <td>{!! $user->name !!}</td>
                                        @if ($user->email == 'valeednaveed@gmail.com')
                                    <td> admin </td>
                                        @else
                                    <td>
<!--
                                            <form method="post">
                                                <input type="text" id="email" name="email" value="{{$user->email }}" hidden/ >
-->

<!--                                                <a type="submit" class="btn btn-danger">Delete</button>-->
                                                <a class="btn btn-danger" href="{{action('MediaController@deleteUser' , $user->email)}}">Delete</a>

<!--                                            </form>-->
                                    </td>

                                        @endif
                               
                                  
                                </tr>
                            
                            @endforeach    

                        </tbody>

                    </table>
                    </div> 



    <section class="bg-light" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Manage Media</h2>
          </div>
        </div>
        <div class="row">
            
@foreach($media as $x)

          @if ($x->mediaType == '4')
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#{!! $x->id !!}">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fa fa-plus fa-3x"></i>
                </div>
              </div>
<!--              <video class="img-fluid" src="{!! $x->mediaURL !!}" alt=""/>-->
                <video class="img-fluid d-block mx-auto" width="320" height="240" >
                    <source src="{!! $x->mediaURL !!}" >
                   </video>
            </a>
            <div class="portfolio-caption">
              <h3 style="color:gold;">Video</h3>
                @if ($x->showName == 'true')
              <h4>{!! $x->userName !!}</h4>
                @endif
              <p class="text-muted">{!! $x->destination !!}</p>
            </div>
              <br>
        <a class="btn btn-danger" href="{{action('MediaController@deleteMedia' , $x->id)}}">Delete</a>

          </div>
            @endif

            @if ($x->mediaType == 'g')

                <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" data-toggle="modal" href="#{!! $x->id !!}">
                  <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                      <i class="fa fa-plus fa-3x"></i>
                    </div>
                  </div>
                  <img class="img-fluid" src="{!! $x->mediaURL !!}" alt="">
                </a>
                <div class="portfolio-caption">
               <h3 style="color:gold;">Image</h3>
                    
                @if($x->showName == 'true')
              <h4>{!! $x->userName !!}</h4>
                @endif
              <p class="text-muted">{!! $x->destination !!}</p>
                </div>
                    
                     <br>
        <a class="btn btn-danger" href="{{action('MediaController@deleteMedia' , $x->id)}}">Delete</a>
                    
              </div>
            @endif
            
@endforeach
            
            
        </div>
      </div>
</section>



    <!-- Portfolio Modals -->

@foreach($media as $y)

          @if ($y->mediaType == '4')

    <div class="portfolio-modal modal fade" id="{!! $y->id !!}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2>{!! $y->destination !!}</h2>
                    
                   <video class="img-fluid d-block mx-auto" controls>
                    <source src="{!! $y->mediaURL !!}" >
                   </video>
                    
                  <ul class="list-inline">
                    <li>Date: {!! $y->created_at !!}</li>
                    <li>Destination: {!! $y->destination !!}</li>
                      @if ($y->showName == 'true')
                    <li>uploaded by : {!! $y->userName !!}</li>
                      @endif
                  </ul>

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
                          <label for="title" class="col-lg-2 control-label">Comment</label>
                          <div class="col-lg-10">
                               <textarea type="text" class="form-control" rows="5" id="comment" name="comment">
                              </textarea> 
                          </div>
                        </div>

  

                        <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="nameofuser" name="nameofuser"  >
                            </div>
                        </div>

                        <input type="text" value="{{ $y->id }}" id="mediaid" name="mediaid" hidden  >

                       


                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" id="update" class="btn btn-xl" >Comment</button>
                            </div>
                        </div>

                    </fieldset>
       
                  
                  </form> 
                    
                    
                    
                  <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                              <div class="page-header">
                                <h1><small class="pull-right"></small> Comments </h1>
                              </div> 
                               <div class="comments-list">

                              @foreach($comments as $comment)

                                    @if($y->id == $comment->mediaid)
                                   <div class="media">
                                       <p class="pull-right"><small>{{$comment->created_at}}</small></p>
                                        <a class="media-left" href="#">
                                          <img src="http://lorempixel.com/40/40/people/1/">
                                        </a>
                                        <div class="media-body">

                                          <h4 class="media-heading user_name">{{$comment->nameofuser}}</h4>
                                          {{$comment->comment}}

                                          <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
                                            
                                             
                                        <a class="btn btn-danger" href="{{action('MediaController@deleteComment' , $comment->id)}}">Delete</a>
                                            
                                        </div>
                                      </div>

                                  @endif
                              @endforeach


                       </div>



                            </div>
                        </div>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endif
          @if ($y->mediaType == 'g')


    <div class="portfolio-modal modal fade" id="{!! $y->id !!}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h2>{!! $y->destination !!}</h2>
                  <img class="img-fluid d-block mx-auto" src="{!! $y->mediaURL !!}" alt="">
                  <ul class="list-inline">
                    <li>Date: {!! $y->created_at !!}</li>
                    <li>Destination: {!! $y->destination !!}</li>
                     @if ($y->showName == 'true')

                    <li>uploaded by : {!! $y->userName !!}</li>
                      @endif
                  </ul>


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
                          <label for="title" class="col-lg-2 control-label">Comment</label>
                          <div class="col-lg-10">
                              <textarea type="text" class="form-control" rows="5" id="comment" name="comment">
                              </textarea> 
                              
                    
                              
                          </div>
                        </div>

  

                        <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="nameofuser" name="nameofuser"  >
                            </div>
                        </div>

                        <input type="text" value="{{ $y->id }}" id="mediaid" name="mediaid" hidden  >

                       


                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" id="update" class="btn btn-xl" >Comment</button>
                            </div>
                        </div>

                    </fieldset>
       
                  
                  </form> 

                  <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                              <div class="page-header">
                                <h1><small class="pull-right"></small> Comments </h1>
                              </div> 
                               <div class="comments-list">

                              @foreach($comments as $comment)

                                    @if($y->id == $comment->mediaid)
                                   <div class="media">
                                       <p class="pull-right"><small>{{$comment->created_at}}</small></p>
                                        <a class="media-left" href="#">
                                          <img src="http://lorempixel.com/40/40/people/1/">
                                        </a>
                                        <div class="media-body">

                                          <h4 class="media-heading user_name">{{$comment->nameofuser}}</h4>
                                          {{$comment->comment}}

                                          <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
                                           
                                        <a class="btn btn-danger" href="{{action('MediaController@deleteComment' , $comment->id)}}">Delete</a>
                                        </div>
                                      </div>

                                  @endif
                              @endforeach


                               </div>



                            </div>
                        </div>
                    </div>


                  <!-- <button class="btn btn-primary" data-dismiss="modal" type="button">
                    <i class="fa fa-times"></i>
                    Close Project</button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        @endif
@endforeach


@else 
<h1>You dont have admin rights</h1>
@endif


@endsection