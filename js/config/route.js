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
    templateUrl: Application.baseURL + 'template/view/user-alterPassword.html',
    controller: "AlterPassword",
    resolve: {
      user: function (tokenAPI, $route) {
        return tokenAPI.checkToken($route.current.params.token);
      }
    }
  });

  // Rotas de erro =============================================================

  $routeProvider.when('/erro/acesso_negado',{
    templateUrl: Application.baseURL + 'template/view/error-accessDenied.html'
  });

  $routeProvider.otherwise({
    redirectTo:'/',
  });
});
