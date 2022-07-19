@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Feuille de temps</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<style type="text/css">
    button, value {
        font-size: 30px;
    }

    .form_colab input {
        border: none;
        text-align: center
    }

    .form_colab input:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }

    .form_colab span {
        height: 50px;
    }

    .form_colab input::placeholder {
        font-size: 12px
    }

    h6, p {
        font-size: 80%;
    }

    thead, .bgdate{
        background-color: #c7c9c939
    }
    td {
        padding: 0 !important;
        height: 50px !important;
    }
    td button{
        width:100%
    }
    .pause td{
        width:20px
    }
    .heure td{
        width:50px
    }

    table {
        empty-cells:show;
    }
</style>

<div class="container-fluid">
    <div class="row g-0">
        <div class="row mt-2 justify-content-center">
            <div class="col-md-10 jusitfy-content-center">
                <form name="formInsert" id="formInsert" action="{{ route('valider_feuille_de_temps')}}" method="POST" enctype="multipart/form-data" class="form_insert_formateur form_colab  needs-validation" novalidate>
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>{{Session::get('success')}}</strong>
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
                    @endif
                    <table id="example" class="table text-center">
                        <thead>
                            <tr>
                                <th colspan="5"><h3> Ravelojaona Yves Rayan </h3></th>
                            </tr>
                            <tr>
                                <th colspan="3"><h5> Département : RH </h5></th>
                                <th colspan="3"><h5> Service : comptabilité </h5></th>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    <label>
                                        <h5>Période :
                                            <input class="bgdate" id="week" type="week" required>
                                        </h5>
                                    </label>
                                </th>
                                <th colspan="3"><h5> Fonction : comptable </h5></th>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th>Entrée</th>
                                <th>Pause</th>
                                <th>Sortie</th>
                                <th>Total en heure</th>
                            </tr>
                        </thead>
                        <tbody id="newRowMontant">
                            @for($i = 0; $i < 7; $i++)
                            <tr>
                                <td>
                                    <input class="form-control " type="text" readonly style="background: background" name="object" id="date_text_{{$i}}">
                                    <input class="form-control " type="date" hidden style="background: background" name="date_{{$i}}" id="date_{{$i}}">
                                </td>
                                <td class="heure">
                                    <input class="form-control "  type="time" name="entree_{{$i}}" value="08:00">
                                </td>
                                <td class="pause">
                                    <input class="form-control " type="number" name="pause_{{$i}}" value="0">
                                </td>
                                <td class="heure">
                                    <input class="form-control " type="time" name="sortie_{{$i}}" value="17:00">
                                </td>
                                <td>
                                    <input class="form-control " type="number" readonly style="background: background" name="total_{{$i}}">
                                </td>
                                </tr>
                                @endfor
                            <tr>
                                <td colspan="3" class="border-0 "></td>
                                <td>heure normales : </td>
                                <td>40 heures</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="border-0 "></td>
                                <td>heure supplémentaires : </td>
                                <td>0 heures</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="border-0 "></td>
                                <td>Total semaine : </td>
                                <td>40 heures</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="border-0 "></td>
                                <td colspan="1" class="border-0 "></td>
                                <td class="border-0">
                                    <button type="submit" class="btn btn-success">sauvegarder</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
let button = document.querySelector('#week');
button.onchange = () => {
    let week = document.querySelector('#week');
    let dates = parseDates(week.value);
}

// fonctions necessaire pour le format des dates
function formatDate(date) {
    return (
        [
        date.getFullYear(),
        padTo2Digits(date.getMonth() + 1),
        padTo2Digits(date.getDate()),
        ].join('-') +
        ' ' +
        [
        padTo2Digits(date.getHours()),
        padTo2Digits(date.getMinutes()),
        // padTo2Digits(date.getSeconds()),  // 👈️ can also add seconds
        ].join(':')
    );
}
function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

// pour avoir les dates de la semaine choisie
let parseDates = (inp) => {
    let year = parseInt(inp.slice(0,4), 10);
    let week = parseInt(inp.slice(6), 10);

    let day = (1 + (week) * 7); // 1st of January + 7 days for each week
    let dayOffset = new Date(year, 0, 1).getDay(); // we need to know at what day of the week the year start

    dayOffset--;  //This should make the week start on a monday. depending on what day you want the week to start increment or decrement this value.

    // let days = [];
    var id_date, date_valeur;
    for (var i = 0; i < 7; i++){ // do this 7 times, once for every day
        id_date = 'date_'.concat(i);
        id_date_text = 'date_text_'.concat(i);
        date_valeur = new Date(year, 0, day - dayOffset + i);
        // days.push(date_valeur); // add a new Date object to the array with an offset of i days relative to the first day of the week
        const [date, time] = formatDate(date_valeur).split(' ');
        document.getElementById(id_date).value = date;
        document.getElementById(id_date_text).value = date_valeur;
    }
    // return days;
}
</script>
@endsection
