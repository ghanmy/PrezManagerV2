<?php $uri=Route::getFacadeRoot()->current()->uri()?>
<div class="modal fade" id="logout" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Se déconnecter</h4>
            </div>
			<form class="form-horizontal" action="{{route('logout')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir quitter?</p>
			</div>
		
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Non</button>
            </div>
			</form>
        </div>
    </div>
</div>	
<div class="modal fade" id="delete_pres" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer</h4>
            </div>
			<form class="form-horizontal" action="{{route('delete_pres')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir supprimer cette présentation?</p>
			</div>
			<input type="hidden" name="id_pres_delete" id="id_pres_delete">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Non</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_prod" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer</h4>
            </div>
			<form class="form-horizontal" action="{{route('delete_prod')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir supprimer ce produit?</p>
			</div>
			<input type="hidden" name="id_prod_delete" id="id_prod_delete">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Non</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_perso" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer</h4>
            </div>
			<form class="form-horizontal" action="{{route('delete_perso')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir supprimer ce personnel?</p>
			</div>
			<input type="hidden" name="id_perso_delete" id="id_perso_delete">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Non</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_groupe" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer</h4>
            </div>
			<form class="form-horizontal" action="{{route('delete_groupe')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir supprimer ce groupe?</p>
			</div>
			<input type="hidden" name="id_groupe_delete" id="id_groupe_delete">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Non</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div class="modal fade" id="detach_perso_pres" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer</h4>
            </div>
			<form class="form-horizontal" action="{{route('detach_perso_pres')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir détacher ce personnel?</p>
			</div>
			<input type="hidden" name="id_perso_prez_delete" id="id_perso_prez_delete">
			<input type="hidden" name="id_perso_prez" id="id_perso_prez">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Non</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div class="modal fade" id="detach_groupe_pres" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer</h4>
            </div>
			<form class="form-horizontal" action="{{route('detach_groupe_pres')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir détacher ce groupe?</p>
			</div>
			<input type="hidden" name="id_groupe_prez_delete" id="id_groupe_prez_delete">
			<input type="hidden" name="id_groupe_prez" id="id_groupe_prez">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Non</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_perso_groupe" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer</h4>
            </div>
			<form class="form-horizontal" action="{{route('delete_perso_groupe')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir détacher ce personnel?</p>
			</div>

			<input type="hidden" name="id_perso_groupe_delete" id="id_perso_groupe_delete">
			<input type="hidden" name="id_perso_groupe" id="id_perso_groupe">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Non</button>
            </div>
			</form>
        </div>
    </div>
</div>
@if (Route::getFacadeRoot()->current()->uri() == 'app/admin')
<div class="modal fade" id="modal_delete_admin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer administrateur</h4>
            </div>
			<form class="form-horizontal" action="{{route('delete_admin')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir supprimer cet administrateur?</p>
			</div>
			<input type="hidden" id="id_delete_admin" name="id_delete_admin">
			
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Nonا</button>
            </div>
			</form>
        </div>
    </div>
</div>		
<div class="modal fade" id="modal_update_admin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Administrateur</h4>
            </div>
			<form class="form-horizontal" action="{{route('update_admin')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
            <div class="modal-body"> 
					<div class="row clearfix">
					<div class="col-md-6">
						 <label>Nom </label>
						 <div class="form-group form-float">
						   <input type="text" name="first_name" id="first_name_edit" class="form-control" placeholder=" Nom" required/>
						 </div>
					</div>
					<div class="col-md-6">
						 <label>Téléphone</label>
						 <div class="form-group form-float">
						   <input type="text" name="phone" id="phone_edit" class="form-control" placeholder="Téléphone" required/>
						 </div>
					</div>
					<div class="col-md-6">
						<label>Email</label>
						<div class="form-group form-float">
								<input type="text" name="email" id="email_edit" class="form-control" placeholder="Email" required/>
						</div>
					</div>
					<div class="col-md-6">
						 <label>Mot de passe</label>
						 <div class="form-group form-float">
							<input type="password" name="password" class="form-control" placeholder="Mot de passe" />                                       
						 </div>
					</div>
				</div>
				
				
			   <label>Photo</label>
               <div class="form-group form-float">    
					<input type="file" class="form-control btn-primary" name="photo" id="filename_image"  />
               </div>
                   				
				<input type="hidden" name="Id_edit_admin" id="Id_edit_admin">
			</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">
				Valider</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Annuler</button>
            </div>
			</form>
        </div>
    </div>
