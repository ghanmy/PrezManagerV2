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
									<li class="breadcrumb-item"><a href="{{ URL::to('product') }}">Produits
									</a>
                                    </li>
                                    <li class="breadcrumb-item active">Modifier un produit
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
			   Modifier un produit</h4>
									
            </div>
			<div class="card-body">
            <div class="row">
			<div class="col-12">
            <form action="{{route('product.update')}}" method="post"  enctype="multipart/form-data">
									{{csrf_field()}}
            <div class="form-group">
				<label>Nom</label>
				<input type="text" name="nom" id="nom" value="{{$Product->nom}}" class="form-control" placeholder="Nom" required/>
            </div>

            <div class="form-group">
				<label>Description</label>
				<textarea rows="5" name="description" id="description"  class="form-control" placeholder="Description">{{$Product->description}}</textarea>
                
            </div>
			<div class="form-group">
				<label>Photo</label>
				<input type="file" name="photo" id="photo" value="" class="form-control"  />
				
			</div>
			<input type="hidden" name="id_product" value="{{$Product->id}}">
			 <button type="submit" class="btn btn-primary btn-round waves-effect">
				Modifier un produit</button>
           

            </form>
			</div>
			</div>
			</div>
			</div>
   </div>
</div>
@endsection