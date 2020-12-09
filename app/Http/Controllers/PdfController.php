<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Personnel;
use App\Presentation;

use md5;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Pdf2Image;
use Image;
use File;
use Illuminate\Filesystem\Filesystem;
use DB;
use ZipArchive;
use Illuminate\Support\Facades\Input;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class PdfController extends Controller {


	const BaseUrl="http://localhost:8085/PrezManagerV2/public/";
	const BasePicturePDF = 'backend/uploads/pdf/';
	
    public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//

        return view('pdf_html')->with('contentPage','');

	}


	public function exportHtml(Request $request){
		
		
		 $imageUrl ="";
			if ($request->hasFile('pdf')) {
				$imageName = time() . '.' . $request->file('pdf')->getClientOriginalExtension();
				$imageUrl = $imageName;
				$upload_success = $request->file('pdf')->move(base_path().'/public/'.self::BasePicturePDF, $imageName);
			}
		Image::configure(array('driver' => 'imagick'));
		$urlPDF=base_path().'/public/'.self::BasePicturePDF.$imageUrl;
		$pageCount = Pdf2Image::setFile($urlPDF) -> totalPages();
		//dd($pageCount);
		
		$file = new Filesystem;
		$file->cleanDirectory(public_path() . "/files/imgs");
		$imgs = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files/imgs");
		//dd($imgs);
		$Step="";
		foreach ($imgs as $pageNumber) {
			$img = Image::make($pageNumber);
			$img->resize(700, 700);
			$img->save();
			
			$path_parts = pathinfo($pageNumber);
			$ImageName="imgs/".$path_parts['filename'].".".$path_parts['extension'];

			//dd($ImageName);
			$Step.="<div class='step'  data-x='-1000' data-y='-500'>";
			$Step.="<img src='".$ImageName."'></img>";
			$Step.="</div>";
			
		}
		$Html=$this->getHead().$Step.$this->getFooter();
		File::put(public_path() . '/files/index.html', $Html);
        return view('pdf_html')->with('contentPage','');
	}
	
	public function getHead(){
		return "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />



<link rel='apple-touch-icon' href='52.png' />
<link rel='apple-touch-icon' sizes='72x72' href='72.png' />
<link rel='apple-touch-icon' sizes='114x114' href='114.png' />
<link rel='apple-touch-icon' sizes='144x144' href='144.png' />

<meta name='viewport' content = 'width = device-width, initial-scale = 1, user-scalable = yes' />

        <meta name='viewport' content='user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0' />
<meta name='apple-mobile-web-app-capable' content='yes' />
<meta name='apple-touch-fullscreen' content='yes'>




        <title>Sanofi | Pixels Trade</title>
        <link rel='stylesheet' href='css/animate.css'>
        <link rel='stylesheet' href='css/style.css'>
        <script type='text/javascript' src='js/jquery.js'></script>


    </head>
    
    <body><div id='impress'>";
	}
	public function getFooter(){
		return "</div><div class='prev'></div>
				<div class='next'></div>
				<script>
				$(function () {
				impress().init();
				});
				</script>
				<script src='js/impress.js'></script>
				<script src='js/highcharts.js'></script>
				<script src='js/charts.js'></script>
				</body>
				</html>";
	}
	
	public function Step1(Request $request){
		//

		$zipfile=$request->zipfile;
		
        try {
				$file = $zipfile;
				$filename = time() .".".$file->getClientOriginalExtension();
				$file->move("uploads/pdf", $filename);
				Image::configure(array('driver' => 'imagick'));
				$urlPDF=base_path().'/public/uploads/pdf/'.$filename;
				$Filesystem = new Filesystem;
				$Filesystem->cleanDirectory(public_path() . "/files/imgs");

				$pageCount = Pdf2Image::setFile($urlPDF) -> totalPages();
				
				
				
				/*******Create folder for thumbnail image************/
				$imgThumb = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files",0);
				$folder_path=substr($filename, 0, -4);
				$path_thumb=public_path() . "/uploads/$folder_path";
				File::makeDirectory($path_thumb,0777,true);
				$val=rename($imgThumb[0],  $path_thumb."/thumb.jpg");
				$ThumURI = 'uploads/' . substr($filename, 0, -4) . "/thumb.jpg";
				/******************************************************/
			
				
			return response()->json(['upload' => 'success','urlPDF' => $urlPDF,'ThumURI' => $ThumURI,'pageCount' => $pageCount]);
           
        } catch (Exception $e) {
            return response()->json(['error' => 'Error'], 400);
        }

		
	}
	public function step2(Request $request){
		$urlPDF=$request->urlPDF;
		$currentPage=$request->currentPage;
		$pageCount=$request->pageCount;
		
        try {
				 
				Image::configure(array('driver' => 'imagick'));
				//$urlPDF = fopen($urlPDF, 'rb');
				$pageNumber = Pdf2Image::setFile($urlPDF)->saveImages(public_path() . "/files/imgs",$currentPage);
				//$pageNumber = fopen($pageNumber, 'rb');
				
					$img = Image::make($pageNumber[0]);
					$img->resize(700, 700);
					$img->save();
					
					
					$img_name= public_path() . "/files/imgs/".$currentPage.".jpg";
					rename($pageNumber[0],$img_name);
					
					$path_parts = pathinfo($pageNumber[0]);
					$ImagePath="imgs/".$path_parts['filename'].".".$path_parts['extension'];

					
			
				$NextPage=$currentPage+1;
			
			return response()->json(['upload' => 'success','NextPage' => $urlPDF]);
           
        } catch (Exception $e) {
            return response()->json(['error' => 'Error',], 400);
        }

		
	}
	public function step3(Request $request){
		//
		$nom=$request->nom;
		$description=$request->description;
		$message_product=$request->message_product;
		$id_produit=$request->id_produit;
		$countPages=$request->pageCount;
		$urlPDF=$request->urlPDF;
		$ThumURI=$request->ThumURI;
		
        try {
           
				
			
				$filename = $file = basename($urlPDF, ".pdf"); 


				$Step="";

				for($i=0;$i<$countPages;$i++) {
					
					
					$img_name= public_path() . "/files/imgs/".$i.".jpg";

					
					$path_parts = pathinfo($img_name);
					$ImagePath="imgs/".$path_parts['filename'].".".$path_parts['extension'];

					$Step.="<div class='step'  data-x='-1000' data-y='-500'>";
					$Step.="<img src='".$ImagePath."' style='width:100%;height:100%'></img>";
					$Step.="</div>";
					
					
				}
				$Html=$this->getHead().$Step.$this->getFooter();
				File::put(public_path() . '/files/index.html', $Html);
				$this->Zip(public_path() .'/files', 'uploads/'.$filename.'.zip');
				$filename = $filename.'.zip';
			
			
			//$presentation->ThumURI = $ThumURI;
			$presentation->id_product = $id_produit;
			$presentation->message_product = $message_product;
            $presentation->nom = $nom;
            $presentation->description = $description;
            $presentation->ZipURI = "uploads/" . $filename;
            $presentation->save();
			
			
			return response()->json(['upload' => 'success']);
           
        } catch (Exception $e) {
            return response()->json(['error' => 'Error'], 400);
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
	
	
}
