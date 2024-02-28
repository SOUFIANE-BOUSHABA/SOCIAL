@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
    <!-- Post input -->
    <div class="container mt-5">
<div class="d-flex gap-2">
    <div class="col-md-8">
        <div class="card mb-3">

            <div class="card-body">
                <form method="post" action="{{ route('AddPost') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="3" placeholder="Write your post..."></textarea>
                    </div>
                    <button type="submit" value="Save" class="btn btn-primary mt-4">Post</button>
                </form>
            </div>
        </div>
    
    
        @foreach ($posts as $post)
            <div class="card shadow-sm border-0 p-4 mb-4">
                <div class="card-body">
                    <div class="mb-4 d-flex  justify-content-between">
                        <div class="d-flex gap-4 align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                            </svg>
                            <div class="ml-3">
                                <h5 class="mb-0">{{ $post->user->name }}</h5>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        @if (auth()->check() && auth()->id() === $post->user_id)
                            <form action="{{ route('DeletePost', $post->id) }}"method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span></button>
                            </form>
                        @endif
                    </div>
    
                    <p class="post-content">{{ $post->content }} </p>
    
    <hr class="mb-4 text-gray mt-4">
                    <div class=" d-flex  justify-content-between">
    
                        <div>
                            <form action="{{ route('PostLike', ['id' => $post->id]) }}" method="post">
                                @csrf
                                @method('POST')
    
                                <button class="btn d-flex gap-3 align-items-center" type="submit">
                                    @if ($post->likes->contains('user_id', auth()->id()))
                                        <svg xmlns="http://www.w3.org/2000/svg" class="heartSvg" style="width: 20px  ;"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path style="fill:red;"
                                                d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="heartSvg" style="width: 20px ; "
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                        </svg>
                                    @endif
                                    <span class="likesNumber">{{ $post->likesCount }}</span>
                                </button>
                            </form>
    
    
                        </div>
    
    
                        <!-- Comment-->
                        <a href="{{ route('Comment', ['id' => $post->id]) }}">
                            @csrf
                            <button class="btn d-flex gap-3 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z" />
                                </svg>
                                <span class="">{{ $post->comments->count() }}</span>
                            </button>
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M400 255.4V240 208c0-8.8-7.2-16-16-16H352 336 289.5c-50.9 0-93.9 33.5-108.3 79.6c-3.3-9.4-5.2-19.8-5.2-31.6c0-61.9 50.1-112 112-112h48 16 32c8.8 0 16-7.2 16-16V80 64.6L506 160 400 255.4zM336 240h16v48c0 17.7 14.3 32 32 32h3.7c7.9 0 15.5-2.9 21.4-8.2l139-125.1c7.6-6.8 11.9-16.5 11.9-26.7s-4.3-19.9-11.9-26.7L409.9 8.9C403.5 3.2 395.3 0 386.7 0C367.5 0 352 15.5 352 34.7V80H336 304 288c-88.4 0-160 71.6-160 160c0 60.4 34.6 99.1 63.9 120.9c5.9 4.4 11.5 8.1 16.7 11.2c4.4 2.7 8.5 4.9 11.9 6.6c3.4 1.7 6.2 3 8.2 3.9c2.2 1 4.6 1.4 7.1 1.4h2.5c9.8 0 17.8-8 17.8-17.8c0-7.8-5.3-14.7-11.6-19.5l0 0c-.4-.3-.7-.5-1.1-.8c-1.7-1.1-3.4-2.5-5-4.1c-.8-.8-1.7-1.6-2.5-2.6s-1.6-1.9-2.4-2.9c-1.8-2.5-3.5-5.3-5-8.5c-2.6-6-4.3-13.3-4.3-22.4c0-36.1 29.3-65.5 65.5-65.5H304h32zM72 32C32.2 32 0 64.2 0 104V440c0 39.8 32.2 72 72 72H408c39.8 0 72-32.2 72-72V376c0-13.3-10.7-24-24-24s-24 10.7-24 24v64c0 13.3-10.7 24-24 24H72c-13.3 0-24-10.7-24-24V104c0-13.3 10.7-24 24-24h64c13.3 0 24-10.7 24-24s-10.7-24-24-24H72z"/></svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="col-md-4  ">
        <div class="card trending">
            <div class="card-body">
                <h5 class="card-title">Trending</h5>
                <li class="list-group-item">
                    <div class="d-flex gap-3 mb-2">
                        <img src="https://source.unsplash.com/random/50x50" alt="Trending Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="mt-2">
                            <h6>{{ Str::random(5) }}</h6>
                            <p>{{ Str::words(Str::random(10), 10) }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <img src="https://source.unsplash.com/random/50x50" alt="Trending Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="mt-2">
                            <h6>{{ Str::random(5) }}</h6>
                            <p>{{ Str::words(Str::random(10), 10) }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <img src="https://source.unsplash.com/random/50x50" alt="Trending Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="mt-2">
                            <h6>{{ Str::random(5) }}</h6>
                            <p>{{ Str::words(Str::random(10), 10) }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <img src="https://source.unsplash.com/random/50x50" alt="Trending Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="mt-2">
                            <h6>{{ Str::random(5) }}</h6>
                            <p>{{ Str::words(Str::random(10), 10) }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <img src="https://source.unsplash.com/random/50x50" alt="Trending Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="mt-2">
                            <h6>{{ Str::random(5) }}</h6>
                            <p>{{ Str::words(Str::random(10), 10) }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <img src="https://source.unsplash.com/random/50x50" alt="Trending Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="mt-2">
                            <h6>{{ Str::random(5) }}</h6>
                            <p>{{ Str::words(Str::random(10), 10) }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <img src="https://source.unsplash.com/random/50x50" alt="Trending Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="mt-2">
                            <h6>{{ Str::random(5) }}</h6>
                            <p>{{ Str::words(Str::random(10), 10) }}</p>
                        </div>
                    </div>
                    
                </li>
            </div>
        </div>    
    </div>        
   
</div>
       






        <script>
            const button = document.querySelector('.secondary');
            const menu = document.querySelector('.dropdown-menu');

            button.addEventListener('click', () => {
                menu.classList.toggle('d-none');
            });
        </script>

        <style>
            .dropdown-menu {
                position: absolute;
                background-color: #fff;
                border: 1px solid #ddd;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                padding: 5px;
                list-style: none;
                display: none;
            }

            .secondary:hover+.dropdown-menu {
                display: block;
            }

        </style>



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (Session::has('success'))
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
