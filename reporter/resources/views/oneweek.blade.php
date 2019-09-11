<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/app.css">
                <style type="text/css">
                html, body {
                    font-family: 'Arial', sans-serif;
                }
                * {
                    box-sizing: border-box;
                }
                h2, b {
                    font-weight: bold;
                }
                .weekTable {
                    margin-top: 3rem;
                }
                .tg  {
                    border-collapse:collapse;
                    border-spacing:0;
                }
                .tg td {
                    font-family:Arial, sans-serif;
                    font-size:14px;
                    padding:1px 0px;
                    border-style:solid;
                    border-width:2px;
                    overflow:hidden;
                    word-break:normal;
                    border-color:black;
                    vertical-align: center;
                }
                .tg th {
                    font-family:Arial, sans-serif;
                    font-size:14px;
                    font-weight:normal;
                    padding: 0 10px;
                    border-style:solid;
                    border-width:2px;
                    overflow:hidden;
                    word-break:normal;
                    border-color:black;
                }
                
                .tg .tg-baqh{
                    text-align:center;
                    vertical-align:middle
                }
                .tg .tg-0lax{
                    text-align:left;
                    vertical-align:center;
                }
                .tg .tg-first {
                    border-top: transparent;
                    border-left: transparent;
                }
                .withSub {
                    padding: 0 !important;
                }
                .withSub p {
                    margin: 0;
                }
                .subBorder tr, .subBorder, .sub, .sub tr {
                    width: 100%;
                }
                .subBorder td {
                    width: 101%;
                    display: block;
                    margin-left: -2px;
                    padding:3px 5px;
                    border-top: none !important;
                    border-right: none !important;
                    border-left: none !important;
                    border-bottom: 2px solid #000;
                }
                .subBorder tr:last-of-type:not(:first-of-type) td {
                    border-bottom: none !important;
                }
                .subBorder tr:first-of-type:last-of-type td {
                    border-top: 2px solid #000;
                }

                .sub td {
                    text-align: center;
                    padding:3px 5px;
                    border: none !important;
                }
                table.subTable {
                    border: none;
                    width: 100%;
                }
                .subTable {
                    min-height: 50px;
                }
                .subTable td {
                    border: none;
                    border-top: 1px solid #000;
                    border-bottom: 1px solid #000;
                }
                .subTable.tasks td {
                    padding-left: 3px;
                }
                .subTable tr:first-of-type td {
                    border-top: none;
                }
                .subTable tr:last-of-type td {
                    border-bottom: none;
                }
                .modal {
                    background-color: rgba(60, 58, 58, 0.41);
                }
                .modal_content {
                    display: flex;
                    justify-content: center;
                    flex-direction: column;
                    width: 410px;
                    margin: 0 auto;
                    margin-top: 4rem;
                }
                @media print
                {    
                    .noPrint, .noPrint *
                    {
                        display: none !important;
                    }
                }
                .din {
                    width: 210mm;
                    height: 297mm;
                    margin: 0 auto;
                }
                .fullWidth {
                    position: relative;
                    width: 100%;
                    display: block;
                    height: 65px;
                }
                .absolut {
                    position: absolute;
                }
                .absolut--right {
                    top: 30px;
                    right: 0;
                }
                .absolut--left {
                    left: 80px;
                }
                .signs {
                    display: flex;
                    justify-content: space-between;
                }
                .signs .half {
                    flex: 0 0 45%;
                    max-width: 45%;
                    width: 45%;
                }
                .signBox {
                    border: 2px solid #000;
                    height: 90px;
                    width: 100%;
                }
                .td--noBorder {
                    border: none !important;
                }
                </style>
