<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 20px;
            margin: 0;
            padding: 0;
            color: #333;
            /*background-color: #fefefe;*/
        }

        .page-break {
            page-break-before: always;
        }

        .image-container {
            width: 100%;
            height: 100vh;
            text-align: center;
            padding: 10px;
            box-sizing: border-box;
        }

        .image-container img {
            max-width: 100%;
            max-height: 100vh;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        .description-content p img {
        display: block;
        margin: 0 auto 10px auto;
        max-width: 250px;
        height: auto;
        text-align: center !important;
    }
    </style>
</head>
    <body> 

    @php
        $cleanDescription = trim(strip_tags($description)); 
    @endphp

    @if(!empty($cleanDescription))
        <div class="description-content" style="padding: 20px;">
            {!! $description !!}
        </div> 
    @endif
    
    @foreach($pdfPaths as $index => $image)
        @if($index > 0 || !empty($cleanDescription))
            <div style="page-break-before: always;"></div>
        @endif
        <div class="image-container">
            <img src="{{ $image }}" alt="Report Image">
        </div>
    @endforeach
</body> 
</html>