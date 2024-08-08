@extends('backend.layouts.app')

@section('page_title', 'Profile')

@section('page_sub_title', 'profile update')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <div class="card-header">
                <h3>Profile</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user-profile.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" id="phone" aria-describedby="phone" placeholder="Phone">
                        @error('phone')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            value="{{ old('address') }}" id="address" aria-describedby="address" placeholder="Address">
                        @error('address')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class=" col-md-12 mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select name="country" id="country" class="form-control">
                                <option value="" selected>Select your country</option>
                                @foreach($countries as $country)

                                <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="token" id="token" value="{{ $token }}">
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="state" class="form-label">State</label>
                            <select name="state" id="state" class="form-control">
                                <option value="" selected>Select your State</option>
                            </select>
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <select name="city" id="city" class="form-control">
                                <option value="1" selected>Select your city</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </form>
            </div>
        </div>

    </div>
</div>


@push('js')
<script type="text/javascript">
    $(document).ready(function () {
            $('#country').change(function (e) {
                e.preventDefault();
                var country = $(this).val();

                if (country == '') {
                    country = null;
                }

                var data = {
                    token : $('#token').val(),
                    country: country
                }
                $.ajax({
                type: "GET",
                url: "{{ route('states') }}",
                data: data,
                dataType: 'json',
                success: function (response) {
                    var states = response;
                    var html = '<option value="" >Select your State</option>';
                    if (states.length > 0) {
                        for(var i = 0; i < states.length; i++){
                            html += '<option value="'+ states[i]['state_name'] +'">' +
                                states[i]['state_name'] +
                                '</option>';
                        }
                        $('#state').html(html);
                    }
                },
                // Error handling
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                }
            });
            });


            // City fetch


            $('#state').change(function (e) {
                e.preventDefault();
                var state = $(this).val();

                if (state == '') {
                    state = null;
                }

                var data = {
                    token : $('#token').val(),
                    state: state
                }
                $.ajax({
                type: "GET",
                url: "{{ route('cities') }}",
                data: data,
                dataType: 'json',
                success: function (response) {
                    var cities = response;
                    var html = '<option value="" >Select your State</option>';
                    if (cities.length > 0) {
                        for(var i = 0; i < cities.length; i++){
                            html += '<option value="'+ cities[i]['city_name'] +'">' +
                                cities[i]['city_name'] +
                                '</option>';
                        }
                        $('#city').html(html);
                    }
                },
                // Error handling
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                }
            });
            });

        });
</script>
@endpush
@endsection
