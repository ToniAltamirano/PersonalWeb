<?php

function errorMessage($e){

    if(!empty($e->errorInfo[1]))
    {
        switch($e->errorInfo[1]){
            case 1062:
                $mensaje = 'Registro duplicado';
                break;
    
            case 1451:
                $mensaje = 'Registro con elementos relacionados';
                break;
    
            default:
                $mensaje = $e-> errorInfo[1] . ' - ' . $errorInfo[2];
                break;
        }
    }else{
    
        switch($e->getCode()){
            case 1044:
                $mensaje = 'Usuario y/o password incorrecto';
                break;
    
            case 1049:
                $mensaje = 'Base de datos desconocida';
                break;
    
            case 2002:
                $mensaje = 'No se encuentra el servidor';
                break;
    
            default:
                $mensaje = $e-> getCode() . ' - ' . $e->getMessage();
                break;
        }
    }
    return $mensaje;
    } 


function openBD(){
 
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new PDO("mysql:host=$servername;dbname=hoteles_dwes;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
}

function closeBD(){
    return null;
}

function selectAllCiudades(){

    $conn = openBD();

    $sentencia = $conn->prepare('select * from ciudades');
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();
    $conn = closeBD();

    return $resultado;

}

function selectCiudadesById($id_ciudad){

    $conn = openBD();

    $sentencia = $conn->prepare('select * from ciudades where id_ciudad = :id_ciudad');
    $sentencia->bindParam(':id_ciudad', $id_ciudad);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $conn = closeBD();

    return $resultado;

}

function insertCiudad($id_ciudad, $nombre){

    try{
        $conn = openBD();
        $sentencia = $conn->prepare("INSERT INTO ciudades VALUES (:id_ciudad, :nombre)");
        $sentencia->bindParam(':id_ciudad', $id_ciudad);
        $sentencia->bindParam(':nombre', $nombre);

        $sentencia->execute();
        
        $_SESSION['mensaje'] = 'Registro insertado correctamente';

    }catch(PDOException $e){

        $_SESSION['error'] = errorMessage($e); 
        $ciudad['id_ciudad'] = $id_ciudad;
        $ciudad['nombre'] = $nombre;
        $_SESSION['ciudad'] = $ciudad;
    }

    $conn = closeBD();
}

function borrarCiudad($id_ciudad){

    try{
        $conn = openBD();
        $sentencia = $conn->prepare("delete from ciudades where id_ciudad = :id_ciudad");
        $sentencia->bindParam(':id_ciudad', $id_ciudad);

        $sentencia->execute();

        $_SESSION['mensaje'] = 'Se ha borrado correctamente correctamente';

    }catch(PDOException $e){

        $_SESSION['error'] = errorMessage($e); 

    }
    $conn = closeBD();

}

function editarCiudad($id_ciudad, $nombre){
    
    try{
        $conn = openBD();
        $sentencia = $conn->prepare('update ciudades SET nombre = :nombre WHERE id_ciudad = :id_ciudad');
        $sentencia->bindParam(':id_ciudad', $id_ciudad);
        $sentencia->bindParam(':nombre', $nombre);

        $sentencia->execute(); 

        $_SESSION['mensaje'] = 'Registro actualizado correctamente';

    }catch(PDOException $e){

        $_SESSION['error'] = errorMessage($e);
        $ciudad['id_ciudad'] = $id_ciudad;
        $ciudad['nombre'] = $nombre;
        $_SESSION['ciudad'] = $ciudad;
    }

    $conn = closeBD();
}

?>