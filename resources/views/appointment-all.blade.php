<x-app-layout>
    <div class="pagetitle">
        <h1>Appointments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">My Appitments</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <main id="min" class="mai">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('info'))
        <div class="alert alert-info bg-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle me-1"></i>
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <section class="section dashboard">
            <div class="row">
                <!-- Coupons -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">

                        <div class="card-body" style="min-height: 350px;">

                            <h5 class="card-title">Appointment Information: </a></h5>

                            <div class="row">
                                <div class="col-md-3">Client Name: </div>
                                <div class="col-md-3">{{$msg->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Subject </div>
                                <div class="col-md-6">{{$msg->Subject}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"Message: </div>
                                <div class="col-md-9">{{$msg->message}}</div>
                            </div>
                            
                            @if(Auth()->user()->role!=="client" && $msg->status=="pending") 
                                <h5 class="card-title">Set Date/Time for Appointment </a></h5>
                                    <form method="POST" action="/approve">
                                        @csrf
                                        <div class="my-2">
                                            <input name="app_date" type="date" class="form-control">
                                        </div>
                                        <div class="my-2">
                                        <textarea style="width: 100%;" name="description" rows="5" placeholder="Your valueable feedback"> Address: 24 Street, Block K, First floor
 Phone: +92155545455
 Email: mzsabie@gmail.com
                                        </textarea>
</div>
                                        <input type="hidden"name="aid" value="{{$msg->id}}">
                                        <input class="btn btn-primary" type="submit" value="Set Appointment">
                                    </form>  
                                    <form method="POST" action="/reject">
                                        @csrf                                        
                                        <input type="hidden"  name="aid" value="{{$msg->id}}">     
                                        <input class="btn btn-danger" type="submit" value="Reject Appointment">                                   
                                    </form>            
                            @endif
                           
                            <h5 class="card-title">My Appointments</a></h5>
                           
                           
                            <table class="table table-borderless datatable" id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Date Sent</th>
                                        <th scope="col">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $m)
                                    <tr>
                                        <td>{{$m->name}}</td>
                                        <td scope="row"><a href="/app/{{$m->id}}" target="_blank">{{$m->subject}}</a></td>
                                        
                                        <td></td>
                                        <td></td>
                                        <td><a href="/app/{{$m->id}}">View More</a></td>
                                        

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           

                        </div>
                    </div>
                </div><!-- End Recent Sales -->
            </div>
        </section>
    </main><!-- End #main -->

</x-app-layout>