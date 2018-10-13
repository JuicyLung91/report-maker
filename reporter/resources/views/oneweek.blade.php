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
                <pre>
                
            </pre>
                @foreach ($week as $key => $item)
                @if (is_array($item))
                        
                    @else
                        {{$key}}: {{$item}}<br>
                    @endif
                @endforeach
            </div>
            <style type="text/css">
                * {
                    box-sizing: border-box;
                }
                .tg  {
                    border-collapse:collapse;
                    border-spacing:0;
                }
                .tg td {
                    font-family:Arial, sans-serif;
                    font-size:14px;
                    padding:0 5px;
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
                    padding:6px 5px;
                    border-style:solid;
                    border-width:2px;
                    overflow:hidden;
                    word-break:normal;
                    border-color:black;
                }
                .tg .tg-baqh{
                    text-align:center;
                    vertical-align:center;
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
                </style>
                <table class="tg" style="undefined;table-layout: fixed; width: 867px">
                <colgroup>
                <col style="width: 207px">
                <col style="width: 380px">
                <col style="width: 120px">
                <col style="width: 228px">
                </colgroup>
                  <tr>
                    <th class="tg-baqh tg-first"></th>
                    <th class="tg-baqh">Ausbildungsinhalte</th>
                    <th class="tg-baqh">vom</th>
                    <th class="tg-baqh">Zeit in Stunden</th>
                  </tr>
                  <tr>
                    <td class="tg-baqh">Montag</td>
                    <td class="tg-0lax withSub">
                        <table class="subBorder">
                            <tr>
                                <td colspan="15">Wordpress mittels PHP und Javascript</td>
                            </tr>
                            <tr>
                                <td>Wordpress mittels PHP und Javascript</td>
                            </tr>
                            <tr>
                                <td>Wordpress mittels PHP und Javascript</td>
                            </tr>
                            <tr>
                                <td>Wordpress mittels PHP und Javascript</td>
                            </tr>
                            <tr>
                                <td>Wordpress mittels PHP und Javascript</td>
                            </tr>
                        </table>
                    </td>
                    <td class="tg-baqh withSub">11.09.2017</td>
                    <td class="tg-baqh">
                        <table class="sub">
                            <tr>
                                <td colspan="15">1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>2</td>
                            </tr>
                        </table>
                    </td>
                  </tr>


                  <tr>
                    <td class="tg-baqh">Dienstag</td>
                    <td class="tg-0lax withSub">
                        <table class="subBorder">
                            <tr>
                                <td colspan="15"> </td>
                            </tr>
                            <tr>
                                <td colspan="15">Krank</td>
                            </tr>
                            <tr>
                                <td colspan="15"> </td>
                            </tr>
                        </table>
                    </td>
                    <td class="tg-baqh withSub">11.09.2017</td>
                    <td class="tg-baqh">
                        <table class="sub">

                            <tr>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>0</td>
                            </tr>
                        </table>
                    </td>
                  </tr>


                  <tr>
                    <td class="tg-baqh">Mittwoch</td>
                    <td class="tg-0lax withSub">
                        <table class="subBorder">
                            <tr>
                                <td colspan="15">Test </td>
                            </tr>
                            <tr>
                                <td colspan="15">test</td>
                            </tr>
                            <tr>
                                <td colspan="15"> test</td>
                            </tr>
                        </table>
                    </td>
                    <td class="tg-baqh withSub">11.09.2017</td>
                    <td class="tg-baqh">
                        <table class="sub">

                            <tr>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>1</td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>
        </div>
    </div>
      <script src="js/app.js"></script>
</body>
</html>