<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Guest</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, pink, lightblue, lightyellow);
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            font-size: 20px;
            font-weight: bold;
            color: #a56cc1; 
        }
        .navbar a {
            text-decoration: none;
            color: #1e90ff;
            font-weight: bold;
        }
        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
            width: 500px;
        }
        .card h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #ff69b4; 
        }
        .card p {
            color: #333;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: linear-gradient(90deg, #ff69b4, #1e90ff, #ffeb3b);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Dashboard Guest</h1>
        <a href="/auth">Logout</a>
    </div>

    <div class="content">
        <div class="card">
            <h2>Selamat Datang {{$username}}!</h2>
            <p>Anda berhasil login.</p>

            <a class="btn" href="/jenis-dokumen">Lihat Jenis Dokumen</a>
        </div>
    </div>
</body>
</html>