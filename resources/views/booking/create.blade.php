@extends('layouts.app')

@section("css")
    <link href="{{ asset('template/back/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />


    <style>
        .list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #f1f1f1;
            padding: 20px
        }
    </style>
@endsection

@section("content")
<form method="post" action="{{ route('bookings.store') }}">
    @csrf

    <div class="card text-left shadow">
      <div class="card-header">
        <h5 class="card-title">New Booking</h5>
      </div>
      <div class="card-body">

            <div class="card shadow mb-2">
                <div class="card-header">
                    <h5> Room </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-11">
                            <label for="my-select">Room</label>
                            <select name="room" id="room" class="form-control select2">
                                <option value="">Choose the room</option>
                                @foreach($rooms as $room)
                                    <option data-room="{{ json_encode($room->getData()) }}" value="{{ $room->id }}" {{ $room->id == $selected_room ? "selected" : ""  }}> Room : {{ $room->number }}  ( {{ $room->price }} € ) </option>
                                @endforeach
                            </select>
                        </div>

                        <a onclick="show_modal()" class="btn btn-info text-white" data-dismiss="modal" style="height: 40px; margin-bottom: 15px; align-self: flex-end">Show</a>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-2">
                <div class="card-header">
                    <h5> Customer </h5>
                </div>
                <div class="card-body row">

                    <div class="form-group col-12 mb-5">
                        <label for="my-select">Search Customer</label>
                        <select name="client_id" id="client_id" class="form-control select2" onchange="clientSelected()">
                            <option value="">Choose the room</option>
                            @foreach($clients as $client)
                                <option data-client="{{ json_encode($client) }}" value="{{ $client->id }}"> {{ $client->lastName . ' ' . $client->firstName }} </option>
                            @endforeach
                        </select>
                    </div>


                    <x-input libelle="First Name" type="text" size="col-12 col-md-6" name="firstName" />
                    <x-input libelle="Last Name" type="text" size="col-12 col-md-6" name="lastName" />
                    <x-input libelle="Email" type="text" size="col-12 col-md-6" name="mail" />
                    <x-input libelle="Phone Number" type="text" size="col-12 col-md-6" name="tel" />

                </div>
            </div>

            <div class="card shadow">
                <div class="card-header">
                    <h5> Booking </h5>
                </div>
                <div class="card-body row">

                    <x-input libelle="Start date" type="datetime-local" size="col-12 col-md-6" name="startDate" />
                    <x-input libelle="End date" type="datetime-local" size="col-12 col-md-6" name="endDate" />

                </div>
            </div>

      </div>

      <div class="card-footer">
        <input type="submit" class='btn btn-primary pull-right' value="Create" />
        <input type="Reset" class='btn btn-danger pull-right mx-3' value="Reset" />
      </div>

    </div>
  </form>

  <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="d-flex justify-content-center my-5">
                    <img id="modal_img" src="" class="rounded shadow w-100">
                </div>
                <ul class="list">
                    <li> <strong> Room </strong> : <span id="modal_rooms"></span> </li>
                    <li> <strong> Price </strong> : <span id="modal_price"></span> € </li>
                    <li id="modal_desc" class="mt-1 mx-2"></li>
                </ul>

            </div>
        </div>
    </div>
  </div>

@endsection


@section("script")
    <script src="{{ asset('template/back/assets/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        $(".select2").select2();
        show_modal = () => {
            currentRoom = JSON.parse($('#room :selected').attr('data-room'));

            $('#modal_rooms').text(currentRoom['number']);
            $('#modal_price').text(currentRoom['price']);
            $('#modal_desc').text(currentRoom['description']);
            $('#modal_img').attr('src', currentRoom['image']);

            $('#my-modal').modal('show');
        }

        clientSelected = () => {
            currentClient = JSON.parse($('#client_id :selected').attr('data-client'));
            $('#firstName').val(currentClient['firstName']);
            $('#lastName').val(currentClient['lastName']);
            $('#mail').val(currentClient['email']);
            $('#tel').val(currentClient['tel']);
        }
    </script>
@endsection