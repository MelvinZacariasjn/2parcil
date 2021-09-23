<?php
if (!empty($_POST)){
    $txt_id = utf8_decode($_POST["txt_id"]);
    $txt_producto = utf8_decode($_POST["txt_producto"]);
    $txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
    $txt_precioc = utf8_decode($_POST["txt_precioc"]);
    $txt_preciov = utf8_decode($_POST["txt_preciov"]) ;
    $drop_marca = utf8_decode($_POST["drop_marca"]) ;
    $txt_existencia = utf8_decode($_POST["txt_existencia"]) ;
    $sql = "";

    if(isset($_POST['btn_agregar'])  ){
        
        $sql = "insert into productos(producto, idMarca, descripcion, precio_costo, precio_venta, existencia)values ('". $txt_producto ."', ". $drop_marca .", '". $txt_descripcion ."', ". $txt_precioc .", ". $txt_preciov .", ". $txt_existencia .");";
        
      }

    if (isset($_POST["btn_modificar"])){
        $sql = "update productos set producto='". $txt_producto ."',idMarca=". $drop_marca .",descripcion='". $txt_descripcion ."', precio_costo=". $txt_precioc ." ,precio_venta=". $txt_preciov ." ,existencia=". $txt_existencia ." where idProducto = ". $txt_id.";";
   }
   if( isset($_POST['btn_eliminar'])  ){
    $sql = "delete from productos  where idProducto = ". $txt_id.";";
   }
        include("datos_conexion.php");
        $db_conn = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre); 
                  
        if($db_conn->query($sql)===true){
        $db_conn->close();
        header("Location: /2PARCIAL");
        }else{
          echo"error" . $sql . "<br>" . $db_conn->close();
        }    


}
       
    
 
    ?>