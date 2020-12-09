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
									<li class="breadcrumb-item"><a href="{{ URL::to('personnel') }}">Personnels
									</a>
                                    </li>
                                    <li class="breadcrumb-item active">Ajouter un personnel
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
			   Ajouter un nouveau personnel</h4>
									
            </div>
			<div class="card-body">
            <div class="row">
			<div class="col-12">
			<form action="{{route('personnel.store')}}" method="post"  enctype="multipart/form-data">
									{{csrf_field()}}
            <div class="form-group">
				<label>Nom</label>
				<input type="text" name="nom" id="nom" value="{{old('nom')}}" class="form-control" placeholder="Nom" required/>
            </div>

            <div class="form-group">
				<label>Prénom</label>
				<input type="text" name="prenom" id="prenom" value="{{old('prenom')}}" class="form-control" placeholder="Prenom" required/>
                
            </div>
            <div class="form-group">
				<label>Email</label>
				<input type="text" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Email" required/>
               
            </div>

            <div class="form-group">
				<label>Mot de passe</label>
				<input type="password" name="password" id="password" value="{{old('password')}}" class="form-control" placeholder="Mot de passe" />
                
            </div>
			<div class="form-group">
				<label>Photo de profil</label>
				<input type="file" name="photo" id="photo" value="" class="form-control"  />
				
			</div>
			 <button type="submit" class="btn btn-primary btn-round waves-effect">
				Ajouter un personnel</button>
           

            </form>
        </div>
		</div>
		</div>
		</div>
   </div>
</div>



@endsection