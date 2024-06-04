<?php
function getDB(){
    $db = new PDO('mysql:host=localhost;dbname=bd_pagos;charset=utf8','root', '');
    return $db;
}
function getPagos(){
    $db = getDB();
    $sentencia = $db->prepare( "select * from pagos");
    $sentencia->execute();
    $pagos = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $pagos;
}

function addPagos($deudor, $cuota, $cuota_capital, $fecha_pago){
    $db = getDB();
    $sentencia = $db->prepare("INSERT INTO pagos(deudor, cuota, cuota_capital, fecha_pago) VALUES(:deudor, :cuota, :cuota_capital, :fecha_pago)");
    $sentencia->execute([':deudor'=>$deudor, ':cuota'=>$cuota, ':cuota_capital'=>$cuota_capital, ':fecha_pago'=>$fecha_pago]);
        
    return $db->lastInsertId();
}
function deletePagos($id){
    $db = getDB();
    $sentencia = $db->prepare("delete from pagos where id=?");    
    $sentencia->execute([$id]);
}
function completarPagos($id){
    $db = getDB();
    $sentencia = $db->prepare("update pagos set finalizado = 1 where id=?");    
    $sentencia->execute([$id]);
}