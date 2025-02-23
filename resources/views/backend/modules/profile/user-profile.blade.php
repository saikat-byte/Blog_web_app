@extends('backend.layouts.app')

@section('page_title', 'Profile')

@section('page_sub_title', 'profile update')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
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
                <form action="{{ route('user-profile.store', $userProfile ? $userProfile->id : '') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone', $userProfile->phone ?? '') }}" id="phone" aria-describedby="phone"
                            placeholder="Phone">
                        @error('phone')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            value="{{ old('address', $userProfile->address ?? '') }}" id="address" aria-describedby="address"
                            placeholder="Address">
                        @error('address')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class=" col-md-12 mb-3">
                            <label for="country_id" class="form-label">Country</label>
                            <select name="country_id" id="country_id" class="form-select">
                                <option value="" selected>Select your country</option>
                                @foreach ($countries as $id => $name)
                                <option value="{{ $id }}" {{ $id == ($userProfile->country_id ?? '') ? 'selected' : '' }}>{{ $name
                                    }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="state_id" class="form-label">State</label>
                            <select name="state_id" id="state_id" class="form-select" disabled>
                                <option value="">Select State</option>
                            </select>
                            @error('state_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="city_id" class="form-label">City</label>
                            <select name="city_id" id="city_id" class="form-select" disabled>
                                <option value="" selected>Select City</option>
                            </select>
                            @error('city_id')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <p>Select gender</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" {{ old('gender', $userProfile->gender ?? '') == 'Male' ? 'checked' : '' }} />
                            <label class="form-check-label" for="male">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" {{ old('gender', $userProfile->gender ?? '') == 'Female' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="female">Female</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="others" value="Others" {{ old('gender', $userProfile->gender ?? '') == 'Others' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="others">Others</label>
                        </div>
                        @error('gender')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Update Profile</button>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3>Profile photo</h3>
                @if(!empty($userProfile->photo))
                @php
                    $photoUrl = asset('image/user/' . $userProfile->photo);
                @endphp
                <img id="previous_photo" src="{{ $photoUrl }}" class="img-thumbnail" alt="Profile Photo">
                @else
                    <p class="text-danger">No profile photo available</p>
                @endif
                <p id="upload_success_message" class="text-success"></p> <!-- Success message -->
            </div>
            <div class="card-body">
                <label for="profile_photo" class="badge text-bg-primary py-2">Upload profile picture</label>
                <input type="file" class="form-control my-2" name="profile_photo" id="profile_photo">
                <p class="text-danger" id="error_message"></p>
                <img id="img-preview" src="" alt="" class="img-thumbnail">
                <button id="image_upload_button" class="btn btn-success btn-sm my-2">Upload</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript">

    $('#profile_photo').on('change', function(e){
    let file = e.target.files[0];
    let reader = new FileReader();
    reader.onloadend = () =>{
        $('#img-preview').attr('src', reader.result);
    }
    reader.readAsDataURL(file);
});


$('#image_upload_button').on('click', function(){
    let photo = $('#img-preview').attr('src');

    if (photo) {
        $('#error_message').text(''); // Clear any previous errors

        axios.post('{{ route('upload.photo') }}', { photo: photo })
            .then(response => {
                if (response.data.success) {
                    // Update the photo in the UI
                    $('#previous_photo').attr('src', response.data.photo);
                    $('#img-preview').attr('src', '');
                    // Show success message
                    $('#upload_success_message').text(response.data.success);
                     // Reset the file input field
                     $('#profile_photo').val(''); // This will clear the file input
                } else {
                    // Handle errors from server
                    $('#error_message').text(response.data.msg);
                }
            })
            .catch(error => {
                console.error('There was an error uploading the photo:', error);
            });
    } else {
        $('#error_message').text('Please select a photo');
    }
});


    // Fetch state when select country
    const getStates = (country_id, selectedStateId = null) => {
        if (!country_id) return; // Add a guard clause to handle cases where country_id is not provided
        axios.get(`${window.location.origin}/user-states/${country_id}`).then(res => {
            let states = res.data;
            let element = $('#state_id');
            let city_element = $('#city_id').empty().append(`<option value="">Select City</option>`).attr('disabled', 'disabled');

            element.removeAttr('disabled');
            element.empty();
            element.append(`<option value="">Select State</option>`);

            states.forEach((state) => {
                element.append(`<option value="${state.id}" ${selectedStateId == state.id ? 'selected' : ''}>${state.name}</option>`);
            });

        }).catch(error => {
            console.error("There was an error fetching the states:", error);
        });
    }

    $('#country_id').on('change', function(){
        getStates($(this).val());
    });

    // Fetch city when select state
    const getCities = (state_id, selectedCityId = null) => {
        if (!state_id) return; // Add a guard clause to handle cases where state_id is not provided
        axios.get(`${window.location.origin}/user-cities/${state_id}`).then(res => {
            let cities = res.data;
            let element = $('#city_id');

            element.removeAttr('disabled');
            element.empty();
            element.append(`<option value="">Select City</option>`);

            cities.forEach((city) => {
                element.append(`<option value="${city.id}" ${selectedCityId == city.id ? 'selected' : ''}>${city.name}</option>`);
            });

        }).catch(error => {
            console.error("There was an error fetching the cities:", error);
        });
    }

    $('#state_id').on('change', function(){
        getCities($(this).val());
    });

    // On page load, if userProfile exists, populate states and cities
    const userProfile = @json($userProfile); // Convert $userProfile to JSON to handle null cases
    if (userProfile && userProfile.country_id) {
        getStates(userProfile.country_id, userProfile.state_id);
        if (userProfile.state_id) {
            getCities(userProfile.state_id, userProfile.city_id);
        }
    }
</script>


@endpush

@endsection
