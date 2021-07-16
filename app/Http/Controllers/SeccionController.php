<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Seccion as SeccionResource;
use App\Http\Data\SeccionDataI;
use Exception;
//use App\Traits\ApiResponser as responser;
use App\Traits\ResponserTest as responsertest;
//use Illuminate\Database\Eloquent\Collection;

class SeccionController extends BaseController
{
    //use ApiResponser;
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seccions = Seccion::all();
    
        return $this->sendResponse(SeccionResource::collection($seccions), 'Seccions retrieved successfully.');
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
            'nom_seccion' => 'required',
            'desc_seccion',
            'grado_id1' => 'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $seccion = Seccion::create($input);
   
        return $this->sendResponse(new SeccionResource($seccion), 'Seccion created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seccion = Seccion::find($id);
  
        if (is_null($seccion)) {
            return $this->sendError('Seccion not found.');
        }
   
        return $this->sendResponse(new SeccionResource($seccion), 'Seccion retrieved successfully.');
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
        $seccion=Seccion::findOrFail($id);
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nom_seccion' => 'required',
            'desc_seccion',
            'grado_id1' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $seccion->nom_seccion = $input['nom_seccion'];
        $seccion->desc_seccion = $input['desc_seccion'];
        $seccion->grado_id1 = $input['grado_id1'];
        $seccion->save();
   
        return $this->sendResponse(new SeccionResource($seccion), 'Seccion updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seccion=Seccion::findOrFail($id);
        $seccion->delete();
   
        return $this->sendResponse([], 'Seccion deleted successfully.');
    }

    //public static $model = 'App\Traits\responserTest.php';
    //public static $model = responsertest::class;

    public function getGradoandNivel(Request $request, $seccion_id)
    {   
        $id_grado=Seccion::find($seccion_id);
        //$iddd=$id_grado::grado_id1;
        //$id_grado->grado_id1;
        $jResponse = [];
        try{
            $jResponse = SeccionDataI::getGradosI($id_grado->grado_id1);
        }catch(Exception $e){
           return $this->errorResponse($e->getMessage(), 400);
        }

        $model = responsertest::class;
        $ff=new responsertest;
        $ff->successResponse($jResponse,201);
        //$ff->showAll($jResponse,201);
        //$model->showAll($jResponse,201);
        return $this->sendResponse($jResponse,201);
        //return responser.showAll($jResponse, 201);
        //return $ff;
    }
}
