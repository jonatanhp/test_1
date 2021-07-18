<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grado;
use App\Models\Nivel;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Grado as GradoResource;
use App\Http\Resources\Nivel as NivelResource;
use App\Http\Data\NivelData;
use App\Http\Data\GradoData;
use Exception;

class GradoController extends BaseController
{
    //

    public function index()
    {
        $grados = Grado::all();
       
        //$niveles=new Nivel;
        $niveles=GradoController::preloadNivel();
        $nivel1=new Nivel;
        $nivel2=$nivel1::all();
        //$niveles->preloadNivel();
        return $this->sendResponse(GradoResource::collection($grados), 'Grados retrieved successfully.');
        //return $this->sendResponse(NivelResource::collection($niveles), 'Gos retrieved successfully.');
        //return array ( $grados, $nivel2);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->all();
        $niveles=GradoController::preloadNivel();
        //$niveles->preloadNivel();

        $validator = Validator::make($input, [
            'nom_grado' => 'required',
            'desc_grado' => 'required',
            'nivel_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $grado = Grado::create($input);
   
        return $this->sendResponse(new GradoResource($grado), 'Grado created successfully.');
    } 

     static public  function preloadNivel (){
        $niveles = Nivel::all();
        //return $this->sendResponse(new NivelResource($niveles), 'Grado created successfully.');
        return ($niveles);
    }

    
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grado = Grado::find($id);
  
        if (is_null($grado)) {
            return $this->sendError('Grado not found.');
        }
   
        return $this->sendResponse(new GradoResource($grado), 'Grado retrieved successfully.');
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grado=Grado::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nom_grado' => 'required',
            'desc_grado' => 'required',
            'nivel_id' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $grado->nom_grado = $input['nom_grado'];
        $grado->desc_grado = $input['desc_grado'];
        $grado->nivel_id = $input['nivel_id'];
        $grado->save();
   
        return $this->sendResponse(new GradoResource($grado), 'Grado updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grado=Grado::findOrFail($id);
        $grado->delete();
   
        return $this->sendResponse([], 'Grado deleted successfully.');
    }

    public function getNivel(Request $request, $grado_id)
    {
        $ff=Grado::find($grado_id);
        $nivel3 = Nivel::find($ff->nivel_id);
        $gg=$ff->nivel_id;
        $jResponse = [];
        try{
            $jResponse = NivelData::getNivel($gg);
        }catch(Exception $e){
           return $this->errorResponse($e->getMessage(), 400);
        }
        return $this->sendResponse($jResponse, 201);
        //return $this->sendResponse(new NivelResource($nivel3), 'Grado updated successfully.');
    }

    public function getSecciones(Request $request, $grado_id)
    {
        $jResponse = [];
        //try{
            $jResponse = GradoData::getSecciones($grado_id);
        //}catch(Exception $e){
           //return $this->errorResponse($e->getMessage(), 400);
        //}
        return $this->sendResponse($jResponse, 201);
    }
    

}
