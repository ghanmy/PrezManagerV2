<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Presentation;
use App\presentationsView;
use App\Question;
use App\viewDelai;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use JWTAuth;
use Input;
use md5;
use App\Personnel;
use Email;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordEmail;

class ApiController extends Controller
{
 public function __construct()
 {
 $this->middleware('auth:api', ['except' => ['authenticate','forgotPassword']]);
 }

    private function personnelInArray($obj,$array){
        foreach($array as $i){
            if($i->id == $obj->id)
                return true;
        }
        return false;
    }


    /**
     * Returns Authentication JWT token
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $personnels = Personnel::where('email', $credentials['email'])->where('password', md5($credentials['password']))->get();
        if (count($personnels) != 0) {
            $personnel = $personnels[0];
            $token = JWTAuth::fromUser($personnel);
            return response()->json(compact('token'));
        } else {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
    }

    /**
     * Retrun User Object
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUser(Request $request)
    {//dd($request->token);
	$token=$request->token;
	//dd($token);
        try {
            //$user = JWTAuth::toUser($token);
			//$token=$request->token;
			$token=JWTAuth::getToken();
			$user = JWTAuth::parseToken()->toUser();
			//dd($user);
            if ($user)
                return $user;
            else
                return response()->json(['error' => 'invalid_credentials'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }


    }

    /**
     * store presentation views
     *
     * @param Request $request
     * @return mixed
     */
    public function addViews(Request $request){

        try {
			$token=JWTAuth::getToken();
            $user = JWTAuth::parseToken()->toUser();
            if (!$user)
                return response()->json(['error' => 'invalid_credentials'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
		$data =json_decode($request->data);
        //$data =INPUT::get("data");
        //for($i=0;$i<count($data);$i++){
		   $date = date('Y-m-d H:i:s');
			foreach($data as $one){
            $vp = new presentationsView;
            $vp->presentation_id = $one->presentationid;
            $vp->personnel_id = $user->id;
            $vp->created_at = $date;
            $vp->save();
        }
        return $data;
    }

    public function addQuestions(Request $request){
        try {
            $user = JWTAuth::parseToken()->toUser();
            if (!$user)
                return response()->json(['error' => 'invalid_credentials'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $data =INPUT::get("data");
        for($i=0;$i<count($data);$i++){
            $question = new Question;
            $question->presentation_id = $data[$i]["presentationid"];
            $question->Question = $data[$i]["question"];
            $question->response = $data[$i]["response"];
            $question->repindex = $data[$i]["repindex"];
            $question->save();
        }
        return $data;
    }


    /**
     * store presentation Delai
     *
     * @param Request $request
     * @return mixed
     */
    public function addDelay(Request $request){
        try {
			$token=JWTAuth::getToken();
			//dd($token);
            $user = JWTAuth::parseToken()->toUser();
            if (!$user)
                return response()->json(['error' => 'invalid_credentials'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $data =json_decode($request->data);
       // for($i=0;$i<count($data);$i++)
		   $date = date('Y-m-d H:i:s');
		foreach($data as $one){
            $vp = new viewDelai;
            $vp->presentation_id = $one->presentationid;
            $vp->personnel_id = $user->id;
            $vp->delai = $one->delai;
            $vp->created_at = $date;
            $vp->updated_at = $date;
            $vp->save();
        }
        return $data;
    }
	/*
	[{"presentationid":15,"delai":"[5,2,3,4]"}]
	*/

    /**
     * Return Zip file of the presentation
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getFile(Request $request, $id){

        try {
			$token=$request->token;
            $user = JWTAuth::parseToken()->toUser();
            if ($user) {
                $file = Presentation::find($id)->ZipURI;
                return response()->download($file);
            } else {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function listPresentation1(Request $request)
    {
        try {
			$token=$request->token;
            $user = JWTAuth::parseToken()->toUser();
            if ($user) {
                //$presentations = Presentation::all();
                $user1 = Personnel::find($user->id);
                $presentations = $user1->presentations;
                foreach($presentations as $p){
                    $p->users->toArray();
                    $p->groupes->toArray();
                    /*foreach($p->groupes as $g){
                        $g->personnels->toArray();
                        foreach($g->personnels as $pg){
                            if(!$this->personnelInArray( $pg, $p->users)){
                                $p->users[] = $pg;
                            }

                        }
                    }*/
                }
                return $presentations;
            } else {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        //
    }
	
	public function listPresentation(Request $request)
    {
        try {
			$token=$request->token;
            $user = JWTAuth::parseToken()->toUser();
            if ($user) {
                //$presentations = Presentation::all();
                $user1 = Personnel::find($user->id);
				
                $presentations = Presentation::join('groupe_presentation','groupe_presentation.presentation_id','presentations.id')
				->join('groupe_personnel','groupe_personnel.groupe_id','groupe_presentation.groupe_id')
				->where('groupe_personnel.personnel_id',$user->id)
				->select('presentations.*')
				->get();
				
				$presentationsPerso = Presentation::join('personnel_presentation','personnel_presentation.presentation_id','presentations.id')
				->where('personnel_presentation.personnel_id',$user->id)
				->select('presentations.*')
				->get();
				$presentations = $presentations->merge($presentationsPerso);
				
                foreach($presentations as $p){
				
                    $p->users->toArray();
                    $p->groupes->toArray();
                    foreach($p->groupes as $g){
                        $g->personnels->toArray();
                        foreach($g->personnels as $pg){
                            if(!$this->personnelInArray( $pg, $p->users)){
                                $p->users[] = $pg;
                            }

                        }
                    }
                }
                return $presentations;
            } else {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return response()->json(['status' => 'ok']);
    }
	public function forgotPassword(Request $request){
		
		$email=$request->email;
		
		$validator = \Validator::make([
                'email' => $email,
            ], [
                'email'=>'required',
            ]);
      	if($validator->fails()){
      	 	return response()->json(['error' => 'email_does_not_exist'], 401);
      	}
		
		$date = date('Y-m-d H:i:s');
		

		 $User = Personnel::where('email',$email)->first();
 
       if (!$User) {
				return response()->json(['error' => 'email_does_not_exist'], 401);
	   }else{
		   //ALTER TABLE `personnels` ADD `code` TEXT NULL AFTER `password`;
			 $CodeUser=$this->apiCode();
             $UpdateUser = Personnel::where('id',$User->id)->update(
					[ 
						
						'code' => $CodeUser,
						'updated_at' => $date,
					]
				);
				
			$message = "Vous avez récemment soumis une demande de réinitialisation de votre mot de passe. Veuillez cliquer sur le lien ci-dessous pour terminer le processus: <a href='https://prezmanager.pixelslabs.com/reset-password/".$CodeUser."'>https://prezmanager.pixelslabs.com/reset-password/".$CodeUser."</a>" ;
			
			  $value=$this->sendEmail($User,($message));  
			
			return response()->json(['success' => 'email_sent'], 200);
 
	  
 
       }
			 
		
	
	}
	public function sendEmail($User,$message){
		
		$email=$User->email;
		$Promo["body"]=utf8_encode($message);
		$Promo["name"]=$User->nom." ".$User->prenom;
		//dd($Promo["body"]);
		try{
		Mail::to($email)->send(new ForgotPasswordEmail($Promo));
		return true;
		}catch(\Exception $e){
		return $e->getMessage();
		}
		
    }
	private function apiCode(){
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$count = mb_strlen($chars);
		$code = '';
		
		$counter = 0;

		while($counter<15) {
			$index = rand(0, $count-1);
			$code.=mb_substr($chars, $index, 1);
			$counter++;
		}

		return $code;
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
