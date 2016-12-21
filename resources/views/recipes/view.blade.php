@extends('layouts.app')
@section('title', $recipe->name)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Detalji za recept - {{ $recipe->name }}</div>
				@if(auth()->user()->id == $recipe->creator_id)
					<br/><a href ="http://localhost:8000/recipes/edit/{{ $recipe->id }}"><i class="fa fa-btn fa-pencil">Uredi recept</i></a>
                @endif
				<br/><br/>
				<p>{{$recipe->description}}</p>
				<h4>Sastojci:</h4>
					@foreach($recipe->ingredients as $ingrediant)
					<li class="list-group-item">{{ $ingrediant->name }}</li>
					@endforeach
            </div>
        </div>
    </div>
</div>
@endsection
