<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Guest</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, pink, lightblue, lightyellow);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }
        .login-title {
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            color: #a56cc1; 
            font-size: 22px;
        }
        .login-box label {
            display: block;
            margin-top: 10px;
            text-align: left;
            font-weight: bold;
            color: #333;
        }
        .login-box input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 10px;
            border: 1px solid #ccc;
            outline: none;
        }
        .login-box input:focus {
            border-color: #1e90ff;
        }
        .login-box button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #ff69b4, #1e90ff, #ffeb3b); 
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .login-box button:hover {
            opacity: 0.9;
        }
        .message {
            margin-top: 15px;
            font-size: 14px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="card-body">
          
            <h2 class="login-title">Form Login</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ( $errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.store') }}" method="POST">
                @csrf
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}">

                <label>Password</label>
                <input type="password" name="password" value="{{ old('password') }}">

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>