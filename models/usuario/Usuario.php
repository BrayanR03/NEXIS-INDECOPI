<?php
// require_once '../../models/usuario/EnviarCorreoUsuario.php';
// require_once __DIR__ . '/../models/usuario/EnviarCorreoUsuario.php';

class Usuario
{
    private $idUsuario;
    private $Usuario;
    private $Password;
    private $Estado;
    private $idTipoUsuario;
    private $idPersona;


    public function __constructor() {}

    public function getidUsuario()
    {
        return $this->idUsuario;
    }
    public function setidUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    public function getUsuario()
    {
        return $this->Usuario;
    }
    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }
    public function getPassword()
    {
        return $this->Password;
    }
    public function setPassword($Password)
    {
        $this->Password = $Password;
    }
    public function getEstado()
    {
        return $this->Estado;
    }
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }
    public function getidTipoUsuario()
    {
        return $this->idTipoUsuario;
    }
    public function setidTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;
    }
    public function getidPersona()
    {
        return $this->idPersona;
    }
    public function setidPersona($idPersona)
    {
        $this->idPersona = $idPersona;
    }

    public function AutenticacionUsuario()
    {
        // $sql = "CALL SP_LoginUsuarioSINOE(?,?)";

        $sql = "EXEC SP_LoginUsuarioSINOE :Usuario,:Password";

        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":Usuario", $this->Usuario, PDO::PARAM_STR);
            $stmt->bindParam(":Password", $this->Password, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($result) == 0) {
                return [
                    'code' => 404,
                    'status' => 'success',
                    'message' => 'Credenciales incorrectas',
                    'action' => 'login',
                    'module' => '',
                    'data' => [],
                    'info' => '',
                ];
            }
            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'inicio de sesión correcto',
                'action' => 'login',
                'module' => '',
                'data' => $result,
                'info' => '',

            ];
        } catch (PDOException $e) {
            return [
                'code' => 500,
                'status' => 'failed',
                'message' => 'Algo salio mal al iniciar sesión',
                'action' => 'login',
                'module' => '',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function listadoUsuarios($datosBusquedaFiltro = null, $filtroBusqueda = null)
    {
        $sql = "EXEC SP_ListadoUsuariosPersonas :DatosBusquedaFiltro,:FiltroBusqueda";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":DatosBusquedaFiltro", $datosBusquedaFiltro, PDO::PARAM_STR);
            $stmt->bindParam(":FiltroBusqueda", $filtroBusqueda, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Listado de Usuarios Cargados',
                    'action' => 'listar',
                    'module' => 'usuario',
                    'data' => $results,
                    'info' => ''
                ];
            } else {
                return [
                    'status' => 'success',
                    'message' => 'No se encontraron registros',
                    'action' => 'listar',
                    'module' => 'usuario',
                    'data' => [],
                    'info' => ''
                ];
            }
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al cargar los usuarios',
                'action' => 'listar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }
    }


    public function informacionPerfilUsuario($usuario)
    {
        $sql = "EXEC SP_InformacionPerfil @Usuario=:Usuario";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":Usuario", $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Informacion del Perfil Cargada',
                    'action' => 'listar',
                    'module' => 'usuario',
                    'data' => $results,
                    'info' => ''
                ];
            } else {
                return [
                    'status' => 'success',
                    'message' => 'No se encontraron informacion del perfil',
                    'action' => 'listar',
                    'module' => 'usuario',
                    'data' => [],
                    'info' => ''
                ];
            }
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al cargar el perfil del usuario',
                'action' => 'listar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarContraseñaUsuario()
    {
        $sql = "EXEC SP_ActualizarPasswordUsuario @idUsuario=:idUsuario,@Password=:Password";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":idUsuario", $this->idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(":Password", $this->Password, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Contraseña Actualizada',
                    'action' => 'listar',
                    'module' => 'usuario',
                    'data' => $results,
                    'info' => ''
                ];
            } else {
                return [
                    'status' => 'success',
                    'message' => 'No se actualizo la contraseña',
                    'action' => 'listar',
                    'module' => 'usuario',
                    'data' => $results,
                    'info' => ''
                ];
            }
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al actualizar la contraseña',
                'info' => $e->getMessage()
            ];
        }
    }

    public function listadoTotalUsuarios($datosBusquedaFiltro = null, $filtroBusqueda = null)
    {
        $sql = "EXEC SP_ListadoTotalUsuariosPersonas :DatosBusquedaFiltro,:FiltroBusqueda";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":DatosBusquedaFiltro", $datosBusquedaFiltro, PDO::PARAM_STR);
            $stmt->bindParam(":FiltroBusqueda", $filtroBusqueda, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al cargar el total de usuarios',
                'info' => $e->getMessage()
            ];
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function RegistrarUsuario()
    {
        $sql = "INSERT INTO USUARIOS(Usuario,Password,idTipoUsuario,idPersona)
              VALUES(:Usuario,:Password,:idTipoUsuario,:idPersona)";

        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":Usuario", $this->Usuario, PDO::PARAM_STR);
            $stmt->bindParam(":Password", $this->Password, PDO::PARAM_STR);
            $stmt->bindParam(":idTipoUsuario", $this->idTipoUsuario, PDO::PARAM_INT);
            $stmt->bindParam(":idPersona", $this->idPersona, PDO::PARAM_INT);
            $stmt->execute();

            // Llamar a la clase de envío de correo después de registrar el usuario
            // $correo = new EnviarCorreoUsuario();
            // $resultadoCorreo = $correo->enviar(
            //     'bneciosup@ucvvirtual.edu.pe',  // Correo del receptor
            //     'NOMBRE USUARIO',                // Nombre del receptor
            //     'Registro exitosom tus credenciales',            // Asunto del correo
            //     $this->Usuario       // Mensaje del correo
            // );
            return [
                'status' => 'success',
                'message' => 'Usuario Registrado Correctamente',
                'action' => 'registrar',
                'module' => 'usuario',
                'info' => ''
            ];
        } catch (PDOException $e) {

            return [
                'status' => 'failed',
                'message' => 'Ocurrion un error al momento de registrar el usuario',
                'action' => 'registrar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }
    }

    public function existeUsuario()
    {
        $sql = "SELECT Usuario FROM USUARIOS WHERE Usuario=:Usuario";
        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":Usuario", $this->Usuario, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Usuario encontrado',
                    'action' => 'buscar',
                    'module' => 'usuario',
                    'data' => [],
                    'info' => ''
                ];
            }
            return [
                'status' => 'success',
                'message' => '¡No se encontraron resultados!',
                'action' => 'buscar',
                'module' => 'usuario',
                'data' => [],
                'info' => ''
            ];
        } catch (PDOException $e) {

            return [
                'status' => 'failed',
                'message' => 'Ocurrió un error al momento de verificar la existencia del Usuario',
                'action' => 'buscar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }
    }

    /*vale sin validar ingreso de usuario */
    public function actualizarUsuario()
    {
        // Consulta para ejecutar el procedimiento almacenado
        $sql = "UPDATE USUARIOS SET Usuario=:Usuario,Password=:Password,idTipoUsuario=:idTipoUsuario WHERE idUsuario=:idUsuario";

        try {
            // Preparar la consulta
            $stmt = database::connect()->prepare($sql);

            // Enlazar los parámetros
            $stmt->bindParam("Usuario", $this->Usuario, PDO::PARAM_STR);
            $stmt->bindParam("Password", $this->Password, PDO::PARAM_STR);
            $stmt->bindParam("idTipoUsuario", $this->idTipoUsuario, PDO::PARAM_INT);
            $stmt->bindParam("idUsuario", $this->idUsuario, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();
            return [
                'status' => 'success',
                'message' => 'Usuario actualizado correctamente',
                'action' => 'actualizar',
                'module' => 'usuario',
                'info' => ''
            ];
        } catch (PDOException $e) {
            // Manejar el error y devolver un mensaje de fallo
            return [
                'status' => 'failed',
                'message' => 'Ocurrió un error al momento de actualizar el usuario',
                'action' => 'actualizar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }
    }

    public function estadoActualizarUsuario()
    {

        $sql = "UPDATE USUARIOS SET Estado = :Estado WHERE idUsuario = :idUsuario";

        try {
            $stmt = database::connect()->prepare($sql);
            $stmt->bindParam(":Estado", $this->Estado, PDO::PARAM_STR);
            $stmt->bindParam(":idUsuario", $this->idUsuario, PDO::PARAM_INT);

            $stmt->execute();
            return [
                'status' => 'success',
                'message' => 'Usuario actualizado',
                'action' => 'actualizar',
                'module' => 'usuario',
                'info' => ''
            ];
        } catch (PDOException $e) {
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el usuario',
                'action' => 'actualizar',
                'module' => 'usuario',
                'info' => $e->getMessage()
            ];
        }
    }
}
