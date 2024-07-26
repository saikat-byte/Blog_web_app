@extends('backend.auth.layouts.app')
@section('page_title', 'Forgot password')
@section('content')

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror "
                value="{{ old('email') }}" id="email" aria-describedby="emailHelp" placeholder="Email">
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-sm">Email Password Reset Link</button>
        </div>
    </form>
    <div class="mb-3 pt-2">
        <p class="my-0 py-0"> Allready have an account? <a href="{{ route('login') }}" class="fw-bold">Login</a></p>
        <p class="my-0 py-0">Register an account. <a href="{{ route('register') }}" class="fw-bold">Signup</a></p>
    </div>
@endsection
