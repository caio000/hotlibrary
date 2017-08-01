hotlibrary.controller('Login', function ($scope, $document, Application) {
  $scope.Application = Application;

  $scope.makeLogin = function (User, formValid) {
    if (formValid) {
      console.log(User);
    }
  };
});
