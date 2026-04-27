<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - {{ \App\Models\Setting::getVal('site_name', config('app.name', 'Bhagva')) }}</title>
    @if(\App\Models\Setting::getVal('site_favicon'))
        <link rel="icon" href="{{ Storage::url(\App\Models\Setting::getVal('site_favicon')) }}">
    @else
        <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Modern reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: #0f0f11;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Full screen split layout */
        .login-container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        .login-left {
            flex: 1.2;
            position: relative;
            background: url('{{ asset('images/login-bg.png') }}') center/cover no-repeat;
            display: none;
            overflow: hidden;
        }

        @media (min-width: 900px) {
            .login-left {
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 4rem;
            }
        }

        /* Glassmorphism overlay on the background */
        .login-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 15, 17, 0.95) 0%, rgba(255, 107, 0, 0.1) 100%);
            z-index: 1;
        }

        .brand-content {
            position: relative;
            z-index: 2;
            animation: fadeUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .brand-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.1;
            background: linear-gradient(135deg, #FF6B00 0%, #FF9500 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-content p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 500px;
            line-height: 1.6;
        }

        /* Form Side */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            background: #0f0f11;
        }

        .form-wrapper {
            width: 100%;
            max-width: 440px;
            animation: fadeIn 0.8s ease-out forwards;
            position: relative;
            z-index: 10;
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-header h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #8b8b93;
            font-size: 1rem;
        }

        /* Inputs */
        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group label {
            display: block;
            font-size: 0.9rem;
            color: #a1a1aa;
            margin-bottom: 0.5rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .input-group input:not([type="checkbox"]) {
            width: 100%;
            padding: 1rem 1.2rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-group input:not([type="checkbox"]):focus {
            background: rgba(255, 255, 255, 0.05);
            border-color: #FF6B00;
            box-shadow: 0 0 0 4px rgba(255, 107, 0, 0.1);
        }

        .input-group input:not([type="checkbox"]):focus + label {
            color: #FF6B00;
        }

        /* Button */
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #FF6B00 0%, #E65100 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 1rem;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 0, 0.3);
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Back to login link */
        .back-link {
            display: inline-block;
            margin-top: 2rem;
            color: #FF6B00;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #FF9500;
            text-decoration: underline;
        }

        /* Errors and Alerts */
        .alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            animation: shake 0.5s ease-in-out;
        }

        .alert ul {
            list-style: none;
            margin-top: 0.5rem;
        }

        .alert ul li {
            margin-bottom: 0.2rem;
        }

        .status-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #22c55e;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        /* Floating shapes for dynamic feel */
        .shape {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.5;
            animation: float 10s ease-in-out infinite alternate;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: rgba(255, 107, 0, 0.2);
            top: -100px;
            right: -100px;
            border-radius: 50%;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: rgba(255, 149, 0, 0.15);
            bottom: -150px;
            left: -150px;
            border-radius: 50%;
            animation-delay: -5s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(30px, 50px) rotate(20deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side: Branding & Image -->
        <div class="login-left">
            <div class="brand-content">
                <h1>Account Recovery</h1>
                <p>Don't worry, it happens to the best of us. We'll send you an email with instructions to reset your password and get back into your account.</p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-right">
            <!-- Decorative floating shapes -->
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>

            <div class="form-wrapper">
                <div class="form-header">
                    <h2>Reset Password</h2>
                    <p>Enter your email address to receive a password reset link.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="status-message">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert">
                        <strong>Whoops! Something went wrong.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    </div>

                    <button type="submit" class="btn-submit">
                        Email Password Reset Link
                    </button>
                    
                    <div style="text-align: center;">
                        <a href="{{ route('login') }}" class="back-link">&larr; Back to login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
