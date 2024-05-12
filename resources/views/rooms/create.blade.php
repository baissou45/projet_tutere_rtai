@extends('layouts.app')

@section("content")
<form method="POST" action="{{ route('rooms.store') }}" encType="multipart/form-data" >
    @csrf

    <div class="card text-left shadow">
      <div class="card-header">
        <h5 class="card-title">Create a new room</h5>
      </div>
      <div class="card-body row">
          <div class="form-group col-12 col-md-6">
            <label htmlFor="type">Room Type</label>
            <select class="form-control" name="type" id='type'>
              <option value="Single King bed">Choose the type of room</option>
              <option value="Single King bed">Single King bed </option>
              <option value="Double Queens bed">Double Queens bed </option>
              <option value="Queen bed">Queen bed </option>
              <option value="King bed">King bed </option>
              <option value="Twin beds">Twin beds </option>
              <option value="Sofa bed">Sofa bed </option>
              <option value="Bunk bed">Bunk bed </option>
              <option value="Single King Handicap">Single King Handicap </option>
              <option value="Double Queen Handicap">Double Queen Handicap </option>
              <option value="Single King Suite">Single King Suite </option>
              <option value="Double Queen Suite">Double Queen Suite </option>
              <option value="Executive">Executive </option>
            </select>
          </div>

          <x-input libelle="Number of room" type="text" size="col-12" name="number" size="col-12 col-md-6" />
          <x-input libelle="Price" type="text" size="col-12" name="price" size="col-12 col-md-6" />

          <div class="form-group col-md-6">
            <label htmlFor="image">Image</label>
            <input type="file" class="form-control" name="image" placeholder="Image" />
          </div>

          <div class="form-group col-md-12">
            <label htmlFor="description">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>
      </div>

      <div class="card-footer">
        <input type="submit" class='btn btn-primary pull-right' value="Create" />
        <input type="Reset" class='btn btn-danger pull-right mx-3' value="Reset" />
      </div>

    </div>
  </form>
@endsection