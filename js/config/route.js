hotlibrary.config(function ($routeProvider, Application) {

  // MOBILE ROUTES =============================================================
  $routeProvider.when('/mobile',{
    templateUrl: Application.baseURL + 'template/view/mobile-user-login.html',
    controller: 'mLogin',
  });
  // Mobile user Routes
  $routeProvider.when('/mobile/user/:id',{

  });
  $routeProvider.when('/mobile/livros',{
    templateUrl: Application.baseURL + 'template/view/mobile-book-list.html',
    controller: 'mBookList',
    requiresAuthentication: true,
    permissions: [3],
    resolve: {
      books: function (bookAPI){
        return bookAPI.getAll({fromUserCity:true});
      }
    }
  });
  $routeProvider.when('/mobile/livro/detalhe/:id',{
    templateUrl: Application.baseURL + 'template/view/mobile-book-details.html',
    controller: 'mBookDetails',
    requiresAuthentication: true,
    permissions: [3],
    resolve: {
      book: function (bookAPI,$route) {
        return bookAPI.getById($route.current.params.id+'/true');
      }
    }
  });
  // WEB ROUTES ================================================================
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
    permissions: [1,2],
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

  // Rotas de bibliotecas ======================================================
  $routeProvider.when('/biblioteca/:id',{
    templateUrl: Application.baseURL + 'template/view/library-index.html',
    controller: 'Library',
    requiresAuthentication: true,
    hasMenu:true,
    permissions: [1,2],
    resolve: {
      library: function (libraryAPI,$route) {
        return libraryAPI.getAll($route.current.params.id);
      },
      books: function (bookAPI) {
        return bookAPI.getAll({params:{with_picture:true}});
      }
    }
  });

  // Rotas de livros ===========================================================
  $routeProvider.when('/livro/editar/:id',{
    templateUrl: Application.baseURL + 'template/view/book-form.html',
    controller: 'BookEdit',
    hasMenu: true,
    requiresAuthentication: true,
    permissions: [1,2],
    resolve: {
      authors: function (authorAPI) {
        return authorAPI.getAll();
      },
      publishingCompanies: function(publishingCompanyAPI) {
        return publishingCompanyAPI.getAll();
      },
      categories: function(categoryAPI) {
        return categoryAPI.getAll();
      },
      book: function (bookAPI,$route) {
        return bookAPI.getById($route.current.params.id+'/false');
      }
    }
  });
  $routeProvider.when('/livro/detalhe/:id',{
    templateUrl: Application.baseURL + 'template/view/book-details.html',
    controller: 'BookDetails',
    hasMenu: true,
    permissions: [1,2],
    resolve: {
      book: function (bookAPI,$route) {
        return bookAPI.getById($route.current.params.id+'/false');
      }
    }
  });
  $routeProvider.when('/livro/cadastrar',{
    templateUrl: Application.baseURL + 'template/view/book-form.html',
    controller: "BookRegistration",
    hasMenu: true,
    requiresAuthentication: true,
    permissions: [1,2],
    resolve: {
      authors: function (authorAPI) {
        return authorAPI.getAll();
      },
      publishingCompanies: function(publishingCompanyAPI) {
        return publishingCompanyAPI.getAll();
      },
      categories: function(categoryAPI) {
        return categoryAPI.getAll();
      }
    }
  });
  $routeProvider.when('/livro',{
    templateUrl: Application.baseURL + 'template/view/book-list.html',
    controller: 'BookList',
    hasMenu: true,
    requiresAuthentication: true,
    permissions: [1],
    resolve: {
      books: function (bookAPI) {
        return bookAPI.getAll();
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
    resolve: {
      categories: function (categoryAPI) {
        return categoryAPI.getAll();
      }
    },
  });

  // Rotas de autor ============================================================
  $routeProvider.when('/autor',{
    templateUrl: Application.baseURL + 'template/view/author-index.html',
    controller: 'Author',
    hasMenu: true,
    requiresAuthentication: true,
    permissions: [1,2],
    resolve: {
      authors: function (authorAPI) {
        return authorAPI.getAll();
      }
    }
  });

  // Rotas de editoras =========================================================
  $routeProvider.when('/editora',{
    templateUrl: Application.baseURL + 'template/view/publishingCompany-index.html',
    controller: 'PublishingCompany',
    hasMenu: true,
    requiresAuthentication: true,
    permissions: [1,2],
    resolve: {
      publishingCompanies: function(publishingCompanyAPI) {
        return publishingCompanyAPI.getAll();
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
