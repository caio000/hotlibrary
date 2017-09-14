hotlibrary.config(function ($routeProvider, Application) {

  $routeProvider.when('/',{
    templateUrl: Application.baseURL+'template/view/login-login.html',
    controller: 'Login'
  });
  $routeProvider.when('/usuario',{
    templateUrl: Application.baseURL + 'template/view/user-list.html',
    controller: 'UserList',
    requiresAuthentication: true,
    permissions: [1],
    resolve: {
      users: function (UserAPI) {
        return UserAPI.getAll();
      }
    }
  });
  $routeProvider.when('/usuario/cadastrar',{
    templateUrl: Application.baseURL+'template/view/user-registration.html',
    controller: 'User',
    resolve: {
      userLevel: function (levelAPI) {
        return levelAPI.getAll();
      }
    },
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

  $routeProvider.when('erro/pagina_nao_encontrada',{
    templateUrl: Application.baseURL + 'template/view/error-notFound.html',
  });

  $routeProvider.otherwise({
    redirectTo:'/',
  });
});
