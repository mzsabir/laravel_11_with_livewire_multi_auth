<x-app-layout>
<div class="pagetitle">
      <h1>Lawyer Dashboard</h1>
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
                            @if(isset($filter))
                                @if(is_numeric($filter))
                                    <h5 class="card-title">{{ucfirst($brand->brand_name)}} ({{$cases->count()}}) | <a class="btn btn-sm bi bi-tag-fill" href="/admin/coupon">All</a>
                                @else
                                    <h5 class="card-title">{{ucfirst($filter)}} Coupons({{$cases->count()}}) | <a class="btn btn-sm bi bi-tag-fill" href="/admin/coupon">All</a>
                                @endif
                            @else
                                <h5 class="card-title">ALL Cases ({{$cases->count()}})
                            @endif
                            
                            | <a class="btn btn-sm bi bi-tag-fill" style="color:green" href="/case/pending">Pending Cases</a>
                            | <a class="btn btn-sm bi bi-tag-fill" style="color:green" href="/case/completed">Completed Cases</a>
                            <a class="btn btn-sm bi bi-tag-fill" style="color:green" href="/case/completed">In progress</a>
                        </h5>
                            <div class="float-start" style="margin:7px 5px 0 0"><a href="/case/create" class="btn btn-primary orange" style="font-size: 14px;"> Create New Case </a></div>
                            <!-- <div class="float-end" style="margin-right:5px">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected="">All Brands</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div> -->
                                <table class="table table-borderless datatable" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Case</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Date Created</th>                                    
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cases as $c)
                                        <tr>
                                            <td scope="row"><a href="/case/{{$c->id}}" target="_blank">{{substr($c->title,0,50)}}</a></td>
                                            <td><a href="/case/{{$c->id}}">{{$c->act}}</a> <a href="{{url('/brand/'.$c->slug)}}" class="bi bi-eye-fill" target="_blank"></a></td>
                                            <td>{{date("d M Y", strtotime($c->created_at))}}</td>
                                         
                                            <td>{{ucfirst($c->status)}}</td>
                                                                                     
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