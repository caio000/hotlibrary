hotlibrary.config(function ($routeProvider, Application) {

  $routeProvider.when('/',{
    templateUrl: Application.baseURL+'template/view/login-login.html',
    controller: 'Login'
  });
  $routeProvider.when('/usuario/cadastrar',{
    templateUrl: Application.baseURL+'template/view/user-registration.html',
    controller: 'User',
    requiresAuthentication: true,
    permissions: [1]
  });
  $routeProvider.when('/usuario/alterar/senha/:token',{
    templateUrl: Application.baseURL + 'template/view/user-forgotpassword.html',
    controller: "AlterPassword",
    resolve: {
      checkToken: function (userAPI, $route) {
        // TODO: Validar token no back-end
        return;
      }
    }
  });
  $routeProvider.when('/erro/acesso_negado',{
    templateUrl: Application.baseURL + 'template/view/error-accessDenied.html'
  });
});
