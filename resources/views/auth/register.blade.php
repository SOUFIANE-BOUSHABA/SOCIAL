@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6"  style="margin-top:60px">
            <img src="{{ asset('images/login.jpg') }}" alt="Your Image" class="img-fluid">
        </div>
        <div class="col-md-6" style="margin-top:100px">
            <div class="card border-0">

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('registerUser') }}">
                        @csrf
                    
                        <div class="mb-3">
                            <input type="text" class="form-control border-0 border-bottom" id="name" name="name" value="{{ old('name') }}"  placeholder="Enter your name">
                        </div>
                    
                        <div class="mb-3">
                            <input type="email" class="form-control border-0 border-bottom" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                        </div>
                    
                        <div class="mb-3">
                            <input type="password" class="form-control border-0 border-bottom" id="password" name="password" required placeholder="Enter your password">
                        </div>
                    
                        <div class="mb-3">
                            <input type="password" class="form-control border-0 border-bottom" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection