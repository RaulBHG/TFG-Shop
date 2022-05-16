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
</head>
<body>
  <div class="container">
 
   <div class="row">
      <div class="col-md-12"><pre id="token_response"></pre></div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <button class="btn btn-primary btn-block" onclick="pay(100)">Pay $100</button>
      </div>
      <div class="col-md-4">
        <button class="btn btn-success btn-block" onclick="pay(500)">Pay $500</button>
      </div>
      <div class="col-md-4">
        <button class="btn btn-info btn-block" onclick="pay(1000)">Pay $10000</button>
      </div>
    </div>
</div>
 
 
 
<script src="https://checkout.stripe.com/checkout.js"></script>
 
<script type="text/javascript">
 
  function pay(amount) {
    var handler = StripeCheckout.configure({
      key: 'pk_test_51Kyf0aLIP7gnkeacpG7gFDGURthcoFrHmuzdmSUAPSMAjJboUjNXm6hawyWWmJheEc3F2fKPrMXOStV4aY3uOQ6A00m0DuMLnH', // your publisher key id
      locale: 'auto',
      token: function (token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log('Token Created!!');
        console.log(token)
        $('#token_response').html(JSON.stringify(token));
 
        $.ajax({
          url:"<?php echo base_url(); ?>/payment",
          method: 'post',
          data: { tokenId: token.id, amount: amount },
          dataType: "json",
          success: function( response ) {
            console.log(response.data);
            $('#token_response').append( '<br />' + JSON.stringify(response.data));
          }
        })
      }
    });
  
    handler.open({
      name: 'Demo Site',
      description: '2 widgets',
      amount: amount * 100
    });
  }
</script>
</body>

<script>let baseUrl = "<?= base_url();?>"; </script>
<!-- Bootstrap core JavaScript -->
<script src="<?= template_url() ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= template_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

</html>