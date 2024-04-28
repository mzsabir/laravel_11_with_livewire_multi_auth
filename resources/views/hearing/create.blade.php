<x-app-layout>
<div class="pagetitle">
      <h1>Create New Case Hearing</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Cases</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.
    </div>
    @endif
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Create New Case
                    </div>
                    <div class="card-body">
                        <form action="{{route('hearing.store')}}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <!-- form -->                          
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">                                        
                                        <div class="col-md-12">
                                            <select name="case_id" class="form-control brand-select" style="width:100%;">
                                                <option value="0">Select Case</option>
                                                @foreach($cases as $case)
                                                    <option value="{{$case->id}}" {{ old('case->id') ==  $case->id ? 'selected' : '' }}>{{$case->act}} - {{$case->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('case_id') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <label>Court</label>
                                        <div class="col-md-8">
                                            <select name="court" class="form-control brand-select" style="width:100%;">
                                                <option value="0">Select court of hearing</option>  
                                                    <option value="Local Court">Local Court</option> 
                                                    <option value="District Court">District Court</option>   
                                                    <option value="Session Court">Session Court</option>                                           
                                                    <option value="High Court">High Court</option>
                                                    <option value="Supreme Court">Supreme Court</option>
                                                   
                                            </select>
                                            @error('court') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <select name="city" class="form-control brand-select" style="width:100%;">
                                                <option value="Islamabad">Islamabad</option>
                                                <option value="Rawalpindi">Rawalpindi</option>
                                                <option value="Lahore">Lahore</option>
                                                <option value="Peshawar">Peshawar</option>
                                                <option value="Peshawar">Peshawar</option>
                                                <option value="Quetta">Quetta</option>
                                            </select>
                                            @error('city') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="judge" placeholder="Name of Judge">
                                            @error('judge') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label>Hearing Date</label>
                                           <input type="date" class="form-control" name="hearing_date">
                                            @error('hearing_date') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Next Hearing Date</label>
                                           <input type="date" class="form-control" name="next_date">
                                            @error('next_date') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                

                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label>Hearing Comment</label>
                                            <textarea style="width: 100%;" rows="5" name="comment"></textarea>
                                            @error('comment') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label>Result`</label>
                                            <textarea style="width: 100%;" rows="5" name="result"></textarea>
                                            @error('result') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div> <!-- 8 Column -->
                            </div> <!-- main row -->
                            <button class="btn btn-primary" type="submit">Submit<button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</x-app-layout>