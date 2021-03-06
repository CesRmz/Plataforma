<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 9/30/14
 * Time: 2:57 PM
 */

$id_modulo = 45; // 45 - Configuración - Colonias
include_once("../../../includes/validar_admin.php");
include_once("../../../includes/clases/class_lib.php");
include_once("../../../includes/validar_acceso.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Sistema Integral Meze - Configuración: Colonias</title>
    <link rel="stylesheet" href="../../../estilo/general.css" />
    <link rel="stylesheet" href="../../../estilo/jquery.dataTables.css" />
</head>
<body>
<div id="wrapper">
    <?php include("../../../includes/header.php"); ?>
    <div id="content">

        <div id="inner_content">

            <h2>Colonias</h2>

            <button onclick="nuevaColoniaClicked()" >Nueva</button>

            <table id="tabla_colonias" >
                <thead>
                <tr>
                    <th>Colonia</th>
                </tr>
                </thead>
                <tbody>
                    <!-- AJAX -->
                </tbody>
            </table>
        </div>

    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="../../../librerias/jquery.dataTables.min.js" ></script>
<script src="../../../librerias/fnAjaxReload.js" ></script>
<script>
    var tabla_colonias;

    declararDataTable();

    function declararDataTable()
    {
        tabla_colonias = $('#tabla_colonias').dataTable({
            "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_ colonias por página",
                "sZeroRecords": "No existen colonias",
                "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ colonias",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 colonias",
                "sInfoFiltered": "(Encontrados de _MAX_ colonias)"
            },
            "bProcessing": true,
            "sAjaxSource": '../../../includes/acciones/configuracion/colonias/print_tabla.php',
            "fnServerParams": function (aoData)
            {
                //aoData.push({ "name": "id_ciclo_escolar", "value": id_ciclo_escolar });
            },
            "iDisplayLength": 25
        });
    }

    function nuevaColoniaClicked()
    {
        var nuevaColoniaNombre = prompt("Nombre");
        if(nuevaColoniaNombre)
        {
            if(confirm("¿Seguro que desea agregar la nueva colonia: " + nuevaColoniaNombre + "?"))
            {
                $.ajax({
                    type: "POST",
                    url: "/includes/acciones/configuracion/colonias/insert.php",
                    data: "nombre=" + nuevaColoniaNombre,
                    success: function (data)
                    {
                        if(data == 1)
                        {
                            reloadTable();
                        }
                        else
                        {
                            alert("Error del sistema.");
                        }
                    }
                });
            }
        }

    }

    function reloadTable()
    {
        tabla_colonias.fnReloadAjax();
    }
</script>
</body>
</html>