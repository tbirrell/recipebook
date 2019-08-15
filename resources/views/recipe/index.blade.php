@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <ul>
        @foreach($recipes as $recipe)
          <li>
            <a href="/recipes/{{$recipe->slug}}">{{$recipe->name}}</a>
          </li>
        @endforeach
      </ul>
  </div>
</div>
@endsection
