<?php

class TipoDocumentoIdentidad{
    private $idTipoDocumentoIdentidad;
    private $Descripcion;
    private $Estado;

    public function __construct()
    {
        
    }

    public function getidTipoDocumentoIdentidad(){
        return $this->idTipoDocumentoIdentidad;
    }
    public function setidTipoDocumentoIdentidad($idTipoDocumentoIdentidad){
        $this->idTipoDocumentoIdentidad=$idTipoDocumentoIdentidad;
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

    public function listarTipoDocumentoIdentidadCombo(){
        $sql="SELECT Descripcion,idTipoDocumentoIdentidad FROM TIPODOCUMENTOSIDENTIDAD";
        $stmt=database::connect()->prepare($sql);
        $stmt->execute();
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function listarTipoDocumentosIdentidadRegistrados(){
        $sql="EXEC SP_ListarTipoDocumentosIdentidad @Descripcion=:Descripcion";
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
                    'module'=>'tipodocumentoidentidad',
                    'data'=>$results,
                    'info'=>''
                ];   
            }

            return [
                'status'=>'success',
                'message'=>'No se encontraron registros',
                'action'=>'listar',
                'module'=>'tipodocumentoidentidad',
                'data'=>[],
                'info'=>''
            ];

        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message'=>'Ocurrio un error al cargar los tipo documento de identidad',
                'action'=>'listar',
                'module'=>'tipodocumentoidentidad',
                'info'=>$e->getMessage()
            ];
        }
    }
    public function registrarTipoDocumento(){
        $sql="INSERT INTO TIPODOCUMENTOSIDENTIDAD(Descripcion)VALUES(:Descripcion)";
        try{
            $stmt=database::connect()->prepare($sql);
            $stmt->bindParam(":Descripcion",$this->Descripcion,PDO::PARAM_STR);
            $stmt->execute();

            return [
                'status'=>'success',
                'message' => 'Tipo Documento Identidad Registrada Correctamente',
                'action' => 'registrar',
                'module' => 'tipodocumento',
                'info' =>''
            ];


        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message' => 'Ocurrio un error al momento de registrar el Tipo Documento De Identidad',
                'action' => 'registrar',
                'module' => 'tipodocumentoidentidad',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalTipoDocumentosIdentidadRegistrados($Descripcion=''){
        $sql = "SELECT count(idTipoDocumentoIdentidad) AS 'total' FROM TIPODOCUMENTOSIDENTIDAD WHERE Descripcion LIKE '%'+ :Descripcion + '%'";

        $stmt = database::connect()->prepare($sql);
        $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeTipoDocumentoIdentidad(){
        $sql= "SELECT * FROM TIPODOCUMENTOSIDENTIDAD WHERE Descripcion = :Descripcion";

        try{
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Tipo Documento Identidad encontrado',
                    'action' => 'buscar',
                    'module' => 'tipodocumentoidentidad',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'tipodocumentoidentidad',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar si el tipo documento de identidad existe',
                'action' => 'buscar',
                'module' => 'tipodocumento',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarTipoDocumentoIdentidad(){
        $sql = "UPDATE TIPODOCUMENTOSIDENTIDAD SET Descripcion = :Descripcion,Estado=:Estado WHERE idTipoDocumentoIdentidad = :idTipoDocumentoIdentidad";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":idTipoDocumentoIdentidad", $this->idTipoDocumentoIdentidad, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Tipo Documento Identidad actualizada',
                'action' => 'actualizar',
                'module' => 'tipodocumentoidentidad',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el tipo documento de identidad',
                'action' => 'actualizar',
                'module' => 'tipodocumentoidentidad',
                'info' => $e->getMessage()
            ];
        }
    }

}

?>