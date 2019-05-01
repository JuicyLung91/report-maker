<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="">
    <title>Document</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <div class="container">

    
        <nav class="row">
            <ul>
                <li>
                    <a href="{{ route('weeks.all') }}">Zeige alle Wochen</a>
                </li>
                <li>
                    <a href="{{ route('tasks.generate') }}">Generiere Aufgaben</a>
                </li>
            </ul>
        </nav>

        <div class="row">
            <div class="col-sm-9">
                <form action="{{ route('period.create') }}" method="GET" class="needs-validation" novalidate>
                    <h2 class="display-4">Zeitraum </h2>
                    <p class="h4">Ein Zeitraum legt automatisch die entsprechenden Tage und Wochen in der Datenbank an.</p>
                    <span class="text-muted">Zeiträume sind Wochen mit einem oder mehreren festen Schultagen. Wenn Sich der Schultag ändert so muss ein neuer Zeitraum angelegt werden.</span>
                    <br>
                    <br>
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label for="validationTooltip01">Startdatum</label>
                        <input type="date" name="startdate" class="form-control" id="validationTooltip01" placeholder="Startdatum required">
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="validationTooltip01">Enddatum</label>
                        <input type="date" name="enddate" class="form-control" id="validationTooltip02" placeholder="Enddatum" required>
                      </div>
                      <div class="col-md-1 mb-1">
                        <label for="validationTooltip01">Ausbildungsjahr</label>
                        <input type="number" name="trainingYear" class="form-control" placeholder="1" value="1" required>
                      </div>
                    </div>
                    <h4>Schultage Auswählen</h4>
                    <br>
                    <div class="form-row">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="schoolday[]" value="montag" class="custom-control-input" id="montag">
                            <label class="custom-control-label" for="montag">Montag </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="schoolday[]" value="dienstag" class="custom-control-input" id="dienstag">
                            <label class="custom-control-label" for="dienstag">Dienstag </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="schoolday[]" value="mittwoch" class="custom-control-input" id="mittwoch">
                            <label class="custom-control-label" for="mittwoch">Mittwoch </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="schoolday[]" value="donnerstag" class="custom-control-input" id="donnerstag">
                            <label class="custom-control-label" for="donnerstag">Donnerstag </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="schoolday[]" value="freitag" class="custom-control-input" id="freitag">
                            <label class="custom-control-label" for="freitag">Freitag </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="schoolday[]" value="samstag" class="custom-control-input" id="samstag">
                            <label class="custom-control-label" for="samstag">Samstag </label>
                        </div>
                    </div>
                    <br><br>
                    <button class="btn btn-primary" type="submit">Zeitraum erstellen</button>
                  </form> 

                  <form action="{{ route('invalid.create') }}" method="GET" data-getname="invalidDate" id="invalidDays" class="needs-validation" novalidate>
                    <h4 class="display-4">Gesperrte Tage </h4>
                    <p class="h4">Urlaubstage, Feiertage, Krankheitstage etc.</p>
                    <br>
                    <div class="dynamic-elements">
                        <div class="row">
                            <label class="col">
                                Datum
                                <input type="date" class="form-control" data-getname="date" name="invalidDate[0][date]" placeholder="Datum">
                            </label>
                            
                            <label class="col">
                                Grund
                                <input type="text" class="form-control" data-getname="reason" name="invalidDate[0][reason]" placeholder="Krankheit/Urlaub...">
                            </label>
                            <label class="col align-self-center">
                                <button type="button" class="btn btn-primary add-one">+</button>
                            </label>
                        </div>
                    </div>
                    <br><br>
                    <button class="btn btn-primary" type="submit">Gesperrte Tage eintragen</button>
                 </form>


                  <form action="{{ route('task.create') }}" method="GET" data-getname="task" id="tasks" class="needs-validation" novalidate>
                    <h4 class="display-4">Aufgaben anlegen</h4>
                    <br>
                    <div class="dynamic-elements">
                        <div class="row">
                            <label class="col-12">
                                Aufgaben Beschreibung
                                <input type="text" class="form-control" data-getname="description" name="task[0][description]" placeholder="Aufgabenbeschreibung">
                            </label>
                            <label class="col-6">
                                Kurzer Name der Aufgabe
                                <input type="text" class="form-control" data-getname="name" name="task[0][name]" placeholder="Name">
                            </label>
                            
                            <label class="col">
                                Dauer
                                <input type="number" class="form-control" data-getname="hour" name="task[0][hour]" placeholder="1-8">
                            </label>
                            <label class="col">
                                Schul Aufgabe?
                                <input type="checkbox" class="form-control" data-getname="schoolTask" name="task[0][schoolTask]">
                            </label>
                            <label class="col align-self-center">
                                <button type="button" class="btn btn-primary add-one">+</button>
                            </label>
                        </div>
                    </div>
                    <br><br>
                    <button class="btn btn-primary" type="submit">Aufgaben erstellen </button>
                 </form>
            </div>
            
            <div class="col-sm">
             
        </div>
      </div>
      <script src="js/app.js"></script>
</body>
</html>