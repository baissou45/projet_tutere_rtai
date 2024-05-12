@extends('layouts.app')

@section('css')
@endsection

@section("content")

<div class="position-relative">
    <form method="get">
      <div class="card shadow mx-5 position-sticky">
        <div class="card-header">
          Filter
        </div>
        <div class="card-body row">

            <div class="form-group col-12 col-md-3">
                <label for="type">Search Type</label>
                <select class="form-control" name="type" id='type' onchange="changeType()">
                  <option value="ras" selected>Choose the type</option>
                  <option {{ request()->type == "geo" ? "selected" : "" }} value="geo">Geo</option>
                  <option {{ request()->type == "city" ? "selected" : "" }} value="city">City</option>
                </select>
              </div>

            <div id="geo" class="row col-md-4">
                <div class="form-group col-12 col-md-6">
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" id="latitude" min="1" max="5" class="form-control" value="{{ request()->latitude }}" />
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" id="longitude" min="1" max="5" class="form-control" value="{{ request()->longitude }}" />
                </div>
            </div>

            <div class="form-group col-12 col-md-4" id="city">
                <label for="ville">City</label>
                <input type="text" name="ville" id="ville" min="1" class="form-control" value="{{ request()->ville }}" />
                <small>Destination city code or airport code. <br><a href="https://www.iata.org/en/publications/directories/code-search/?airport.search=Paris">Available codes can be found in IATA table codes</a></small>
            </div>

            <div class="form-group col-12 col-md-2">
                <label for="ratings">Ratings</label>
                <input type="number" name="ratings" id="ratings" min="1" max="5" class="form-control" value="{{ request()->ratings }}" />
            </div>

            <div class="form-group col-12 col-md-3">
                <label for="radius">Radius</label>
                <input type="number" name="radius" id="radius" min="1" max="5" class="form-control" value="{{ request()->radius }}" />
            </div>

            {{-- <div class="form-group col-12 col-md-3">
                <label for="adults">Number of adults</label>
                <input type="number" name="adults" id="adults" min="1" max="9" class="form-control" value="{{ request()->adults }}" />
            </div>

            <div class="form-group col-12 col-md-3">
                <label for="checkInDate">Check In Date</label>
                <input type="date" name="checkInDate" id="checkInDate" class="form-control" value="{{ request()->checkInDate }}" />
            </div>

            <div class="form-group col-12 col-md-3">
                <label for="checkOutDate">Check Out Date</label>
                <input type="date" name="checkOutDate" id="checkOutDate" class="form-control" value="{{ request()->checkOutDate }}" />
            </div>

            <div class="form-group col-12 col-md-3">
                <label for="minPrice">Min Price</label>
                <input type="number" name="minPrice" id="minPrice" min="1" class="form-control" value="{{ request()->minPrice }}" />
            </div>

            <div class="form-group col-12 col-md-3">
                <label for="maxPrice">Max Price</label>
                <input type="number" name="maxPrice" id="maxPrice" min="1" class="form-control" value="{{ request()->maxPrice }}" />
            </div>

            <div class="form-group col-12 col-md-3">
              <label for="boardType">Board Type</label>
              <select class="form-control" name="boardType" id='boardType'>
                <option value="">Choose the type</option>
                <option {{ request()->boardType == "ROOM_ONLY" ? "selected" : "" }} value="ROOM_ONLY">Room Only</option>
                <option {{ request()->boardType == "BREAKFAST" ? "selected" : "" }} value="BREAKFAST">Breakfast</option>
                <option {{ request()->boardType == "HALF_BOARD" ? "selected" : "" }} value="HALF_BOARD">Diner & Breakfast (only for Aggregators)</option>
                <option {{ request()->boardType == "FULL_BOARD" ? "selected" : "" }} value="FULL_BOARD">Full Board (only for Aggregators)</option>
                <option {{ request()->boardType == "ALL_INCLUSIVE" ? "selected" : "" }} value="ALL_INCLUSIVE">All Inclusive (only for Aggregators)</option>
              </select>
            </div> --}}

        </div>
        <div class="card-footer">
          <input type="submit" class='btn btn-primary pull-right' value="Filter" />
          <input type="Reset" class='btn btn-danger pull-right mx-3' value="Reset" />
        </div>
      </div>
    </form>

    @forelse ($data as $hotel)
        <div class="card mx-5 mt-5">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3> {{ $hotel['hotel']['name'] }} </h3>

                        <a class='text-primary' href="https://www.google.fr/maps/{{ $hotel['hotel']['latitude'] }}},{{ $hotel['hotel']['longitude'] }},15z?entry=ttu" target='_blanc'>
                            <div class="bg-primary py-2 px-3 rounded mr-3 my-3">
                                <i class="fa fa-map-marker fa-2x text-white" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>

                    <div class="d-flex justify-content-between">
                        @isset($hotel['hotel']['contact']['fax'])
                            <div>
                                <i class="fa fa-fax" aria-hidden="true"></i> : {{ $hotel['hotel']['contact']['fax'] }}
                            </div>
                        @endisset

                        @isset($hotel['hotel']['contact']['phone'])
                            <div>
                                <i class="fa fa-phone" aria-hidden="true"></i> : {{ $hotel['hotel']['contact']['phone'] }}
                            </div>
                        @endisset
                    </div>
                </div>


                <div class="card-body">

                    @foreach ($hotel['offers'] as $offer)
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="">
                                    Name : {{ $offer['room']['name'] ?? '-' }} <br>
                                    Category : {{ $offer['room']['typeEstimated']['category'] ?? '-' }}
                                </div>

                                <div>
                                    <i class="fa fa-users" aria-hidden="true"></i> {{ $offer['guests']['adults'] ?? '-' }} Adult(s) <br>
                                    boardType : {{ $offer['boardType'] ?? '-' }}
                                </div>
                            </div>

                            <div class="card-body">

                                {{ $offer['room']['description']['text'] ?? '-' }}

                                <div>
                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                    <span class="text-primary"> Room Type : </span> {{ $offer['room']['type'] ?? '-' }}
                                </div>

                                <div>
                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                    <span class="text-primary"> Bed : </span> {{ $offer['room']['typeEstimated']['beds'] ?? '-' }}
                                </div>

                                <div>
                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                    <span class="text-primary"> Bed type : </span> {{ $offer['room']['typeEstimated']['bedType'] ?? '-' }}
                                </div>

                                <div>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <span class="text-primary"> Check In : </span> {{ $offer['checkInDate'] ?? '-' }}
                                </div>

                                <div>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <span class="text-primary"> Check Out : </span> {{ $offer['checkOutDate'] ?? '-' }}
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        Base : {{ ($offer['price']['base'] ?? '-') . ' ' . $offer['price']['currency'] }} <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div>
                                        Total : {{ $offer['price']['total'] . ' ' . $offer['price']['currency'] }} <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    @empty
    @endforelse

    <div>
    </div>
  </div>

@endsection


@section("script")
    <script>
        const changeType = () => {

            if ($('#type :selected').val() === "geo") {
                $('#geo').show();
                $('#city').hide();
            } else if ($('#type :selected').val() === "city") {
                $('#city').show();
                $('#geo').hide();
            } else {
                console.log("hi");
                $('#geo').hide();
                $('#city').hide();
            }
        }

        $(document).ready(function () {
            $('#geo').hide();
            $('#city').hide();

            changeType();
        });
    </script>
@endsection