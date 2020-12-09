@extends('app')

@section('content')


    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
                Modifier Présentation
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
				<form class="form-horizontal" action="{{route('pdf')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
									<label>PDF</label>
                                    <div class="form-group form-float">   
									<input type="file" class="form-control btn-primary" name="pdf" id="pdf" title="Browse file" />
                                    </div>
							<button type="submit" class="btn btn-primary btn-round waves-effect">حفظ البيانات</button>
				</form>
				</div>
			</div>
			@if($contentPage!="")
				<div class="row">
				@foreach ($contentPage->getAllPages() as $page)
				{!! $page !!}
				@endforeach
				</div>
			@endif
		</div>
	</div>
@endsection