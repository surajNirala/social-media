<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    <h2>Hi {{ $name }}</h2>,
    <br>
    You can reset Your password On {{ $resetEmail }}!
    <br>

    <a href="{{ url('resetpassword')}}">Reset Email</a>

    <br/>
</div>

</body>
</html>