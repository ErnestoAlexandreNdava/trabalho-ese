<!DOCTYPE html>
<html>

<head>
    <title>Acesso Negado</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            font-size: 2rem;
            color: #333;
        }

        p {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2rem;
            color: #555;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: block;
            font-size: 1.2rem;
            margin: 20px auto 0;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            width: 100%;
            max-width: 300px;
        }

        button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <h1>Acesso Negado</h1>
    <p>Você não tem permissão para acessar esta página.</p>
    <button onclick="window.location.href='login.php'">Fazer login novamente</button>
</body>

</html>
