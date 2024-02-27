@extends('auth.layouts')
@section('content')
<link rel="stylesheet" href="css/login.css.css">
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="{{ route('save') }}" method="put">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gender" class="col-md-4 col-form-label text-md-end text-start">Gender</label>
                        <div class="col-md-6">
                        <input type="radio" id="gender" name="gender" value="Male">
                        <label for="gender" class="col-md-4 col-form-label text-md-end text-start">Male</label>
                        <input type="radio" id="gender" name="gender" value="Female">
                        <label for="gender" class="col-md-4 col-form-label text-md-end text-start">Female</label>          
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                         </div>
                         <div class="mb-3 row">
                         <label for="countries" class="col-md-4 col-form-label text-md-end text-start">Country</label>
                         <div class="col-md-6">
                         <select name="countries" id="countries" class="form-control-md form-control"   required>
                                <option value="">Select Country</option>
                                @if (!empty($countries))
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        </div>
                        <div class="mb-3 row">
                         <label for="state" class="col-md-4 col-form-label text-md-end text-start"   required={required}>State</label>
                         <div class="col-md-6">
                         <select name="state" id="state" class="form-control-md form-control">
                                <option value="">Select State</option>
                            </select>
                        </div>
                     </div>
                <div class="mb-3 row">
                         <label for="city" class="col-md-4 col-form-label text-md-end text-start"   required={required}>City</label>
                         <div class="col-md-6">
                         <select name="city" id="city" class="form-control-md form-control">
                         <option value="">Select City</option>
                         </select>
                    </div>
                </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                    </div>    
                </form>
            </div>
        </div>
    </div>    
</div>   
<script>
    $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
   });
   $(document).ready(function(){
        $("#countries").change(function(){
            var country_id = $(this).val();

            if (country_id == "") {
                var country_id = 0;
            } 

            $.ajax({
                url: '{{ url("/fetch-states/") }}/'+country_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {                    
                    $('#state').find('option:not(:first)').remove();
                    $('#city').find('option:not(:first)').remove();

                    if (response['states'].length > 0) {
                        $.each(response['states'], function(key,value){
                            $("#state").append("<option value='"+value['id']+"'>"+value['name']+"</option>")
                        });
                    } 
                }
            });            
        });

        $("#state").change(function(){
            var state_id = $(this).val();
            console.log(state_id);
            if (state_id == "") {
                var state_id = 0;
            } 
            $.ajax({
                url: '{{ url("/fetch-cities/") }}/'+state_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {                    
                    $('#city').find('option:not(:first)').remove();

                    if (response['cities'].length > 0) {
                        $.each(response['cities'], function(key,value){
                            $("#city").append("<option value='"+value['id']+"'>"+value['name']+"</option>")
                        });
                    } 
                }
            });            
        });

   });

</script>
@endsection

