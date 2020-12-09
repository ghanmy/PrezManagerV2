<?php
 namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Email;
use Session;
use Illuminate\Support\Facades\Mail;

use App\Presentation;
use App\presentationsView;
use App\Personnel;
use App\Groupe;
use App\Product;
use App\viewDelai;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {

		$this->middleware('auth',['except'=>['PostLogin','login','logout','reset','resetPassword']]);
		
    }
	public function PostLogin(Request $request){
		Auth::logout();
		$email = $request->email;
		$password =  $request->password;
		$array = ['email'=>$email,'password'=>$password];

		if (Auth::attempt($array, true)) {
			return redirect()->route('home');
		}else{
			$error = ['error'=>"Error Email/Password !!"];
			return redirect()->back()->withErrors($error);
		}
			
	}
	public function logout(){
	Auth::logout();
	//session()->forget('picture');
	return redirect()->route('auth.login');
	}
	public function login(){
		return view('auth.login');
	}
	public function resetPage($token){
		$Personnel=Personnel::where('code',$token)->first();
		if($Personnel)
		return view('password.reset')->with('id_personnel',$Personnel->id);
		else
		return view('error.404');
	}
	public function resetPassword(Request $request){
		
		$co_password = $request->co_password;
		$password =  $request->password;
		$id_personnel =  $request->id_personnel;
		$validator = \Validator::make([
                'co_password' => $co_password,
                'password' => $password,

            ], [
                'co_password'=>'required',
                'password'=>'required',

            ]);
		if ($validator->fails()){
                $request->session()->flash('danger', $validator->messages());
                return redirect()->back()->withInput();
        }else{
		if(trim($password)!=trim($co_password)){
			$error = ['error'=>"Le mot de passe et le mot de passe de confirmation ne correspondent pas !!"];
			return redirect()->back()->withErrors($error);
		}
		
		$Personnel=Personnel::find($id_personnel);
		$Personnel->password= md5($password);
		$Personnel->save();
		$success = ['success'=>"Réinitialiser le mot de passe est effectué avec succès"];
			return redirect()->back()->withErrors($success);
		
		}
		
		
			
	}
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(){
		$viewDelai=viewDelai::get();
		//dd(json_encode($viewDelai));
        $countPresentation = Presentation::count();
        $countPersonnel = Personnel::count();
        $countGroupe = Groupe::count();
        $countProduct = Product::count();
		
		$presentations = Presentation::all();
		
		
		
		$viewsPerPresentation = DB::table('presentations_views')
                ->select(DB::raw('presentation_id'),DB::raw('count(*) as total'))
                ->groupBy('presentation_id')
                ->paginate(4);
				
		$TabStatusLabel=array();
		$TabStatusCount=array();
		foreach($viewsPerPresentation as $one){
        $pres=Presentation::find($one->presentation_id);
		$one->nom_pres=$pres->nom;
        $TabStatusLabel[]= $pres->nom;
        $TabStatusCount[]= $one->total;
		}
		
		$currMonth=date("m",strtotime(date('Y-m-d')));
		
		/***************************CHART PRESENTATION PER DAY *******************/
		//$selectedPresentation=$one->presentation_id;
		$selectedPresentation=30;
		/*$viewsPerPresentation = DB::table('presentations_views')
                ->select(DB::raw('presentation_id'),DB::raw('count(*) as total'))
                ->where('presentation_id',$selectedPresentation)
                ->get();
				dd(json_encode($viewsPerPresentation));
				
		$viewsPerPresentation = DB::table('view_delais')
                ->select(DB::raw('presentation_id'),DB::raw('count(*) as total'))
                ->where('presentation_id',$selectedPresentation)
                ->get();*/
		
		
		
		$TabDays=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
		$Previousmonth=( date("Y-m", strtotime("previous month")));
		$Currentmonth= date("Y-m");
		
		$PreviousmonthCount=array();
		$CurrentmonthCount=array();
		foreach($TabDays as $Day){
		$PreviousmonthDay=$Previousmonth."-".$Day;
		$CurrentmonthDay=$Currentmonth."-".$Day;
		
		$count = DB::table('presentations_views')->whereDate('created_at',$PreviousmonthDay)->count();
		$PreviousmonthCount[]=$count;
		
		$count = DB::table('presentations_views')->whereDate('created_at',$CurrentmonthDay)->count();
		$CurrentmonthCount[]=$count;
		}
		
		$TotalPreviousMonth=DB::table('presentations_views')->whereBetween('created_at', [$Previousmonth.'-01', $Previousmonth.'-31'])->count();
		$TotalCurrentMonth=DB::table('presentations_views')->whereBetween('created_at', [$Currentmonth.'-01', $Currentmonth.'-31'])->count();
		
		
		$Produits= Product::get();
		$Personnels= Personnel::get();
		$viewsPerPersonnels = DB::table('view_delais')
                ->select(DB::raw('presentation_id'),DB::raw('personnel_id'),DB::raw('count(*) as total'))
                ->groupBy('personnel_id','presentation_id')
                ->get();
				//dd(json_decode($viewsPerPersonnels));
		foreach($viewsPerPersonnels as $one){
		$one->Presentation=Presentation::find($one->presentation_id);
		$one->Personnel=Personnel::find($one->personnel_id);
		}
		
		
		$TabPrez=array();
		//$Presentations=Presentation::get();
		foreach($presentations as $one)
		$TabPrez[]=$one->nom;
		
		foreach($presentations as $Pres){
			
		$CountPerPrez = presentationsView::where('presentation_id',$Pres->id)
		->count();
		$CountPrez[]=$CountPerPrez;
		}
		
		
		
		/***************************CHART SLIDE PER PRESENTATION *******************/
		$TabSlide=array();
		$CountSlide=array();
		$id_pres=$presentations[0]->id;
		$SlidesPres=viewDelai::where('presentation_id',$id_pres)->first();
		if($SlidesPres){
		$delai=$SlidesPres->delai;
		$delai=str_replace("[","",$delai);
		$delai=str_replace("]","",$delai);
		$delai=explode(',', $delai);
		//dd(json_encode($delai));

		$NbrSlide=count($delai);
		/*for($i=1;$i<=$NbrSlide ; $i++)
		$TabSlide[]="Slide ".$i;*/
		
		$viewDelai=viewDelai::where('presentation_id',$id_pres)->get();
		for($i=0;$i<$NbrSlide ; $i++){
			$TotalDelai=0;
			foreach($viewDelai as $one){
				$presDelai=$one->delai;
				$presDelai=str_replace("[","",$presDelai);
				$presDelai=str_replace("]","",$presDelai);
				$presDelai=explode(',', $presDelai);
				//dd((int)$presDelai[$i]);
				$TotalDelai=$TotalDelai+((int)$presDelai[$i]);
				
			}
			
			$TotalDelaiConvert=$this->ConvertisseurTime($TotalDelai);
			$j=$i+1;
			$TabSlide[]="Slide ".$j.": ".$TotalDelaiConvert;
			$CountSlide[]=$TotalDelai;
		}
		}
		
		return view('home')
		->with('Produits',$Produits)
		->with('presentations',$presentations)
		->with('Personnels',$Personnels)
		->with('selectedPresentation',$id_pres)
		->with('countPresentation',$countPresentation)
		->with('countPersonnel',$countPersonnel)
		->with('countGroupe',$countGroupe)
		->with('countProduct',$countProduct)
		->with('TabStatusLabel',$TabStatusLabel)
		->with('TabStatusCount',$TabStatusCount)
		->with('TabDays',$TabDays)
		->with('PreviousmonthCount',$PreviousmonthCount)
		->with('CurrentmonthCount',$CurrentmonthCount)
		->with('TotalCurrentMonth',$TotalCurrentMonth)
		->with('TotalPreviousMonth',$TotalPreviousMonth)
		->with('viewsPerPersonnels',$viewsPerPersonnels)
		->with('viewsPerPresentation',$viewsPerPresentation)
		->with('TabPrez',$TabPrez)
		->with('CountPrez',$CountPrez)
		->with('TabSlide',$TabSlide)
		->with('CountSlide',$CountSlide);
	}
	public function getChartPresentation(Request $request){
  
		$id_presentation=$request->id_presentation;
		
		/***************************CHART PRESENTATION PER DAY *******************/
		
		$TabDays=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
		
		$Previousmonth=( date("Y-m", strtotime("previous month")));
		$Currentmonth= date("Y-m");
		
		$PreviousmonthCount=array();
		$CurrentmonthCount=array();
		foreach($TabDays as $Day){
		$PreviousmonthDay=$Previousmonth."-".$Day;
		$CurrentmonthDay=$Currentmonth."-".$Day;
		if($id_presentation != '-1'){
			$countPrevious = DB::table('presentations_views')->whereDate('created_at',$PreviousmonthDay)->where('presentation_id',$id_presentation)->count();
			
			$countCurrent = DB::table('presentations_views')->whereDate('created_at',$CurrentmonthDay)->where('presentation_id',$id_presentation)->count();
		}else{
			$countPrevious = DB::table('presentations_views')->whereDate('created_at',$PreviousmonthDay)->count();
			
			$countCurrent = DB::table('presentations_views')->whereDate('created_at',$CurrentmonthDay)->count();	
		}
		$CurrentmonthCount[]=$countCurrent;
		$PreviousmonthCount[]=$countPrevious;
		}
		if($id_presentation != '-1'){
			$TotalPreviousMonth=DB::table('presentations_views')->whereBetween('created_at', [$Previousmonth.'-01', $Previousmonth.'-31'])->where('presentation_id',$id_presentation)->count();
			$TotalCurrentMonth=DB::table('presentations_views')->whereBetween('created_at', [$Currentmonth.'-01', $Currentmonth.'-31'])->where('presentation_id',$id_presentation)->count();
		}else{
			$TotalPreviousMonth=DB::table('presentations_views')->whereBetween('created_at', [$Previousmonth.'-01', $Previousmonth.'-31'])->count();
			$TotalCurrentMonth=DB::table('presentations_views')->whereBetween('created_at', [$Currentmonth.'-01', $Currentmonth.'-31'])->count();
		}
		
		
		
		$Tab=array();
		$Tab['TabDays']=$TabDays;
		$Tab['PreviousmonthCount']=$PreviousmonthCount;
		$Tab['CurrentmonthCount']=$CurrentmonthCount;
		$Tab['TotalCurrentMonth']=$TotalCurrentMonth;
		$Tab['TotalPreviousMonth']=$TotalPreviousMonth;

		return response()->json($Tab, 200);
	
	}
	public function getGlobalChart(Request $request){
  
		//$id_pres=$request->id_pres;
		$id_personnel=$request->id_personnel;
		$id_produit=$request->id_produit;
		$from_date=$request->from_date;
		$to_date=$request->to_date;
		$id_pres=$request->id_pres;
		
		/***************************CHART PRESENTATION PER DAY *******************/
		$TabPrez=array();
		if($id_pres)
		$Presentations=Presentation::whereIn('id',$id_pres)->get();
		else
		$Presentations=Presentation::get();
			
		foreach($Presentations as $one)
		$TabPrez[]=$one->nom;
		
		foreach($Presentations as $Pres){
			
		$CountPerPrez = presentationsView::join('presentations','presentations.id','presentations_views.presentation_id')
		->where('presentation_id',$Pres->id)
		->where(function ($query) use ($id_personnel,$id_produit,$from_date,$to_date) {
			if($id_personnel!='-1')
				$query->where('personnel_id', '=', $id_personnel);
			if($id_produit!='-1')
				$query->where('presentations.id_product', '=', $id_produit);
			if($from_date!='')
				$query->where('presentations_views.created_at', '>=', $from_date);
			if($to_date!='')
				$query->where('presentations_views.created_at', '<=', $to_date);
		})->count();
		
		
		$CountPrez[]=$CountPerPrez;
		}
		
		
		
		
		$Tab=array();
		$Tab['TabPrez']=$TabPrez;
		$Tab['CountPrez']=$CountPrez;

		return response()->json($Tab, 200);
	
	}
	public function getSlideChart(Request $request){
  
		//$id_pres=$request->id_pres;
		$id_personnel=$request->id_personnel;
		$id_produit=$request->id_produit;
		$from_date=$request->from_date;
		$to_date=$request->to_date;
		$id_pres=$request->id_pres;
		
		/***************************CHART SLIDE PER PRESENTATION *******************/
		$TabSlide=array();
		$CountSlide=array();
		$SlidesPres=viewDelai::where('presentation_id',$id_pres)->orderBy('created_at','desc')->first();
		if($SlidesPres){

		$delai=$SlidesPres->delai;
		$delai=str_replace("[","",$delai);
		$delai=str_replace("]","",$delai);
		$delai=explode(',', $delai);
		
		$NbrSlide=count($delai);
		
		/*for($i=1;$i<=$NbrSlide ; $i++)
		$TabSlide[]="Slide ".$i;
	
	
	join('presentations','presentations.id','view_delais.presentation_id')
		->*/
		
		$viewDelai=viewDelai::where('presentation_id',$id_pres)
		->where(function ($query) use ($id_personnel,$id_produit,$from_date,$to_date) {
			/*if($id_personnel!='-1')
				$query->where('view_delais.personnel_id', '=', $id_personnel);
			if($id_produit!='-1')
				$query->where('presentations.id_product', '=', $id_produit);*/
			if(trim($from_date)!='')
				$query->whereDate('view_delais.created_at', '>=', $from_date. " 00:00:00");
			if(trim($to_date)!='')
				$query->whereDate('view_delais.created_at', '<=', $to_date. " 00:00:00");
		})->get();
		

		for($i=0;$i<$NbrSlide ; $i++){
			$TotalDelai=0;
			foreach($viewDelai as $one){
				$presDelai=$one->delai;
				$presDelai=str_replace("[","",$presDelai);
				$presDelai=str_replace("]","",$presDelai);
				$presDelai=explode(',', $presDelai);
				//dd((int)$presDelai[$i]);
				if($presDelai)
					$TotalDelai=$TotalDelai+((int)$presDelai[$i]);
				
					
			}
			
			$TotalDelaiConvert=$this->ConvertisseurTime($TotalDelai);
			$j=$i+1;			
			$TabSlide[]="Slide ".$j.": ".$TotalDelaiConvert;

			$CountSlide[]=$TotalDelai;
		}
		
	
		
		}
		
		
		$Tab=array();
		$Tab['TabSlide']=$TabSlide;
		$Tab['CountSlide']=$CountSlide;


		return response()->json($Tab, 200);
	
	}
	public function index1(){
        $presentations = Presentation::all();
        $previw = array(count($presentations));
        $totalviews = DB::table('presentations_views')
            ->select(DB::raw('count(*) as total'))
            ->get();
        $totalviewsweek = DB::table('presentations_views')
            ->select(DB::raw('count(*) as total'))
            ->whereRaw("created_at > '".date("Y-m-d",strtotime('this week', time()))."'")
            ->get();
        $toppresentation= Presentation::find(DB::table('presentations_views')->select("presentation_id",DB::raw('count(*) as total'))->groupBy('presentation_id')->orderBy('total','DESC')->first()->presentation_id);
        for($i = 0;$i<count($presentations);$i++){
            $views = DB::table('presentations_views')
                ->select(DB::raw('count(*) as total'))
                ->where("presentation_id",$presentations[$i]->id)
                ->groupBy('presentation_id')
                ->first();
            $previw[$i] = array('nom'=>$presentations[$i]->nom,'views'=>$views == null ? 0 : $views->total);
        }
		return view('home',compact("previw","totalviews","totalviewsweek","toppresentation"));
	}
	public function ConvertisseurTime($Time){
     if($Time < 3600){ 
       $heures = 0; 
       
       if($Time < 60){$minutes = 0;} 
       else{$minutes = round($Time / 60);} 
       
       $secondes = floor($Time % 60); 
	   $secondes2 = round($secondes % 60); 
	   if($minutes == 0)
	   $TimeFinal = "$secondes2 s"; 
		else
	   $TimeFinal = "$minutes min $secondes2 s"; 
       }else{ 
       $heures = round($Time / 3600); 
       $secondes = round($Time % 3600); 
       $minutes = floor($secondes / 60); 
	   $secondes2 = round($secondes % 60); 
	   $TimeFinal = "$heures h $minutes min $secondes2 s"; 
       } 
       
       
	
       
       return $TimeFinal; 
    }
}
