<!DOCTYPE html>
<html lang="de">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$filename}}</title>
                <style type="text/css">
                  html, body {
                    font-family: 'DejaVu Sans', sans-serif;
                    font-size: 14px;
                }
                * {
                    box-sizing: border-box;
                }
                h2, b {
                    font-weight: bold;
                }
                .weekTable {
                    margin-top: 3rem;
                    width: 94%;
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
                    width: 110%;
                    margin-left: -5px;
                    text-indent: 5px;
                }
                .subTable {
                    min-height: 50px;
                }
                .subTable td {
                    border: none;
                    border-bottom: 1px solid #000;
                }
                .subTable.tasks td {
                    padding-left: 3px;
                    padding-right: 8px;
                }
              
                .subTable tr:last-of-type td {
                    border-bottom: none;
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
                    width: 99%;
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
                    height: 60px;
                    width: 100%;
                }
                .td--noBorder {
                    border: none !important;
                }
                </style>
</head>
<body>
    
  <div>

        <h2>Berichtsheft</h2>
        <table style="width: 95%">
            <tr style="line-height: 1rem">
                <td style="width: 100px"><b>Name<b></td>
                <td>Roj</td>
                <td style="width: 170px"><b>Ausbildungsberuf<b></td>
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


      </div>


      <div>

      
              <table class="tg weekTable">
               
                  <tr >
                    <th style="height: 25px;" class="tg-baqh tg-first"></th>
                    <th class="tg-baqh">Ausbildungsinhalte</th>
                    <th class="tg-baqh">vom</th>
                    <th class="tg-baqh">Zeit in Stunden</th>
                    <th class="tg-baqh">Insgesamt</th>
                  </tr>

                  
                  @foreach ($week['tage'] as $key => $item)
                  <?php $date = $item['Datum']; ?>
                  <?php $school = $item['Schultag']; ?>
                    <tr>
                        <td class="tg-baqh" style="width: 90px; height: 45px; padding:0 15px;">{{ $key }}</td>
                        <td class="tg-0lax withSub" style="width: 300px; vertical-align:middle;">
                         
                            <?php $hours = $item['Aufgaben']; ?>
                            <table class="subTable tasks">
                                @foreach ($item['Aufgaben'] as $key => $item)
                                    <tr>
                                        <td>{{ $key }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="tg-baqh " style="width: 90px">{{ $date }}</td>
                        <td class="tg-baqh widthSub" style="width: 120px">
                            <table class="subTable">
                                @foreach ($hours as $key => $item)
                                @if ($item)
                                <tr clasS="td--noBorder" style="text-align: center">
                                    <td clasS="td--noBorder">{{ $item }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </table>
                        </td>
                        @if($key == 'Samstag' || $key == 'Sonntag' )
                        <td class="tg-baqh " style="width: 80px"></td>
                        @else
                        <td class="tg-baqh " style="width: 80px">8</td>
                        @endif
                    </tr>
                  
                @endforeach
                
            </table>

          </div>
            
<div class="fullWidth">
    <div class="absolut absolut--right"><span>Anzahl h gesamt: </span><span class="hours">40</span></div>
</div>
<div class="fullWidth">
    <div class="absolut absolut--left"><b>Unterschriften</b></div>
</div>

<div class="fullWidth signs">
    <div class="half">Auszubildender<br><div class="signBox"></div></div>
    <div class="half" style="float:right;">Ausbilder<br><div class="signBox"></div></div>
</div>


</body>
</html>