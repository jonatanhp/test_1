<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Nivel;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\DB;


use function PHPUnit\Framework\isNull;

class Grado extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function getNivel($grado_id)
    {
        $niveles = DB::table('nivel')
            ->select('*')
           
            ->where('nivel.id', '=', $grado_id)
            ->orderBy('nivel.id')
            ->get();
       
        return $niveles;
    }
    

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nom_grado' => $this->nom_grado,
            'desc_grado' => $this->desc_grado,
            'nivel_id' => $this->nivel_id,
            'nivel_id' => ($this->nivel_id),
            
            'nivel_name' =>(DB::table('nivel')->select('nom_nivel')->where('nivel.id','=', $this->nivel_id)->take(1)->get()->first()),
            'gg' => $this->nivel_name.value($this->data),
           

            //'grado' => !is_null($this->nivel_id) ? Nivel::where('idNivel', $this->id)

            //'asignadoss' => ($this->nivel_id) ? Nivel::select('nom_nivel')->where('id', $this->nivel_id) :$this->nom_nivel,
                                                    

           'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];

        
    }
}