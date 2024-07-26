@extends('backend.auth.layouts.app')
@section('page_title', 'Register')
@section('content')
<form action="{{ route('register') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="name" class="form-control @error('name') is-invalid @enderror " name="name" value="{{ old('name') }}" id="name" aria-describedby="nameHelp"
            placeholder="name">
        @error('name')
        <div id="nameHelp" class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" aria-describedby="emailHelp"
            placeholder="Email">
            @error('email')
            <div id="nameHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
        @error('password')
        <div id="nameHelp" class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password" placeholder="Password">
        @error('password_confirmation')
        <div id="nameHelp" class="form-text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember_me">
        <label class="form-check-label" for="remember_me">Remember me</label>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </div>
</form>
    <div class="mb-3 pt-2">
        <p class="my-0 py-0"> Allready registered?  <a href="{{ route('login') }}" class="fw-bold">Login</a></p>
        <p class="my-0 py-0">Forgot password? <a href="{{ route('password.request') }}" class="fw-bold">Forgot Password</a></p>
    </div>
@endsection
