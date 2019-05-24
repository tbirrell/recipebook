@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
        <ul>
      @foreach ($recipe->ingredients as $ingredient)
          <li>{{$ingredient->amount}} {{$ingredient->amount_unit}} - {{$ingredient->food->name}}</li>
      @endforeach
        </ul>
    </div>
    <div class="row">
      <ol>
        
      @foreach ($recipe->instructions as $instruction)
        <li>{{$instruction->instruction}}</li>
      @endforeach
      </ol>
    </div>
  </div>
@endsection
