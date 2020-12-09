@extends('app')
@section('content')
  <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Prez Manager
									</a>
                                    </li>
									<li class="breadcrumb-item"><a href="{{ URL::to('groupe') }}">Groupe
									</a>
                                    </li>
                                    <li class="breadcrumb-item active">Ajouter un groupe
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <div class="content-body">
			@include('layouts.alert') 
			<div class="card">
			<div class="card-header border-bottom mx-2 px-0">
               <h4 class="border-bottom py-1 mb-0 font-medium-2">
			   Ajouter un nouvel groupe</h4>
									
            </div>
			<div class="card-body">
            <div class="row">
			<div class="col-12">
            {!! Form::open(array('url' => 'groupe')) !!}

            <div class="form-group">
                {!! Form::label('nom', 'Nom') !!}
                {!! Form::text('nom', old('nom'), array('required','class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', old('description'), array('required','class' => 'form-control')) !!}
            </div>


            {!! Form::submit('Ajouter un groupe ', array('class' => 'btn btn-primary')) !!}

            {!! Form::close() !!}
			</div>
			</div>
			</div>
			</div>
        </div>

@endsection