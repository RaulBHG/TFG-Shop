<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= template_url() ?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= template_url() ?>vendor/fontawesome-free/css/all.min.css">    
    <link rel="stylesheet" href="<?= template_url() ?>css/adminStyle.css">
</head>
<body>
    <h1>ADMIN MENU</h1>
    <div class="optionsMenu">
        <div class="rowMenu">
            <a href="<?= base_url() ?>/adminPage/blogEdit">
                <div class="container">
                    Blog
                    <i class="fas fa-blog"></i>
                </div>
            </a>     
                   
        </div>
        <div class="rowMenu">
            <a href="<?= base_url() ?>/adminPage/productEdit">
                <div class="container">
                    Productos
                    <i class="fas fa-box"></i>
                </div>
            </a> 
        </div>
        <div class="rowMenu">
            <a href="<?= base_url() ?>/adminPage/orderEdit">
                <div class="container">
                    Pedidos
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </a> 
        </div>
        <div class="rowMenu">
            <a href="<?= base_url() ?>/adminPage/contactEdit">
                <div class="container">
                    Contactos
                    <i class="fas fa-address-book"></i>
                </div>
            </a> 
        </div>
    </div>    

    <script src="<?= template_url() ?>vendor/jquery/jquery.min.js"></script>
</body>
<script>
    $('a').click(function(e){
        e.preventDefault();
        var href= $(this).attr('href');
        $("html").css("overflow", "hidden");
        $(this).parent().addClass("opened");
        setTimeout(function(){
            window.location.href = href;
        }, 700);
        // over ride browser following link when clicked
        return false;
    });
</script>
</html>