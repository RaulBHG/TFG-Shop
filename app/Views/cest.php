<!DOCTYPE html>
<html lang="es">
<head>

    <script>
        dataLayer = [];
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <meta name="description" content="">
    <link rel="canonical" href=""/>
    <link rel="icon" href="">
    <title>Document</title>
    <link href="<?= template_url() ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= template_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= template_url() ?>/css/central.css">
    <link rel="stylesheet" type="text/css" href="<?= template_url() ?>/css/style-cest.css">
    <link rel="stylesheet" type="text/css" href="<?= template_url() ?>/css/media-cest.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-5 col-md-5 col-lg-2">
                    <a href="<?= base_url() ?>">
                        <img class="logo" src="<?= template_url() ?>/img/logo.png" alt="logo">
                    </a>
                </div>
                <div class="hide-mobile col-md-1 col-lg-7"></div>
                <div class="col-7 col-md-6 col-lg-3">
                </div>
            </div>
        </div>        
    </header>

    
    <section class="cestaSection">        
        <div class="container"> 
        <h1>Cesta</h1>
            <div class="row">
                <div class="headRows">
                    <p>IMAGE</p>
                    <p>NAME</p>
                    <p>PRICE</p>
                    <p>CANT</p>
                </div>
            </div>       
        <?php
            $totalPrices = 0;
            foreach ($products as $product) {
            $totalPrices += $product["priceTotal"];
        ?>
            <div class="row">                
                <div class="rowProduct" productId="<?= $product["id"] ?>">
                    <div class="imgCont">
                        <a href="<?= base_url() ?>/product/<?= $product["id"] ?>">
                            <img src="<?= template_url() ?>img/img_products/<?= $product["main_img"] ?>" alt="<?= $product["name"] ?>">
                        </a>
                    </div>
                    <div class="infoProd">
                        <p class="nameProd"><?= $product["name"] ?></p>
                        <p class="priceProd"><?= $product["price"] ?>€</p>
                        <input type="number" class="inputCant" min="0" max="50" placeholder="Cantidad" value="<?= $product["cant"] ?>" oninput="this.value = Math.abs(this.value)">
                    </div>
                    <div class="removeFrom">
                        <i class="fas fa-minus-circle"></i>
                    </div>
                </div>                
            </div>
        <?php
            }
        ?>
        </div>
        <div class="total">
            <div class="container">            
                <div class="row">
                    <div>
                        <p class="totalPrice"><b>TOTAL:</b> <span class="numPrice"><?= $totalPrices ?></span>€</p>
                        <button class="payButton">Pagar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-2">
                </div>
                <div class="col-12 col-md-12 col-lg-8 caracsFooter d-flex align-items-center justify-content-center">
                    <a href="#" data-toggle="modal" data-target="#privacidad">Politica de Privacidad</a>
                    <a href="#" data-toggle="modal" data-target="#legales">Aviso Legal</a>
                    <a href="#" data-toggle="modal" data-target="#cookies">Política de Cookies</a>
                    <a href="#" data-toggle="modal" data-target="#condicionespromo">Condiciones de la promoción</a>
                </ul>
                </div>
                <div class="col-12 col-md-12 col-lg-2">
                </div>
            </div>
        </div>
    </footer>

    <script>let baseUrl = "<?= base_url();?>"; </script>
    <!-- Bootstrap core JavaScript -->
    <script src="<?= template_url() ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= template_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= template_url() ?>js/cest.js"></script>
    
</body>
</html>