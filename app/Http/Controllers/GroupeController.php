<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Groupe;
use App\Personnel;

use Illuminate\Http\Request;
use Input;
use Session;
use Illuminate\Support\Facades\Redirect;

class GroupeController extends Controller {


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
	public function index()
	{
        $groupes = Groupe::all();
        foreach ($groupes as $g) {
            $g->personnels->toArray();
        }
        return view('groupe.liste',compact("groupes"));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('groupe.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $groupe= new Groupe();

        $groupe->nom = $request->nom;
        $groupe->description = $request->description;
        $groupe->save();

        Session::flash('message', 'Successfully created groupe!');
        return Redirect::to('groupe/'.$groupe->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$groupe = Groupe::find($id);
        $groupe->personnels->toArray();
        $ids = array();
        foreach ($groupe->personnels as $u) {
            $ids[] = $u->id;
        }
        $users = Personnel::whereNotIn('id',$ids)->get();



        if($groupe)
            return view('groupe.single',compact("groupe","users"));
        return Redirect::to('groupe');

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		//
		$groupe = Groupe::find($id);
		//dd($personnel);
        return view('groupe.edit',compact('groupe'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request){
		$nom=$request->nom;
		$description=$request->description;
		$id_groupe=$request->id_groupe;
		

		$validator = \Validator::make([
                'nom' => $nom,
                'description' => $description,
            ], [
                'nom'=>'required',
                'description'=>'required',
            ]);
		if ($validator->fails()){
                $request->session()->flash('danger', $validator->messages());
                return redirect()->back()->withInput();
        }
			
        $Groupe = Groupe::find($id_groupe);
        
        $Groupe->nom = $nom;
        $Groupe->description =$description;
        $Groupe->save();
		
		$request->session()->flash('success',self::SUCCESS_UPDATE);
        return redirect('groupe')->withInput();
		
	}
	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
        $groupe = Groupe::find($id);
        if($groupe != null){
            $groupe->delete();
        }
        return Redirect::to('groupe');
	}


    public function linkUser(Request $request,$id){
        $groupe = Groupe::find($id);
        if($groupe == null){
            return Redirect::to('groupe');
        }

        $users =$request->users;
        foreach($users as $u){
            $groupe->personnels()->attach($u);
        }
        return Redirect::to('groupe/'.$id);

    }

    /**
     * Unlink between user and presentation
     *
     * @param $id
     * @param $uid
     * @return mixed
     */
    public function unlinkUser($id,$uid){
        $groupe = Groupe::find($id);
        if($groupe == null){
            return Redirect::to('groupe');
        }

        $groupe->personnels()->detach($uid);
        return Redirect::to('groupe/'.$id);
    }
	public function deletePersoGroupe(Request $request){
	 	$id=$request->id_perso_groupe_delete;
	 	$id_perso_groupe=$request->id_perso_groupe;
        $groupe = Groupe::find($id_perso_groupe);
        if($groupe == null){
            return Redirect::to('groupe');
        }

        $groupe->personnels()->detach($id);
		$request->session()->flash('success',self::SUCCESS_DELETE);
        return redirect()->back();
    }
	
	public function deleteGroupe(Request $request)
	{ 	$id=$request->id_groupe_delete;
        $Groupe = Groupe::find($id);
        if($Groupe != null){
            $Groupe->delete();
        }
		
		$request->session()->flash('success',self::SUCCESS_DELETE);
        return redirect()->back();
	}

}
