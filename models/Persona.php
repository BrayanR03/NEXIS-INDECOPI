<?php

class Persona
{
    private $idPersona;
    private $nombres;
    private $apellidos;
    // private $apellidoPaterno;
    // private $apellidoMaterno;
    // private $dni;
    private $dniCUI;
    private $email;
    private $telefono;
    private $domicilio;
    private $tipoPersona;
    private $tipoDocumentoIdentidad;
    private $numDocumentoIdentidad;
    private $representanteLegal;
    private $estado;

    public function __construct() {}


    public function getidPersona()
    {
        return $this->idPersona;
    }
    public function setidPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }

    public function getNombres()
    {
        return $this->nombres;
    }
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    // public function getApellidoPaterno(){
    //     return $this->apellidoPaterno;
    // }
    // public function setApellidoPaterno($apellidoPaterno){
    //     $this->apellidoPaterno=$apellidoPaterno;
    // }
    // public function getApellidoMaterno(){
    //     return $this->apellidoMaterno;
    // }
    // public function setApellidoMaterno($apellidoMaterno){
    //     $this->apellidoMaterno=$apellidoMaterno;
    // }
    // public function getDni(){
    //     return $this->dni;
    // }
    // public function setDni($dni){
    //     $this->dni=$dni;
    // }
    public function getDniCUI()
    {
        return $this->dniCUI;
    }
    public function setDniCUI($dniCUI)
    {
        $this->dniCUI = $dniCUI;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getDomicilio()
    {
        return $this->domicilio;
    }
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }

    public function getTipoPersona()
    {
        return $this->tipoPersona;
    }
    public function setTipoPersona($tipoPersona)
    {
        $this->tipoPersona = $tipoPersona;
    }

    public function getTipoDocumentoIdentidad()
    {
        return $this->tipoDocumentoIdentidad;
    }
    public function setTipoDocumentoIdentidad($tipoDocumentoIdentidad)
    {
        $this->tipoDocumentoIdentidad = $tipoDocumentoIdentidad;
    }

    public function getNumDocumentoIdentidad()
    {
        return $this->numDocumentoIdentidad;
    }
    public function setNumDocumentoIdentidad($numDocumentoIdentidad)
    {
        $this->numDocumentoIdentidad = $numDocumentoIdentidad;
    }

    public function getRepresentanteLegal()
    {
        return $this->representanteLegal;
    }
    public function setRepresentanteLegal($representanteLegal)
    {
        $this->representanteLegal = $representanteLegal;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function existeNumDocIdentidad()
    {
        $sql = "SELECT * FROM PERSONAS WHERE NumDocumentoIdentidad=:NumDocumentoIdentidad";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":NumDocumentoIdentidad", $this->numDocumentoIdentidad, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'NumDoc encontrado',
                    'action' => 'buscar',
                    'module' => 'persona',
                    'data' => [],
                    'info' => ''
                ];
            }
            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'persona',
                'data' => [],
                'info' => ''
            ];
        } catch (PDOException $e) {

            return [
                'status' => 'failed',
                'message' => 'Ocurrió un error al momento de verificar la existencia del Documento',
                'action' => 'buscar',
                'module' => 'persona',
                'info' => $e->getMessage()
            ];
        }
    }
    public function registrarPersona()
    {
        $sql = "INSERT INTO PERSONAS(Nombres,Apellidos,Email,Telefono,Domicilio,idTipoPersona,idTipoDocumentoIdentidad,NumDocumentoIdentidad,DniCUI,RepresentanteLegal)
        VALUES(:Nombres,:Apellidos,:Email,:Telefono,:Domicilio,:idTipoPersona,:idTipoDocumentoIdentidad,:NumDocumentoIdentidad,:DniCUI,:RepresentanteLegal)";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":Nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":Apellidos", $this->apellidos, PDO::PARAM_STR);
            // $stmt->bindParam(":ApellidoPaterno",$this->apellidoPaterno,PDO::PARAM_STR);
            // $stmt->bindParam(":ApellidoMaterno",$this->apellidoMaterno,PDO::PARAM_STR);
            // $stmt->bindParam(":Dni",$this->dni,PDO::PARAM_STR);
            $stmt->bindParam(":DniCUI", $this->dniCUI, PDO::PARAM_STR);
            $stmt->bindParam(":Email", $this->email, PDO::PARAM_STR);
            $stmt->bindParam(":Telefono", $this->telefono, PDO::PARAM_STR);
            $stmt->bindParam(":Domicilio", $this->domicilio, PDO::PARAM_STR);
            $stmt->bindParam(":idTipoPersona", $this->tipoPersona, PDO::PARAM_INT);
            $stmt->bindParam(":idTipoDocumentoIdentidad", $this->tipoDocumentoIdentidad, PDO::PARAM_INT);
            $stmt->bindParam(":NumDocumentoIdentidad", $this->numDocumentoIdentidad, PDO::PARAM_STR);
            $stmt->bindParam(":RepresentanteLegal", $this->representanteLegal, PDO::PARAM_STR);

            $stmt->execute();
            return [
                'status' => 'success',
                'message' => 'Persona Registrada Correctamente',
                'action' => 'registrar',
                'module' => 'persona',
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar la Persona',
                'action' => 'registrar',
                'module' => 'persona',
                'info' => $e->getMessage()
            ];
        }
    }

    public function ListarPersonasRegistradas($datosBusquedaFiltro = null, $filtroBusqueda = null)
    {
        $sql = "EXEC SP_BusquedaPersonasFiltrado :DatosBusquedaFiltro,:FiltroBusqueda";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("DatosBusquedaFiltro", $datosBusquedaFiltro, PDO::PARAM_STR);
            $stmt->bindParam("FiltroBusqueda", $filtroBusqueda, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Listado de Personas Cargados',
                    'action' => 'listar',
                    'module' => 'persona',
                    'data' => $results,
                    'info' => ''
                ];
            }
            return [
                'status' => 'success',
                'message' => 'No se encontraron registros',
                'action' => 'listar',
                'module' => 'persona',
                'data' => [],
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al cargar las personas',
                'action' => 'listar',
                'module' => 'persona',
                'info' => $e->getMessage()
            ];
        }
    }

    public function obtenerTotalPersonasRegistradas($datosBusquedaFiltro = '', $filtroBusqueda = null)
    {
        $sql = "EXEC SP_TotalPersonasFiltrado :DatosBusquedaFiltro,:FiltroBusqueda";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam("DatosBusquedaFiltro", $datosBusquedaFiltro, PDO::PARAM_STR);
            $stmt->bindParam("FiltroBusqueda", $filtroBusqueda, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de verificar el total de personas',
                'info' => $e->getMessage()
            ];
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarPersona()
    {
        $sql = "UPDATE PERSONAS SET Nombres=:Nombres,Apellidos=:Apellidos,Email=:Email,Telefono=:Telefono,Domicilio=:Domicilio,idTipoPersona=:idTipoPersona,
              idTipoDocumentoIdentidad=:idTipoDocumentoIdentidad,NumDocumentoIdentidad=:NumDocumentoIdentidad,RepresentanteLegal=:RepresentanteLegal,Estado=:Estado,DniCUI=:DniCUI
              WHERE idPersona=:idPersona";
        try {
            $stmt = database::connect()->prepare($sql);
            // echo "ANTES DE ENTRAR A ASIGNAR PARAMETROS\n";
            $stmt->bindParam(":Nombres", $this->nombres, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->nombres,"\n";
            $stmt->bindParam(":Apellidos", $this->apellidos, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->apellidos,"\n";
            $stmt->bindParam(":Email", $this->email, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->email,"\n";
            $stmt->bindParam(":Telefono", $this->telefono, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->telefono,"\n";
            $stmt->bindParam(":Domicilio", $this->domicilio, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->domicilio,"\n";
            $stmt->bindParam(":idTipoPersona", $this->tipoPersona, PDO::PARAM_INT);
            // echo "TIPO PERSONA : ",$this->tipoPersona,"\n";
            $stmt->bindParam(":idTipoDocumentoIdentidad", $this->tipoDocumentoIdentidad, PDO::PARAM_INT);
            // echo "NOMBRES: ",$this->tipoDocumentoIdentidad,"\n";
            $stmt->bindParam(":NumDocumentoIdentidad", $this->numDocumentoIdentidad, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->numDocumentoIdentidad,"\n";
            $stmt->bindParam(":RepresentanteLegal", $this->representanteLegal, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->representanteLegal,"\n";
            $stmt->bindParam(":Estado", $this->estado, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->estado,"\n";
            $stmt->bindParam(":DniCUI", $this->dniCUI, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->dniCUI,"\n";
            $stmt->bindParam(":idPersona", $this->idPersona, PDO::PARAM_INT);
            // echo "NOMBRES: ",$this->idPersona,"\n";
            $stmt->execute();
            return [
                'status' => 'success',
                'message' => 'Persona actualizada',
                'action' => 'actualizar',
                'module' => 'persona',
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar la persona',
                'action' => 'actualizar',
                'module' => 'persona',
                'info' => $e->getMessage()
            ];
        }
    }

    public function estadoActualizarPersona()
    {

        $sql = "UPDATE PERSONAS SET Estado = :Estado WHERE idPersona = :idPersona";

        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":Estado", $this->estado, PDO::PARAM_STR);
            $stmt->bindParam(":idPersona", $this->idPersona, PDO::PARAM_INT);

            $stmt->execute();
            return [
                'status' => 'success',
                'message' => 'Persona actualizada',
                'action' => 'actualizar',
                'module' => 'persona',
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar la persona',
                'action' => 'actualizar',
                'module' => 'persona',
                'info' => $e->getMessage()
            ];
        }
    }


    public function existeNumDocIdentidadActualizarPerfil($idUsuario)
    {
        $sql = "EXEC SP_ActualizarNumDocIdentidad @NumDocIdentidad=:NumDocIdentidad,@idUsuario=:idUsuario";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":NumDocumentoIdentidad", $this->numDocumentoIdentidad, PDO::PARAM_STR);
            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results == 1) {
                return [
                    'status' => 'success',
                    'message' => 'ACTUALIZA NORMAL',
                    'action' => 'buscar',
                    'module' => 'persona',
                    'data' => [],
                    'info' => ''
                ];
            } else if ($results == 2) {
                return [
                    'status' => 'success',
                    'message' => 'ACTUALIZA NORMAL, NO EXISTE EN OTRO USUARIO',
                    'action' => 'buscar',
                    'module' => 'persona',
                    'data' => [],
                    'info' => ''
                ];
            } else if ($results == 3) {
                return [
                    'status' => 'success',
                    'message' => 'EXISTE EN OTRO USUARIO, NO ACTUALICES',
                    'action' => 'buscar',
                    'module' => 'persona',
                    'data' => [],
                    'info' => ''
                ];
            }
            // if(count($results)>0){
            //     return [
            //         'status'=>'success',
            //         'message' => 'NumDoc encontrado',
            //         'action' => 'buscar',
            //         'module' => 'persona',
            //         'data' => [],
            //         'info' => ''
            //     ];
            // }
            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'persona',
                'data' => [],
                'info' => ''
            ];
        } catch (PDOException $e) {

            return [
                'status' => 'failed',
                'message' => 'Ocurrió un error al momento de verificar la existencia del Documento',
                'action' => 'buscar',
                'module' => 'persona',
                'info' => $e->getMessage()
            ];
        }
    }
    public function actualizarDatosPerfilUsuario($idUsuario,$Password)
    {
        $sql = "EXEC SP_ActualizarPerfilUsuarios 
            @Nombres = :Nombres,
            @Apellidos = :Apellidos,
            @Email = :Email,
            @Telefono = :Telefono,
            @Domicilio = :Domicilio,
            @idTipoPersona = :idTipoPersona,
            @idTipoDocumentoIdentidad = :idTipoDocumentoIdentidad,
            @NumDocumentoIdentidad = :NumDocumentoIdentidad,
            @DniCUI = :DniCUI,
            @idUsuario = :idUsuario,
            @Password = :Password";
        try {
            $stmt = database::connect()->prepare($sql);
            // echo "ANTES DE ENTRAR A ASIGNAR PARAMETROS\n";
            $stmt->bindParam(":Nombres", $this->nombres, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->nombres,"\n";
            $stmt->bindParam(":Apellidos", $this->apellidos, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->apellidos,"\n";
            $stmt->bindParam(":Email", $this->email, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->email,"\n";
            $stmt->bindParam(":Telefono", $this->telefono, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->telefono,"\n";
            $stmt->bindParam(":Domicilio", $this->domicilio, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->domicilio,"\n";
            $stmt->bindParam(":idTipoPersona", $this->tipoPersona, PDO::PARAM_INT);
            // echo "TIPO PERSONA : ",$this->tipoPersona,"\n";
            $stmt->bindParam(":idTipoDocumentoIdentidad", $this->tipoDocumentoIdentidad, PDO::PARAM_INT);
            // echo "NOMBRES: ",$this->tipoDocumentoIdentidad,"\n";
            $stmt->bindParam(":NumDocumentoIdentidad", $this->numDocumentoIdentidad, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->numDocumentoIdentidad,"\n";
            // $stmt->bindParam(":RepresentanteLegal", $this->representanteLegal, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->representanteLegal,"\n";
            // $stmt->bindParam(":Estado", $this->estado, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->estado,"\n";
            $stmt->bindParam(":DniCUI", $this->dniCUI, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->dniCUI,"\n";
            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(":Password", $Password, PDO::PARAM_STR);
            // echo "NOMBRES: ",$this->idPersona,"\n";
            $stmt->execute();
            return [
                'status' => 'success',
                'message' => 'Perfil actualizado',
                'action' => 'actualizar',
                'module' => 'persona',
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar la persona',
                'action' => 'actualizar',
                'module' => 'persona',
                'info' => $e->getMessage()
            ];
        }
    }
}
