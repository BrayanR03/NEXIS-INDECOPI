<?php

class TipoPersonas{
    private $idTipoPersona;
    private $Descripcion;
    private $Estado;

    public function __construct()
    {
        
    }

    public function getidTipoPersona(){
        return $this->idTipoPersona;
    }
    public function setidTipoPersona($idTipoPersona){
        $this->idTipoPersona=$idTipoPersona;
    }
    public function getDescripcion(){
        return $this->Descripcion;
    }
    public function setDescripcion($Descripcion){
        $this->Descripcion=$Descripcion;
    }
    public function getEstado(){
        return $this->Estado;
    }
    public function setEstado($Estado){
        $this->Estado=$Estado;
    }
    public function listarTipoPersonasCombo(){
        $sql="SELECT Descripcion,idTipoPersona FROM TIPOPERSONAS";
        $stmt=database::connect()->prepare($sql);
        $stmt->execute();
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    public function listarTipoPersonasRegistradas(){
        $sql="EXEC SP_ListarTipoPersonas @Descripcion=:Descripcion";
        try{
            $stmt=database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion",$this->Descripcion,PDO::PARAM_STR);
            $stmt->execute();
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($results)>0){
                return [
                    'status'=>'success',
                    'message'=>'Listado Cargado',
                    'action'=>'listar',
                    'module'=>'tipopersona',
                    'data'=>$results,
                    'info'=>''
                ];   
            }

            return [
                'status'=>'success',
                'message'=>'No se encontraron registros',
                'action'=>'listar',
                'module'=>'tipopersona',
                'data'=>[],
                'info'=>''
            ];

        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message'=>'Ocurrio un error al cargar los tipo de persona',
                'action'=>'listar',
                'module'=>'tipopersona',
                'info'=>$e->getMessage()
            ];
        }
    }
    public function registrarTipoPersona(){
        $sql="INSERT INTO TIPOPERSONAS(Descripcion)VALUES(:Descripcion)";
        try{
            $stmt=database::connect()->prepare($sql);
            $stmt->bindParam(":Descripcion",$this->Descripcion,PDO::PARAM_STR);
            $stmt->execute();

            return [
                'status'=>'success',
                'message' => 'Tipo Persona Registrado Correctamente',
                'action' => 'registrar',
                'module' => 'tipopersona',
                'info' =>''
            ];


        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message' => 'Ocurrio un error al momento de registrar el Tipo de Persona',
                'action' => 'registrar',
                'module' => 'tipopersona',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalTipoPersonasRegistrados($Descripcion=''){
        $sql = "SELECT count(idTipoPersona) AS 'total' FROM TIPOPERSONAS WHERE Descripcion LIKE '%'+ :Descripcion + '%'";

        $stmt = database::connect()->prepare($sql);
        $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeTipoPersona(){
        $sql= "SELECT * FROM TIPOPERSONAS WHERE Descripcion = :Descripcion";

        try{
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Tipo Persona encontrado',
                    'action' => 'buscar',
                    'module' => 'tipopersona',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'tipopersona',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar si el tipo de persona existe',
                'action' => 'buscar',
                'module' => 'tipopersona',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarTipoPersona(){
        $sql = "UPDATE TIPOPERSONAS SET Descripcion = :Descripcion,Estado=:Estado WHERE idTipoPersona = :idTipoPersona";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":idTipoPersona", $this->idTipoPersona, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Tipo Persona actualizada',
                'action' => 'actualizar',
                'module' => 'tipopersona',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el tipo de persona',
                'action' => 'actualizar',
                'module' => 'tipopersona',
                'info' => $e->getMessage()
            ];
        }
    }
}

?>