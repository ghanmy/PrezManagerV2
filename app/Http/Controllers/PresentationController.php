<?php namespace App\Http\Controllers;

use App\Groupe;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Personnel;
use App\Product;
use App\Presentation;
use App\presentationsView;
use App\viewDelai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
//use Input;
use DB;
use Session;
use ZipArchive;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

use Pdf2Image;
use Image;
use File;
use Illuminate\Filesystem\Filesystem;
use Email;
use Illuminate\Support\Facades\Mail;
use App\Mail\SimpleEmail;
use App\Mail\AffectationEmail;

class presentationController extends Controller {


	const SUCCESS_INSERT ="Ajouté avec succès";
	const SUCCESS_UPDATE ="Modifié avec succès";
	const SUCCESS_DELETE ="Supprimé avec succès";
	
    public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
        $presentations = Presentation::orderBy('id','desc')->get();
		foreach($presentations as $one){
			if($one->id_product) $one->product =Product::find($one->id_product);
			
		//	dd(json_encode($one));
		}
        //return view("presentation.show",compact('presentations'));
        return view("presentation.tableview",compact('presentations'));
		//
	}

    /**
     * Display a tableview of the resource.
     *
     * @return Response
     */
    public function tableView(){
        $presentations = Presentation::orderBy('id','desc')->get();
		foreach($presentations as $one){
			if($one->id_product) $one->product =Product::find($one->id_product);
		}
        return view("presentation.tableview",compact('presentations'));
        //
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		//
		$Products=Product::get();
        return view('presentation.create')
		->with('Products',$Products);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
		//
		$nom=$request->nom;
		$description=$request->description;
		$zipfile=$request->zipfile;
		$message_product=$request->message_product;
		$id_product=$request->id_product;
		
		$validator = \Validator::make([
                'nom' => $nom,
                'description' => $description,
                'zipfile' => $zipfile,
            ], [
                'nom'=>'required',
				'description'=>'required',
				'zipfile'=>'required|mimes:pdf,zip',
            ]);
		if ($validator->fails()){
                $request->session()->flash('danger', $validator->messages());
                return redirect()->back()->withInput();
        }else{


        try {
            if($zipfile == null )
                return Redirect::to('presentation/create');

            $file = $zipfile;
			$presentation = new Presentation;
			if($file->getClientOriginalExtension()=='zip'){
				$filename = time() . $nom . $file->getClientOriginalName();
				$file->move("uploads", $filename);



				$zip = new ZipArchive;
				$res = $zip->open("uploads/" . $filename);
				if ($res === TRUE) {
					for ($i = 0; $i < $zip->numFiles && !strcmp($zip->getNameIndex($i), "thumb.jpg") == 0; $i++) ;
					if (strcmp($zip->getNameIndex($i), "thumb.jpg") == 0) {
						$zip->extractTo('uploads/' . substr($filename, 0, -4) . "/", "thumb.jpg");
						$presentation->ThumURI = 'uploads/' . substr($filename, 0, -4) . "/thumb.jpg";
					}
				}
			}elseif($file->getClientOriginalExtension()=='pdf'){
				$filename = time() . $nom . $file->getClientOriginalName();
				$file->move("uploads/pdf", $filename);
				Image::configure(array('driver' => 'imagick'));
				$urlPDF=base_path().'/public/uploads/pdf/'.$filename;
				$Filesystem = new Filesystem;
				$Filesystem->cleanDirectory(public_path() . "/files/imgs");

				//$pageCount = Pdf2Image::setFile($urlPDF) -> totalPages();
				
				
				$imgThumb = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files",0);
				/*******Create folder for thumbnail image************/
				$folder_path=substr($filename, 0, -8);
				$path_thumb=public_path() . "/uploads/$folder_path";
				File::makeDirectory($path_thumb,0777,true);
				$val=rename($imgThumb[0],  $path_thumb."/thumb.jpg");
				/******************************************************/
				//dd($val);
				$presentation->ThumURI = 'uploads/' . substr($filename, 0, -8) . "/thumb.jpg";

				//Pdf2Image::setCompressionQuality(50);
				$imgs = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files/imgs");
				$Step="";
				$i=0;
				foreach ($imgs as $pageNumber) {
					/*$img = Image::make($pageNumber);
					$img->resize(700, 700);
					$img->save();*/
					rename($pageNumber,  public_path() . "/files/imgs/".$i."jpg");
					$path_parts = pathinfo($pageNumber);
					$ImageName="imgs/".$path_parts['filename'].".".$path_parts['extension'];
		
					//dd($ImageName);
					if($i==0)
					$Step.="<div class='step'  data-x='-1000' data-y='-500' class='show'>";
					else
					$Step.="<div class='step'  data-x='-1000' data-y='-500'>";
					$Step.="<img src='".$ImageName."' ></img>";
					$Step.="</div>";
					$i++;
				}
				$Html=$this->getHead().$Step.$this->getFooter();
				File::put(public_path() . '/files/index.html', $Html);
				$this->Zip(public_path() .'/files', 'uploads/'.$filename.'.zip');
				$filename = $filename.'.zip';
			
			}

			
			$presentation->id_product = $id_product;
			$presentation->message_product = $message_product;
            $presentation->nom = $nom;
            $presentation->description = $description;
            $presentation->ZipURI = "uploads/" . $filename;
            $presentation->save();


            Session::flash('message', 'Successfully created presentation!');
            return Redirect::to('presentation/' . $presentation->id);

        } catch (Exception $e) {
            return Redirect::to('presentation/create');
        }

		}
	}
	 

	function Zip($source, $destination){
    if (!extension_loaded('zip') || !file_exists($source)) {
        return "source : ".$source;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return "destination : ".$destination;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
	}
	public function unzip($source,$destination){
		$zip = new ZipArchive; 
  
		// Zip File Name 
		if ($zip->open($source) === TRUE) { 
		  
			// Unzip Path 
			if($zip->extractTo($destination)){
				$zip->close();
				return true; 				
			}else return "cant extract";
			//echo 'Unzipped Process Successful!'; 
		} else { 
			return 'cant open'; 
		} 
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }
		if($presentation->id_product) 
			$presentation->product =Product::find($presentation->id_product);
			$presentation->users->toArray();
			$presentation->groupes->toArray();

        $ids = array();
        foreach ($presentation->users as $u) {
            $ids[] = $u->id;
        }


        $ids2 = array();
        foreach ($presentation->groupes as $u) {
            $ids2[] = $u->id;
        }


        $views = DB::table('presentations_views')
            ->select('created_at', DB::raw('count(*) as total'))
            ->where("presentation_id",$id)
            ->groupBy('created_at')
            ->get();
			/*foreach($views as $one){
				$one->personnel=Personnel::find($one->personnel_id);
			}*/
			
        $questions = DB::table('questions')
            ->select('Question', 'response')
            ->where("presentation_id",$id)
            ->groupBy('Question','presentation_id')
            ->get()->toArray(); ;
        foreach($questions as $q){
            $q->reps = DB::table('questions')
                ->select('repindex', DB::raw('count(*) as total'))
                ->where("presentation_id",$id)
                ->where("Question",$q->Question)
                ->groupBy('repindex','Question','presentation_id')
                ->get();
        }
			


        $users = Personnel::whereNotIn('id',$ids)->get();
        $Personnels = Personnel::whereIn('id',$ids)->get();
        $Produits = Product::join('presentations','presentations.id_product','products.id')->whereIn('presentations.id',$ids)->get();
        $groupes = Groupe::whereNotIn('id',$ids2)->get();
        $delai = viewDelai::where("presentation_id",$id)->get();
        $presentationsView = presentationsView::where("presentation_id",$id)
		->orderBy('created_at','desc')
		->get();
		foreach($presentationsView as $one){
				$one->personnel=Personnel::find($one->personnel_id);
			}
			
			
			
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
		$presentations=Presentation::get();
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
		$id_pres=$id;
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
		}else{
			
		}
        return view('presentation.single',compact('presentation','users','views','delai','groupes','questions','presentationsView'))->with('Personnels',$Personnels)->with('Produits',$Produits)
		->with('TabDays',$TabDays)
		->with('PreviousmonthCount',$PreviousmonthCount)
		->with('CurrentmonthCount',$CurrentmonthCount)
		->with('TotalCurrentMonth',$TotalCurrentMonth)
		->with('TotalPreviousMonth',$TotalPreviousMonth)
		->with('TabPrez',$TabPrez)
		->with('CountPrez',$CountPrez)
		->with('TabSlide',$TabSlide)
		->with('CountSlide',$CountSlide);
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//

        $presentation = Presentation::find($id);
		if($presentation->id_product) 
			$presentation->product =Product::find($presentation->id_product);
		
		$Products=Product::get();

        return view('presentation.edit',compact('presentation'))
		->with('Products',$Products);
	}

    /**
     * Return the number of views
	 *
	 * @param  int  $id
	 * @return Response
     */
    public function views($id){
        $presentations = Presentation::all();
		foreach($presentations as $one){
			if($one->id_product) $one->product =Product::find($one->id_product);
		}
        $previw = array(count($presentations));


        for($i = 0;$i<count($presentations);$i++){
            $views = DB::table('presentations_views')
                ->select('created_at', DB::raw('count(*) as total'))
                ->where("presentation_id",$presentations[$i]->id)
                ->groupBy('created_at')
                ->get();

            $previw[$i] = array('nom'=>$presentations[$i]->nom,'views'=>$views);
        }

        return $previw;
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$presentation = Presentation::find($id);
        if($presentation == null){
            return response()->json(['error' => 'Error'], 400);
        }
		$date = date('Y-m-d H:i:s');
		$presentation->updated_at = $date;
        $presentation->nom = Input::get('nom');
        $presentation->id_product = Input::get('id_product');
        $presentation->message_product = Input::get('message_product');
        $presentation->description = Input::get('description');
        $presentation->save();
        return Redirect::to('presentation/'.$id);
	}

    /**
     * Update Zip of the presentation.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateZip($id){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return response()->json(['error' => 'Error'], 400);
        }


        try {
            $file = Input::file('zipfile');
			if($file->getClientOriginalExtension()=='zip'){
            $filename = time() . Input::get('nom') . $file->getClientOriginalName();
            $file->move("uploads", $filename);


            $zip = new ZipArchive;
            $res = $zip->open("uploads/" . $filename);
				if ($res === TRUE) {
					for ($i = 0; $i < $zip->numFiles && !strcmp($zip->getNameIndex($i), "thumb.jpg") == 0; $i++) ;
					if (strcmp($zip->getNameIndex($i), "thumb.jpg") == 0) {
						$zip->extractTo('uploads/' . substr($filename, 0, -4) . "/", "thumb.jpg");
						$presentation->ThumURI = 'uploads/' . substr($filename, 0, -4) . "/thumb.jpg";
					}
				}
			}elseif($file->getClientOriginalExtension()=='pdf'){
				$filename = time() . $file->getClientOriginalName();
				$file->move("uploads/pdf", $filename);
				Image::configure(array('driver' => 'imagick'));
				$urlPDF=base_path().'/public/uploads/pdf/'.$filename;
				$Filesystem = new Filesystem;
				$Filesystem->cleanDirectory(public_path() . "/files/imgs");

				$pageCount = Pdf2Image::setFile($urlPDF) -> totalPages();
				
				
				$imgThumb = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files",0);
				/*******Create folder for thumbnail image************/
				$folder_path=substr($filename, 0, -8);

				
				$path_thumb=public_path() . "/uploads/$folder_path";
				$path_thumb_pres=public_path() . "/files/thumb.jpg";
				
				if(!file_exists($path_thumb))
					File::makeDirectory($path_thumb,0777,true);
				$val=rename($imgThumb[0],  $path_thumb."/thumb.jpg");
				$img = Image::make($path_thumb."/thumb.jpg");
				$img->resize(250, 250);
				$img->save();
				
				if(file_exists($path_thumb_pres))
				unlink($path_thumb_pres);
				copy( $path_thumb."/thumb.jpg", $path_thumb_pres);
				
				/******************************************************/
				//dd($val);
				$presentation->ThumURI = 'uploads/' . substr($filename, 0, -8) . "/thumb.jpg";


				$imgs = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files/imgs");
				$Step="";
				$i=1;

				foreach ($imgs as $pageNumber) {
					$img_name= public_path() . "/files/imgs/".$i.".jpg";
					rename($pageNumber,$img_name);
					
					$path_parts = pathinfo($img_name);
					$ImagePath="imgs/".$path_parts['filename'].".".$path_parts['extension'];

					//dd($ImageName);
					if($i==1)
					$Step.="<div data-url='".$ImagePath."' class='show'><div class='num'>".$i."/".$pageCount."</div></div>";		
					else
					$Step.="<div data-url='".$ImagePath."'><div class='num'>".$i."/".$pageCount."</div></div>";
					
					$i++;
				}
				$Html=$this->getHead().$Step.$this->getFooter();
				File::put(public_path() . '/files/index.html', $Html);
				$this->Zip(public_path() .'/files', 'uploads/'.$filename.'.zip');
				
				$filename = $filename.'.zip';
			
			}
			$date = date('Y-m-d H:i:s');
			$presentation->updated_at = $date;
            $presentation->ZipURI = "uploads/" . $filename;
            $presentation->version = $presentation->version + 1;
            $presentation->save();
			
			$result=$this->unzip('uploads/'.$filename,'uploads/prez_'.$presentation->id."/");
            return response()->json(['upload' => 'success']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error'], 400);
        }
    }
    public function storePresentation(Request $request){
		//
		$nom=$request->nom;
		$description=$request->description;
		$zipfile=$request->zipfile;
		$message_product=$request->message_product;
		$id_produit=$request->id_produit;
		
        try {
            if($zipfile == null )
                return Redirect::to('presentation/create');

            $file = $zipfile;
			$presentation = new Presentation;
			if($file->getClientOriginalExtension()=='zip'){
				$filename = time() . $nom . $file->getClientOriginalName();
				$file->move("uploads", $filename);



				$zip = new ZipArchive;
				$res = $zip->open("uploads/" . $filename);
				if ($res === TRUE) {
					for ($i = 0; $i < $zip->numFiles && !strcmp($zip->getNameIndex($i), "thumb.jpg") == 0; $i++) ;
					if (strcmp($zip->getNameIndex($i), "thumb.jpg") == 0) {
						$zip->extractTo('uploads/' . substr($filename, 0, -4) . "/", "thumb.jpg");
						$presentation->ThumURI = 'uploads/' . substr($filename, 0, -4) . "/thumb.jpg";
					}
				}
			}elseif($file->getClientOriginalExtension()=='pdf'){
				$filename = time() .".".$file->getClientOriginalExtension();
				$file->move("uploads/pdf", $filename);
				Image::configure(array('driver' => 'imagick'));
				$urlPDF=base_path().'/public/uploads/pdf/'.$filename;
				$Filesystem = new Filesystem;
				$Filesystem->cleanDirectory(public_path() . "/files/imgs");

				$pageCount = Pdf2Image::setFile($urlPDF) -> totalPages();
				
				
				
				/*******Create folder for thumbnail image************/
				$imgThumb = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files",0);
				$folder_path=substr($filename, 0, -8);
				$path_thumb=public_path() . "/uploads/$folder_path";
				$path_thumb_pres=public_path() . "/files/thumb.jpg";
				if(!file_exists($path_thumb))
					File::makeDirectory($path_thumb,0777,true);
				$val=rename($imgThumb[0],  $path_thumb."/thumb.jpg");
				$img = Image::make($path_thumb."/thumb.jpg");
				$img->resize(250, 250);
				$img->save();
				$presentation->ThumURI = 'uploads/' . substr($filename, 0, -8) . "/thumb.jpg";
				if(file_exists($path_thumb_pres))
				unlink($path_thumb_pres);
				copy( $path_thumb."/thumb.jpg", $path_thumb_pres);
				
				/******************************************************/
			
				


				$imgs = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files/imgs");
				$Step="";
				$i=1;

				foreach ($imgs as $pageNumber) {
					/*$img = Image::make($pageNumber);
					$img->resize(900, 800);
					$img->save();*/
					
					
					$img_name= public_path() . "/files/imgs/".$i.".jpg";
					rename($pageNumber,$img_name);
					
					$path_parts = pathinfo($img_name);
					$ImagePath="imgs/".$path_parts['filename'].".".$path_parts['extension'];

					
					if($i==1)
					$Step.="<div data-url='".$ImagePath."' class='show'><div class='num'>".$i."/".$pageCount."</div></div>";		
					else
					$Step.="<div data-url='".$ImagePath."'><div class='num'>".$i."/".$pageCount."</div></div>";
					
					$i++;
				}
				$Html=$this->getHead().$Step.$this->getFooter();
				File::put(public_path() . '/files/index.html', $Html);
				$this->Zip(public_path() .'/files', 'uploads/'.$filename.'.zip');
				$filename = $filename.'.zip';
			
			}


			$presentation->id_product = $id_produit;
			$presentation->message_product = $message_product;
            $presentation->nom = $nom;
            $presentation->description = $description;
			$presentation->version ='1';
            $presentation->ZipURI = "uploads/" . $filename;
            $presentation->save();
			
			$result=$this->unzip('uploads/'.$filename,'uploads/prez_'.$presentation->id."/");
			
			
			
			return response()->json(['upload' => 'success','result' => $result]);
            //Session::flash('message', 'Successfully created presentation!');
            //return Redirect::to('presentation/' . $presentation->id);

        } catch (Exception $e) {
          //  return Redirect::to('presentation/create');
            return response()->json(['error' => 'Error'], 400);
        }

		
	}
	
	/**
     * Download Zip of the presentation.
     *
     * @param  int  $id
     * @return Response
     */
    public function downloadZip($id){
        $file = Presentation::find($id)->ZipURI;
        return response()->download($file);
    }

    public function linkUser($id){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }
		
			$preznom=$presentation->nom;
			$prezDate= date('Y/m/d H:m');
			
        $users =Input::get('users');
        foreach($users as $u){
			
            $presentation->users()->attach($u);
			
			$Personnel=Personnel::find($u);
			$message = "Une nouvelle présentation nommée ".$preznom." a été affectée à votre compte le ".$prezDate;
			$this->sendEmail($Personnel,htmlentities($message));
        }
        return Redirect::to('presentation/'.$id);

    }


    public function linkGroupe($id){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }

        $groupes =Input::get('groupes');
        foreach($groupes as $u){
            $presentation->groupes()->attach($u);
			$Personnels=Personnel::join('groupe_personnel','groupe_personnel.personnel_id','personnels.id')->where('groupe_personnel.groupe_id',$u)->select('personnels.*')->get();
			//dd($Personnels);
			$preznom=$presentation->nom;
			$prezDate= date('Y/m/d H:m');
			foreach($Personnels as $one){
				$message = "Une nouvelle présentation nommée ".$preznom." a été affectée à votre compte le ".$prezDate;
				$this->sendEmail($one,htmlentities($message));
			}
        }
		
		
        return Redirect::to('presentation/'.$id);

    }


    /**
     * Unlink between user and presentation
     *
     * @param $id
     * @param $uid
     * @return mixed
     */
    public function unlinkUser($id,$uid){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }

        $presentation->users()->detach($uid);
        return Redirect::to('presentation/'.$id);
    }
	public function unlinkPerso(Request $request)
	{ 	
		$id=$request->id_perso_prez_delete;
	 	$id_perso_prez=$request->id_perso_prez;
		$presentation = Presentation::find($id_perso_prez);
        if($presentation == null){
            return Redirect::to('presentation');
        }
        $presentation->users()->detach($id);
		
		$request->session()->flash('success',self::SUCCESS_DELETE);
        return redirect()->back();
	}

    public function unlinkGroupe($id,$uid){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }

        $presentation->groupes()->detach($uid);
        return Redirect::to('presentation/'.$id);
    }
	
    public function unlinkPrezGroupe(Request $request){
		$id=$request->id_groupe_prez_delete;
	 	$id_groupe_prez=$request->id_groupe_prez;
        $presentation = Presentation::find($id_groupe_prez);
        if($presentation == null){
            return Redirect::to('presentation');
        }

        $presentation->groupes()->detach($id);
		$request->session()->flash('success',self::SUCCESS_DELETE);
        return redirect()->back();
    }
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $presentation = Presentation::find($id);
        if($presentation != null){
            $presentation->delete();
        }
        return Redirect::to('presentation');
	}
	
	public function deletePres(Request $request)
	{ 	$id=$request->id_pres_delete;
        $presentation = Presentation::find($id);
        if($presentation != null){
            $presentation->delete();
        }
        return Redirect::to('presentation');
	}
	
	/*******************************SHARED FUNCTION***************************/
	public function getHead(){
		return "<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />

<link rel='stylesheet' href='css/reset.css'>
<link rel='stylesheet' href='css/style.css'>
</head>
<body>
<div class='images'>";
	}
	public function getFooter(){
		return "</div>
<div class='prev hide'></div>
<div class='next'></div>
<script src='js/main.js'></script>

</body>
</html>";
	}
	public function sendEmail($User,$message){
		
		$email=$User->email;
		$Promo["body"]=utf8_encode($message);
		$Promo["name"]=$User->nom." ".$User->prenom;
		//dd($Promo["body"]);
		try{
		Mail::to($email)->send(new AffectationEmail($Promo));
		return true;
		}catch(\Exception $e){
		return $e->getMessage();
		}
		
    }
}
