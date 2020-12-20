<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear <strong>{{ $name }}</strong> !</td>
        </tr>
        <tr>
            <td>Please click the link below to activate your account :</td>
        </tr>
        <tr>
            <td><strong><a href="{{ url('/confirm/'.$code) }}">Confirm Account</a></strong></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Thanks, Stay Safe :)</td>
        </tr>
        <tr>
            <td><strong>Amar Store</strong></td>
        </tr>
    </table>
</body>
</html>