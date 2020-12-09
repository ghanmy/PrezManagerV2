    <?php $uri=Route::getFacadeRoot()->current()->uri(); ?>
	<!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

      <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <!-- BEGIN: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->
<!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/extensions/dropzone.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
   <!-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
     END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
	 <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>

	<script>
	  var $primary = '#7367F0';
	  var $success = '#28C76F';
	  var $danger = '#EA5455';
	  var $warning = '#FF9F43';
	  var $info = '#00cfe8';
	  var $seconday = '#B8C2CC';
	  var $teal = '#20C997';
	  var $primary_light = '#A9A2F6';
	  var $danger_light = '#f29292';
	  var $success_light = '#55DD92';
	  var $warning_light = '#ffc085';
	  var $info_light = '#1fcadb';
	  var $strok_color = '#b9c3cd';
	  var $label_color = '#e7e7e7';
	  var $white = '#fff';
	$(document).ready(function() {
	  "use strict"
	  // init list view datatable
	$('.format-picker').pickadate({
        format: 'yyyy-mm-dd'
    });
	
	});
	
	function deletePres(id){
		$("#id_pres_delete").val(id);
	}
	function deleteProd(id){
		$("#id_prod_delete").val(id);
	}
	function deletePerso(id){
		$("#id_perso_delete").val(id);
	}
	function deleteGroupe(id){
		$("#id_groupe_delete").val(id);
	}
	function deletePersoGroupe(id,id_groupe){
		$("#id_perso_groupe_delete").val(id);
		$("#id_perso_groupe").val(id_groupe);
	}
	function detachPersoPres(id,id_prez){
		$("#id_perso_prez_delete").val(id);
		$("#id_perso_prez").val(id_prez);
	}
	function detachGroupePres(id,id_prez){
		$("#id_groupe_prez_delete").val(id);
		$("#id_groupe_prez").val(id_prez);
	}
	</script>
	<?php $Uri=Route::getFacadeRoot()->current()->uri();?>

	<script>


        var table = $('#tableWithSearch2');
        var settings = {
            "sDom": "<'table-responsive't><'row'<p i>>",
            "sPaginationType": "bootstrap",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {"sLengthMenu": "_MENU_ ", "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"},
            "iDisplayLength": 5
        };
        table.dataTable(settings);
        $('#search-table2').keyup(function () {
            table.fnFilter($(this).val());
        });


        $('#updatebt').click(function () {
            var formData = new FormData($('#updateForm')[0]);
            $.ajax({
                url: window.location + '/updateZip',  //Server script to process data
                type: 'POST',
                xhr: function () {  // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Check if upload property exists
                        myXhr.upload.addEventListener('progress', progressHandlingFunction1, false); // For handling the progress of the upload
                    }
                    return myXhr;
                },
                //Ajax events
                beforeSend: beforeSendHandler1,
                success: completeHandler1,
                error: errorHandler1,
                // Form data
                data: formData,
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function beforeSendHandler1(e) {
            $('#progressUpdate').css('width', '0%');
            $('#progressUpdate').data('percentage', '0%');
        }
        function progressHandlingFunction1(e) {
            if (e.lengthComputable) {
                var percentage = (e.loaded / e.total) * 100
                $('#progressUpdate').css('width', percentage + '%');
                $('#progressUpdate').data('percentage', percentage + '%');

            }
        }
        function completeHandler1(e) {
            $('#progressUpdate').css('width', '100%');
            $('#progressUpdate').data('percentage', '100%');
            console.log(e);
            if (e['upload'] != undefined && e['upload'] == 'success') {
                window.location.reload();
            }
        }
        function errorHandler1(e) {
            alert("Erreur lors de mise à jour");
            window.location.reload();
        }


        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            jQuery(window).trigger('resize');
            console.log("resize");
        });

        $(".select2").select2({
			dropdownAutoWidth: true,
			width: '100%',
			maximumSelectionLength: 5,
			placeholder: "Sélectionnez au maximum 5 présentations"
			});
		  
    </script>
	<!--------------------------------STEPS---------------------------------------->
	@if ($Uri == 'presentation/createq')
	<script>
	$(function() {
	$("form#createForm1").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
	for (var key of formData.entries()) {
    console.log(key[0] + ', ' + key[1]);
	}
            $.ajax({
				url : "{{ URL::to('step1') }}" ,
                type: 'POST',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                xhr: function () {  // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Check if upload property exists
                        myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // For handling the progress of the upload
                    }
                    return myXhr;
                },
                //Ajax events
                beforeSend: beforeSendHandler,
                success: completeHandler,
                error: errorHandler,
                // Form data
                data: formData,
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false
            });
        });
		
        function beforeSendHandler(e) {
            $('#progressUpdate').css('width', '0%');
            $('#progressUpdate').data('percentage', '0%');
        }
        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
				
                var percentage = ((e.loaded / e.total) * 100);
				
                $('#progressUpdate').css('width', percentage + '%');
                $('#progressUpdate').data('percentage', percentage + '%');
				$("#status").html(Math.round(percentage) + '%');
				
            }
        }
        function completeHandler(e) {
            $('#progressUpdate').css('width', '100%');
            $('#progressUpdate').data('percentage', '100%');
            console.log(e['upload']);
            if (e['upload'] != undefined && e['upload'] == 'success') {
				//var tab=(e['tab']);
				var urlPDF=(e['urlPDF']);
				var ThumURI=(e['ThumURI']);
				var pageCount=(e['pageCount']);
				//alert(urlPDF);
				var promises = [];
				for(var i=0;i<pageCount;i++){
					
					var request =step2(urlPDF,i,pageCount);
					promises.push(request);
				}
				
				$.when.apply($, promises)
				.done(function() {
					console.log("All done!") // do other stuff
					var nom= $("#nom").val();
					var description= $("#description").val();
					var message_product= $("#message_product").val();
					var id_produit= $("#id_produit").val();
				step3(nom,description,message_product,id_produit,pageCount,urlPDF,ThumURI);
				}).fail(function() {
					// something went wrong here, handle it
				});
	
				
				
				
				
				
               //window.location.reload();
				//window.location.href = {{ URL::to('presentation') }};
            }
        }
        function errorHandler(e) {
            alert("Erreur lors de mise à jour");
			 console.log(e);
          // window.location.reload();
        }
   
   function step2(urlPDF,currentPage,pageCount){

	var formData = new FormData();
	formData.append('urlPDF', urlPDF);
	formData.append('currentPage', currentPage);
	formData.append('pageCount', pageCount);
	formData.append('_token', '<?php echo csrf_token() ?>');

	   $.ajax({
				url : "{{ URL::to('step2') }}" ,
                type: 'POST',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                //Ajax events
                beforeSend: beforeSendHandler,
                success: function(result){
					console.log("step2"+result); 
				},
                error: errorHandler,
                // Form data
                 data: formData,
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false
            });
   }
   function step3(nom,description,message_product,id_produit,pageCount,urlPDF,ThumURI){
	   
	var formData1 = new FormData();
	formData1.append('nom', nom);
	formData1.append('description', description);
	formData1.append('message_product', message_product);
	formData1.append('id_produit', id_produit);
	formData1.append('pageCount', pageCount);
	formData1.append('urlPDF', urlPDF);
	formData1.append('ThumURI', ThumURI);
	formData1.append('_token', '<?php echo csrf_token() ?>');
	for (var key of formData1.entries()) {
    console.log(key[0] + ', ' + key[1]);
	}
	   $.ajax({
				url : "{{ URL::to('step3') }}" ,
                type: 'POST',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                //Ajax events
               // beforeSend: beforeSendHandler,
                success: function(result){
					console.log("step3"+result); 
				},
                error: errorHandler,
                // Form data
                 data: formData1,
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false
            });
   }
   
   
		
   
   
   });
   </script>
	@endif
	<!------------------------------------------------------------------------------>

	<script>
	$(function() {

		$('form').submit(function() {
		  $(this).find("button[type='submit']").prop('disabled',true);
		});
	}); 
   </script>
	@if ($Uri == 'presentation/create')
	<script>
	$.fn.hasExtension = function(exts) {
		return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test($(this).val());
	}
	$(function() {
	$("form#createForm").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
	var typeFile="";
	if ($('#zipfile').hasExtension(['.pdf', '.PDF'])) {
		typeFile= 'pdf';
	}
	for (var key of formData.entries()) {
    console.log(key[0] + ', ' + key[1]);
	}
            $.ajax({
				url : "{{ URL::to('store_presentation') }}" ,
                type: 'POST',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                xhr: function () {  // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Check if upload property exists
                        myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // For handling the progress of the upload
                    }
                    return myXhr;
                },
                //Ajax events
                beforeSend: beforeSendHandler,
                success: completeHandler,
                error: errorHandler,
                // Form data
                data: formData,
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function beforeSendHandler(e) {
            $('#progressUpdate').css('width', '0%');
            $('#progressUpdate').data('percentage', '0%');
        }
        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
                var percentage = ((e.loaded /e.total) * 100);
				if ($('#zipfile').hasExtension(['.pdf', '.PDF'])) {
					$('#progressUpdate').css('width', percentage + '%');
					$('#progressUpdate').data('percentage', percentage + '%');
					$("#status").html(Math.round(percentage) + '% ');
					$("#status-text").html('1/2 Chargement de PDF');
					
					if(percentage==100){
						$("#status").hide();
						$("#status-text").hide();
						$(".progress").hide();
						$("#conversation").show();
					}
				}else{
				
				$('#progressUpdate').css('width', percentage + '%');
                $('#progressUpdate').data('percentage', percentage + '%');	
				$("#status").html(Math.round(percentage) + '% ');
				$("#status-text").html('Chargement de la présentation');
				}	
            }
        }
        function completeHandler(e) {
            $('#progressUpdate').css('width', '100%');
            $('#progressUpdate').data('percentage', '100%');
            console.log(e['upload']);
            if (e['upload'] != undefined && e['upload'] == 'success') {
               window.location.reload();
				//window.location.href = {{ URL::to('presentation') }};
            }
        }
        function errorHandler(e) {
            alert("Erreur lors de mise à jour");
			 console.log(e);
          // window.location.reload();
        }
   });
   </script>
	@endif
	 
	@if ($Uri == 'home' || $Uri == '/' || Route::is('presentation.show'))
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="{{ asset('app-assets/vendors/js/extensions/tether.min.js') }}"></script>

		<script>
	 
	
	/******************SLIDE VIEWS******************/
	  var slideChartoptions = {
		chart: {
		  id:'slide',
		  height: 270,
		  toolbar: { show: true },
		  type: 'bar',
		},
		stroke: {
		  curve: 'smooth',
		  dashArray: [0, 8],
		  width: [4, 2],
		},
		grid: {
		  borderColor: $label_color,
		},
		legend: {
		  show: true,
		},
		colors: [$info, $info],

		fill: {
		  type: 'gradient',
		  gradient: {
			shade: 'dark',
			inverseColors: true,
			gradientToColors: [$info, $info],
			shadeIntensity: 1,
			type: 'horizontal',
			opacityFrom: 1,
			opacityTo: 1,
			stops: [0, 100, 100, 100]
		  },
		},
		markers: {
		  size: 0,
		  hover: {
			size: 3
		  }
		},
		xaxis: {
		  labels: {
			style: {
			  colors: $danger,
			}
		  },
		  axisTicks: {
			show: false,
		  },
		  categories: <?php echo json_encode($TabSlide); ?>,
		  axisBorder: {
			show: false,
		  },
		  tickPlacement: 'off',
		},
		yaxis: {
		  show: false,
		  tickAmount: 5,
		  labels: {
			style: {
			  color: $strok_color,
			},
			formatter: function (val) {
			  return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
			}
		  }
		},
		tooltip: {
		  x: { show: false }
		},
		series: [{
		  name: "Delai slide/seconde",
		  data: {{json_encode($CountSlide)}}
		}
		],

	  }

		  var slideChart = new ApexCharts(
			document.querySelector("#slide-chart"),
			slideChartoptions
		  );

		  slideChart.render();


	$("#filtre_slide").click( function(){
    
	
	var id_pres=$("#id_pres_slide").val();
	var id_personnel=$("#id_personnel_slide").val();
	var id_produit=$("#id_produit_slide").val();
	var from_date=$("#from_date_slide").val();
	var to_date=$("#to_date_slide").val();

	console.log(id_pres);
    $.ajax({
       url : "{{ URL::to('slide_presentation') }}" ,
	   method: 'post',
       data: {
          id_personnel: id_personnel,
          id_produit: id_produit,
          from_date: from_date,
          to_date: to_date,
          id_pres: id_pres,
          _token : '<?php echo csrf_token() ?>'
       },
       dataType : 'json',
       
		success : function(result, statut){ // success est toujours en place, bien sûr !
          
		  
		   var CountSlide=result.CountSlide;
		   var TabSlide=result.TabSlide;

		   
		   data = [];
		   for(var i=0;i<CountSlide.length;i++)
			data.push(CountSlide[i]);
		   
			 ApexCharts.exec("slide", "updateOptions", {
			  series: [{
				  name: "Delai slide/seconde",
				  data: data
				}
			  ],
			  xaxis: {
				categories: result.TabSlide
			  }
			});
			 
       },
       error : function(resultat, statut, erreur){

       }

    });

});
	

		</script>
	@endif
	@if ($Uri == 'home' || $Uri == '/' )
	<!--<script src="{{ asset('app-assets/vendors/js/charts/apexchartsapexcharts.min.js') }}"></script>-->
    
	
	<script>
	  	 /******************DATE/PERSONNELS/PRODUCTS CHART******************/
	  var GlobalChartoptions = {
		chart: {
		  id:'glob',
		  height: 270,
		  toolbar: { show: true },
		  type: 'bar',
		},
		stroke: {
		  curve: 'smooth',
		  dashArray: [0, 8],
		  width: [4, 2],
		},
		grid: {
		  borderColor: $label_color,
		},
		legend: {
		  show: true,
		},
		colors: [$success, $danger],

		fill: {
		  type: 'gradient',
		  gradient: {
			shade: 'dark',
			inverseColors: false,
			gradientToColors: [$success, $danger],
			shadeIntensity: 1,
			type: 'horizontal',
			opacityFrom: 1,
			opacityTo: 1,
			stops: [0, 100, 100, 100]
		  },
		},
		markers: {
		  size: 0,
		  hover: {
			size: 5
		  }
		},
		xaxis: {
		  labels: {
			style: {
			  colors: $danger,
			}
		  },
		  axisTicks: {
			show: false,
		  },
		  categories: <?php echo json_encode($TabPrez); ?>,
		  axisBorder: {
			show: false,
		  },
		  tickPlacement: 'on',
		},
		yaxis: {
		  tickAmount: 5,
		  labels: {
			style: {
			  color: $strok_color,
			},
			formatter: function (val) {
			  return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
			}
		  }
		},
		tooltip: {
		  x: { show: false }
		},
		series: [{
		  name: "Nombre de vue",
		  data: {{json_encode($CountPrez)}}
		}
		],

	  }

	  var GlobalChart = new ApexCharts(
		document.querySelector("#global-chart"),
		GlobalChartoptions
	  );

	  GlobalChart.render();
	 
	 // var revenueChart;
	 // var revenueChartoptions ;
		/******************PRESENTATIONS VIEWS******************/
	   var customerChartoptions = {
			chart: {
			  type: 'pie',
			  height: 330,
			  dropShadow: {
				enabled: true,
				blur: 5,
				left: 1,
				top: 1,
				opacity: 0.2
			  },
			  toolbar: {
				show: false
			  }
			},
			labels: <?php echo json_encode($TabStatusLabel); ?>,
			series: <?php echo json_encode($TabStatusCount); ?>,
			dataLabels: {
			  enabled: true
			},
			legend: { show: false },
			stroke: {
			  width: 5
			},
			colors: [$primary, $success, $danger, $warning, $info, $seconday, $teal],
			fill: {
			  type: 'gradient',
			  gradient: {
				gradientToColors: [$primary, $success, $danger, $warning, $info, $seconday, $teal]
			  }
			}
		  }

		  var customerChart = new ApexCharts(
			document.querySelector("#customer-chart"),
			customerChartoptions
		  );

		  customerChart.render();
	  /******************PRESENTATIONS CHART******************/
	  var revenueChartoptions = {
		chart: {
		  id:'prez',
		  height: 270,
		  toolbar: { show: true },
		  type: 'line',
		},
		stroke: {
		  curve: 'smooth',
		  dashArray: [0, 8],
		  width: [4, 2],
		},
		grid: {
		  borderColor: $label_color,
		},
		legend: {
		  show: true,
		},
		colors: [$success, $warning],

		fill: {
		  type: 'gradient',
		  gradient: {
			shade: 'dark',
			inverseColors: false,
			gradientToColors: [$success, $warning],
			shadeIntensity: 1,
			type: 'horizontal',
			opacityFrom: 1,
			opacityTo: 1,
			stops: [0, 100, 100, 100]
		  },
		},
		markers: {
		  size: 0,
		  hover: {
			size: 5
		  }
		},
		xaxis: {
		  labels: {
			style: {
			  colors: $warning,
			}
		  },
		  axisTicks: {
			show: false,
		  },
		  categories: <?php echo json_encode($TabDays); ?>,
		  axisBorder: {
			show: false,
		  },
		  tickPlacement: 'on',
		},
		yaxis: {
		  tickAmount: 5,
		  labels: {
			style: {
			  color: $strok_color,
			},
			formatter: function (val) {
			  return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
			}
		  }
		},
		tooltip: {
		  x: { show: false }
		},
		series: [{
		  name: "Ce mois",
		  data: {{json_encode($CurrentmonthCount)}}
		},
		{
		  name: "Le mois passé",
		  data: {{json_encode($PreviousmonthCount)}}
		}
		],

	  }

	  var revenueChart = new ApexCharts(
		document.querySelector("#revenue-chart"),
		revenueChartoptions
	  );

	  revenueChart.render();
	  
	/***************************************************/
	
	$('#id_presentation').on('change',function(){
	
	var id_presentation=$(this).val();
	
    $.ajax({
       url : "{{ URL::to('data_presentation') }}" ,
	   method: 'post',
       data: {
          id_presentation: id_presentation,
          _token : '<?php echo csrf_token() ?>'
       },
       dataType : 'json',
       
		success : function(result, statut){ // success est toujours en place, bien sûr !
           $("#TotalCurrentMonth").html(result.TotalCurrentMonth);
           $("#TotalPreviousMonth").html(result.TotalPreviousMonth);
		   // result= JSON.parse(result);
		   var CurrentmonthCount=result.CurrentmonthCount
		   var PreviousmonthCount=result.PreviousmonthCount
		   
		   data1 = [];data2 = [];
		   for(var i=0;i<CurrentmonthCount.length;i++)
			data1.push(CurrentmonthCount[i]);
		   for(var i=0;i<PreviousmonthCount.length;i++)
			data2.push(PreviousmonthCount[i]);
		
		
		
			 ApexCharts.exec("prez", "updateOptions", {
			  series: [{
				  name: "Ce mois",
				  data: data1
				},
				{
				  name: "Le mois passé",
				  data: data2
				}
			  ],
			  xaxis: {
				categories: result.TabDays
			  }
			});
			 
       },
       error : function(resultat, statut, erreur){

       }

    });

});
	$("#filtre_glob").click( function(){
    
	
	var id_personnel=$("#id_personnel").val();
	var id_produit=$("#id_produit").val();
	var from_date=$("#from_date").val();
	var to_date=$("#to_date").val();
	var id_pres=$("#id_pres").val();
	console.log(id_pres);
    $.ajax({
       url : "{{ URL::to('global_presentation') }}" ,
	   method: 'post',
       data: {
          id_personnel: id_personnel,
          id_produit: id_produit,
          from_date: from_date,
          to_date: to_date,
          id_pres: id_pres,
          _token : '<?php echo csrf_token() ?>'
       },
       dataType : 'json',
       
		success : function(result, statut){ // success est toujours en place, bien sûr !
          
		  
		   var CountPrez=result.CountPrez;
		   var TabPrez=result.TabPrez;

		   
		   data = [];
		   for(var i=0;i<CountPrez.length;i++)
			data.push(CountPrez[i]);
		   
		
		
		
			 ApexCharts.exec("glob", "updateOptions", {
			  series: [{
				  name: "Nombre de vue",
				  data: data
				}
			  ],
			  xaxis: {
				categories: result.TabPrez
			  }
			});
			 
       },
       error : function(resultat, statut, erreur){

       }

    });

});
	
	</script>
	@endif
	
	<script src="{{ asset('app-assets/js/scripts/ui/data-list-view.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
	
	