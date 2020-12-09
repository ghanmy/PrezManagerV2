@extends('app')
@section('content')
<style>
.text-seconday{color:#B8C2CC !important}
.text-teal{color:#20C997 !important}

</style>
     <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
				<section id="dashboard-ecommerce">
                    <div class="row">
					<div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>
                                        <h2 class="text-bold-700 mb-0">{{$countPresentation}}</h2>
                                        <p>Présentations</p>
                                    </div>
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                           <a href="{{ URL::to('presentation') }}"> <i class="feather icon-folder text-primary font-medium-5"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>
                                        <h2 class="text-bold-700 mb-0">{{$countPersonnel}}</h2>
                                        <p>Personnels</p>
                                    </div>
                                    <div class="avatar bg-rgba-success p-50 m-0">
                                        <div class="avatar-content">
                                          <a href="{{ URL::to('personnel') }}">  <i class="feather icon-user text-success font-medium-5"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>
                                        <h2 class="text-bold-700 mb-0">{{$countProduct}}</h2>
                                        <p>Produits</p>
                                    </div>
                                    <div class="avatar bg-rgba-danger p-50 m-0">
                                        <div class="avatar-content">
                                         <a href="{{ URL::to('product') }}">   <i class="feather icon-grid text-danger font-medium-5"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>
                                        <h2 class="text-bold-700 mb-0">{{$countGroupe}}</h2>
                                        <p>Groupes</p>
                                    </div>
                                    <div class="avatar bg-rgba-info p-50 m-0">
                                        <div class="avatar-content">
                                          <a href="{{ URL::to('groupe') }}">  <i class="feather icon-users text-info font-medium-5"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </section>   
                <!-- Dashboard Analytics end -->
				 <section id="dashboard-analytics">
                    <div class="row  match-height">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-end">
                                    <h4 class="card-title">Présentation : </h4><br><br>
									<select name="id_presentation" id="id_presentation"  class="form-control" >
									<option value="-1" selected>Tous les présentations</option>
									@foreach($presentations as $one)
									<option value="{{$one->id}}">{{$one->nom}}</option>
									@endforeach
									</select>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pb-0">
                                        <div class="d-flex justify-content-start">
                                            <div class="mr-2">
                                                <p class="mb-50 text-bold-600">Le mois passé</p>
                                                <h2 class="text-bold-400">
                                                    <span class="text-warning" id="TotalPreviousMonth">
													{{$TotalPreviousMonth}}</span>
                                                    <sup class="font-medium-1">Vues</sup>
                                                </h2>
                                            </div>
                                            <div>
                                                <p class="mb-50 text-bold-600">Ce mois</p>
                                                <h2 class="text-bold-400">
                                                    <span class="text-success" id="TotalCurrentMonth">
													{{$TotalCurrentMonth}}</span>
                                                    <sup class="font-medium-1">Vues</sup>
                                                </h2>
                                            </div>

                                        </div>
                                        <div id="revenue-chart" style="height:350px !important"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
					
					</div>
                   
					<div class="row  match-height">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Personnels/Présentation</h4>
                                </div>
                                <div class="card-body card-dashboard">
								<div class="table-responsive">
								<table class="table  zero-configuration dataTable">
								 <thead>
								  <tr>
                                    <th>Personnel</th>
                                    <th>Présentation</th>
                                    <th>Nombre de vue</th>
								  </tr>
										  </thead>
										  <tbody>
										@foreach($viewsPerPersonnels as $one)
										<tr>
										<th>@if($one->Personnel){{$one->Personnel->nom}}@endif</th>
										<th>
										@if($one->Presentation)
											<img src="{{ URL::asset($one->Presentation->ThumURI)}}" width="70px" alt=""/>{{$one->Presentation->nom}}
										@endif
										</th>
										<th>{{$one->total}}</th>
										</tr>
										@endforeach
                                             </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between pb-0">
                                    <h4 class="card-title">Nombre de vue / Présentation</h4>
                                    <div class="dropdown chart-dropdown">
                                        
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body py-0">
                                        <div id="customer-chart"></div>
                                    </div>
                                    <ul class="list-group list-group-flush customer-info">

                                     @foreach($viewsPerPresentation as $one)
									   <li class="list-group-item d-flex justify-content-between ">
                                            <div class="product-result">
                                                <span>{{$one->nom_pres}}</span>
                                            </div>
											
                                            <div class="series-info">
                                                
                                                <span class="text-bold-600">{{$one->total}}</span>
                                            </div>
                                        </li>

                                    @endforeach
									</ul>
									
									<div class="row" style="margin-top: 20px;">
										<div class="col-3"></div>                 
										<div class="col-6 text-center">     
										<ul class="pagination pagination-primary m-b-0">
								{{ $viewsPerPresentation->links('layouts.Pagination.page') }}
										</ul>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
					</div>
					<section id="pick-a-date">
						<div class="row  match-height">
							<div class="col-lg-12 col-md-12 col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between align-items-end">
										<h4 class="col-12">Présentation : 
										<select name="id_pres" id="id_pres"  class="form-control select2" multiple="multiple" >

										@foreach($presentations as $one)
										<option value="{{$one->id}}">{{$one->nom}}</option>
										@endforeach
										</select>
										</h4>
										<!-------------------------------------------------->
										<h4 class="col-12 form-group ">Personnels : 
										<select name="id_personnel" id="id_personnel"  class="form-control" >
										<option value="-1" selected>Tous les personnels</option>
										@foreach($Personnels as $one)
										<option value="{{$one->id}}">{{$one->nom}} {{$one->prenom}}</option>
										@endforeach
										</select>
										</h4>
										<!------------------------------------------------->
										<h4 class="col-12 form-group">Produits : 
										<select name="id_produit" id="id_produit"  class="form-control" >
										<option value="-1" selected>Tous les produits</option>
										@foreach($Produits as $one)
										<option value="{{$one->id}}">{{$one->nom}} {{$one->prenom}}</option>
										@endforeach
										</select>
										</h4>
										<h4 class="col-6 form-group">Date debut: 
										<form>
										 <input type='text' name="from_date" id="from_date" class="form-control format-picker" />
										 </form>
										</h4>
										<h4 class="col-6 form-group">Date fin: 
										<form>
										  <input type='text' name="to_date" id="to_date" class="form-control format-picker" />
										  </form>
										</h4>
										<span class="col-6">
										<button name="filtre_glob" id="filtre_glob" class="btn btn-primary btn-round waves-effect">Recherche</button>
										<span>
									</div>
									<div class="card-content">
										<div class="card-body pb-0">
											<div id="global-chart" style="height:350px !important"></div>
										</div>
									</div>
								</div>
							</div>
						
						</div>
					   
					</section>
				   

				</div>
					</section>
					<section id="pick-a-date">
							<div class="row  match-height">
								<div class="col-lg-12 col-md-12 col-12">
									<div class="card">
										<div class="card-header d-flex justify-content-between align-items-end">
										
											<h4 class="col-12">Présentation : 
											<select name="id_pres_slide" id="id_pres_slide"  class="form-control" >

											@foreach($presentations as $one)
											<option value="{{$one->id}}">{{$one->nom}}</option>
											@endforeach
											</select>
											</h4>
											<!-------------------------------------------------->
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
						   
						</section>
					   

					</div>
						</section>
			  
		  </div>
   
@endsection			