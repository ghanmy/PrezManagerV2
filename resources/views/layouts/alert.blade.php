@if(Session::has('success'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success" style='text-align:left'>
                <button type="button" class="close" data-dismiss="alert"  style="float: right;">
                    <span aria-hidden="true">x</span>
                    <span class="sr-only">Close</span>
                </button>
                @if(is_object(Session::get('success')))
                    @foreach (Session::get('success')->all(':message') as $message)
                        {{ $message }}
                    @endforeach
                @else
                    {{ Session::get('success') }}
                @endif
            </div>
        </div>
    </div>
@elseif(Session::has('danger'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger" style='text-align:left'>
                <button type="button" class="close" data-dismiss="alert" style="float: right;">
                    <span aria-hidden="true">x</span>
                    <span class="sr-only">Close</span>
                </button>

                @if(is_object(Session::get('danger')))
                    @foreach (Session::get('danger')->all(':message') as $message)
                        {{ $message }}
                        <br>
                    @endforeach
                @else
                    {{ Session::get('danger') }}
                @endif
            </div>
        </div>
    </div>
@elseif(Session::has('warning'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-warning" style='text-align:left'>
                <button type="button" class="close" data-dismiss="alert" style="float: right;">
                    <span aria-hidden="true">x</span>
                    <span class="sr-only">Close</span>
                </button>
				Attention : 
                @if(is_object(Session::get('warning')))
                    @foreach (Session::get('warning')->all(':message') as $message)
                        {{ $message }}
                    @endforeach
                @else
                    {{ Session::get('warning') }}
                @endif
            </div>
        </div>
    </div>
@elseif(Session::has('info'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info" style='    background-color: rgb(235, 101, 33);'>
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">x</span>
                    <span class="sr-only">Close</span>
                </button>

                @if(is_object(Session::get('info')))
                    @foreach (Session::get('info')->all(':message') as $message)
                        {{ $message }}
                    @endforeach
                @else
                    {{ Session::get('info') }}
                @endif
            </div>
        </div>
    </div>
@elseif(Session::has('add_duration'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">x</span>
                    <span class="sr-only">Close</span>
                </button>
				<form class="form_validation" action="{{route('duree_add')}}" method="post"  enctype="multipart/form-data">
									{{csrf_field()}}
                <label for="Nb_calories">Désolé, une erreur de calcul est survenue.</label>
                <label for="Nb_calories">La durée du fichier audio (seconde) : </label>
				<div class="form-group form-float">
					<input type="text" name="Duree_audio" class="form-control" placeholder="La durée du fichier audio"/>
                </div>
					<input type="hidden" name="id_cours_duree" class="form-control" value="{{ Session::get('add_duration') }}"/>
					<button class="btn btn-raised btn-primary btn-round waves-effect" onclick="showLoading()" type="submit">Valider</button>
				</form>
				
            </div>
        </div>
    </div>
@endif