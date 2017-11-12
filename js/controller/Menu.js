hotlibrary.controller("Menu", function ($scope,Auth,$location) {

  $scope.logout = function () {
    Auth.logout();
    var url = ($location.path().match(/mobile/g) ? '/mobile' : '/');
    $location.path(url);
  }

});
