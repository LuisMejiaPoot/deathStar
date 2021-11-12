<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Usuario;


class JedisController extends Controller
{


    public function getJedis(Request $request)
    {
       
        $usuarios = DB::table('usuarios')->get();
        $response = ["usuarios"=>$usuarios];
        return response()->json($response);
    }

    public function createJedis(Request $request)
    {
        $data = $request->all();
        $validator = $this->JediDataValidator($data);

        if($validator->fails()){
                return response()->json(['status'=>'error',
                'message'=>'Campos vacíos o cuerpo de entrada no válido',
                'errores'=>$validator->errors()],422);
        }



        $response =[];
        $status= 200;
        try {
            $jedi = Usuario::create([
                "nombre"=>$data["nombre"],
                "color_sable"=>$data["color_sable"],
                "aprendiz"=>$data["aprendiz"],
                "estilo_batalla"=>$data["estilo_batalla"]
            ]);
            $response["status"]="success";
            $response["message"]="Jedi creado exitosamente";
            $response["jedi"]=$jedi;

        } catch (\Throwable $th) {
            $response["status"]="error";
            $response["message"]="Error al crear al Jedi";
            $status = 400;
        }
        return response()->json($response,$status);
    }

    public function updateJedi(Request $request)
    {
        $data =  $request->all();
        $validatorId =  \Validator::make($data,[
            "id"=>"required|exists:usuarios,id"
        ]);


        if($validatorId->fails()){
            return response()->json(['status'=>'error',
            'message'=>'Campos vacíos o cuerpo de entrada no válido',
            'errores'=>$validatorId->errors()],422);
        }
        $validator = $this->JediDataValidator($data);
        if($validator->fails()){
                return response()->json(['status'=>'error',
                'message'=>'Campos vacíos o cuerpo de entrada no válido',
                'errores'=>$validator->errors()],422);
        }

        $jedi =  Usuario::find($data["id"]);
        $jedi->nombre  = $data["nombre"];
        $jedi->color_sable = $data["color_sable"];
        $jedi->aprendiz =  $data["aprendiz"];
        $jedi->estilo_batalla =  $data["estilo_batalla"];

        $status  = 201;
        try {
            $jedi->save();
            $response["status"]="success";
            $response["message"]="Jedi actualizado exitosamente";
            $response["jedi"]=$jedi;
        } catch (\Throwable $th) {
            $response["status"]="error";
            $response["message"]="Error al actualizar el Jedi";
            $status = 400;
        }
        return response()->json($response,$status);
    }

    public function deleteJedi(Request $request)
    {
        $data =  $request->all();
        $validatorId =  \Validator::make($data,[
            "id"=>"required|exists:usuarios,id"
        ]);


        if($validatorId->fails()){
            return response()->json(['status'=>'error',
            'message'=>'Campos vacíos o cuerpo de entrada no válido',
            'errores'=>$validatorId->errors()],422);
        }

        $jedi =  Usuario::find($data["id"]);

        if ($jedi->delete()) {
            return response(["status"=>"success","message"=>"Jedi Eliminado"],200);
        }else{
            return response(["status"=>"error","message"=>"No se ha podido eliminar el Jedi intente mas tarde"],400); 
        }
    }

    public function calcularMonedas(Request $request)
    {
        $monto =  $request->monto;
        $monedas = ["20"=>20,"10"=>10,"5"=>5,"1"=>1];

        $resultado = [];
        foreach ($monedas as $key =>  $nominacion) {

        $resultado[$key] = intval ($monto / $nominacion); 
        $monto  =  intval($monto  % $nominacion);
        }
        return $resultado;
    }


    //
}
