<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
    <meta http-equiv="refresh" content="0;url={{ $url }}">
    <script>
        window.open('{{ $url }}', '_blank');
    </script>
</head>
<body>
    <p>If you are not redirected automatically, <a href="{{ $url }}" target="_blank">click here</a>.</p>
</body>
</html>
