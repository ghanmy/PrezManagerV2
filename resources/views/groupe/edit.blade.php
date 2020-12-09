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
                                    <li class="breadcrumb-item active">Modifier un groupe
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
			   Modifier un groupe</h4>
									
            </div>
			<div class="card-body">
            <div class="row">
			<div class="col-12">
            <form action="{{route('groupe.update')}}" method="post"  enctype="multipart/form-data">
									{{csrf_field()}}

            <div class="form-group">
                <label>Nom</label>
				<input type="text" name="nom" id="nom" value="{{$groupe->nom}}" class="form-control" placeholder="Nom" required/>
            </div>

            <div class="form-group">
                <label>Description</label>
				<textarea  name="description" id="description" class="form-control" placeholder="Description" />{{$groupe->description}}</textarea>
            </div>

			<input type="hidden" name="id_groupe" value="{{$groupe->id}}">
			<button type="submit" class="btn btn-primary btn-round waves-effect">
				Modifier un groupe</button>
            </form>
			</div>
			</div>
			</div>
			</div>
        </div>

@endsection