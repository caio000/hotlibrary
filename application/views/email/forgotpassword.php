<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>email</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <h2 class="text-center">Olá <?= $user->name ?>!</h2>
          <p class="text-justify">
            Recebemos uma solicitação para recuperar sua senha de acesso ao sistema
            <strong>Hotlibrary</strong>, para alterar sua senha
            <?= anchor('usuario/alterar/senha/'.$token,'clique aqui.') ?>
          </p>

          <p class="text-justify">Caso você não tenha feito a solicitação, ignore esse email.</p>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <?= img('img/hotlibrary-logo.png',FALSE,array('class'=>'img-responsive')) ?>
        </div>

      </div>
    </div>
  </body>
</html>
