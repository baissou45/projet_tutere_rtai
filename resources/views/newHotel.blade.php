@extends('layouts.guest')

@section("content")

    <div class="card shadow">
        <div class="card-body">

            <div class="p-3">
                <h4 class="text-muted font-18 m-b-5 text-center">New Hotel !</h4>

                <div class="alert alert-danger d-none" role="alert">
                <h4 class="alert-heading">Error !!!</h4>

                <ul class="errorAlerte"></ul>
                </div>

                <form class="form-horizontal m-t-30" action="{{ route('hotels.store') }}" method="post">
                    @csrf

                    <div class="row">

                        <x-input libelle="Hotel name" type="text" name="name" size="col-12 col-md-6" />

                        <div class="form-group col-md-6">
                            <label htmlFor="email">Rate</label>
                            <input type="number" class="form-control" name="rate" placeholder="Hotel rate" min="1" max="5" required />
                            @error("rate")
                                <small class="text-danger"> {{ $errors->first("rate") }} </small>
                            @enderror
                        </div>

                        <x-input libelle="Hotel mail" type="text" name="name" size="col-12 col-md-6" />
                        <x-input libelle="Hotel number" type="tel" name="name" size="col-12 col-md-6" />
                    </div>

                    <hr class="my-4" />

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label htmlFor="zip">Zip</label>
                            <input type="text" class="form-control" name="zip" placeholder="Hotel zip" required />
                            @error("zip")
                                <small class="text-danger"> {{ $errors->first("zip") }} </small>
                            @enderror
                        </div>


                        <div class="form-group col-md-6">
                            <label htmlFor="country">State</label>
                            <input type="text" class="form-control" name="state" placeholder="Hotel state" />
                            @error("country")
                                <small class="text-danger"> {{ $errors->first("country") }} </small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label htmlFor="country">Country</label>
                            <input type="text" class="form-control" name="country" placeholder="Hotel country" required />
                            @error("country")
                                <small class="text-danger"> {{ $errors->first("country") }} </small>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label htmlFor="city">City</label>
                            <input type="text" class="form-control" name="city" placeholder="Hotel city" required />
                            @error("city")
                                <small class="text-danger"> {{ $errors->first("city") }} </small>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label htmlFor="address">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Hotel address" required />
                            @error("address")
                                <small class="text-danger"> {{ $errors->first("address") }} </small>
                            @enderror
                        </div>

                    </div>

                    <hr class="my-4" />

                    <div class="form-group">
                        <label htmlFor="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection