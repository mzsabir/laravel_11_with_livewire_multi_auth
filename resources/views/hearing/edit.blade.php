@extends('layouts.admin_nolive')
@section('page_title','Edit Coupon')
@section('page_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-results__option,
    .select2-selection__choice__display {
        font-size: 12px;
    }
</style>
@endsection
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Coupon</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item"><a href="/admin/coupon">Coupons</a></li>
                <li class="breadcrumb-item">Edit</li>
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
                        Edit Coupon
                    </div>
                    <div class="card-body">
                        <form action="{{ route('coupon.update',$coupon->id) }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            @method('PUT')
                            <!-- form -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input class="form-control" type="text" name="text" placeholder="Coupon Text" value="{{ old('text', $coupon->text)}}" />
                                            @error('text') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" type="text" name="short_text" placeholder="Coupon Display Text" value="{{ old('short_text',$coupon->short_text)}}" />
                                            @error('short_text') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <select name="brand_id" class="form-control" style="font-size: 12px; padding: 5px 10px">
                                                <option value="0">Select Brand/Store</option>
                                                @foreach($brands as $brand)
                                                <option @selected(old('brand_id', $brand->id) == $coupon->brand_id) value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Type</label>
                                            <select name="type" class="form-control" style="font-size: 12px; padding: 5px 10px">
                                                <option value="0" @selected('type'=='0' )>Select Type</option>
                                                <option value="code" @selected(old('type',$coupon->type) == 'code')>Code</option>
                                                <option value="deal" @selected(old('type',$coupon->type) == 'deal')>Deal</option>
                                            </select>
                                            @error('type') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Code (optional)</label>
                                            <input class="form-control" type="text" name="code" value="{{ old('code', $coupon->code)}}" placeholder="Code" />
                                            @error('code') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label>Expiry</label>
                                            <input class="form-control" type="date" name="expiry" value="{{ old('expiry',$coupon->expiry)}}" />
                                            @error('expiry') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Select Categories: </label>
                                            <select name="cats[]" multiple class="category-select" style="width: 100%;">
                                                @foreach($categories as $c)
                                                <option value="{{$c->id}}" {{ in_array($c->id, $selected_cats) ? 'selected' : '' }}>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('cats') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Select Events (optional): </label>
                                            <select name="events[]" multiple class="event-select" style="width: 100%;">
                                                @foreach($events as $e)
                                                <option value="{{$e->id}}" {{ in_array($e->id, $selected_events) ? 'selected' : '' }}>{{$e->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('events') <span class="text-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Affiliate Link</label>
                                        <input class="form-control" type="text" name="aflink" placeholder="https://www.examples.com/" value="{{ old('aflink', $coupon->aflink)}}" />
                                        @error('aflink') <span class="text-error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12" style="margin: 10px 0;">
                                            <span><label>Choices: </label></span>
                                            <span style="margin-left: 15px; font-size:11px"><input type="checkbox" name="exclusive" {{ old('exclusive',$coupon->exclusive)!=NULL ? 'checked="checked"' : '' }} id="exclusive"/> Exclusive</span>
                                            <span style="margin-left: 15px; font-size:11px"><input type="checkbox" name="trending" {{ old('trending',$coupon->trending) ? 'checked="checked"' : '' }}/> Trending</span>
                                            <span style="margin-left: 15px; font-size:11px"><input type="checkbox" name="top" {{ old('top',$coupon->top) ? 'checked="checked"' : '' }}/> Top</span>
                                            <span style="margin-left: 15px; font-size:11px"><input type="checkbox" name="display_home" {{ old('display_home',$coupon->display_home) ? 'checked="checked"' : '' }}/> Display at Home Page</span>
                                    </div>                                    
                                    <div class="row" id="exclusive_row" {{ $coupon->exclusive==NULL ? ' style=display:none;' : '' }}>
                                        <div class="col-md-12">
                                        <input type="file" class="form-control" name="exc_image">
                                        @if($coupon->exclusive!=NULL)
                                            <img src="{{url('images/exclusive/'.$coupon->exclusive)}}" width="200">
                                        @endif
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Coupon Description</label>
                                            <textarea style="width: 100%;" rows="5" name="description">{{ old('description',$coupon->description)}}</textarea>
                                            @error('description') <span class="text-error">{{ $message }}</span> @enderror
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

</main>
@endsection

@section('page_js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.category-select').select2();
        $('.brand-select').select2();
        $('.event-select').select2();
        $("#exclusive").change(function(){
                $("#exclusive_row").slideToggle();
        });
    });
</script>
@endsection