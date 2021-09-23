<!doctype html>
<html lang="en">
  <head>
    <title>Página PHP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body><div class="p-3 mb-2 bg-secondary text-white"><h1>Formulario Empleados</h></div>
  

   
    <div class="container">
    <form class="d-flex" action="crud_productos.php" method="post" >
      <div class="col">
        <div class="mb-3">
          <label for="lbl_id" class="form-label"><b>ID Producto</b></label>
          <input type="number" name="txt_id" id="txt_id" class="form-control" value="0" readonly>
       </div>

       <div class="mb-3">
          <label for="lbl_producto" class="form-label"><b>Producto</b></label>
          <input type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="leche" required>
       </div>

       <div class="mb-3">
                <label for="lbl_marca" class="form-label"><b>Marca</b></label>
                <select class="form-select" name="drop_marca" id="drop_marca">
                  <option value=0> ---- Marca ---- </option>
                  <?php 
                   include("datos_conexion.php");
                   $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                   $db_conexion -> real_query ("SELECT idMarca as id, marca FROM marcas;");
                  $resultado = $db_conexion -> use_result();
                  while ($fila = $resultado ->fetch_assoc()){
                    echo "<option value=". $fila[ 'id'].">". $fila['marca']."</option>";

                  }
                  $db_conexion ->close();

                  ?>
                </select>
              </div>

          <div class="mb-3">
          <label for="lbl_descripcion" class="form-label"><b>Descripcion</b></label>
          <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" placeholder="Color, etc" required>
       </div> 
       
       <div class="mb-3">
          <label for="lbl_precioc" class="form-label"><b>Precio Costo</b></label>
          <input type="number" name="txt_precioc" id="txt_precioc" class="form-control" placeholder="Q0.00" required>
       </div>

       <div class="mb-3">
          <label for="lbl_preciov" class="form-label"><b>Precio Venta</b></label>
          <input type="number" name="txt_preciov" id="txt_preciov" class="form-control" placeholder="Q0.00" required>
       </div>

          <div class="mb-3">
          <label for="lbl_preciov" class="form-label"><b>Existencia</b></label>
          <input type="number" name="txt_existencia" id="txt_existencia" class="form-control" placeholder="cantidad" required>
       </div>

       <div class="mb-3">
          <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
          <input type="submit" name="btn_modificar" id="btn_modificar" class="btn btn-success" value="Modificar">
          <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" value="Eliminar">
          
       </div>

      </fomr>
     <table class="table table-striped table-inverse table-responsive">
      <thead class="thead-inverse">
        <tr>
        <th>Producto</th>
          <th>Marca</th>
          <th>Existencia</th>
          <th>Descripcion</th>
          <th>Precio Costo</th>
          <th>Precio Venta</th>
          <th>ID</th>
           </tr>
        </thead>
        <tbody id="tbl_productos">
        <?php
       include("datos_conexion.php");
       $db_conn = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
       $db_conn -> real_query ("select p.idProducto as id, p.producto, m.marca, p.descripcion, p.existencia, p.precio_costo, p.precio_venta, p.existencia, m.idMarca from productos as p inner join marcas as m on p.idMarca = m.idmarca;");
       $resultado = $db_conn -> use_result();
       while($fila = $resultado->fetch_assoc()){
        echo "<tr data-id=". $fila['id']." data-idm=". $fila['idMarca'].">";
        echo"<td>".$fila['producto']."</td>";
        echo"<td>".$fila['marca']."</td>";
        echo"<td>".$fila['existencia']."</td>";
        echo"<td>".$fila['descripcion']."</td>";
        echo"<td>".$fila['precio_costo']."</td>";
        echo"<td>".$fila['precio_venta']."</td>";
        echo"<td>".$fila['idMarca']."</td>";
        echo"<tr>";
      }
       $db_conn->close();
      ?>
        </tbody">
    </table>
    </div>

    
      <!-- Bootstrap JavaScript Libraries -->

    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script>
   $('#tbl_productos').on('click','tr td',function(evt){
        var target,id, idm, producto,existencia,descripcion,precio_costo,precio_venta;
        target = $(event.target);
        id = target.parent().data('id');
        idm = target.parent().data('idm');
        producto = target.parent("tr").find("td").eq(0).html();
        existencia =  target.parent("tr").find("td").eq(2).html();
        descripcion = target.parent("tr").find("td").eq(3).html();
        precio_costo = target.parent("tr").find("td").eq(4).html();
        precio_venta  = target.parent("tr").find("td").eq(5).html();

        $("#txt_id").val(id);
        $("#drop_marca").val(idm);
        $("#txt_producto").val(producto);
        $("#txt_existencia").val(existencia);
        $("#txt_descripcion").val(descripcion);
        $("#txt_precioc").val(precio_costo);
        $("#txt_preciov").val(precio_venta);
        
        
               
    });
  </script>  
  </body>
</html>
