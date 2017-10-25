hotlibrary.config(function ($routeProvider, Application) {

  $routeProvider.when('/',{
    templateUrl: Application.baseURL+'template/view/login-login.html',
    controller: 'Login',
    hasMenu: false,
  });
  $routeProvider.when('/usuario',{
    templateUrl: Application.baseURL + 'template/view/user-list.html',
    controller: 'UserList',
    requiresAuthentication: true,
    permissions: [1],
    hasMenu: true,
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
    permissions: [1],
    hasMenu: true,
  });
  $routeProvider.when('/usuario/editar/:id',{
    templateUrl: Application.baseURL + 'template/view/user-registration.html',
    controller: "UserEdit",
    hasMenu: true,
    requiresAuthentication: true,
    permissions: [1],
    resolve: {
      user: function(UserAPI, $route) {
        return UserAPI.getById($route.current.params.id);
      },
      level: function (levelAPI) {
        return levelAPI.getAll();
      }
    }
  });
  $routeProvider.when('/usuario/alterar/senha/:token',{
    templateUrl: Application.baseURL + 'template/view/user-alterPassword.html',
    controller: "AlterPassword",
    resolve: {
      user: function (tokenAPI, $route) {
        return tokenAPI.checkToken($route.current.params.token);
      }
    },
    hasMenu: false,
  });

  // Rotas de livros ===========================================================
  $routeProvider.when('/livro/cadastrar',{
    templateUrl: Application.baseURL + 'template/view/book-form.html',
    controller: "BookRegistration",
    hasMenu: true,
    requiresAuthentication: true,
    permissions: [1,2],
    resolve: {
      authors: function (authorAPI) {
        return authorAPI.getAll();
      }
    }
  });

  // Rotas de categoria ========================================================
  $routeProvider.when('/categoria',{
    templateUrl: Application.baseURL + 'template/view/category-index.html',
    controller: 'Category',
    hasMenu: true,
    requiresAuthentication: true,
    permissions: [1,2],
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
