{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrap">
        <h1>Reset Password</h1>

        <p class="info-text">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="input-box">
                <input id="email" type="email" name="email" placeholder="Email" :value="old('email')" value="{{ old('email') }}" required autofocus>
                <i class="fa-solid fa-envelope"></i>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">{{ __('Email Password Reset Link') }}</button>

            <div class="register">
                <p>Remembered your password? <a href="{{ route('login') }}">Login</a></p>
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
            text-align: center;
        }

        .wrap h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .wrap .info-text{
            font-size: 14.5px;
            margin-bottom: 20px;
            color: #fff;
        }

        .wrap .input-box{
            width: 100%;
            height: 50px;
            margin: 20px 0;
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
            margin-top: 20px;
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
            text-align: left;
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

