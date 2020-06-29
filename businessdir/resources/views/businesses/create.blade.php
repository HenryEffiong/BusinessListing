@extends('layouts.app')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Create a new business listing</h3>
  </div>

  @if (count ($errors)>0)

  <ul class="list-group">
    @foreach ($errors->all() as $error)
    <li class="list-group-item text-danger">
      {{ $error }}
    </li>
    @endforeach
  </ul>

  @endif

  <div class="panel-body">
    <form class="" action="{{ route('businesses.store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="" placeholder="">
        <p class="help-block"></p>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" id="" placeholder="">
        <p class="help-block"></p>
      </div>

      <div class="form-group">
        <label for="url">URL</label>
        <input type="text" name="url" class="form-control" id="" placeholder="">
        <p class="help-block"></p>
      </div>

      <div class="form-group">
        <label for="contact_email">Email</label>
        <input type="email" name="contact_email" class="form-control" id="" placeholder="">
        <p class="help-block"></p>
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image[]" multiple class="form-control" id="" placeholder="">
        <p class="help-block"></p>
      </div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone_number" class="form-control" id="" placeholder="">
        <p class="help-block"></p>
      </div>

      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" class="form-control" id="" placeholder="">
        <p class="help-block"></p>
      </div>


      <div class="form-group">
        <label for="category">Select a Category</label>
        <select class="form-control" id="category" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
      </div>

      <div class="form-group">

        <div class="text-center">
          <button type="submit" class="btn btn-success">
            Store listing
          </button>
        </div>

      </div>

    </form>
  </div>
  <div class="panel-footer">

  </div>
</div>


@endsection