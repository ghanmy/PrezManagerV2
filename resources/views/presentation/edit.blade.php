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
									<li class="breadcrumb-item"><a href="{{ URL::to('presentation') }}">Présentations
									</a>
                                    </li>
                                    <li class="breadcrumb-item active">Modifier une présentation
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
			   Modifier une présentation</h4>
									
            </div>
			<div class="card-body">
            <div class="row">
			<div class="col-8">
			
            {!! Form::model($presentation,array('route' => array('presentation.update', $presentation->id), 'method' => 'PUT')) !!}

            <div class="form-group">
                {!! Form::label('nom', 'Nom') !!}
                {!! Form::text('nom', old('nom'), array('class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', old('description'), array('class' => 'form-control')) !!}
            </div>
			 <div class="form-group">
				<label>Produit</label>
				<select name="id_product" id="id_product"  class="form-control" />
				@foreach($Products as $one)
				@if($presentation->id_product==$one->id)
				<option value="{{$one->id}}" selected>{{$one->nom}}</option>
				@else
				<option value="{{$one->id}}" >{{$one->nom}}</option>
				@endif
				@endforeach
				</select>
            </div>


            {!! Form::submit('Mise à jour du Presentation ', array('class' => 'btn btn-primary')) !!}

            {!! Form::close() !!}
            </div>
			<div class="col-md-4">
                    <img src="{{ URL::asset($presentation->ThumURI)}}" width="250" alt=""/>
            </div>
			</div>
			</div>
			</div>
   </div>
</div>
@endsection
				