</div>		
<div class="modal fade" id="modal_add_admin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Administrateur</h4>
            </div>
			<form class="form-horizontal" action="{{route('add_admin')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
            <div class="modal-body"> 
					<div class="row clearfix">
					<div class="col-md-6">
						 <label>Nom </label>
						 <div class="form-group form-float">
						   <input type="text" name="first_name"  class="form-control" placeholder=" Nom" required/>
						 </div>
					</div>
					
					<div class="col-md-6">
						 <label>Téléphone</label>
						 <div class="form-group form-float">
						   <input type="text" name="phone"  class="form-control" placeholder="Téléphone" required/>
						 </div>
					</div>
					<div class="col-md-6">
						<label>Email</label>
						<div class="form-group form-float">
								<input type="text" name="email" class="form-control" placeholder="Email" required/>
						</div>
					</div>
					<div class="col-md-6">
						 <label>Mot de passe</label>
						 <div class="form-group form-float">
							<input type="password" name="password" class="form-control" placeholder="Mot de passe" />                                       
						 </div>
					</div>
				</div>
				
				
				
			   <label>Photo</label>
               <div class="form-group form-float">    
					<input type="file" class="form-control btn-primary" name="photo" id="filename_image"  />
               </div>
			       				
			</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">
				Valider</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Annuler</button>
            </div>
			</form>
        </div>
    </div>
</div>	
@endif
@if (Route::getFacadeRoot()->current()->uri() == 'app/company')
<div class="modal fade" id="modal_delete_company" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer société</h4>
            </div>
			<form class="form-horizontal" action="{{route('delete_company')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir supprimer cet société?</p>
			</div>
			<input type="hidden" id="id_delete_company" name="id_delete_company">
			
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Nonا</button>
            </div>
			</form>
        </div>
    </div>
</div>		
<div class="modal fade" id="modal_update_company" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Société</h4>
            </div>
			<form class="form-horizontal" action="{{route('update_company')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
            <div class="modal-body"> 
					<div class="row clearfix">
					<div class="col-md-6">
						 <label>Nom </label>
						 <div class="form-group form-float">
						   <input type="text" name="first_name" id="first_name_edit" class="form-control" placeholder=" Nom" required/>
						 </div>
					</div>
					<div class="col-md-6">
						 <label>Nom de la société </label>
						 <div class="form-group form-float">
						   <input type="text" name="name_company" id="name_company_edit" class="form-control" placeholder="Nom de la société" required/>
						 </div>
					</div>
					<div class="col-md-6">
						 <label>Téléphone</label>
						 <div class="form-group form-float">
						   <input type="text" name="phone" id="phone_edit" class="form-control" placeholder="Téléphone" required/>
						 </div>
					</div>
					<div class="col-md-6">
						<label>Email</label>
						<div class="form-group form-float">
								<input type="text" name="email" id="email_edit" class="form-control" placeholder="Email" required/>
						</div>
					</div>
					<div class="col-md-6">
						 <label>Mot de passe</label>
						 <div class="form-group form-float">
							<input type="password" name="password" class="form-control" placeholder="Mot de passe" />                                       
						 </div>
					</div>
					<div class="col-md-6">
						<label>Photo</label>
					   <div class="form-group form-float">    
							<input type="file" class="form-control btn-primary" name="photo" id="filename_image"  />
					   </div>
					</div>
				</div>
				
				
			   
                   				
				<input type="hidden" name="Id_edit_company" id="Id_edit_company">
			</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">
				Valider</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Annuler</button>
            </div>
			</form>
        </div>
    </div>
</div>		
<div class="modal fade" id="modal_add_company" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Société</h4>
            </div>
			<form class="form-horizontal" action="{{route('add_company')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
            <div class="modal-body"> 
					<div class="row clearfix">
					<div class="col-md-6">
						 <label>Nom </label>
						 <div class="form-group form-float">
						   <input type="text" name="first_name"  class="form-control" placeholder=" Nom" required/>
						 </div>
					</div>
					<div class="col-md-6">
						 <label>Nom de la société </label>
						 <div class="form-group form-float">
						   <input type="text" name="name_company" class="form-control" placeholder="Nom de la société" required/>
						 </div>
					</div>
					<div class="col-md-6">
						 <label>Téléphone</label>
						 <div class="form-group form-float">
						   <input type="text" name="phone"  class="form-control" placeholder="Téléphone" required/>
						 </div>
					</div>
					<div class="col-md-6">
						<label>Email</label>
						<div class="form-group form-float">
								<input type="text" name="email" class="form-control" placeholder="Email" required/>
						</div>
					</div>
					<div class="col-md-6">
						 <label>Mot de passe</label>
						 <div class="form-group form-float">
							<input type="password" name="password" class="form-control" placeholder="Mot de passe" />                                       
						 </div>
					</div>
					<div class="col-md-6">
						 <label>Photo</label>
						 <div class="form-group form-float">
							<input type="file" class="form-control btn-primary" name="photo" id="filename_image"  />                                       
						 </div>
					</div>
				</div>
				
				
				
			  
			       				
			</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">
				Valider</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Annuler</button>
            </div>
			</form>
        </div>
    </div>
