hotlibrary.config(function ($routeProvider, Application) {

  $routeProvider.when('/',{
    templateUrl: Application.baseURL+'template/view/login-login.html',
    controller: 'Login'
  });
  $routeProvider.when('/usuario/cadastrar',{
    templateUrl: Application.baseURL+'template/view/user-registration.html',
    controller: 'User'
  });
});
