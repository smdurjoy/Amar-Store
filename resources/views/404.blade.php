<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script>
    <style type="text/css">
        body {
            background-color: #343A40;
        }
        .mainbox {
            background-color: #343A40;
            margin: auto;
            height: 600px;
            width: 600px;
            position: relative;
        }
        .err {
            color: #ffffff;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 11rem;
            position:absolute;
            left: 20%;
            top: 8%;
        }
        .far {
            position: absolute;
            font-size: 8.5rem;
            left: 42%;
            top: 15%;
            color: #ffffff;
        }
        .err2 {
            color: #ffffff;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 11rem;
            position:absolute;
            left: 68%;
            top: 8%;
        }
        .msg {
            text-align: center;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 1.6rem;
            position:absolute;
            left: 16%;
            top: 45%;
            width: 75%;
            color: white;
        }
        a {
            text-decoration: none;
            color: #5454f1;
        }
        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .mainbox {
                height: 400px;
                width: 400px;
            }
            .err {
                font-size: 7rem;
                position:absolute;
                left: 15%;
                top: 10%;
            }
            .far {
                font-size: 5rem;
                left: 35%;
                top: 18%;
            }
            .err2 {
                font-size: 7rem;
                left: 59%;
                top: 10%;
            }
            .msg {
                font-size: 1rem;
                position:absolute;
                left: 10%;
                top: 45%;
                width: 75%;
            }
        }
    </style>
</head>
<body>
    <div class="mainbox">
        <div class="err">4</div>
        <i class="far fa-question-circle fa-spin"></i>
        <div class="err2">4</div>
        <div class="msg">Maybe this page moved? Got deleted? Is hiding out in quarantine? Never existed in the first place?<p>Let's go <a href="{{ url('/') }}">home</a> and try from there.</p></div>
    </div>
</body>
</html>
