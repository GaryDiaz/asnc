<?php
srand(time());
$captcha_value = (string) rand(1000, 9999);
$captcha_numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
?>

<style>
  .current_captcha {
    font-family: emoji;
    font-size: 22px;
    font-weight: 400;
    color: #ffffff;
    background-image: url(http://localhost/asnc/Plantilla/img/images.jpeg);
    margin: 0 0 25px;
    overflow: hidden;
    border-radius: 35px 0px 35px 0px;
    -moz-border-radius: 35px 0px 35px 0px;
    -webkit-border-radius: 35px 0px 35px 0px;
    border: 2px solid #ca9258;
    text-align: center;
  }

  .captha_numbers {
    margin-bottom: 10px;
  }

  .captha_numbers a {
    border: 1px solid #0085CF;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    color: #0085CF;
    padding: 6px;
    text-decoration: none;
  }

  .captha_numbers a:hover {
    background-color: #0085CF;
    color: #ffffff;
  }
</style>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <title>Inicio de Sesión</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />

  <link rel="shortcut icon" href="<?= base_url() ?>Plantilla/img/favicon.ico" type="image/vnd.microsoft.icon" />

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="<?= base_url() ?>Plantilla/admin/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>Plantilla/admin/assets/plugins/font-awesome/5.3/css/all.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>Plantilla/admin/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>Plantilla/admin/assets/plugins/animate/animate.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>Plantilla/admin/assets/css/apple/style.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>Plantilla/admin/assets/css/apple/style-responsive.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>Plantilla/admin/assets/css/apple/theme/default.css" rel="stylesheet" id="theme" />
  <script src="<?= base_url() ?>Plantilla/admin/assets/plugins/pace/pace.min.js"></script>
  <link href="<?= base_url() ?>Plantilla/admin/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
</head>

<body class="pace-top bg-white">
  <div id="page-loader" class="fade show"><span class="spinner"></span></div>
  <div id="page-container" class="fade">
    <div class="login login-with-news-feed">
      <div class="news-feed">
        <div class="news-image" style="background-image: url(<?= base_url() ?>Plantilla/img/2.png);"></div>
        <!-- <img style="background-repeat: no-repeat;" src="<?= base_url() ?>Plantilla/img/2.png" alt=""> -->
      </div>
      <div class="right-content" style="padding-top:4%">
        <a href="<?= base_url() ?>index.php/llamadoconcurso" class="btn btn-light btn-lg btn-block">Llamado a concurso</a>
        <div class="login-header">
          <div class="brand  text-center">
            <span class="logo">
              <i style="color:darkred" class="fas fa-user-shield"></i>
            </span>
            <b class="ml-3"> Bienvenido</b>
          </div>
          <div class="icon">
            <i class="fa fa-sign-in"></i>
          </div>
        </div>
        <div class="login-content">
          <form action="<?= base_url() ?>index.php/login/validacion" method="POST" class="margin-bottom-0">
            <div class="form-group m-b-15">
              <input type="text" id="bloquear" class="form-control form-control-lg" autocomplete=off placeholder="Usuario" name="usuario" required />
            </div>
            <div class="form-group m-b-15">
              <input type="password" id="bloquear1" onpaste="return false;" onCopy="return false" onCut="return false" class="form-control form-control-lg" placeholder="Contraseña" name="contrasena" required />
            </div>
            <p class="form-group current_captcha">
              <?php echo $captcha_value; ?>
            </p>

            <div class="col-12 text-center">
              <p class="text form-group">
                <label for="captcha" class="captha_numbers">
                  <?php
                  foreach ($captcha_numbers as $number) {
                    echo '<a href="#" data="' . $number . '">' . $number . '</a> ';
                  }
                  ?>
                </label>
                <input type="text" size="4" maxlength="4" id="captcha" name="captcha" class="form-control">
                <input type="hidden" id="current_captcha" name="current_captcha" value="<?php echo $captcha_value; ?>">
              </p>
            </div>

            <div class="login-buttons">
              <button onclick="$(this).hide();" name="submitContact" type="submit" class="btn btn-block btn-lg button" style="background-color:darkred;color:#FFFFFF">Ingresar</button>
            </div>
            <hr />
            <div class="login-buttons mt-2">
              <!-- <button type="button"
        onclick="location.href='<?php echo base_url() ?>index.php/User/contrato'"
        class="btn btn-grey btn-lg">Registrar Cuentadante</button>
                        </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php if ($this->session->flashdata('sa-error')) { ?>
    <div hidden id="sa-error"> <?= $this->session->flashdata('sa-error') ?> </div>
  <?php } ?>
  <?php if ($this->session->flashdata('sa-error2')) { ?>
    <div hidden id="sa-error2"> <?= $this->session->flashdata('sa-error2') ?> </div>
  <?php } ?>
  <?php if ($this->session->flashdata('fallido')) { ?>
    <div hidden id="fallido"> <?= $this->session->flashdata('fallido') ?> </div>
  <?php } ?>

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="<?= base_url() ?>Plantilla/admin/assets/plugins/jquery/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url() ?>Plantilla/admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?= base_url() ?>Plantilla/admin/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>Plantilla/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?= base_url() ?>Plantilla/admin/assets/plugins/js-cookie/js.cookie.js"></script>
  <script src="<?= base_url() ?>Plantilla/admin/assets/js/theme/apple.min.js"></script>
  <script src="<?= base_url() ?>Plantilla/admin/assets/js/apps.min.js"></script>

  <script src="<?= base_url() ?>Plantilla/admin/assets/plugins/sweetalert/sweetalert.min.js"></script>
  <script src="<?= base_url() ?>Plantilla/admin/assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
  <!-- ================== END BASE JS ================== -->

  <script>
    $(document).ready(function() {
      $('.button').attr("disabled", true);
      $('.captha_numbers a').on('click', function() {
        var data = $(this).attr('data');
        $('#captcha').val($('#captcha').val() + data);

        if ($('#captcha').val() == $('#current_captcha').val())
          $('.button').attr("disabled", false);

        return false;
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $("#bloquear").on('paste', function(e) {
        e.preventDefault();
        alert('Esta acción está deshabilitada');
      });

      $("#bloquear").on('copy', function(e) {
        e.preventDefault();
        alert('Esta acción está deshabilitada');
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $("#bloquear1").on('paste', function(e) {
        e.preventDefault();
        alert('Esta acción está deshabilitada');
      });

      $("#bloquear1").on('copy', function(e) {
        e.preventDefault();
        alert('Esta acción está deshabilitada');
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      App.init();
    });
  </script>
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-53034621-1', 'auto');
    ga('send', 'pageview');
  </script>
</body>

</html>