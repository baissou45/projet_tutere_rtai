@extends('layouts.app')


@section('css')
    <!--calendar css-->
    <link href="{{ asset('template/back/assets/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />
@endsection


@section("content")

    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-3">Liste des tournées</h2>

            <div class="row">
                <div id='calendar' class="col-9"></div>

                <div class="col-3">
                    <h3 class="text-center mb-5"> Appliquer un filtre </h3>

                    <div class="form-group">
                        <label for="my-select">Inspecteur</label>
                        <select id="my-select" class="form-control" name="">
                            <option>Text</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Date début</span>
                        </div>
                        <input class="form-control" type="text" name="" placeholder="Recipient's text" aria-label="Recipient's text">
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Date fin</span>
                        </div>
                        <input class="form-control" type="text" name="" placeholder="Recipient's text" aria-label="Recipient's text">
                    </div>
                </div>
            </div>

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