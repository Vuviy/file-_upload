<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="POST" action="/test">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
    <input type="text" name="email">
    <button type="submit">Send</button>
</form>

</body>
</html>