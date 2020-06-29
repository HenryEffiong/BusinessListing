@extends('layouts.app')

@section('content')

      <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Create a new category</h3>
            </div>

          @if (count ($errors)>0)

            <ul class="list-group">
              @foreach ($errors->all() as $error)
                <li class="list-group-item text-danger" >
                  {{ $error }}
                </li>
              @endforeach
            </ul>

          @endif

                <div class="panel-body">
                      <form class="" action="{{ route('categories.store') }}" method="post">
                          {{ csrf_field() }}

                            <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" name="name" class="form-control" id="" placeholder="">
                                  <p class="help-block"></p>
                            </div>

                            <div class="form-group">

                                  <div class="text-center">
                                        <button type="submit" class="btn btn-success">
                                              Store category
                                        </button>
                                  </div>

                            </div>

                      </form>
                </div>
            <div class="panel-footer">

            </div>
      </div>


@endsection
