<x-app-layout>
<div class="pagetitle">
      <h1>Create New Case</h1>
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
                        <form action="{{route('case.store')}}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <!-- form -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="title" placeholder="Case Title" value="{{old('title')}}"/>
                                            @error('title') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <select name="lawyer_id" class="form-control brand-select" style="width:100%;">
                                                <option value="0">Select Lawyer</option>
                                                @foreach($lawyers as $lawyer)
                                                    <option value="{{$lawyer->id}}" {{ old('lawyer->id') ==  $lawyer->id ? 'selected' : '' }}>{{$lawyer->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('lawyer_id') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label>Caes Type</label>
                                            <select name="type" class="form-control" style=" padding: 5px 10px" wire:model="type">
                                                <option value="Murder Case (302)" {{ old('type') ==  'deal' ? 'selected' : '' }}>Murder Case (302)</option>
                                                <option value="Fraud Case (420)" {{ old('type') ==  'code' ? 'selected' : '' }}>Fraud Case (420)</option>                                                
                                            </select>
                                            @error('type') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                     
                                       
                                    </div>
                                    
                                  
                                                                      
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label>Cases Description</label>
                                            <textarea style="width: 100%;" rows="5" name="detail"></textarea>
                                            @error('detail') <span class="text-error">{{ $message }}</span> @enderror
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