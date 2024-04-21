<?php
include_once '../version1.php';

//valores de los parametros
$existeId = false;
$valorId = 0;

if (count($_parametros) > 0) {
    foreach ($_parametros as $p) {
        if (strpos($p, 'id') !== false) {
            $existeId = true;
            $valorId = explode('=', $p)[1];
        }
    }
}

if ($_version == 'v1') {
    if ($_mantenedor == 'mantenedor') {
        switch ($_metodo) {
            case 'GET':
                if (strpos($_header, 'Bearer') !== false) {
                    if (strpos($_header, 'SERVICIOS') !== false) {
                        $json_file = file_get_contents('services.json');
                        $servicios = json_decode($json_file, true);
                
                        if ($servicios === null) {
                            http_response_code(500); 
                            echo json_encode(["Error" => "Error al decodificar el JSON"]);
                        } else {
                            http_response_code(200);
                            echo $json_file;
                        }
                    } else if (strpos($_header, 'NOSOTROS') !== false) {
                        $json_file = file_get_contents('aboutus.json');
                        $servicios = json_decode($json_file, true);
                
                        if ($servicios === null) {
                            http_response_code(500); 
                            echo json_encode(["Error" => "Error al decodificar el JSON"]);
                        } else {
                            http_response_code(200);
                            echo $json_file;
                        }
                    } else {
                        http_response_code(404);
                        echo json_encode(["Error" => "Endpoint no encontrado"]);
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(["Error" => "No tiene autorización GET"]);
                }
                break;
            default:
                http_response_code(405);
                echo json_encode(["Error" => "Método no permitido"]);
                break;
        }
    }
}