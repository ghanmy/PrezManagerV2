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
                                    <li class="breadcrumb-item active">Présentations
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-12">
                <a id="show-modal" href="{{ url('presentation/create') }}" class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i> Ajouter</a>
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
                        <th></th>
                        <th>Nom</th>
                        <th>Produit</th>
                        <th>Version</th>
                        <th>Date de création</th>
                        <th>Date de mise à jour</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($presentations as $key => $value)
                        <tr>
                            <td>
                                <a href="" onclick="window.open('{{ URL::asset('uploads/prez_'.$value->id.'/index.html') }}','name','width=800,height=800')">
                                <img src="{{ URL::asset('uploads/prez_'.$value->id.'/thumb.jpg')}}" width="100px" alt=""/>
                                    </a>
                            </td>
                            <td>
                                <a href="{{ URL::to('presentation',$value->id) }}">
                                {{ $value->nom }}
                                    </a>
                            </td>
                            <td>
                               @if($value->id_product)
								  <a href="{{ URL::to('product') }}">
                                {{ $value->product->nom }}
                                    </a>
								@endif
                            </td>
                            <td>
                                <a href="{{ URL::to('presentation',$value->id) }}">
                                {{ $value->version }}
                                    </a>
                            </td>
							
                            <td>
								@if($value->created_at)
                                {{ $value->created_at->Format("Y/m/d H:m") }}
								@endif
                            </td>
                            <td>
								@if($value->updated_at)
                                {{ $value->updated_at->Format("Y/m/d H:m") }}
								@endif
                            </td>
                            <td>
                                <a href="javascript:;" onclick="deletePres({{ $value->id }})" data-toggle="modal" data-target="#delete_pres">
                                    <i class="fa fa-trash"></i> Supprimer
                                </a>
                            </td>
                            <td>
                                <a href="{{ url('presentation', array($value->id, 'edit')) }}">
                                    <i class="fa fa-pencil"></i> Modifier
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

