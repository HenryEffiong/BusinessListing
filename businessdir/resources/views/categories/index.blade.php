@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
      <div class="panel panel-heading">
          Categories
      </div>
                <div class="panel-body">

                      <table class="table" table-hover>

                          <thead>

                              <th>

                                  Category name

                              </th>
                             
                          </thead>

                          <tbody>

                            @if ($categories->count()!==0)
                              @foreach ($categories as $category)

                                  <tr>
                                      <td>{{ $category->name }}</td>
                                  </tr>

                              @endforeach
                            @else
                                <tr>
                                    <th colspan="5" class="text-center">No categories yet</th>
                                </tr>
                            @endif

                          </tbody>

                      </table>

                </div>

    </div>
@endsection
