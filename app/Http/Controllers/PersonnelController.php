<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Personnel;
use Input;
use md5;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Email;
use Illuminate\Support\Facades\Mail;
use App\Mail\SimpleEmail;

class PersonnelController extends Controller {
	
	const SUCCESS_INSERT ="Ajouté avec succès";
	const SUCCESS_UPDATE ="Modifié avec succès";
	const SUCCESS_DELETE ="Supprimé avec succès";
	const EMAIL_DUPLACATED ="L'adresse e-mail existe déjà!";

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
        $personnels = Personnel::all();

        return view('personnel.list',compact('personnels'));

	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('personnel.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$nom=$request->nom;
		$prenom=$request->prenom;
		$email=$request->email;
		$password=$request->password;
		

		$validator = \Validator::make([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'password' => $password,
            ], [
                'nom'=>'required',
                'prenom'=>'required',
                'email'=>'required',
                'password'=>'required',
            ]);
		if ($validator->fails()){
                $request->session()->flash('danger', $validator->messages());
                return redirect()->back()->withInput();
        }
			
		$CheckEmail=Personnel::where('email',$email)->first();	
		if($CheckEmail){
			$request->session()->flash('danger',self::EMAIL_DUPLACATED);
			return redirect()->back()->withInput();
		}
        $personnel = new Personnel();
        
		if ($request->hasFile('photo')) {
			$imageName = time() . '.' . $request->file('photo')->getClientOriginalExtension();
			$request->file('photo')->move("personnels/", $imageName);
			$imageUrl='personnels/' .$imageName;
			$personnel->photo = $imageUrl;
		}
        
        $personnel->nom = $nom;
        $personnel->prenom =$prenom;
        $personnel->email =$email;
        $personnel->password = md5($password);
        $personnel->save();
		/*Prezmanger vous a invité à utiliser l'application mobile. Vos informations de connexion sont les suivantes:Identifiant: "login"Mot de passe: XXXXXXXX*/
		
		$message = "Prezmanger vous a invité à utiliser l'application mobile. Vos informations de connexion sont les suivantes:Identifiant: ".$email." Mot de passe: ".$password ;
		
		$this->sendEmail($personnel,htmlentities($message));
		
		
		$request->session()->flash('success',self::SUCCESS_INSERT);
        return redirect()->back();
		
	}
	public function sendEmail($User,$message){
		
		$email=$User->email;
		$Promo["body"]=utf8_encode($message);
		$Promo["name"]=$User->nom." ".$User->prenom;
		//dd($Promo["body"]);
		try{
		Mail::to($email)->send(new SimpleEmail($Promo));
		return true;
		}catch(\Exception $e){
		return $e->getMessage();
		}
		
    }
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $personnel = Personnel::find($id);
		//dd($personnel);
        return view('personnel.edit',compact('personnel'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request){
		$nom=$request->nom;
		$prenom=$request->prenom;
		$email=$request->email;
		$password=$request->password;
		$id_personnel=$request->id_personnel;
		

		$validator = \Validator::make([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
            ], [
                'nom'=>'required',
                'prenom'=>'required',
                'email'=>'required',
            ]);
		if ($validator->fails()){
                $request->session()->flash('danger', $validator->messages());
                return redirect()->back()->withInput();
        }
			
        $personnel = Personnel::find($id_personnel);
        
		if ($request->hasFile('photo')) {
			$imageName = time() . '.' . $request->file('photo')->getClientOriginalExtension();
			$request->file('photo')->move("personnels/", $imageName);
			$imageUrl='personnels/' .$imageName;
			$personnel->photo = $imageUrl;
		}
        
        $personnel->nom = $nom;
        $personnel->prenom =$prenom;
        $personnel->email =$email;
        if($password != "")
            $personnel->password = md5($password);
        $personnel->save();
		
		$request->session()->flash('success',self::SUCCESS_UPDATE);
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
        $personnel = Personnel::find($id);
        if($personnel != null){
            $personnel->delete();
        }
        return Redirect::to('personnel');
	}
	public function deletePerso(Request $request)
	{ 	$id=$request->id_perso_delete;
        $Personnel = Personnel::find($id);
        if($Personnel != null){
            $Personnel->delete();
        }
		session()->flash('success',self::SUCCESS_DELETE);
        return redirect()->back();
	}

}
