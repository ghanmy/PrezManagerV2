@extends('app')
@section('css')
    <link href="{{ URL::asset('assets/plugins/nvd3/nv.d3.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ URL::asset('assets/plugins/rickshaw/rickshaw.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        #question {
            min-height: 500px;
        }
    </style>
@endsection
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
                                    <li class="breadcrumb-item active">{{ $presentation->nom}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
		<div class="content-body">
			@include('layouts.alert') 

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 "></div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="btn-group"role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#uploadModal">
                        <span class="p-t-5 p-b-5">
                        <i class="fa fa-cloud-upload fs-15"></i>
                        </span>
                        <br>
						<span>Upload</span>
                    </button>

                    <a type="button" class="btn  waves-effect waves-light btn-info"
                       href="{{ url('presentation', array($presentation, 'download')) }}">
                        <span class="p-t-5 p-b-5">
                        <i class="fa fa-cloud-download fs-15"></i>
                        </span>
                        <br>
						<span>Télécharger</span>
                    </a>


                    <a type="button" class="btn waves-effect waves-light btn-warning"
                       href="{{ url('presentation', array($presentation, 'edit')) }}">
                        <span class="p-t-5 p-b-5">
                        <i class="fa fa-pencil fs-15"></i>
                        </span>
                        <br>
						<span>Modifier</span>
                    </a>

                    <a type="button" class="btn waves-effect waves-light btn-danger"
                       href="{{ url('presentation', array($presentation, 'delete')) }}">
                        <span class="p-t-5 p-b-5">
                        <i class="fa  fa-trash fs-15"></i>
                        </span>
                        <br>
						<span>Supprimer</span>
                    </a>





                {{--<div class="btn-group">--}}
                {{--<button type="button" class="btn btn-default">--}}
                {{--<span class="p-t-5 p-b-5">--}}
                {{--<i class="pg-form fs-15"></i>--}}
                {{--</span>--}}
                {{--<br>--}}
                {{--<span class="fs-11 font-montserrat text-uppercase">Editer</span>--}}
                {{--</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
    <br/>
	 <section id="nav-justified">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card overflow-hidden">
							<div class="card-content">
                            <div class="card-body">
									 <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#information" role="tab" aria-controls="information" >Informations</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " id="home-tab-justified" data-toggle="tab" href="#statistique" role="tab" aria-controls="statistique" >Statistiques</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " id="home-tab-justified" data-toggle="tab" href="#question" role="tab" aria-controls="question" >Questions</a>
                                            </li>
                                             <li class="nav-item">
                                                <a class="nav-link " id="home-tab-justified" data-toggle="tab" href="#personnels" role="tab" aria-controls="personnels" >Personnels</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " id="home-tab-justified" data-toggle="tab" href="#groupes" role="tab" aria-controls="groupes">Groupes</a>
                                            </li>
										</ul>
   
							<div class="tab-content pt-1">
								<div class="tab-pane " id="statistique" role="tabpanel" aria-labelledby="home-tab-justified">
									
						<div class="row  match-height">
							
						
											<div class="col-lg-12 col-md-12 col-12">
												<div class="card">
													<div class="card-header d-flex justify-content-between align-items-end">

														<input type="hidden" name="id_pres_slide" id="id_pres_slide" value="{{ $presentation->id}}"><!-------------------------------------------------->
														<h4 class="col-12 form-group " style="display:none">Personnels : 
														<select name="id_personnel" id="id_personnel_slide"  class="form-control" >
														<option value="-1" selected>Tous les personnels</option>
														@foreach($Personnels as $one)
														<option value="{{$one->id}}">{{$one->nom}} {{$one->prenom}}</option>
														@endforeach
														</select>
														</h4>
														<!------------------------------------------------->
														<h4 class="col-12 form-group" style="display:none">Produits : 
														<select name="id_produit" id="id_produit_slide"  class="form-control" >
														<option value="-1" selected>Tous les produits</option>
														@foreach($Produits as $one)
														<option value="{{$one->id}}">{{$one->nom}} {{$one->prenom}}</option>
														@endforeach
														</select>
														</h4>
														<h4 class="col-6 form-group">Date debut: 
														<form>
														 <input type='text' name="from_date" id="from_date_slide" class="form-control format-picker" />
														 </form>
														</h4>
														<h4 class="col-6 form-group">Date fin: 
														<form>
														  <input type='text' name="to_date" id="to_date_slide" class="form-control format-picker" />
														  </form>
														</h4>
														<span class="col-6">
														<button name="filtre_slide" id="filtre_slide" class="btn btn-primary btn-round waves-effect">Recherche</button>
														<span>
													</div>
													<div class="card-content">
														<div class="card-body pb-0">
														<div class="d-flex justify-content-start">
														<div class="ml-2">
															<p class="mb-50 text-bold-600 text-danger">Temps passé par slide</p>
														</div>
														</div>
															<div id="slide-chart" style="height:350px !important"></div>
														</div>
													</div>
												</div>
											</div>
										
										</div>
									   <div class="row m-t-30">
										<div class="col-md-12">
										<hr>
											<h4>Les visites :</h4>
										</div>
										<div class="col-md-12">
										<div class="table-responsive">
										<table class="table  zero-configuration dataTable">
											<thead>
											<tr>
											<th>Personnel</th>
											<th>Date de visite</th>
											</tr>
											</thead>
											<tbody>
											@foreach($presentationsView as $one)
												<tr>
												<td>
												@if($one->personnel)
												{{ $one->personnel->nom }} {{ $one->personnel->prenom }}
												@endif
												</td>
												<td>
												{{ $one->created_at }}
												</td>
												</tr>
											@endforeach
											</tbody>
										</table>
										</div>
										</div>
									</div>

								   

						  
								</div>
								<div class="tab-pane" id="question" role="tabpanel" aria-labelledby="home-tab-justified">

									
									@foreach(array_chunk($questions, 2) as $k => $twoQuestions)
										<div class="row">
										 @foreach($twoQuestions as $key => $q)


												<div class="col-md-6">
													<h3 class="text-center">{{$q->Question}}</h3>

													<div id="question{{$key + $k*2}}" class="m-t-30 text-center questionpie">
														<svg></svg>
													</div>
												</div>



										@endforeach
										</div>
									@endforeach
								</div>
								<div class="tab-pane active" id="information" role="tabpanel" aria-labelledby="home-tab-justified">

									<div class="row">

										<div class="col-md-12">
											<div class="row">
												<div class="col-md-3">
													<div class="row">
														<div class="col-md-12">
														<h4><img src="{{ URL::asset('uploads/prez_'.$presentation->id.'/thumb.jpg')}}" alt="" width="150"/>
														</h4></div>
													</div>
												</div>
												<div class="col-md-9">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6"><h4>Nom :</h4></div>
														<div class="col-md-6">
														<h4>
														{{ $presentation->nom}}</h4></div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6"><h4>Description :</h4></div>
														<div class="col-md-6"><h4>{{ $presentation->description}}</h4></div>
													</div>
												</div>
											
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6"><h4>Version :</h4></div>
														<div class="col-md-6"><h4>{{ $presentation->version}}</h4></div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6"><h4>Date de création :</h4></div>
														<div class="col-md-6"><h4>@if($presentation->created_at)
														{{ $presentation->created_at->Format("Y/m/d H:m") }}
														@endif
														</h4></div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6"><h4>Date de mise à jour :</h4></div>
														<div class="col-md-6"><h4>
														@if($presentation->updated_at)
														{{ $presentation->updated_at->Format("Y/m/d H:m") }}
														@endif
														</h4></div>
													</div>
												</div>
												</div>
											</div>
										</div>

									
									</div>
									
								</div>
								<div class="tab-pane" id="personnels" role="tabpanel" aria-labelledby="home-tab-justified">
									<div class="row">
										<div class="col-md-12">


											<div class="panel">
												<div class="panel-heading">
												<div class="row">
												<div class="col-md-4 col-xs-12 ml-auto  float-right">
													<a id="show-modal" href="#" data-toggle="modal" data-target="#linkModal" class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i>
													Ajouter
													</a>
												</div>
												</div>
												</div>
												<div class="panel-body">
													
                    <div class="table-responsive">
					<table class="table  zero-configuration dataTable">
							<thead>
							<tr>
							<th>Nom</th>
							<th>Prenom</th>
							<th>Email</th>
							<th></th>
							</tr>
							</thead>

							<tbody>
							@foreach($presentation->users as $key => $value)
							<tr>
							<td>{{ $value->nom }}</td>
							<td>{{ $value->prenom }}</td>
							<td>{{ $value->email }}</td>
							<td>
							
							 <a href="javascript:;" onclick="detachPersoPres({{ $value->id }},{{ $presentation->id }})" data-toggle="modal" data-target="#detach_perso_pres">
                                    <i class="fa fa-chain-broken"></i> Détacher
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
				<div class="tab-pane" id="groupes" role="tabpanel" aria-labelledby="home-tab-justified">
					<div class="row">
				    <div class="col-md-12">
						<div class="panel">
						<div class="panel-heading">
						<div class="row">
						<div class="col-md-4 col-xs-12 ml-auto  float-right">
						<a id="show-modal" href="#" data-toggle="modal" data-target="#linkgroupeModal" class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i>Ajouter</a>
						</div>
						</div>
						</div>
						<div class="panel-body">
						<div class="table-responsive">
							<table class="table  zero-configuration dataTable">
								<thead>
								<tr>
								<th>Nom</th>
								<th></th>
								</tr>
								</thead>
								<tbody>
								@foreach($presentation->groupes as $key => $value)
									<tr>
									<td>{{ $value->nom }}</td>
									<td>
									
									<a href="javascript:;" onclick="detachGroupePres({{ $value->id }},{{ $presentation->id }})" data-toggle="modal" data-target="#detach_groupe_pres">
                                    <i class="fa fa-chain-broken"></i> Détacher</a>				
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
				 </div>
            </div>
            </div>
            </div>
            </div>
            </div>
      </section>
</div>
    <!-- Modal Upload-->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="pg-close fs-14"></i>
                        </button>
                        <h5>Mise à jour du Presentation</h5>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="updateForm" action="post" accept-charset="UTF-8"
                              enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group-attached">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Selectionner Fichier</label>
                                            <input type="file" name="zipfile" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="p-t-30 clearfix p-l-10 p-r-10">
                                    <div class="progress">
                                        <div class="progress-bar" id="progressUpdate" data-percentage="0%"
                                             style="width: 0%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 m-t-10 sm-m-t-10">
                                <button id="updatebt" type="button" class="btn btn-primary btn-block m-t-5">Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <!-- Modal Link-->
    <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="pg-close fs-14"></i>
                        </button>
                        <h5>Mise à jour du Presentation</h5>
                    </div>
                    <form role="form" method="post" action="{{ url('presentation', array($presentation, 'linkUser')) }}"
                          accept-charset="UTF-8">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group-attached">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default form-group-default-select2">
                                            <label>Selectionner Personnel</label>
                                            <select id="multi" name="users[]" class="full-width" multiple>
                                                @foreach($users as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->nom }} {{ $value->prenom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    <input type="submit" class="btn btn-primary btn-block m-t-5" value="Associer"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>





    <!-- Modal Link-->
    <div class="modal fade" id="linkgroupeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="pg-close fs-14"></i>
                        </button>
                        <h5>Mise à jour du Presentation</h5>
                    </div>
                    <form role="form" method="post"
                          action="{{ url('presentation', array($presentation, 'linkGroupe')) }}" accept-charset="UTF-8">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group-attached">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default form-group-default-select2">
                                            <label>Selectionner Groupe</label>
                                            <select id="multi2" name="groupes[]" class="full-width" multiple>
                                                @foreach($groupes as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    <input type="submit" class="btn btn-primary btn-block m-t-5" value="Associer"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
