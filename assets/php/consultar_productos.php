<?php

require("../../admin/assets/config/ConexionBaseDatos_PDO.php");

$conexion = conectaDb();

$sql_productos = $conexion->prepare("SELECT * from producto_editorial");
$sql_productos->execute();

?>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Favoritos</span></h2>
            <p>Los productos que son mas comprados en el momento</p>
          </div>
        </div>
      </div>

      <div class="row">
        <?php
        foreach ($sql_productos as $row) { ?>
    
        
            <div class="col-lg-4 col-md-6">
            <div class="single-product">
                <div class="product-img">
                <img class="img-fluid w-100" src="admin/assets/img/productos/<?php echo $row['imagen']; ?>" alt="" />
                <div class="p_icon">
                    <a href="single-product.html">
                    <i class="ti-eye"></i>
                    </a>
                    <a href="encanta/index.html">
                    <i class="ti-heart"></i>
                    </a>
                    <a href="cart.html">
                    <i class="ti-shopping-cart"></i>
                    </a>
                </div>
                </div>
                <div class="product-btm">
                <a href="single-product.html" class="d-block">
                    <h4><?php echo $row['nombre_producto']; ?></h4>
                </a>
                <div class="mt-3">
                    <span class="mr-4"><?php echo $row['precio_producto']; ?></span>
                    <del>$35.00</del>
                </div>
                </div>
            </div>
            </div>

            <div class="col-lg-4 col-md-6">
            <div class="single-product">
                <div class="product-img">
                <img class="img-fluid w-100" src="img/product/feature-product/libro_que_habla_de_libros.jpg" alt="" />
                <div class="p_icon">
                    <a href="single-product.html">
                    <i class="ti-eye"></i>
                    </a>
                    <a href="encanta/index.html">
                    <i class="ti-heart"></i>
                    </a>
                    <a href="cart.html">
                    <i class="ti-shopping-cart"></i>
                    </a>
                </div>
                </div>
                <div class="product-btm">
                <a href="single-product.html" class="d-block">
                    <h4>
                    Un libro que habla de libros. Aproximación pedagógica a la teoría literaria</h4>
                </a>
                <div class="mt-3">
                    <span class="mr-4">$25.00</span>
                    <del>$35.00</del>
                </div>
                </div>
            </div>
            </div>

            <div class="col-lg-4 col-md-6">
            <div class="single-product">
                <div class="product-img">
                <img class="img-fluid w-100" src="img/product/feature-product/arte_de_escribir.jpg" alt="" />
                <div class="p_icon">
                    <a href="single-product.html">
                    <i class="ti-eye"></i>
                    </a>
                    <a href="encanta/index.html">
                    <i class="ti-heart"></i>
                    </a>
                    <a href="cart.html">
                    <i class="ti-shopping-cart"></i>
                    </a>
                </div>
                </div>
                <div class="product-btm">
                <a href="single-product.html" class="d-block">
                    <h4>El Arte de Escribir. Tercera edición</h4>
                </a>
                <div class="mt-3">
                    <span class="mr-4">$25.00</span>
                    <del>$35.00</del>
                </div>
                </div>
            </div>
            </div>

        <?php } ?>

      </div>
    </div>
