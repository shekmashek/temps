@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Calendrier</p>
@endsection
<script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css">

<script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.umd.min.js"></script>
<script src="https://unpkg.com/js-year-calendar@latest/locales/js-year-calendar.fr.js"></script>

<style>
#events-log {
    display: inline-block;
    vertical-align: top;
    width: 340px;
    background-color: #e5e5e5;
    padding: 10px;
    min-height: 200px;
    border-radius: 10px;
    position: relative;
}

#events-log div {
    font-size: 14px;
    line-height: 1.4;
}

#calendar {
    display: inline-block;
    vertical-align: top;
    width: calc(100% - 380px);
}

.calendar .calendar-header {
    background-color: white;
    box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.1);
    border: 0;
}

.calendar .calendar-header .year-title {
    font-size: 18px;
}

.calendar .calendar-header .year-title:hover,
.calendar .calendar-header .prev:hover,
.calendar .calendar-header .next:hover{
    background: rgba(255, 255, 255, 0.2);
}

.calendar .calendar-header .year-title:not(.year-neighbor):not(.year-neighbor2) {
    border-bottom: 2px solid #ccc;
}

.calendar .calendar-header .year-neighbor {
    color: inherit;
    opacity: 0.7;
}

.calendar .calendar-header .year-neighbor2 {
    color: inherit;
    opacity: 0.4;
}

.calendar .months-container .month-container {
    margin-bottom: 25px;
}

.calendar table.month {
    background-color: white;
    box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.2);
    height: 100%;
}

.calendar table.month th.month-title {
    background-color: #f0f0f0;
    color: #888;
    padding: 6px;
    font-size: 13px;
    font-weight: 600;
}

.calendar table.month th.day-header {
    padding-top: 8px;
    padding-bottom: 5px;
    color: #666;
    font-weight: 500;
}

.calendar table.month td.day .day-content {
    color: #666;
    padding: 9px 7px;
    border-radius: 2px;
}
</style>

@section('content')

<div class="container-fluid">
    <div class="row w-100 mt-3">
        <div id="events-log">
        </div>
        <div class="calendar" id="calendar"></div>
    </div>
</div>

<script>
const currentYear = new Date().getFullYear();

// Initialize calendar
var calendar = new Calendar('#calendar', {
    language: 'fr',
    enableContextMenu: true,
        enableRangeSelection: true,
        selectRange: function(e) {
            editEvent({ startDate: e.startDate, endDate: e.endDate });
        },
        mouseOnDay: function(e) {
            if(e.events.length > 0) {
                var content = '';

                for(var i in e.events) {
                    content += '<div class="event-tooltip-content">'
                                    + '<div style="color:' + e.events[i].color + '">' + e.events[i].type + '</div>'
                                    + '<div>' + e.events[i].debut + ' - ' + e.events[i].fin + '</div>'
                                + '</div>';
                }

                $(e.element).popover({
                    trigger: 'manual',
                    container: 'body',
                    html:true,
                    content: content
                });

                $(e.element).popover('show');
            }
        },
        mouseOutDay: function(e) {
            if(e.events.length > 0) {
                $(e.element).popover('hide');
            }
        },
        dayContextMenu: function(e) {
            $(e.element).popover('hide');
        }
});

// recupération des données dans calendar
function liste_heure_supplementaire() {
    return fetch(`{{route('liste_heure_supplementaire')}}`)
        .then(result => result.json())
        .then(result => {
            return {
                heure_supplementaire_avant_huit : result.heure_supplementaire_avant_huit.map(r => ({
                    startDate: new Date(r.jour),
                    endDate: new Date(r.jour),
                    debut: r.debut,
                    fin: r.fin,
                    type: "premières 8 heures",
                    color: "red"
                })),
                heure_supplementaire_apres_huit : result.heure_supplementaire_apres_huit.map(r => ({
                    startDate: new Date(r.jour),
                    endDate: new Date(r.jour),
                    debut: r.debut,
                    fin: r.fin,
                    type: "après 8 heures d'heure supplementaire",
                    color: "blue"
                }))
                ,
                heure_supplementaire_jour : result.heure_supplementaire_jour.map(r => ({
                    startDate: new Date(r.jour),
                    endDate: new Date(r.jour),
                    debut: r.debut,
                    fin: r.fin,
                    type: "heure de jour",
                    color: "green"
                })),
                heure_supplementaire_nuit : result.heure_supplementaire_nuit.map(r => ({
                    startDate: new Date(r.jour),
                    endDate: new Date(r.jour),
                    debut: r.debut,
                    fin: r.fin,
                    type: "heure de nuit",
                    color: "yellow"
                }))
            }
        });
}

// ajout des données dans calendar
var data = calendar.getDataSource();
liste_heure_supplementaire()
    .then(result => (
        result.heure_supplementaire_avant_huit.map(r => (
            data.push(r)
        )),
        result.heure_supplementaire_apres_huit.map(r => (
            data.push(r)
        )),
        result.heure_supplementaire_jour.map(r => (
            data.push(r)
        )),
        result.heure_supplementaire_nuit.map(r => (
            data.push(r)
        )),
        calendar.setDataSource(data)
    ));

// Register events
document.querySelector('#calendar').addEventListener('clickDay', function(e) {
    appendLog("Click on day: " + e.date.toLocaleDateString() + " (" + e.events.length + " events)")
})

document.querySelector('#calendar').addEventListener('dayContextMenu', function(e) {
    appendLog("Right-click on day: " + e.date.toLocaleDateString() + " (" + e.events.length + " events)")
})

document.querySelector('#calendar').addEventListener('selectRange', function(e) {
    appendLog("Select a range: " + e.startDate.toLocaleDateString() + " - " + e.endDate.toLocaleDateString())
})

document.querySelector('#calendar').addEventListener('yearChanged', function(e) {
    appendLog("Year changed: " + e.currentYear)
})

document.querySelector('#calendar').addEventListener('renderEnd', function(e) {
    appendLog("Render end: " + e.currentYear)
})

function appendLog(log) {
    var logElt = document.createElement('div');
    logElt.textContent = log;
    document.querySelector('#events-log').appendChild(logElt);
}
</script>
@endsection
