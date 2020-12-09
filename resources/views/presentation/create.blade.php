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
                                    <li class="breadcrumb-item active">Ajouter une présentation
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
			   Ajouter une nouvelles présentation</h4>
									
            </div>
			<div class="card-body">
            <div class="row">
			<div class="col-12">
			<form role="form" id="createForm" action="get" accept-charset="UTF-8" enctype="multipart/form-data">
			
											{{csrf_field()}}
					<div class="form-group">
						<label>Nom</label>
						<input type="text" name="nom" id="nom" value="" class="form-control" placeholder="Nom" required/>
					</div>

					
					<div class="form-group">
						<label>Description</label>
						<textarea rows="5" name="description" id="description"  class="form-control" placeholder="Description" required></textarea>
						
					</div>
					 <div class="form-group">
						<label>Produit</label>
						<select name="id_produit" id="id_produit"  class="form-control" >
						@foreach($Products as $one)
						<option value="{{$one->id}}">{{$one->nom}}</option>
						@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Ficher de présentation (Zip,Pdf)</label>
						<input type="file" name="zipfile" id="zipfile" value="" class="form-control"  required/>
						
					</div>
					 
					<div class="row">
						 <div class="col-sm-12 p-l-40">
							  <div class="progress"  style="height: 15px;margin-bottom:0">
                                   <div class="progress-bar" id="progressUpdate" data-percentage="0%" style="width: 0%;"></div>
								   
                              </div>
							  <div id="status" class="float-right"></div>
							  <div id="status-text" class="float-left"></div>
							 <div id="conversation" style="display:none">
							 <div class="loader" class="float-right"></div> 2/2 Conversation PDF en HTML</div>
						  </div>
					</div>
					
					<button  id="createbt" type="submit" class="submit btn btn-raised btn-primary btn-round waves-effect" style="margin-top: 15px;">Créer une présentation </button>

			</form>
			</div>
			</div>
			</div>
			</div>
   </div>
</div>
<style>
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 2s linear infinite;
  margin-left: 65px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
@endsection
@section('js')

@endsection