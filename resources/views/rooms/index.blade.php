@extends('layouts.app')

@section('css')
  <style>
    .imgStyle {
      width: '85%';
      height: "100%";
      fit: "cover";
      position: "center";
      border-radius: "10px"
    }
  </style>
@endsection

@section("content")

<div class="position-relative">
    <form method="get" action="{{ route('rooms.index') }}">
      <div class="card shadow mx-5 position-sticky">
        <div class="card-header">
          Filter
        </div>
        <div class="card-body row">

            <div class="form-group col-12 col-md-4">
              <label htmlFor="type">Room Type</label>
              <select class="form-control" name="type" id='type'>
                <option value="">Choose the type of room</option>
                <option {{ request()->type == "Single King bed" ? "selected" : "" }} value="Single King bed">Single King bed </option>
                <option {{ request()->type == "Double Queens bed" ? "selected" : "" }} value="Double Queens bed">Double Queens bed </option>
                <option {{ request()->type == "Queen bed" ? "selected" : "" }} value="Queen bed">Queen bed </option>
                <option {{ request()->type == "King bed" ? "selected" : "" }} value="King bed">King bed </option>
                <option {{ request()->type == "Twin beds" ? "selected" : "" }} value="Twin beds">Twin beds </option>
                <option {{ request()->type == "Sofa bed" ? "selected" : "" }} value="Sofa bed">Sofa bed </option>
                <option {{ request()->type == "Bunk bed" ? "selected" : "" }} value="Bunk bed">Bunk bed </option>
                <option {{ request()->type == "Single King Handicap" ? "selected" : "" }} value="Single King Handicap">Single King Handicap </option>
                <option {{ request()->type == "Double Queen Handicap" ? "selected" : "" }} value="Double Queen Handicap">Double Queen Handicap </option>
                <option {{ request()->type == "Single King Suite" ? "selected" : "" }} value="Single King Suite">Single King Suite </option>
                <option {{ request()->type == "Double Queen Suite" ? "selected" : "" }} value="Double Queen Suite">Double Queen Suite </option>
                <option {{ request()->type == "Executive" ? "selected" : "" }} value="Executive">Executive </option>
              </select>
            </div>

            <div class="form-group col-12 col-md-3">
              <label htmlFor="nbrRoom">Number of room</label>
              <input type="number" name="nbrRoom" id="nbrRoom" min="1" class="form-control" value="{{ request()->nbrRoom }}" />
            </div>

            <div class="form-group col-12 col-md-3">
              <label htmlFor="price">Price</label>
              <input type="number" name="price" id="price" min="1" class="form-control" value="{{ request()->price }}" />
            </div>

            <div class="form-group col-12 col-md-2">
              <label htmlFor="booked">Booked</label>
              <select class="form-control" name="booked" id='booked'>
                <option {{ request()->booked == "false" ? "selected" : "" }} value="false">No</option>
                <option {{ request()->booked == "true" ? "selected" : "" }} value="true">Yes</option>
              </select>
            </div>

        </div>
        <div class="card-footer">
          <input type="submit" class='btn btn-primary pull-right' value="Filter" />
          <input type="Reset" class='btn btn-danger pull-right mx-3' value="Reset" />
        </div>
      </div>
    </form>
    <div class="row mx-5 pt-5">
        @forelse ($rooms as $room)
          <div class="col-6">
            <div class="row mb-3 p-3 m-1 border shadow" style="height: 340px">
                <div class="col-4">
                    <a href="{{ route('rooms.show', $room->id) }}">
                        <img class="w-100" src="{{ asset($room->image) }}" />
                    </a>
                </div>
                <div class="col-8">
                    <h2> {{ $room->hotel?->name }} </h2>
                    <h5><span class='text-muted font-italic'> room number : {{ $room->number }} </span></h5>
                    <div class="d-flex justify-content-between align-items-center">

                        <h4 style="fontSize: 2em"> Price : <strong class='font-italic text-success'> {{ $room->price }} </strong> € </h4>

                        <div class="bg-primary p-2 text-white rounded">
                            {{ $room->hotel?->rate }} <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <a class='text-primary' href="https://www.google.fr/maps/{{ $room->hotel->lat }}},{{ $room->hotel->long }},15z?entry=ttu" target='_blanc'>
                            <div class="bg-primary py-2 px-3 rounded mr-3 my-3">
                                <i class="fa fa-map-marker fa-2x text-white" aria-hidden="true"></i>
                            </div>
                        </a>
                        <a class='text-primary' href="https://www.google.fr/maps/{{ $room->hotel->lat }},{{ $room->hotel->long }},15z?entry=ttu" target='_blanc'>
                              {{ $room->hotel->country }} <br />
                              {{ $room->hotel->address }}, {{ $room->hotel->city }},
                        </a>
                    </div>

                    <p class='text-muted font-italic'> {{ Str::limit($room->description, 50, ' ...') }} </p>

                    <div class="d-flex justify-content-between">
                        <p class='font-italic font-500 p-0'> <strong> {{ $room->type }} </strong> </p>
                        <div class="">
							@if ($room->isBooked())
								<a class="btn btn-secondary mr-2" onclick="already_booked()"> Booked </a>
							@else
								<a href="{{ route('bookings.create', ["room" => $room->id]) }}" class="btn btn-success mr-2">
									Book
								</a>
							@endif
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-primary pull-right">See more</a>
                        </div>
                    </div>

                </div>
            </div>
          </div>
        @empty
          <div class="card text-left mx-5 mt-5">
            <div class="card-body">
              <h5 class='text-center my-3'>No room found</h5>
            </div>
          </div>
        @endforelse

    </div>
  </div>

@endsection


@section("script")
	<script>
		$(document).ready(function() {
			var already_booked = () => {
				toastr.options.timeOut = 10000;

				toastr.error('Already Booked');
			}
		});
	</script>
@endsection