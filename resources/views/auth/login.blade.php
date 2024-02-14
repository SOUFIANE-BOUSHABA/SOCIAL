@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <img src="{{ asset('images/login.jpg') }}" alt="Login Image" class="img-fluid">
        </div>

        <div class="col-md-5 " style="margin-top: 150px">
            <div class="card border-0">

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="">
                        @csrf

                        <div class="mb-3">
                            <input type="email" class="form-control border-0 border-bottom" id="email" name="email" value="{{ old('email') }}" required  placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control border-0 border-bottom" id="password" name="password" required placeholder="Enter your password">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
       
        @if(Session::has('success'))
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "success",
            title: "{{ Session::get('success') }}"
            });
        @endif
    });
</script>
@endsection