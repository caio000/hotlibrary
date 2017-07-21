<!DOCTYPE html>
<html ng-app="hotlibrary" ng-controller="User">
  <head>
    <meta charset="utf-8">
    <title>{{Page.title}}</title>
    <!-- Bootstrap Core -->
    <link rel="stylesheet" href="/hotlibrary/bower_components/bootstrap/dist/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/hotlibrary/bower_components/font-awesome/css/font-awesome.css">
  </head>
  <body>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
          <h2 class="text-center">{{ Page.title }}</h2>

          <form class="form-horizontal" name="newUser" autocomplete="off" novalidate>

            <div class="form-group">
              <div ng-class="{'has-error':newUser.name.$invalid && (newUser.name.$dirty || newUser.$submitted), 'has-success':newUser.name.$valid}">
                <label for="name" class="control-label">Nome:</label>
                <?php // TODO: arrumar a expressão regular para validar o campo nome ?>
                <input id="name" class="form-control" type="text" name="name" placeholder="Fulano de tal" ng-model="User.name" ng-required="true" ng-minlength="10" ng-maxlength="50" ng-pattern="/[a-z]+/g" autofocus>
                <span ng-if="newUser.name.$error.required && (newUser.name.$dirty || newUser.$submitted)" class="help-block"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> O campo nome é obrigatório</span>
                <span ng-if="newUser.name.$error.minlength && newUser.name.$dirty" class="help-block"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> O nome deve conter no minimo 10 caracteres</span>
                <span ng-if="newUser.name.$error.maxlength && newUser.name.$dirty" class="help-block"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> O nome deve conter no maximo 50 caracteres</span>
                <span ng-if="newUser.name.$error.pattern && newUser.name.$dirty" class="help-block"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Nome inválido</span>
                <span ng-if="newUser.name.$valid" class="help-block"><i class="fa fa-check"></i></span>
              </div>
            </div>

            <div class="form-group">
              <div ng-class="{'has-error':newUser.email.$invalid && (newUser.email.$dirty || newUser.$submitted), 'has-success':newUser.email.$valid}">
                <label for="email" class="control-label">Email:</label>
                <input id="email" class="form-control" type="email" name="email" placeholder="example@example.com" ng-model="User.email" ng-required="true">
                <span ng-if="newUser.email.$error.required && (newUser.email.$dirty || newUser.$submitted)" class="help-block"><i class="fa fa-exclamation-circle"> O campo email é obrigatório</i></span>
                <span ng-if="newUser.email.$error.email && newUser.email.$dirty" class="help-block"><i class="fa fa-exclamation-circle"> Informa um email válido</i></span>
                <span ng-if="newUser.email.$valid" class="help-block"><i class="fa fa-check"></i></span>
              </div>
            </div>

            <div class="form-group">
              <div ng-class="{'has-error':newUser.password.$invalid && (newUser.password.$dirty || newUser.$submitted), 'has-success':newUser.password.$valid}">
                <label for="password" class="control-label">Senha:</label>
                <input id="password" class="form-control" type="password" name="password" ng-model="User.password" ng-required="true" ng-minlength="8">
                <span ng-if="newUser.password.$error.required && (newUser.password.$dirty || newUser.$submitted)" class="help-block"><i class="fa fa-exclamation-circle"> O campo senha é obrigatório</i></span>
                <span ng-if="newUser.password.$error.minlength" class="help-block"><i class="fa fa-exclamation-circle"> A senha deve possuir no minimo 8 caracteres</i></span>
                <span ng-if="newUser.password.$valid" class="help-block"><i class="fa fa-check"></i></span>
              </div>
            </div>

            <div class="form-group">
              <button id="btnNewUser" class="btn btn-primary" type="submit" name="btnNewUser" ng-click="sendUser(User, newUser.$valid)" ng-disabled="btnNewUser.disabled">Cadastrar Usuário <i ng-show="btnNewUser.disabled" class="fa fa-spinner fa-spin"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Angular -->
    <script src="/hotlibrary/bower_components/angular/angular.js" charset="utf-8"></script>
    <!-- Module -->
    <script src="/hotlibrary/js/app.js" charset="utf-8"></script>
    <!-- controller -->
    <script src="/hotlibrary/js/controller/User.js" charset="utf-8"></script>
    <!-- Services -->
    <script src="/hotlibrary/js/services/config.js" charset="utf-8"></script>

  </body>
</html>
