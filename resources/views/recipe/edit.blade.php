@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <recipe-form :recipe="{{ $recipe->toJson() }}"></recipe-form>
  </div>
</div>
@endsection
