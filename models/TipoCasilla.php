<?php

class TipoCasilla
{

    private $idTipoCasilla;
    private $Descripcion;
    private $Estado;

    public function __construct() {}

    public function getidTipoCasilla()
    {
        return $this->idTipoCasilla;
    }
    public function setidTipoCasilla($idTipoCasilla)
    {
        $this->idTipoCasilla = $idTipoCasilla;
    }
    public function getDescripcion()
    {
        return $this->Descripcion;
    }
    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }
    public function getEstado(){
        return $this->Estado;
    }
    public function setEstado($Estado){
        $this->Estado=$Estado;
    }

    public function ListadoTipoCasillasCombo()
    {
        $sql = "SELECT Descripcion,idTipoCasilla FROM TIPOCASILLAS";
        $stmt = database::connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }


    public function listarTipoCasillasRegistrados(){
        $sql="EXEC SP_ListarTipoCasillas @Descripcion=:Descripcion";
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
                    'module'=>'tipocasilla',
                    'data'=>$results,
                    'info'=>''
                ];   
            }

            return [
                'status'=>'success',
                'message'=>'No se encontraron registros',
                'action'=>'listar',
                'module'=>'tipocasilla',
                'data'=>[],
                'info'=>''
            ];

        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message'=>'Ocurrio un error al cargar los tipo de casilla',
                'action'=>'listar',
                'module'=>'tipocasilla',
                'info'=>$e->getMessage()
            ];
        }
    }
    public function registrarTipoCasilla(){
        $sql="INSERT INTO TIPOCASILLAS(Descripcion)VALUES(:Descripcion)";
        try{
            $stmt=database::connect()->prepare($sql);
            $stmt->bindParam(":Descripcion",$this->Descripcion,PDO::PARAM_STR);
            $stmt->execute();

            return [
                'status'=>'success',
                'message' => 'Tipo Casilla Registrada Correctamente',
                'action' => 'registrar',
                'module' => 'tipocasilla',
                'info' =>''
            ];


        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message' => 'Ocurrio un error al momento de registrar el Tipo de Casilla',
                'action' => 'registrar',
                'module' => 'tipocasilla',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalTipoCasillasRegistradas($Descripcion=''){
        $sql = "SELECT count(idTipoCasilla) AS 'total' FROM TIPOCASILLAS WHERE Descripcion LIKE '%'+ :Descripcion + '%'";

        $stmt = database::connect()->prepare($sql);
        $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeTipoCasilla(){
        $sql= "SELECT * FROM TIPOCASILLAS WHERE Descripcion = :Descripcion";

        try{
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Tipo Casilla encontrado',
                    'action' => 'buscar',
                    'module' => 'tipocasilla',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'tipocasilla',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar si el tipo de casilla existe',
                'action' => 'buscar',
                'module' => 'tipocasilla',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarTipoCasilla(){
        $sql = "UPDATE TIPOCASILLAS SET Descripcion = :Descripcion,Estado=:Estado WHERE idTipoCasilla = :idTipoCasilla";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":idTipoCasilla", $this->idTipoCasilla, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Tipo Casilla actualizada',
                'action' => 'actualizar',
                'module' => 'tipocasilla',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el tipo de casilla',
                'action' => 'actualizar',
                'module' => 'tipocasilla',
                'info' => $e->getMessage()
            ];
        }
    }

}

?>
