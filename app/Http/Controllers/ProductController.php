<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use Input;
use md5;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ProductController extends Controller {
	
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
		//
        $Products = Product::all();

        return view('product.list',compact('Products'));

	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//product
        return view('product.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$nom=$request->nom;
		$description=$request->description;
		

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
			
        $Product = new Product();
        
		if ($request->hasFile('photo')) {
			$imageName = time() . '.' . $request->file('photo')->getClientOriginalExtension();
			$request->file('photo')->move("products/", $imageName);
			$imageUrl='products/' .$imageName;
			$Product->photo = $imageUrl;
		}
        
        $Product->nom = $nom;
        $Product->description =$description;
        $Product->save();
		
		$request->session()->flash('success',self::SUCCESS_INSERT);
		return redirect()->route('product');
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
        $Product = Product::find($id);
		//dd($personnel);
        return view('product.edit',compact('Product'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$nom=$request->nom;
		$description=$request->description;
		$id_product=$request->id_product;
		

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
			
        $Product = Product::find($id_product);
        
		if ($request->hasFile('photo')) {
			$imageName = time() . '.' . $request->file('photo')->getClientOriginalExtension();
			$request->file('photo')->move("products/", $imageName);
			$imageUrl='products/' .$imageName;
			$Product->photo = $imageUrl;
		}
        
        $Product->nom = $nom;
        $Product->description =$description;
        $Product->save();
		
		$request->session()->flash('success',self::SUCCESS_UPDATE);
       return redirect()->route('product');
		
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $Product = Product::find($id);
        if($Product != null){
            $Product->delete();
        }
        session()->flash('success',self::SUCCESS_DELETE);
        return redirect()->back();
	}
	public function deleteProd(Request $request)
	{ 	$id=$request->id_prod_delete;
        $Product = Product::find($id);
        if($Product != null){
            $Product->delete();
        }
		session()->flash('success',self::SUCCESS_DELETE);
        return redirect()->back();
	}
}
