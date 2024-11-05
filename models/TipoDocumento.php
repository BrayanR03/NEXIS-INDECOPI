<?php

class TipoDocumento{
    private $idTipoDocumento;
    private $Descripcion;
    private $Estado;
    public function __construct()
    {
        
    }

    public function getidTipoDocumento(){
        return $this->idTipoDocumento;
    }
    public function setidTipoDocumento($idTipoDocumento){
        $this->idTipoDocumento=$idTipoDocumento;
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

    public function listarTipoDocumentoCombo(){
        $sql="SELECT Descripcion,idTipoDocumento FROM TIPODOCUMENTO";
        $stmt=database::connect()->prepare($sql);
        $stmt->execute();
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function listarTipoDocumentosRegistrados(){
        $sql="EXEC SP_ListarTipoDocumentos @Descripcion=:Descripcion";
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
                    'module'=>'tipodocumento',
                    'data'=>$results,
                    'info'=>''
                ];   
            }

            return [
                'status'=>'success',
                'message'=>'No se encontraron registros',
                'action'=>'listar',
                'module'=>'tipodocumento',
                'data'=>[],
                'info'=>''
            ];

        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message'=>'Ocurrio un error al cargar los tipo de documento',
                'action'=>'listar',
                'module'=>'tipodocumento',
                'info'=>$e->getMessage()
            ];
        }
    }
    public function registrarTipoDocumento(){
        $sql="INSERT INTO TIPODOCUMENTO(Descripcion)VALUES(:Descripcion)";
        try{
            $stmt=database::connect()->prepare($sql);
            $stmt->bindParam(":Descripcion",$this->Descripcion,PDO::PARAM_STR);
            $stmt->execute();

            return [
                'status'=>'success',
                'message' => 'Tipo Documento Registrada Correctamente',
                'action' => 'registrar',
                'module' => 'tipodocumento',
                'info' =>''
            ];


        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message' => 'Ocurrio un error al momento de registrar el Tipo de Documento',
                'action' => 'registrar',
                'module' => 'tipodocumento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalTipoDocumentosRegistrados($Descripcion=''){
        $sql = "SELECT count(idTipoDocumento) AS 'total' FROM TIPODOCUMENTO WHERE Descripcion LIKE '%'+ :Descripcion + '%'";

        $stmt = database::connect()->prepare($sql);
        $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeTipoDocumento(){
        $sql= "SELECT * FROM TIPODOCUMENTO WHERE Descripcion = :Descripcion";

        try{
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Tipo Documento encontrado',
                    'action' => 'buscar',
                    'module' => 'tipodocumento',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'tipodocumento',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar si el tipo de documento existe',
                'action' => 'buscar',
                'module' => 'tipodocumento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarTipoDocumento(){
        $sql = "UPDATE TIPODOCUMENTO SET Descripcion = :Descripcion,Estado=:Estado WHERE idTipoDocumento = :idTipoDocumento";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":idTipoDocumento", $this->idTipoDocumento, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Tipo Documento actualizada',
                'action' => 'actualizar',
                'module' => 'tipodocumento',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el tipo de documento',
                'action' => 'actualizar',
                'module' => 'tipodocumento',
                'info' => $e->getMessage()
            ];
        }
    }
}

?>