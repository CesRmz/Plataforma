<?php
/**
 * Created by PhpStorm.
 * User: Yozki
 * Date: 10/4/14
 * Time: 1:06 PM
 */

$id_modulo = 46; // 46 - Configuración - Papeleria
include_once("../../../includes/validar_admin.php");
include_once("../../../includes/clases/class_lib.php");
include_once("../../../includes/validar_acceso.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Sistema Integral Meze - Configuración: Papeleria</title>
    <link rel="stylesheet" href="../../../estilo/general.css" />
    <link rel="stylesheet" href="../../../estilo/jquery.dataTables.css" />
</head>
<body>
<div id="wrapper">
    <?php include("../../../includes/header.php"); ?>
    <div id="content">

        <div id="inner_content">

            <h2>Papeleria</h2>

            <button onclick="nuevaPapeleriaClicked()" >Nueva</button>

            <table id="tabla_papeleria" >
                <thead>
                <tr>
                    <th>Documento</th>
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
    var tabla_papeleria;

    declararDataTable();

    function declararDataTable()
    {
        tabla_papeleria = $('#tabla_papeleria').dataTable({
            "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_ documentos por página",
                "sZeroRecords": "No existen documentos",
                "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ documentos",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 documentos",
                "sInfoFiltered": "(Encontrados de _MAX_ documentos)"
            },
            "bProcessing": true,
            "sAjaxSource": '../../../includes/acciones/configuracion/papeleria/print_tabla.php',
            "fnServerParams": function (aoData)
            {

            },
            "iDisplayLength": 25
        });
    }

    function nuevaPapeleriaClicked()
    {
        var nuevaPapeleriaNombre = prompt("Nombre");
        if(nuevaPapeleriaNombre)
        {
            if(confirm("¿Seguro que desea agregar el nuevo documento: " + nuevaPapeleriaNombre + "?"))
            {
                $.ajax({
                    type: "POST",
                    url: "/includes/acciones/configuracion/papeleria/insert.php",
                    data: "nombre=" + nuevaPapeleriaNombre,
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
        tabla_papeleria.fnReloadAjax();
    }
</script>
</body>
</html>