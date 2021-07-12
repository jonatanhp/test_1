<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Models\Grado;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Nivel as NivelResource;
use App\Http\Resources\Grado as GradoResource;
use App\Http\Data\NivelData;
use Exception;

class NivelController extends BaseController
{
    public function index()
    {
        $nivels = Nivel::all();
        $grado=new Grado;
        $grados=$grado::all();
        //return $this->sendResponse(NivelResource::collection($nivels), 'Nivels retrieved successfully.');
        return $this->sendResponse(NivelResource::collection($nivels), GradoResource::collection($grados), 'Nivels retrieved successfully.');
        /*$nivelesstring=$this->sendResponse(NivelResource::collection($nivels), 'Nivels retrieved successfully.');
        $gradosstring=$this->sendResponse(GradoResource::collection($grados), 'dddd');
        return array ($nivelesstring, $gradosstring);*/
    }
    public static function Grados(){
        $grado=new Grado;
        $grados=$grado::all();
        return 'ggg';

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
   
        $validator = Validator::make($input, [
            'nom_nivel' => 'required',
            'desc_nivel' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $nivel = Nivel::create($input);
   
        return $this->sendResponse(new NivelResource($nivel), 'Nivel created successfully.');
        echo "nivel creado";
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivel = Nivel::find($id);
        $gradoFromNivel=$nivel->grados;
        
        //$nivel->grados;

        if (is_null($nivel)) {
            return $this->sendError('Nivel not found.');
        }
        //return $this->sendResponse($gradoFromNivel,'ff');
        //return $this->sendResponse(new NivelResource($nivel), 'Nivel retrieved successfully.');
        return $this->sendResponse(new NivelResource($nivel), $gradoFromNivel, 'Nivel retrieved successfully.');
    }

    static public function getGradosListbyId($id){
        $nivel=Nivel::find($id);
        $nivel->grados;
        

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
        $input = $request->all();
        $nivel=Nivel::findOrFail($id);
        $validator = Validator::make($input, [
            'nom_nivel' => 'required',
            'desc_nivel' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $nivel->nom_nivel = $input['nom_nivel'];
        $nivel->desc_nivel = $input['desc_nivel'];
        $nivel->save();
   
        return $this->sendResponse(new NivelResource($nivel), 'Nivel updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $nivel=Nivel::findOrFail($id);
        $nivel->delete();
   
        return $this->sendResponse([], 'Nivel deleted successfully.');
    }

    public function getGrados(Request $request, $nivel_id)
    {
        $jResponse = [];
        try{
            $jResponse = NivelData::getGrados($nivel_id);
        }catch(Exception $e){
           return $this->errorResponse($e->getMessage(), 400);
        }
        return $this->sendResponse($jResponse, 201);
    }
    
}