</div>	
@endif	
@if (Route::getFacadeRoot()->current()->uri() == 'app/news')
<div class="modal fade" id="modal_delete_news" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Supprimer actualité</h4>
            </div>
			<form class="form-horizontal" action="{{route('delete_news')}}" method="post">
									{{csrf_field()}}
            <div class="modal-body"> 
                            <p>Êtes-vous sûr de vouloir supprimer cette actualités?</p>
			</div>
			<input type="hidden" id="id_delete_news" name="id_delete_news">
			
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">Oui</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Nonا</button>
            </div>
			</form>
        </div>
    </div>
</div>		
<div class="modal fade" id="modal_update_news" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Actualité</h4>
            </div>
			<form class="form-horizontal" action="{{route('update_news')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
            <div class="modal-body"> 
					<div class="row clearfix">
					
					<div class="col-md-12"
					@if(Auth::user()->role=='10')
						style="display:none"
					@endif
					>
						 <label>Société </label>
						 <div class="form-group form-float">
						   @if(Auth::user()->role=='10')
								<input type="text" name="id_company" name="id_company_edit" value="{{Auth::user()->id}}">
							@else
								 <select name="id_company" id="id_company_edit" class="form-control">
								@foreach($Company as $one)
								<option value="{{$one->id}}">{{$one->name_company}}</option>
								@endforeach
								</select>
							@endif
						 </div>
					</div>
					</div>
					<div class="row clearfix">
					<div class="col-md-6">
						 <label>Titre </label>
						 <div class="form-group form-float">
						   <input type="text" name="title" id="title_edit" class="form-control" placeholder="Titre" required/>
						 </div>
					</div>
					
					<div class="col-md-6">
						<label>Photo</label>
					   <div class="form-group form-float">    
							<input type="file" class="form-control btn-primary" name="picture" id="picture"  />
					   </div>
					</div>
					
					<div class="col-md-12">
						 <label>Description</label>
						 <div class="form-group form-float">
						   <textarea rows="7" name="description" id="description_edit" class="form-control" required></textarea>
						 </div>
					</div>
				</div>
				
				
			   
                   				
				<input type="hidden" name="Id_edit_news" id="Id_edit_news">
			</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">
				Valider</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Annuler</button>
            </div>
			</form>
        </div>
    </div>
</div>		
<div class="modal fade" id="modal_add_news" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Actualité</h4>
            </div>
			<form class="form-horizontal" action="{{route('add_news')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
            <div class="modal-body"> 
					<div class="row clearfix">
					<div class="col-md-12"
					@if(Auth::user()->role=='10')
						style="display:none"
					@endif
					>
						 <label>Société </label>
						 <div class="form-group form-float">
							@if(Auth::user()->role=='10')
								<input type="text" name="id_company" value="{{Auth::user()->id}}">
							@else
								 <select name="id_company" id="id_company" class="form-control">
							@foreach($Company as $one)
							<option value="{{$one->id}}">{{$one->name_company}}</option>
							@endforeach
						   </select>
							@endif
						  
						 </div>
					</div>
					<div class="col-md-6">
						 <label>Titre </label>
						 <div class="form-group form-float">
						   <input type="text" name="title" id="title" class="form-control" placeholder="Titre" required/>
						 </div>
					</div>
					
					<div class="col-md-6">
						<label>Photo</label>
					   <div class="form-group form-float">    
							<input type="file" class="form-control btn-primary" name="picture" id="picture"  />
					   </div>
					</div>
					
					<div class="col-md-12">
						 <label>Description</label>
						 <div class="form-group form-float">
						   <textarea rows="7" name="description" id="description" class="form-control" required></textarea>
						 </div>
					</div>
				</div>
				</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-round waves-effect">
				Valider</button>
                <button type="button" class="btn btn-danger btn-simple btn-round waves-effect" data-dismiss="modal">Annuler</button>
            </div>
			</form>
        </div>
    </div>
</div>		
@endif


