<?php
class Area
{
    private $idArea;
    private $Descripcion;
    private $Estado;

    public function  __construct() {}

    public function getidArea()
    {
        return $this->idArea;
    }
    public function setidArea($idArea)
    {
        $this->idArea = $idArea;
    }
    public function getDescripcion()
    {
        return $this->Descripcion;
    }
    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }
    public function getEstado()
    {
        return $this->Estado;
    }
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    public function registrarArea()
    {
        $sql = "INSERT INTO AREAS(Descripcion)VALUES(:Descripcion)";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Area Registrada Correctamente',
                'action' => 'registrar',
                'module' => 'area',
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el Area',
                'action' => 'registrar',
                'module' => 'area',
                'info' => $e->getMessage()
            ];
        }
    }

    public function ListarAreasCombo()
    {
        $sql = "SELECT Descripcion, idArea FROM AREAS";
        $stmt = database::connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    public function ListarAreasRegistradas($Descripcion = null)
    {
        $sql = "EXEC SP_ListadoAreas :Descripcion";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Listado de Areas Cargados',
                    'action' => 'listar',
                    'module' => 'area',
                    'data' => $results,
                    'info' => ''
                ];
            }
            return [
                'status' => 'success',
                'message' => 'No se encontraron registros',
                'action' => 'listar',
                'module' => 'area',
                'data' => [],
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al cargar las areas',
                'action' => 'listar',
                'module' => 'area',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalAreasRegistradas($Descripcion = '')
    {
        $sql = "SELECT count(idArea) AS 'total' FROM AREAS WHERE Descripcion LIKE '%'+ :Descripcion + '%'";

        $stmt = database::connect()->prepare($sql);
        $stmt->bindParam("Descripcion", $Descripcion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeArea()
    {
        $sql = "SELECT * FROM AREAS WHERE Descripcion = :Descripcion";

        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Area encontrada',
                    'action' => 'buscar',
                    'module' => 'area',
                    'data' => [],
                    'info' => ''
                ];
            }

            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'area',
                'data' => [],
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar si el area existe',
                'action' => 'buscar',
                'module' => 'area',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarArea()
    {
        $sql = "UPDATE AREAS SET Descripcion = :Descripcion,Estado=:Estado WHERE idArea = :idArea";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":Descripcion", $this->Descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":idArea", $this->idArea, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Area actualizada',
                'action' => 'actualizar',
                'module' => 'area',
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el area',
                'action' => 'actualizar',
                'module' => 'area',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarEstadoArea()
    {
        $sql = "UPDATE AREAS SET Estado = :Estado WHERE idArea = :idArea";

        try {
            $stmt = database::connect()->prepare($sql);

            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":idArea", $this->idArea, PDO::PARAM_INT);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Area actualizada',
                'action' => 'actualizar',
                'module' => 'area',
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el area',
                'action' => 'actualizar',
                'module' => 'area',
                'info' => $e->getMessage()
            ];
        }
    }
}
