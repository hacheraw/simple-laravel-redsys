<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>amaroa.es</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            background-image: url({{ config('config.design.background') }});
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
            font-family: 'Open Sans', sans-serif;
        }

        .card {
            background-color: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            text-transform: uppercase;
        }
    </style>
    @yield('style')
</head>

<body>
    <div class="card">
        @yield('content')
    </div>
</body>

</html>
