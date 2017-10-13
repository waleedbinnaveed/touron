@extends('layouts.app')

@section('content')


 <!-- Header -->
 <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">Inspired from travelling Enthusisats</div>
          <img class="" src="site-content/img/logo2.png" width="400" height="400" alt="">
          <div class="intro-heading">Scroll to see what is happening around</div> 
          <!-- <a class="btn btn-xl js-scroll-trigger" href="#services">Tell Me More</a> -->
        </div>
      </div>
    </header>



 <!-- Portfolio Grid -->
    <section class="bg-light" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Portfolio</h2>
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
              <h4>{!! $x->userName !!}</h4>
              <p class="text-muted">{!! $x->destination !!}</p>
            </div>
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
              <h4>{!! $x->userName !!}</h4>
              <p class="text-muted">{!! $x->destination !!}</p>
                </div>
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
                    <li>uploaded by : {!! $y->userName !!}</li>
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
                              <textarea type="text" class="form-control" id="comment" name="comment">Comment Here!
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
                    <li>uploaded by : {!! $y->userName !!}</li>
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
                              <textarea type="text" class="form-control" id="comment" name="comment">Comment Here!
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



@endsection