</head>
<body>
    
  
<div class="container noPrint">
    <div class="row">
        <div class="col-sm-9">
            <div><a href="http://localhost:8100/public/weeks/{{ $week['Wochennummer'] - 1 }}">zurück</a></div>
            <div><a href="http://localhost:8100/public/weeks/{{ $week['Wochennummer'] + 1 }}">weiter</a></div>
            @foreach ($week['tage'] as $key => $item)
                <form style="display-none" action="{{ route('update.tasks') }}" data-getname="task" method="GET" data-dayid="{{ $item['ID']}}" class="modal needs-validation" novalidate>
                    <div class="modal_content">
                        <div class="closeModal">x</div>
                    @if ($item['Schultag']) 
                        <h4 class="display-4">Schultag:</h4>
                        <input type="hidden" name="schoolday" value="1">
                    @endif  
                    <input type="hidden" name="dayid" value="{{ $item['oneDayID']}}">
                    <?php $c = 0; ?>
                    @foreach ($item['Aufgaben'] as $key => $dayTasks )
                    <div class="dynamic-elements">
                        <div class="row">
                            <label>
                                <input class="" data-getname="name" name="task[{{$c}}][name]" value="{{ $key }}">
                            </label>
                            <label>
                                <input class="" data-getname="hour" name="task[{{$c}}][hour]" value="{{ $dayTasks }}">
                            </label>
                            
                            <label class="col align-self-center">
                                @if ($c == 0)
                                    <button type="button" class="btn btn-primary add-one">+</button>
                                @else
                                    <button type="button" class="btn btn-danger delete">-</button>
                                @endif
                            </label>
                            <br>
                        </div>
                    </div>
                    
                    <?php $c++; ?>
                    @endforeach
                    @if ( count($item['Aufgaben']) == 0 ) 
                        <div class="dynamic-elements">
                            <div class="row">
                                <label>
                                    <input class="" data-getname="name" name="task[0][name]" value="">
                                </label>
                                <label>
                                    <input class="" data-getname="hour" name="task[0][hour]" value="">
                                </label>
                                <label class="col align-self-center">
                                    <button type="button" class="btn btn-primary add-one">+</button>
                                </label>
                            </div>
                        </div>
                    @endif
                    <button class="btn btn-primary" type="submit">Tag Bearbeiten</button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</div>

    <div class="container noPrint">
        <div class="row">
            <div class="col-sm-9">
                @foreach ($week as $key => $item)
                @if (is_array($item))
                        
                    @else
                        {{$key}}: {{$item}}<br>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
    <div class="din">
        <h2>Berichtsheft</h2>
        <table style="width: 85%">
            <tr style="line-height: 1rem">
                <td style="width: 110px"><b>Name<b></td>
                <td>Roj</td>
                <td style="width: 160px"><b>Ausbildungsberuf<b></td>
                <td>Mediengestalter</td>
            </tr>
            
            <tr>
                <td><b>Vorname<b></td>
                <td>Peter</td>
                <td><b>Ausbildungsjahr<b></td>
                <td>{{$week['Ausbildungsjahr']}}</td>
            </tr>

            <tr style="line-height: 1rem">
                <td><b>geboren am<b></td>
                <td>30.09.1991</td>
                <td><b>Ausbildungsstätte<b></td>
                <td>smit und partner, designer</td>
            </tr>

            <tr>
                <td><b>Geburtsort<b></td>
                <td>Heydebreck‐Cosel</td>
                <td><b>Nr. vom Berichtsheft<b></td>
                <td>{{ $week['Wochennummer'] }}</td>
            </tr>
        </table>
                <table class="tg weekTable" style="undefined;table-layout: fixed;">
                <colgroup>
                <col style="width: 207px">
                <col style="width: 380px">
                <col style="width: 140px">
                <col style="width: 228px">
                <col style="width: 120px">
                </colgroup>
                  <tr>
                    <th class="tg-baqh tg-first"></th>
                    <th class="tg-baqh">Ausbildungsinhalte</th>
                    <th class="tg-baqh">vom</th>
                    <th class="tg-baqh">Zeit in Stunden</th>
                    <th class="tg-baqh">Insgesamt</th>
                  </tr>

                  @foreach ($week['tage'] as $key => $item)
                  <?php $date = $item['Datum']; ?>
                  <?php $school = $item['Schultag']; ?>
                    <tr>
                        <td class="tg-baqh">{{ $key }} 
                            <span data-dayid="{{$item['ID']}}" class="noPrint openModal">(E)</span>
                            <form action="{{ route('task.createSingle') }}" class="noPrint" method="GET" novalidate>
                                    <input type="hidden" name="date" value="{{ $item['Datum']}}">
                                    <input type="hidden" name="dateID" value="{{ $item['ID']}}">
                                    <button class="btn btn-link" type="submit">(Neu)</button>
                            </form>
                        </td>
                        <td class="tg-0lax withSub">
                         
                            <?php $hours = $item['Aufgaben']; ?>
                            <table class="subTable tasks">
                                @foreach ($item['Aufgaben'] as $key => $item)
                                    <tr>
                                        <td>{{ $key }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="tg-baqh ">{{ $date }}</td>
                        <td class="tg-baqh widthSub">
                            <table class="subTable">
                                @foreach ($hours as $key => $item)
                                @if ($item)
                                <tr clasS="td--noBorder">
                                    <td clasS="td--noBorder">{{ $item }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </table>
                        </td>
                        <td class="tg-baqh ">8</td>
                        </tr>
                    </tr>
                  
                @endforeach
                
                </table>
<div class="fullWidth">
    <div class="absolut absolut--right"><span>Anzahl h gesamt: </span><span class="hours">40</span></div>
</div>
<div class="fullWidth">
    <div class="absolut absolut--left"><b>Unterschriften</b></div>
</div>

<div class="fullWidth signs">
    <div class="half">Auszubildender<br><div class="signBox"></div></div>
    <div class="half">Ausbilder<br><div class="signBox"></div></div>
</div>
</div>


      <script src="/public/js/app.js"></script>
</body>
</html>