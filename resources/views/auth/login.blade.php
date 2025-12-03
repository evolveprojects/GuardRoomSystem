{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Session Status -->
    @if (session('status'))
        <div class="session-status">{{ session('status') }}</div>
    @endif

    <div class="wrap">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Login</h1>

            <!-- Email / Username -->
            <div class="input-box">
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                <i class="fa-solid fa-user"></i>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-box">
                <input id="password" type="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="container">
                <label>
                    <input id="remember_me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register">
                <p>Don't have an account Please Contact The Admin</p>
            </div>
        </form>
    </div>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('{{ asset('images/login-bg.jpg') }}') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .wrap{
            width: 420px;
            background-color: rgba(0,0,0,0.4);
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            padding: 30px 40px;
            color: #fff;
            border-radius: 10px;
        }

        .wrap h1 {
            font-size: 36px;
            text-align: center;
        }

        .wrap .input-box{
            width: 100%;
            height: 50px;
            margin: 30px 0;
            position: relative;
        }

        .input-box input{
            width: 100%;
            height: 100%;
            background: transparent;
            outline: none;
            border: 2px solid rgba(255, 255, 255,.2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder{
            color: #fff;
        }

        .input-box i{
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrap .container{
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .container label input {
            accent-color: #fff;
            margin-right: 3px;
        }

        .container a {
            color: #fff;
            text-decoration: none;
        }

        .container a:hover{
            text-decoration: underline;
        }

        .wrap .btn {
            width: 100%;
            height: 45px;
            background-color: #fff ;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow:  0 0 10px rgb(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .wrap .btn:hover{
            background: transparent;
            transition: 0.5s ease;
            color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            border: 2px solid rgba(255, 255, 255,.2);
        }

        .wrap .register{
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0px 15px;
        }

        .register p a{
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register p a:hover{
            text-decoration: underline;
        }

        .error{
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .session-status{
            text-align: center;
            margin-bottom: 15px;
            background-color: rgba(255,255,255,0.2);
            padding: 10px;
            border-radius: 6px;
            color: #fff;
        }
    </style>
</body>

</html>
