hotlibrary.config(function ($routeProvider, Application) {

  $routeProvider.when('/',{
    templateUrl: Application.baseURL+'template/view/user-registration.html',
    controller: 'User'
  });
});
