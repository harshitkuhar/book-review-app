<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="container-fluid shadow-lg header">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h1 class="text-center"><a href="{{route('home.books')}}" class="h3 text-white text-decoration-none">Book Review App</a></h1>
                <div class="d-flex align-items-center navigation">
                    @if (Auth::check())
                        <a href="{{route('account.profile')}}" class="text-white">My Account</a>
                    @else
                        <a href="{{route('account.login')}}" class="text-white">Login</a>
                        <a href="{{route('account.register')}}" class="text-white ps-2">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif

        <div class="container">
            <div class="row my-5">
            @if ( Auth::check() && !Route::is('home.books') && !Route::is('home.singlebook') )
                <div class="col-md-3">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header  text-white">
                            Welcome,
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{asset('/images/user/'.Auth::user()->image)}}" width="100" class="img-fluid rounded-circle" alt="{{Auth::user()->name}}">
                            </div>
                            <div class="h5 text-center">
                                <strong>{{Auth::user()->name}}</strong>
                                <p class="h6 mt-2 text-muted">5 Reviews</p>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-lg mt-3">
                        <div class="card-header  text-white">
                            Navigation
                        </div>
                        <div class="card-body sidebar">
                            <ul class="nav flex-column">
                                @if (Auth::user()->role == 'admin')
                                    <li class="nav-item">
                                        <a href="{{route('book.index')}}">Books</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('review.index')}}">Reviews</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{route('account.profile')}}">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('review.my', Auth::user()->id)}}">My Reviews</a>
                                </li>
                                <li class="nav-item">
                                    <a href="change-password.html">Change Password</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('account.logout')}}">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif


    @yield('content')

    @yield('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
