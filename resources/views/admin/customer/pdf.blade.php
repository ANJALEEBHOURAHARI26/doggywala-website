<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        /*img {*/
        /*    max-width: 100%;*/
        /*    height: auto;*/
        /*}*/
        
        img {
            display: block;
            margin: 0 auto 10px;
            max-width: 300px;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 6px;
            border: 1px solid #000;
        }

        body {
            font-size: 14px;
            line-height: 1.6;
        }
        .date-line {
            white-space: nowrap;
        }
    </style>
</head>
<body>

    {!! $estimationDetails->description !!}

</body>
</html>
