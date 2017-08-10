@extends('templates.layouts')

@section('content')

@include('partials.errors')

{!! Form::open(['url' => 'users', 'action' => 'POST', 'class' => 'left-alert']) !!}
    <div class="row unremove user">
        <div class="input-field col s3" >
          {!! Form::label('name', 'Nombre', ['id' => 'name', 'class' => ($errors->has('name')? 'invalid':'valid'), 'placeholder'=> 'Nombre']); !!}
          {!! Form::text('name', '',['class' => ($errors->has('name')? 'invalid':'valid')]); !!}
        </div>
        <div class="input-field col s3" >
          {!! Form::label('email', 'Email', ['id' => 'name', 'class' => ($errors->has('email')? 'invalid':'valid'), 'placeholder'=> 'Email']); !!}
          {!! Form::text('email', '',['class' => ($errors->has('email')? 'invalid':'valid')]); !!}
        </div>
        <div class="input-field col s3" >
          {!! Form::label('ocupation', 'Ocupacion', ['id' => 'ocupation', 'class' => ($errors->has('ocupation')? 'invalid':'valid'), 'placeholder'=> 'Nombre']); !!}
          {!! Form::text('ocupation', '',['class' => ($errors->has('ocupation')? 'invalid':'valid')]); !!}
        </div>
        <div class="s3">
        	<a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i></a>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
        	{!! Form::submit('Guardar', ['class' => 'waves-effect waves-light btn']); !!}	
        </div>
        
    </div>
{!! Form::close() !!}

@endsection