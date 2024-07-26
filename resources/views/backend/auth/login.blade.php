@extends('backend.auth.layouts.app')
@section('page_title', 'Login')
@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror " value="{{ old('email') }}" id="email" aria-describedby="emailHelp"
            placeholder="Email">
            @error('email')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror"  id="password" placeholder="Password">
        @error('password')
        <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
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
        <p class="my-0 py-0"> Create an account.  <a href="{{ route('register') }}" class="fw-bold">Register</a></p>
        <p class="my-0 py-0">Forgot password? <a href="{{ route('password.request') }}" class="fw-bold">Forgot Password</a></p>
    </div>
@endsection
