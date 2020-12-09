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
                                    <li class="breadcrumb-item active">Personnels
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-12">
                <a id="show-modal" href="{{ url('personnel/create') }}" class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i> Ajouter</a>
            </div> 
                
            </div>
		<div class="content-body">
			@include('layouts.alert') 
           <section id="basic-datatable">
                    <div class="row">
                    <div class="col-12">
                    <div class="card">
                    <div class="card-content">
                    <div class="card-body card-dashboard">
                    <div class="table-responsive">
					<table class="table  zero-configuration dataTable">
						<thead>
						<tr>
							<th>Photo</th>
							<th>Nom</th>
							<th>Prenom</th>
							<th>Email</th>
							<th></th>
							<th></th>
						</tr>
						</thead>

						<tbody>
						@foreach($personnels as $key => $value)
						<tr>
							<td>
							@if($value->photo)
							<img src="{{ URL::asset($value->photo) }}" width="120">
							@endif
							</td>
							<td>{{ $value->nom }}</td>
							<td>{{ $value->prenom }}</td>
							<td>{{ $value->email }}</td>
							<td>
								<a href="{{ url('personnel', array($value->id, 'edit')) }}">
									<i class="fa fa-pencil"></i> Modifier
								</a>
							</td>
							<td>
								<a href="javascript:;" onclick="deletePerso({{ $value->id }})" data-toggle="modal" data-target="#delete_perso">
                                    <i class="fa fa-trash"></i> Supprimer
                                </a>
								
								
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				    </div>
					</div>
					</div>
					</div>
					</div>
					</div>
			</section>
</div>
</div>
@endsection
