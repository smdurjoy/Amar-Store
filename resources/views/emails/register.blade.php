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
            <td>Thanks for joining with us. Your account details are as below :</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Name:</strong> {{ $name }}</td>
        </tr>
        <tr>
            <td><strong>Mobile:</strong> {{ $mobile }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong> {{ $email }}</td>
        </tr>
        <tr>
            <td><strong>Password:</strong> ****** (as choosen by you)</td>
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