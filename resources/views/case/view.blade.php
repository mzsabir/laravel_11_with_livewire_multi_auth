<x-app-layout>
<div class="pagetitle">
      <h1>Case: {{$case->title}}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">My Case</li>
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
                           
                            <h5 class="card-title">Case Information: </a></h5>
                            @if($case->status=="completed")
                                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                                    This Case is now cLosed. 
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @if($case->rating==0)
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                    <label>Rate and Feedback your Lawyer</label> 
                                    <form method="POST" action="/rate">
                                        @csrf
                                        <input name="rate" type="number" class="form-control" min="1" max="10" value="5">
                                        <textarea style="width: 100%;" name="comment" rows="5" placeholder="Your valueable feedback"></textarea>
                                        <input type="hidden"name="cid" value="{{$case->id}}">
                                        <input class="btn btn-primary" type="submit" value="Send Your Feedback">
                                    </form>
                                    </div>
                                </div>
                                @else
                                <div class="alert alert-secondary border-0 alert-dismissible fade show" role="alert">
                                     You gave {{$case->rating}}/10 
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                    
                                @endif
                            @endif
                            <div class="row">
                                <div class="col-md-3">Client Name: </div>
                                <div class="col-md-3">{{$client->name}}</div>
                                <div class="col-md-3">Case Type / Act </div>
                                <div class="col-md-3">{{$case->act}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Case Status: </div>
                                <div class="col-md-3">{{$case->status}}</div>
                                
                            </div> 
                            <h5 class="card-title">Lawyer Information: </a></h5>
                            <div class="row">
                            <div class="col-md-3">Lawer Name: </div>
                                <div class="col-md-3">{{$lawyer->name}}</div>
                               
                                <div class="col-md-3">Area of Specilization: </div>
                                <div class="col-md-3">{{$lawyer->area}}</div>
                            </div> 
                            <h5 class="card-title">Hearing History</a></h5>
                            @if($case->status=="in progress")
                                <div class="float-start" style="margin:7px 5px 0 0"><a href="/hearing/create" class="btn btn-primary orange" style="font-size: 14px;"> Create New Hearing </a></div>
                            @endif
                                <table class="table table-borderless datatable" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Hearing Date</th>
                                            <th scope="col">Court</th>
                                            <th scope="col">Judge</th>
                                            <th scope="col">Date Created</th>                                    
                                            <th scope="col">Result</th>
                                            <th scope="col">Next Hearing</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hearings as $h)
                                        <tr>
                                            <td scope="row"><a href="/hearing/{{$h->id}}" target="_blank">{{date("d M Y", strtotime($h->hearing_date))}}</a></td>
                                            <td>{{$h->court}}</td>
                                            <td>{{$h->judge}}</td>
                                            <td>{{date("d M Y", strtotime($h->hearing_date))}}</td>                                         
                                            <td>{{ucfirst($h->result)}} - <a href="/hearing/{{$h->id}}">View More</a></td>
                                            <td>{{date("d M Y", strtotime($h->next_date))}}</td>                                         
                                                                                     
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if(Auth()->user()->role!="client")
                                    @if($case->status=="pending")
                                    
                                    <a href="/accept/{{$case->id}}" class="btn btn-success">Approve this Case</a>
                                    <a href="/deny/{{$case->id}}" class="btn btn-danger">Reject this Case</a>
                                    @endif
                                    @if($case->status=="in progress")
                                    <a href="/close/{{$case->id}}" class="btn btn-success">Complete this Case</a>
                                    @endif
                                @endif
                                
                            </div>
                    </div>
                </div><!-- End Recent Sales -->
            </div>
        </section>

    </main><!-- End #main -->
   
</x-app-layout>