<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilosIndex.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="img/icono.png">
    <title>VideoGames</title>
</head>
<body>
    <div class="header bg-primary p-5">
        <h1 class="text-uppercase text-center text-white font-weight-bold">Game Store <i class='bx bxs-game'></i></h1>
    </div>
    <div class="fixed-top">
        <h4 class="notificacion bg-light shadow rounded-circle d-inline-block p-3 m-1">
            <a href="#cliente" class="text-dark">
                <i class="fas fa-cart-arrow-down"></i>
            </a>
            <!-- <div class="notificacion d-none position-absolute alert alert-light m-0 p-1" role="alert">
                Articulo agregado
            </div> -->
        </h4>
    </div>
    <div class="container">
        <div id="cliente" class="cliente card shadow w-75 mx-auto my-4">
            <h2 class="card-header"><i class="fas fa-shopping-cart"></i> Cliente</h2>
            <div class="card-body">
                <div class="carrito p-2 border text-center">

                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-cash-register"></i> - TOTAL</span>
                            </div>
                            <div id="total" class="form-control bg-light font-weight-bold">
                                $0.0
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="float-right">
                            <button type="button" class="comprar-productos btn btn-secondary mb-2" data-toggle="modal" data-target="#caja">
                                    Comprar productos
                            </button>
                            <a href="#" class="vaciar-carrito btn btn-danger border mb-2">Vaciar Carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mercado container-fluid bg-secondary pb-5">
        <div class="row">
            <?php
                $str = file_get_contents('./juegos.json', true);

                $json = json_decode($str, true);
                $size = count($json);

                $colNum = $size / 3;
                $colNum = intval($colNum);
                $rest =  $size % 3;
                $productsXCol = [$colNum, $colNum, $colNum];
                if($rest > 0) {
                    $productsXCol[0]++;
                }
                if($rest > 1) {
                    $productsXCol[1]++;
                }
                $products = array();
                $cont = 0;
                foreach ($json as $value) {
                    if($cont == 0) {
                        $product = "<li class=\"producto\">
                        <div class=\"card text-center\">
                            <p class=\"articulo font-weight-bold card-header\">{$value['nombre_juego']} <i class=\"fas fa-tag\"></i></p>
                            <p class=\"articulo_descripcion font-weight-bold card-header\">{$value['descripcion']}</p>
                            <p class=\"articulo_empresa font-weight-bold card-header\"><strong>Empresa:</strong> {$value['empresa']}</p>
                            <p class=\"articulo_fecha_lanzamiento font-weight-bold card-header\"><strong>Fecha de lanzamiento:</strong> {$value['fecha_lanzamiento']}</p>
                            <span class=\"precio text-muted\">{$value['valor_juego']}$</span>
                            <div class=\"card-footer\">
                                <a href=\"#\" class=\"generar-error btn btn-primary btn-block\" data-id=\"{$value['id_juego']}\" data-toggle=\"modal\" data-target=\"#exampleModal\" >Llevar <i class=\"fas fa-cart-arrow-down\"></i></a>
                            </div>
                        </div>
                    </li>";
                    $cont++;
                    } else {
                        $product = "<li class=\"producto\">
                        <div class=\"card text-center\">
                            <p class=\"articulo font-weight-bold card-header\">{$value['nombre_juego']} <i class=\"fas fa-tag\"></i></p>
                            <p class=\"articulo_descripcion font-weight-bold card-header\">{$value['descripcion']}</p>
                            <p class=\"articulo_empresa font-weight-bold card-header\"><strong>Empresa:</strong> {$value['empresa']}</p>
                            <p class=\"articulo_fecha_lanzamiento font-weight-bold card-header\"><strong>Fecha de lanzamiento:</strong> {$value['fecha_lanzamiento']}</p>
                            <span class=\"precio text-muted\">{$value['valor_juego']}$</span>
                            <div class=\"card-footer\">
                                <a href=\"#\" class=\"llevar-articulo btn btn-primary btn-block\" data-id=\"{$value['id_juego']}\">Llevar <i class=\"fas fa-cart-arrow-down\"></i></a>
                            </div>
                        </div>
                    </li>";
                    }
                    array_push($products, $product);
                }
                $productIndex = 0;
                for ($i = 0; $i < 3; $i++) {
                    $colProduct = "
                    <div class=\"col-md-4 p-0\">
                        <div class=\"pasillo my-5\"></div>
                        <div class=\"pasillo-1 px-5\">
                            <ul class=\"seccion\">
                    ";
                    $colProduct .= $products[$productIndex];
                    $productIndex++;
                    for ($o=0; $o < $productsXCol[$i] - 1 ; $o++) {
                        if($productIndex < $size) {
                            $colProduct .= $products[$productIndex];
                            $productIndex++;
                        }
                    }
                    $colProduct .= "
                                </ul>
                            </div>
                        </div>";
                        echo $colProduct;
                }
            ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="caja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cajero <i class="fas fa-cash-register"></i></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h2><i class="fas fa-receipt"></i> Factura:</h2>
            <div id="recivo">

            </div>
            <div class="dropdown-divider"></div>
            <div class="font-weight-bold">
                Total a pagar: <div id="total">0.00$</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="compra.php" method="post">
                <input type="hidden" name="ID_JUEGO" value="" id="ID_JUEGO">
                <input type="hidden" name="NOMBRE" value="" id="NOMBRE">
                <input type="hidden" name="DESCRIPCION" value="" id="DESCRIPCION">
                <input type="hidden" name="VALOR" value="" id="VALOR">
                <button type="submit" class="btn btn-primary" id="pagar">Pagar <i class="fas fa-money-check-alt"></i></button>
            </form>
        </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Juego no disponible, selecciona otro
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>