hotlibrary.controller("Menu", function ($scope,$interval,$rootScope,Auth,$location,libraryAPI) {

  $scope.notifications = {};

  $scope.logout = function () {
    Auth.logout();
    var url = ($location.path().match(/mobile/g) ? '/mobile' : '/');
    $location.path(url);
  }

  if ($rootScope.globals.currentUser.level == 2) {
    $interval(function(){
      libraryAPI.getNotification($rootScope.globals.currentUser.id).then(function (response) {
        $scope.notifications = response.data;
      });
    },3000);
  }
});
