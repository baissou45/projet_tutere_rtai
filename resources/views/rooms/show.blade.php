@extends('layouts.app')

@section("css")
    <style>
        .myBg {
            position: relative;
            background: url('{{ asset($room->image) }}') no-repeat;
            background-size: cover;
            background-position: center;
            height: 40vh;
            width: 100%;
            border: 1px solid black;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
@endsection

@section("content")
<div>
    <div class="myBg">
        <div class="overlay"></div>
        <h3 class='text-white' style="position: 'absolute', bottom: 0, right: 20"> {{ $room->hotel->name }} </h3>
    </div>

    <div class="card text-left m-4 mx-5">
      <div class="card-body row">

        <div class="col-12 col-md-6">
          <div class="d-flex align-items-center">
            <a class='text-primary' href="https://www.google.fr/maps/{{ $room->hotel->lat }}},{{ $room->hotel->long }},15z?entry=ttu" target='_blanc'>
                  <div class="bg-primary py-2 px-3 rounded mr-3 my-3">
                      <i class="fa fa-map-marker fa-2x text-white" aria-hidden="true"></i>
                  </div>
              </a>
              <a class='text-primary' href="https://www.google.fr/maps/{{ $room->hotel->lat }}},{{ $room->hotel->long }},15z?entry=ttu" target='_blanc'>
                    <strong>{{ $room->hotel->country }}</strong> <br />
                    {{ $room->hotel->address }}, {{ $room->hotel->city }} <br />
                    {{ $room->hotel->zip }}
              </a>
          </div>
        </div>

        <div class='col-12 col-md-6 d-flex flex-column align-items-end'>
          <div class="bg-primary p-2 text-white rounded" style="width: '50px'">
              <span>{{ $room->hotel->rate }} <i class="fa fa-star text-warning" aria-hidden="true"></i></span>
          </div>
          <div class="">
          <h4> Price : <strong class='font-italic text-success'> {{ $room->price }}</strong> € </h4>
          </div>
        </div>
      </div>
    </div>

    <div class="card text-left my-3 mx-5">
      <div class="card-body">
        <p class='mt-3'> {{ $room->description}} </p>

        <div class="jumbotron py-3 mt-5">
          <i> {{ $room->hotel->description }} </i>

          <div class="d-flex justify-content-between mt-3">
              <i><i class="fa fa-phone" aria-hidden="true"></i> {{ $room->hotel->tel }}</i>
              <i><i class="fa fa-envelope" aria-hidden="true"></i> {{ $room->hotel->email }}</i>
          </div>

        </div>
      </div>
    </div>

</div>
@endsection