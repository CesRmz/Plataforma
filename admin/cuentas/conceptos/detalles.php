<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 12/22/14
 * Time: 6:26 PM
 */

extract($_GET);
# id_concepto

$id_modulo = 49; // 49 - Cuentas - Dinámicas
include_once("../../../includes/validar_admin.php");
include_once("../../../includes/clases/class_lib.php");
include_once("../../../includes/clases/class.Concepto.php");
include_once("../../../includes/validar_acceso.php");
include_once("../../../includes/validar_acceso.php");

$concepto = new Concepto($id_concepto);
$pagos = $concepto->getPagos();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Sistema Integral Meze - Configuración: Clubs</title>
    <link rel="stylesheet" href="../../../estilo/general.css" />
    <link rel="stylesheet" href="../../../estilo/jquery.dataTables.css" />
</head>
<body>
<div id="wrapper">
    <?php include("../../../includes/header.php"); ?>
    <div id="content">

        <div id="inner_content">

            <h2>Pagos a Conceptos</h2>
            <table id="tabla_pagos" >
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Monto</th>
                        <th>No. Cuenta</th>
                        <th>Usuario</th>
                        <th>Fecha de Pago</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(is_array($pagos))
                {
                    foreach($pagos as $pago)
                    {
                        echo "
                                        <tr>
                                            <td>".$pago['Concepto']."</td>
                                            <td>".$pago['Monto']."</td>
                                            <td>".$pago['No. Cuenta']."</td>
                                            <td>".$pago['Usuario']."</td>
                                            <td>".$pago['Fecha de Pago']."</td>
                                        </tr>
                                    ";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="../../../librerias/jquery.dataTables.min.js" ></script>
<script src="../../../librerias/fnAjaxReload.js" ></script>
<script>
    var tabla_cuentas;

    declararDataTable();

    function declararDataTable()
    {
        tabla_cuentas = $('#tabla_pagos').dataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ cuentas por página",
                "zeroRecords": "No existen cuentas",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ cuentas",
                "infoEmpty": "Mostrando 0 a 0 de 0 cuentas",
                "infoFiltered": "(Encontrados de _MAX_ cuentas)"
            },
            "processing": true,
            "iDisplayLength": 25
        });
    }
</script>
</body>
</html>