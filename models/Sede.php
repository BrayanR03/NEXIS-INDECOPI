<?php

class Sede{
    private $idSede;
    private $Descripcion;
    private $Estado;
    

    public function  __construct(){
    }

    public function getidSede(){
        return $this->idSede;
    }
    public function setidSede($idSede){
        $this->idSede=$idSede;
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

    public function registrarSede(){
        $sql="INSERT INTO SEDES(Descripcion)VALUES(:Descripcion)";
        try{
            $stmt=database::connect()->prepare($sql);
            $stmt->bindParam(":Descripcion",$this->Descripcion,PDO::PARAM_STR);
            $stmt->execute();

            return [
                'status'=>'success',
                'message' => 'Sede Registrada Correctamente',
                'action' => 'registrar',
                'module' => 'sede',
                'info' =>''
            ];


        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message' => 'Ocurrio un error al momento de registrar la Sede',
                'action' => 'registrar',
                'module' => 'sede',
                'info' => $e->getMessage()
            ];
        }
    }

    public function ListarSedeCombo()
    {
        $sql = "SELECT Descripcion, idSede FROM SEDES";
        $stmt = database::connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    public function ListarSedesRegistradas($Descripcion=null){
        $sql = "EXEC SP_ListadoSedes :Descripcion";
        try{
            $stmt=database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($results)>0){
                return [
                    'status'=>'success',
                    'message'=>'Listado de Sedes Cargados',
                    'action'=>'listar',
                        'module'=>'sede',
                    'data'=>$results,
                    'info'=>''
                ];
            }
            return [
                'status'=>'success',
                'message'=>'No se encontraron registros',
                'action'=>'listar',
                'module'=>'sede',
                'data'=>[],
                'info'=>''
            ];
        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message'=>'Ocurrio un error al cargar las sedes',
                'action'=>'listar',
                'module'=>'sede',
                'info'=>$e->getMessage()
            ];
        }

    }

    public function obtenerTotalSedesRegistradas($Descripcion=''){
        $sql = "SELECT count(idSede) AS 'total' FROM SEDES WHERE Descripcion LIKE '%'+ :Descripcion + '%'";

        $stmt = database::connect()->prepare($sql);
        $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeSede(){
        $sql= "SELECT * FROM SEDES WHERE Descripcion = :Descripcion";

        try{
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Sede encontrada',
                    'action' => 'buscar',
                    'module' => 'sede',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'sede',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar si la sede existe',
                'action' => 'buscar',
                'module' => 'sede',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarSede(){
        $sql = "UPDATE SEDES SET Descripcion = :Descripcion,Estado=:Estado WHERE idSede = :idSede";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":idSede", $this->idSede, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Sede actualizada',
                'action' => 'actualizar',
                'module' => 'sede',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar la sede',
                'action' => 'actualizar',
                'module' => 'sede',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarEstadoSede(){
        $sql = "UPDATE SEDES SET Estado = :Estado WHERE idSede = :idSede";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":idSede", $this->idSede, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Sede actualizada',
                'action' => 'actualizar',
                'module' => 'sede',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar la sede',
                'action' => 'actualizar',
                'module' => 'sede',
                'info' => $e->getMessage()
            ];
        }
    }

}

?>