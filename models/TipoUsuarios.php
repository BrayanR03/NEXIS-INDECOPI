<?php

class TipoUsuarios{
    private $idTipoUsuario;
    private $Descripcion;
    private $Estado;

    public function __construct()
    {
        
    }

    public function getidTipoUsuario(){
        return $this->idTipoUsuario;
    }
    public function setidTipoUsuario($idTipoUsuario){
        $this->idTipoUsuario=$idTipoUsuario;
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
    public function listarTipoUsuariosCombo(){
        $sql="SELECT Descripcion,idTipoUsuario FROM TIPOUSUARIOS";
        $stmt=database::connect()->prepare($sql);
        $stmt->execute();
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function listarTipoUsuariosRegistrados(){
        $sql="EXEC SP_ListarTipoUsuarios @Descripcion=:Descripcion";
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
                    'module'=>'tipousuario',
                    'data'=>$results,
                    'info'=>''
                ];   
            }

            return [
                'status'=>'success',
                'message'=>'No se encontraron registros',
                'action'=>'listar',
                'module'=>'tipousuario',
                'data'=>[],
                'info'=>''
            ];

        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message'=>'Ocurrio un error al cargar los tipo de usuario',
                'action'=>'listar',
                'module'=>'tipousuario',
                'info'=>$e->getMessage()
            ];
        }
    }
    public function registrarTipoUsuario(){
        $sql="INSERT INTO TIPOUSUARIOS(Descripcion)VALUES(:Descripcion)";
        try{
            $stmt=database::connect()->prepare($sql);
            $stmt->bindParam(":Descripcion",$this->Descripcion,PDO::PARAM_STR);
            $stmt->execute();

            return [
                'status'=>'success',
                'message' => 'Tipo Usuario Registrada Correctamente',
                'action' => 'registrar',
                'module' => 'tipousuario',
                'info' =>''
            ];


        }catch(PDOException $e){
            return [
                'status'=>'failed',
                'message' => 'Ocurrio un error al momento de registrar el Tipo de Usuario',
                'action' => 'registrar',
                'module' => 'tipousuario',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalTipoUsuariosRegistrados($Descripcion=''){
        $sql = "SELECT count(idTipoUsuario) AS 'total' FROM TIPOUSUARIOS WHERE Descripcion LIKE '%'+ :Descripcion + '%'";

        $stmt = database::connect()->prepare($sql);
        $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeTipoUsuario(){
        $sql= "SELECT * FROM TIPOUSUARIOS WHERE Descripcion = :Descripcion";

        try{
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Tipo Usuario encontrado',
                    'action' => 'buscar',
                    'module' => 'tipousuario',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'tipousuario',
                'data' => [],
                'info' => ''
            ];
        }catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar si el tipo de usuario existe',
                'action' => 'buscar',
                'module' => 'tipousuario',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarTipoUsuario(){
        $sql = "UPDATE TIPOUSUARIOS SET Descripcion = :Descripcion,Estado=:Estado WHERE idTipoUsuario = :idTipoUsuario";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":idTipoUsuario", $this->idTipoUsuario, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Tipo Usuario actualizada',
                'action' => 'actualizar',
                'module' => 'tipousuario',
                'info' => ''
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el tipo de usuario',
                'action' => 'actualizar',
                'module' => 'tipousuario',
                'info' => $e->getMessage()
            ];
        }
    }

}

?>