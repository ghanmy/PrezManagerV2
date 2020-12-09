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
                                    <li class="breadcrumb-item active">{{$groupe->nom}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<a id="show-modal" href="#" data-toggle="modal" data-target="#linkModal" class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i> Ajouter</a>
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
					<h4>Description : </h4><p>{{$groupe->description}}</p>
					 <div class="table-responsive">
						<table class="table  zero-configuration dataTable">
                            <thead>
                            <tr>
                                <th>Personnel</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($groupe->personnels as $key => $value)
                                <tr>
                                    <td>{{ $value->nom }} {{ $value->prenom }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        
										<a href="javascript:;" onclick="deletePersoGroupe({{ $value->id }},{{ $groupe->id }})" data-toggle="modal" data-target="#delete_perso_groupe">
                                    <i class="fa fa-trash"></i> Détacher
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
 



    <!-- Modal Link-->
    <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>Mise à jour du groupe</h5>
                    </div>
                    <form role="form" method="post" action="{{ url('groupe', array($groupe, 'linkUser')) }}" accept-charset="UTF-8">
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

</div>
@endsection


@section('js')


    <script src="{{ URL::asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/datatables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/lodash.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/datatables.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-select2/select2.min.js')}}"></script>
    <script>
        $("#multi").select2();
    </script>

@endsection