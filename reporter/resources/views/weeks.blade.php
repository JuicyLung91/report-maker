<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-9">
          
                @foreach ($weeks as $week )
                    <div>
                        <a style="padding-right: 25px;" href="{{ route('weeks.id', ['id'=> $week->IDweeks ]) }}">{{ $week->start->read_date }} Woche: {{ $week->IDweeks }}  </a>
                        <a href="{{ route('weekpdf.id', ['id'=> $week->IDweeks ]) }}">PDF: {{ $week->IDweeks }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
      <script src="js/app.js"></script>
</body>
</html>