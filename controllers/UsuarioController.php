<?php

require_once 'models\usuario\Usuario.php';


class UsuarioController
{
    private Usuario $usuarioModelo;

    public function __construct()
    {
        $this->usuarioModelo = new Usuario();
    }

    public function index()
    {
        require_once 'views/Login/login.php';
    }

    public function Login()
    {

        if ($_POST) {
            $usuario = trim($_POST['Usuario']);
            $password = trim($_POST['Password']);

            $this->usuarioModelo->setUsuario($usuario);
            $this->usuarioModelo->setPassword($password);
            $response = $this->usuarioModelo->AutenticacionUsuario();

            if (count($response['data']) == 0) {
                $response['status'] = 'not found';
                $_SESSION['response'] = $response;

                            echo "
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            alert('Credenciales Incorrectas');
                            setTimeout(function() {
                                window.location.href = '" . base_url . "';
                            }, 100); // Pequeño retraso antes de redirigir
                        });
                    </script>
                ";
                // require_once "views/alertaInicioSesion.php";

                exit();
            }

            // echo "<pre>";
            // print_r($response['data']);
            // echo "</pre>";

            $_SESSION['Usuario'] = $response['data'][0]['Usuario'];
            $_SESSION['TipoUsuario'] = $response['data'][0]['TipoUsuario'];
            $_SESSION['Persona'] = $response['data'][0]['Persona'];
            $_SESSION['TipoPersona'] = $response['data'][0]['TipoPersona'];
            $_SESSION['autenticado'] = true;
            // echo "
            // <script>
            // alter('BIENVENIDO');
            // </script>
            // ";
            // // echo "
            // //     let rol='{$_SESSION['TipoUsuario']['TipoUsuario']}';
            // //     localStorage.setItem('TipoUsuario',rol);
            // // ";
            echo "
            <script>
                window.location.href = '" . base_url . "';
            </script>
        ";
            exit();
        }
    }
    public function  logout()
    {
        $_SESSION['Usuario'] = false;
        $_SESSION['TipoUsuario'] = false;
        $_SESSION['Persona'] = false;
        $_SESSION['TipoPersona'] = false;
        $_SESSION['autenticado'] = false;
        unset($_SESSION['autenticado']);
        unset($_SESSION['Usuario']);
        unset($_SESSION['TipoUsuario']);
        unset($_SESSION['Persona']);

        echo "
        <script>
            window.location.href = '" . base_url . "';
        </script>
    ";
        exit();
        //header('Location:'.base_url);
    }
}
