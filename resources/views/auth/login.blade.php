{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - SneakersClean Club</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <style>
        /* Reset & base */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: #12121e;
            color: #fff;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            color: #a3a3ff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover,
        a:focus {
            color: #6b6bff;
            outline: none;
        }

        /* Header */
        header {
            background: #1f1f37;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-weight: 700;
            font-size: 1.3rem;
            color: #fbbf24;
            /* amber-400 */
            user-select: none;
        }

        /* Responsive header nav toggle */
        .mobile-menu-button {
            background: none;
            border: none;
            color: #fbbf24;
            font-size: 2rem;
            cursor: pointer;
            display: none;
        }

        nav.nav-links {
            display: flex;
            gap: 2rem;
        }

        nav.nav-links a {
            font-weight: 500;
            font-size: 1rem;
            color: #cccce0;
        }

        @media (max-width: 767px) {
            .mobile-menu-button {
                display: block;
            }

            nav.nav-links {
                display: none;
                flex-direction: column;
                background: #1f1f37;
                position: absolute;
                top: 60px;
                right: 0;
                width: 200px;
                padding: 1rem;
                border-radius: 8px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            }

            nav.nav-links.show {
                display: flex;
            }

            nav.nav-links a {
                padding: 0.75rem 0;
                border-bottom: 1px solid #333355;
            }
        }

        /* Main content */
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .login-container {
            background: 1E1E2D;
            border-radius: 16px;
            max-width: 900px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 3rem 3rem 3rem 4rem;
        }

        /* Left side image block */
        .image-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .branding {
            font-weight: 700;
            font-size: 1.8rem;
            color: #fbbf24;
            /* amber-400 */
            margin-bottom: 0.2rem;
        }

        .branding span.club {
            font-weight: 700;
            font-size: 1.8rem;
            color: white;
            margin-left: 0.1rem;
            display: inline-block;
            vertical-align: bottom;
        }

        .image-block img {
            max-width: 100%;
            border-radius: 16px;
            user-select: none;
            pointer-events: none;
        }

        /* Right login form block */
        .login-form-container {
            background: #2a2a4a;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            box-shadow: inset 0 0 12px rgba(255 255 255 / 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form-container h1 {
            margin-bottom: 2rem;
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
            color: white;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            position: relative;
            font-size: 0.9rem;
            color: #f0f0f0cc;
            margin-bottom: 0.4rem;
        }

        input[type=email],
        input[type=password] {
            background: rgb(255, 255, 255);
            border: none;
            border-radius: 9999px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            width: 100%;
            font-weight: 600;
            color: black;
            margin-bottom: 1.5rem;
            transition: background-color 0.3s ease;
        }

        input[type=email]:focus,
        input[type=password]:focus {
            outline: 2px solid #fbbf24;
            background: rgb(255, 255, 255);
        }

        button.login-button {
            background: #a3a3ff;
            border: none;
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 9999px;
            cursor: pointer;
            color: #1f1f37;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        button.login-button:hover,
        button.login-button:focus {
            background: #7b7be0;
            outline: none;
        }

        /* Back to landing link */
        .back-link {
            margin-top: 1rem;
            font-size: 0.8rem;
            text-align: center;
            color: #bcbcff;
        }

        .back-link a {
            font-weight: 700;
        }

        .back-link a:hover,
        .back-link a:focus {
            color: #fbbf24;
            outline: none;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .login-container {
                display: flex;
                flex-direction: column;
                padding: 2rem 1.5rem;
                gap: 2rem;
                max-width: 400px;
                margin: 0 auto;
                border-radius: 12px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.8);
            }

            .image-block {
                order: -1;
            }

            .image-block img {
                width: 100%;
                height: auto;
                border-radius: 12px;
            }

            .login-form-container {
                padding: 2rem 1.5rem;
                border-radius: 12px;
            }
        }

        @media (min-width: 1440px) {
            main {
                max-width: 1440px;
                margin: 0 auto;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main>
        <section class="login-container" aria-label="Login form container">
            <div class="image-block" role="img"
                aria-label="Sneakers cleaning illustration showing sneaker being cleaned">
                <div class="branding">Sneakers Clean <span class="club">Club</span></div>
                <img src="{{ asset('/LandingPage/image/logo-login.png') }}"
                    alt="Illustration of sneaker being cleaned by gloved hand on mat" draggable="false" loading="lazy"
                    width="400" height="350" />
            </div>

            <div class="login-form-container">
                <h1>Login</h1>
                <form novalidate method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="email">
                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>


                    </label>
                    <label for="password">
                        <input id="password" placeholder="Password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @if ($errors->has('login_failed'))
                            <div class="alert alert-danger">
                                {{ $errors->first('login_failed') }}
                            </div>
                        @endif

                    </label>
                    <button type="submit" class="login-button" aria-label="Submit login form">Login</button>
                </form>
                <p class="back-link">
                    <a href="{{ route('landingPage') }}" tabindex="0" aria-label="Back to landing page">Back to Landing
                        Page?</a>
                </p>
            </div>
        </section>
    </main>

    <script>
        // Mobile menu toggle for header navigation
        const mobileMenuBtn = document.querySelector('.mobile-menu-button');
        const navLinks = document.querySelector('nav.nav-links');
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('show');
        });
        // Close menu if window resized to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 767) {
                navLinks.classList.remove('show');
            }
        });
    </script>
</body>

</html>