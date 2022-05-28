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
    <link rel="stylesheet" type="text/css" href="<?= template_url() ?>/css/style-contact.css">
    <link rel="stylesheet" type="text/css" href="<?= template_url() ?>/css/media-contact.css">
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

    <section class="contactSection">
        <form id="formContact">
            <div class="container">
                <div class="row">
                        <h1>Contáctanos</h1>
                </div>
                <div class="row input-container">
                        <div class="col-12">
                            <div class="styled-input wide">
                                <input type="text" name="nombre" required/>
                                <label>Nombre</label> 
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="styled-input wide">
                                <input type="text" name="id_buy"/>
                                <label>Id de compra</label> 
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="styled-input">
                                <input type="email" name="sender" required/>
                                <label>Email</label> 
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="styled-input" style="float:right;">
                                <input type="tel" name="phone" pattern="[5-9]{1}[0-9]{8}" maxlength="9" required/>                                
                                <label>Teléfono</label> 
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="styled-input wide">
                                <textarea name="message" required></textarea>
                                <label>Mensaje</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn-lrg submit-btn">Enviar</div>
                        </div>
                </div>
            </div>
        </form>
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
    <script src="<?= template_url() ?>js/contact.js"></script>
    
</body>
</html>