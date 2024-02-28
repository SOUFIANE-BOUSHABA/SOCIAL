<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOCIAL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <!-- Add this line -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        nav {
            margin-top: -20px;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
        }

        .post-content {
            white-space: pre-line;
        }


        body {
            margin-top: 20px;
            background: #FAFAFA;
        }

        .people-nearby .google-maps {
            background: #f8f8f8;
            border-radius: 4px;
            border: 1px solid #f1f2f2;
            padding: 20px;
            margin-bottom: 20px;
        }

        .people-nearby .google-maps .map {
            height: 300px;
            width: 100%;
            border: none;
        }

        .people-nearby .nearby-user {
            padding: 20px 0;
            border-top: 1px solid #f1f2f2;
            border-bottom: 1px solid #f1f2f2;
            margin-bottom: 20px;
        }

        img.profile-photo-lg {
            height: 80px;
            width: 80px;
            border-radius: 50%;
        }



        .heartSvg:hover path {
            fill: red;
        }

        .commentSvg:hover path {
            fill: rgb(85, 15, 236);
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>

    <nav class="navbar shadow-sm navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h3>SOCIAL<span class="text-primary">ME</span> </h3>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <div class="d-flex" style="gap:400px">
                        <div class="d-flex">
                            <li class="nav-item">
                                <a class="nav-link" href="/home">Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/users">users</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="">Support</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">About</a>
                            </li>

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Notifications
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                        <a class="dropdown-item" href="">
                                            {{ $notification->data['liker_name'] }} <span class="text-primary">liked</span>  your post
                                        </a>
                                    @empty
                                        <div class="dropdown-item">No notifications</div>
                                    @endforelse
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="">Clear notifications</a>
                                </div>
                            </li> --}}
                            
                            
                          
                        </div>

                        <div class="d-flex">

                            @auth
                                <div class="d-flex gap-4 align-items-center">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                          @auth
                                              {{Auth::user()->name}}

                                          @endauth
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                            <a class="dropdown-item" href="{{ route('profil', auth()->id()) }}">Profil</a>
                                            <a class="dropdown-item text-danger" href="{{ route('delete-account') }}">Delete Account</a>
                                            <a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a>

                                        </div>
                                    </li>


                                </div>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Account
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>

                                    </div>
                                </li>
                            @endauth
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>
