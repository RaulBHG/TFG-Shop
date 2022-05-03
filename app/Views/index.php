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
    <link rel="stylesheet" type="text/css" href="<?= template_url() ?>/css/style-home.css">
    <link rel="stylesheet" type="text/css" href="<?= template_url() ?>/css/media-home.css">
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

    <section class="banner-central">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-left align-items-center">
                    <div class="firstInfo">

                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <div class="mainForm">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cardsSection">
        <h2>Las mejores ofertas</h2>       

        <!-- OFERTAS DESKTOP -->
        <div class="container carouselContainer" id="carousel">
            <div class="row">
                <div class="card">1</div>
                <div class="card">2</div>
                <div class="card">3</div>
            </div>
            <div class="carouselPoints">
                <div class="point" position="0"></div>
                <div class="point active" position="1"></div>
                <div class="point" position="2"></div>
            </div>
        </div>
        <!-- FIN OFERTAS DESKTOP -->

    </section>

    
    <section class="ventajasSection">
        <h2>Las ventajas</h2>
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-five">
                    <div class="cardVentajas">
                        <img src="<?= template_url() ?>/img/ventaja.svg" alt="ventaja">
                        <h3>Ventaja</h3>
                        <p>Hola esta es una ventaja, te gusta?</p>
                    </div>
                </div>
                <div class="col-6 col-md-five">
                    <div class="cardVentajas">
                        <img src="<?= template_url() ?>/img/ventaja.svg" alt="ventaja">
                        <h3>Ventaja</h3>
                        <p>Hola esta es una ventaja, te gusta?</p>
                    </div>
                </div>
                <div class="col-6 col-md-five">
                    <div class="cardVentajas">
                        <img src="<?= template_url() ?>/img/ventaja.svg" alt="ventaja">
                        <h3>Ventaja</h3>
                        <p>Hola esta es una ventaja, te gusta?</p>
                    </div>
                </div>
                <div class="col-6 col-md-five">
                    <div class="cardVentajas">
                        <img src="<?= template_url() ?>/img/ventaja.svg" alt="ventaja">
                        <h3>Ventaja</h3>
                        <p>Hola esta es una ventaja, te gusta?</p>
                    </div>
                </div>
                <div class="col-12 col-md-five">
                    <div class="cardVentajas">
                        <img src="<?= template_url() ?>/img/ventaja.svg" alt="ventaja">
                        <h3>Ventaja</h3>
                        <p>Hola esta es una ventaja, te gusta?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faqs" class="preguntas_frecuentes">
    <h2>Preguntas Frecuentes</h2>
    <div class="containerColorFaqs">
        <div class="container containerFaqs">
        <div class="accordion" id="accordion">
            <div id="preguntasFrec" class="row">
            <div class="col-12 col-md-12">
                <div id="pregunta-1" class="box box-1">
                <div class="offset" type="button" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" aria-controls="collapse_1">
                    <div class="pregunta btn btn-link collapsed">
                    <h3 class="p3">
                        <b>¿Qué es el comparador de seguros médicos?</b>
                    </h3>                    
                    </div>
                    <div id="collapse_1" class="respuesta collapse" data-parent="#accordion">
                    <div class="card-body">
                        <p>El comparador de seguros médicos es una herramienta en la que podrás introducir tus datos e intereses y te dirá qué seguro médico se adapta a tus necesidades y el precio más bajo por el que podrás contratarlo.</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div id="pregunta-2" class="box box-2">
                <div class="offset" type="button" data-toggle="collapse" data-target="#collapse_2" aria-expanded="false" aria-controls="collapse_2">
                    <div class="pregunta btn btn-link collapsed">
                    <h3 class="p3">
                        <b>¿Qué factores influyen el contratar un seguro de salud?</b>
                    </h3>
                    </div>
                    <div id="collapse_2" class="respuesta collapse" data-parent="#accordion">
                    <div class="card-body">
                        <p>A la hora de contratar un seguro de salud influyen diversos factores como el tipo de seguro, ya que existen seguros con copago, sin copago o de reembolso; también la edad, enfermedades preexistentes o el uso que se le vaya a dar al seguro.</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-12 col-md-12">
                <div id="pregunta-3" class="box box-3">
                <div class="offset" type="button" data-toggle="collapse" data-target="#collapse_3" aria-expanded="false" aria-controls="collapse_3">
                    <div class="pregunta btn btn-link collapsed">
                    <h3 class="p3">
                        <b>Ventajas de tener un seguro de salud</b>
                    </h3>
                    </div>
                    <div id="collapse_3" class="respuesta collapse" data-parent="#accordion">
                    <div class="card-body">
                        <p>Son numerosas las ventajas de contar con un seguro médico, por ejemplo: <br>
                            - Tiempos de espera reducidos. <br>
                            - Contar con segundas opiniones. <br>
                            - Posibilidad de pedir cita con un especialista sin pasar por el médico de cabecera. <br>
                            - Libre elección de profesional y de centro médico. <br>
                            - Tratamientos médicos innovadores. <br>
                            - Cobertura nacional e internacional. <br>
                        </p>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-12 col-md-12">
                <div id="pregunta-4" class="box box-3">
                <div class="offset" type="button" data-toggle="collapse" data-target="#collapse_4" aria-expanded="false" aria-controls="collapse_3">
                    <div class="pregunta btn btn-link collapsed">
                    <h3 class="p3">
                        <b>Las mejores ofertas de seguros médicos privados</b>
                    </h3>
                    </div>
                    <div id="collapse_4" class="respuesta collapse" data-parent="#accordion">
                    <div class="card-body">
                        <p>Con nuestro comparador de seguros de salud encontrarás el seguro adecuado para ti al mejor precio. Trabajamos con las grandes aseguradoras médicas por lo que te recomendaremos la mejor póliza para ti y los tuyos.</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-12 col-md-12">
                <div id="pregunta-5" class="box box-3">
                <div class="offset" type="button" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" aria-controls="collapse_3">
                    <div class="pregunta btn btn-link collapsed">
                    <h3 class="p3">
                        <b>¿Qué son los periodos de carencia?</b>
                    </h3>
                    </div>
                    <div id="collapse_5" class="respuesta collapse" data-parent="#accordion">
                    <div class="card-body">
                        <p>Las carencias son los periodos de tiempo que un asegurado debe esperar para solicitar pruebas o tratamientos al contratar un seguro.</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            
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
    <script src="<?= template_url() ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= template_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= template_url() ?>/js/functions.js"></script>
    <script src="<?= template_url() ?>/js/main-home.js"></script>
    
</body>
</html>