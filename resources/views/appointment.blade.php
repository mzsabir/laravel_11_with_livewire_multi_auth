<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>Book An Appointment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="{{url('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/animate.css')}}">
    
    <link rel="stylesheet" href="{{url('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{url('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{url('css/aos.css')}}">

    <link rel="stylesheet" href="{{url('css/ionicons.min.css')}}">
    
    <link rel="stylesheet" href="{{url('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{url('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    
	  <nav class="navbar px-md-0 navbar-expand-lg navbar-dark ftco_navbar bg-dark " id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="/">Best Lawyer <span>Plateform to find Justice</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	       <livewire:sections.home-nav/>
	      </div>
	    </div>
	  </nav>
	  
	 
	  <h2 style="margin: 0 auto; padding:10px 0; text-align:center; font-size:30px">Book An Appointment</h2>
    <!-- END nav -->
   	<livewire:sections.search-lawyer/>

     @if(session()->has('success'))
    <p style="color:green; text-align:center">
        {{ session()->get('success') }}
    </p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
     <section class="ftco-section ftco-no-pt" style="z-index: -1; position:relative">
    	<div class="container-fluid px-md-5">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
          	<span class="subheading">Discuss your Case with</span>
            <h2 class="mb-4">Our Legal Attorney</h2>
          </div>
        </div>
		
        <div class="row">
        	<div class="col-lg-3 col-sm-6">
        		<div class="block-2 ftco-animate fadeInUp ftco-animated">
	            <div class="flipper">
	              <div class="front" style="background-image: url('{{url('images/users/'.$lawyer->picture)}}')">
	                <div class="box">
	                  <h2>{{$lawyer->name}}</h2>
	                  <p>{{$lawyer->area}}</p>
	                </div>
	              </div>
	              <div class="back">
	                <!-- back content -->
	                <blockquote>
	                  <p>“Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text ”</p>
	                </blockquote>
	                <div class="author d-flex">
	                  <div class="image align-self-center">
	                    <img src="{{url('images/users/'.$lawyer->picture)}}" alt="{{$lawyer->name}}">
	                  </div>
	                  <div class="name align-self-center ml-3">Ryan Anderson <span class="position">Civil Lawyer</span></div>
	                </div>
	              </div>
	            </div>
	          </div>
        	</div>
        	<div class="col-lg-6 col-sm-6">
        		<h2 style="font-size: 30px;">{{$lawyer->name}}</h2>
            <h2 style="font-size: 24px;">8 Year of Experence as {{$lawyer->area}}</h2>   
            <h2 style="font-size: 30px;">{{$lawyer->name}}</h2> 
            <br><br>        
            <h2>Use the form below to contact for inital appoitment</h2>

        	</div>
        	
        
        </div>
    	</div>
    </section>

     <section class="ftco-consultation ftco-section ftco-no-pt ftco-no-pb img" style="background-image: url(http://127.0.0.1:8000/images/bg_2.jpg);">
    <div class="overlay"></div>
    	<div class="container">
    		<div class="row d-md-flex justify-content-end">
    			<div class="col-md-6 half p-3 py-5 pl-md-5 ftco-animate heading-section heading-section-white">
    				<span class="subheading" style="color:#a52a2a">Book an appointment with {{$lawyer->name}}</span>
    				<h2 class="mb-4">Free Consultation</h2>
    				<form  class="consultation" action="{{ route('appointment.book') }}" method="POST">
              @csrf
	            <div class="form-group">
	              <input type="text" class="form-control" name="name" placeholder="Your Name">
	            </div>
	            <div class="form-group">
	              <input type="text" class="form-control" name="email" placeholder="Your Email">
	            </div>
	            <div class="form-group">
	              <input type="text" class="form-control" name="subject" placeholder="Subject">
	            </div>
	            <div class="form-group">
	              <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                <input type="hidden" name="lawyer_id" value="{{$lawyer->id}}">
                <input type="hidden" name="client_id" value="{{$uid}}">
	            </div>
	            <div class="form-group">
	              <input type="submit" value="Send message" class="btn btn-dark py-3 px-4">
	            </div>
	          </form>
    			</div>
    		</div>
    	</div>
    </section>
	

   
		

   
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="logo"><a href="#">Legalcare <span>A Law Firm Agency</span></a></h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Practice Areas</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Family Law</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Business Law</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Insurance Law</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Criminal Law</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Drug Offenses</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Fire Accident</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Employment Law</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>Property Law</a></li>

              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Business Hours</h2>
              <div class="opening-hours">
              	<h4>Opening Days:</h4>
              	<p class="pl-3">
              		<span>Monday – Friday : 9am to 20 pm</span>
              		<span>Saturday : 9am to 17 pm</span>
              	</p>
              	<h4>Vacations:</h4>
              	<p class="pl-3">
              		<span>All Sunday Days</span>
              		<span>All Official Holidays</span>
              	</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

  <p>
      Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This project is developed By 
  	  <a style="color: white;" href="#">Hassan Rasheed</a> - 
      <a style="color: white;" href="#">Zohaib Bhervi</a> -
      <a style="color: white;" href="#">Ali haider Khan</a>
      </p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{url('js/jquery.min.js')}}"></script>
  <script src="{{url('js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{url('js/popper.min.js')}}"></script>
  <script src="{{url('js/bootstrap.min.js')}}"></script>
  <script src="{{url('js/jquery.easing.1.3.js')}}"></script>
  <script src="{{url('js/jquery.waypoints.min.js')}}"></script>
  <script src="{{url('js/jquery.stellar.min.js')}}"></script>
  <script src="{{url('js/owl.carousel.min.js')}}"></script>
  <script src="{{url('js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{url('js/aos.js')}}"></script>
  <script src="{{url('js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{url('js/scrollax.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{url('js/google-map.js')}}"></script>
  <script src="{{url('js/main.js')}}"></script>
    
  </body>
</html>