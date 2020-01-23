<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        window.api_url = "http://localhost:8000/api/"
        window.api = (path) => {
            return window.api_url + path;
        }
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="bg-light container-fluid">

    <div class="row">
        <div class="col-2 pl-0 pr-0 bg-dark shadow-sm" style="min-height: 100vh">
            <nav class="navbar navbar-dark bg-info" style="height:70px;">
                <a href="" class="navbar-brand m-auto" style="letter-spacing:2px"><b>HOTELIN</b> </a>
            </nav>
        </div>
        <div class="col pl-0 pr-0">
            <nav class="navbar navbar-dark bg-white shadow-sm"style="height:70px">

            </nav>
            <div style="padding-left:20px;padding-right:20px">
                @yield('content')
            </div>
        </div>
    </div>

    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  @yield('script')
</body>
</html>
