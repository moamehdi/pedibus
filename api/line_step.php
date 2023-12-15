<?php

require_once('bdd.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PATCH');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $lines = $cnx->query("SELECT ls.name, ls.hour, ls.type, ls.id_line, lt.name AS line_name
                          FROM line_step ls
                          JOIN line_table lt ON ls.id_line = lt.id_line");

    $data = array();
    var_dump($lines);
    foreach ($lines as $line) {
        $data[] = [
            "name" => $line['line_name'],
            "hour" => $line["departure_hour"],
            "type" => $line["arrival_hour"],
            "id_line" => $line["is_active"],
            "line_name" => $line["name"],  // Utilisation du nom associé à id_line
        ];
    }

    echo json_encode($data);
}



?>