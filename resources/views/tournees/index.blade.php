@extends('layouts.app')


@section('css')
    <!--calendar css-->
    <link href="{{ asset('template/back/assets/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />
@endsection


@section("content")

    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-3">Liste des tournées</h2>

            <div id='calendar'></div>
        </div>
    </div>
@endsection


@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: @json($tournees),

                eventDidMount: function(event, element) {
                    var desc = "Heure : " + event.event.extendedProps.heure;
                    desc += "\nAdresse : " + event.event.extendedProps.maison;

                    var titre = `<a href="#" title="` + desc + `" class="text-white">` + event.event.extendedProps.auteur + `</a>`

                    event.el.children[0].innerHTML = titre;
                    event.el.bgColor = event.event.color;
                }
            });
            calendar.setOption('locale', 'fr');
            calendar.render();
        });
    </script>
@endsection