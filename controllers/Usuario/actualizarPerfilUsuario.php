    <?php
    require_once "../../models/usuario/Usuario.php";
    require_once "../../models/Persona.php";
    require_once "../../config/database.php";

    $idUsuario = $_POST['idUsuario'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];
    $tipoPersona = $_POST['tipoPersona'];
    $tipoDocumentoIdentidad = $_POST['tipoDocumentoIdentidad'];
    $numDocumentoIdentidad = $_POST['numDocumentoIdentidad'];
    // $representanteLegal = $_POST['representanteLegal'];
    $dniCUI = $_POST['dniCUI'];
    // $usuario=$_POST['usuario'];
    $password=$_POST['password'];

    $personaModel = new Persona();
    $personaModel->setNombres($nombres);
    $personaModel->setApellidos($apellidos);
    $personaModel->setEmail($email);
    $personaModel->setTelefono($telefono);
    $personaModel->setDomicilio($domicilio);
    $personaModel->setTipoPersona($tipoPersona);
    $personaModel->setTipoDocumentoIdentidad($tipoDocumentoIdentidad);
    $personaModel->setNumDocumentoIdentidad($numDocumentoIdentidad);
    $personaModel->setDniCUI($dniCUI);
    // $personaModel->setEstado($estado);
    // $personaModel->setRepresentanteLegal($representanteLegal);
    // $usuarioModel=new Usuario();
    // $usuarioModel->setidUsuario($idUsuario);
    // $usuarioModel->setPassword($password);

    if($password===''){
        $password=null;
    }

    $response = $personaModel->actualizarDatosPerfilUsuario($idUsuario,$password);
    // $response=$usuarioModel->actualizarContraseñaUsuario();
    print json_encode($response);
