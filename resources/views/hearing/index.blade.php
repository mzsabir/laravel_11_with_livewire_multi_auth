<x-app-layout>
<div class="pagetitle">
      <h1>Case Hearings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
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
                <!-- Cases -->
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        
                        <div class="card-body" style="min-height: 350px;">
                           
                             
                               
                                <h5 class="card-title">ALL Hearings ({{$hearings->count()}})
                          
                        </h5>
                            @if(Auth()->user()->role=="lawyer")
                            <div class="float-start" style="margin:7px 5px 0 0"><a href="/case/create" class="btn btn-primary orange" style="font-size: 14px;"> Create New Hearing </a></div>
                            @endif
                                <table class="table table-borderless datatable" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Case</th>
                                            <th scope="col">Hearing Date</th>
                                            <th scope="col">Next Hearing</th>                                    
                                            <th scope="col">Result</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hearings as $h)
                                        <tr>
                                            <td scope="row"><a href="/case/{{$h->id}}" target="_blank">{{$h->case->title}}</a></td>
                                            <td><a href="/case/{{$h->id}}">{{date("d M Y", strtotime($h->hearing_date))}}</a> <a href="{{url('/brand/'.$h->id)}}" class="bi bi-eye-fill" target="_blank"></a></td>
                                            <td>{{date("d M Y", strtotime($h->next_hearing))}}</td>                                         
                                            <td>{{ucfirst($h->result)}}</td>
                                            <td><a href="">View</a></td>

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