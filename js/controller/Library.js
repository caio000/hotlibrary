hotlibrary.controller('Library',function ($scope,$document,library,UserAPI) {

  var init = function () {
    $scope.library = library.data;
    $scope.Page = {title:$scope.library.name};
    $scope.alterPassword = _alterPassword;
  }

  var _alterPassword = function (password,form) {
    if (form.$valid) {

      $scope.library.password = password;
      UserAPI.alterPassword($scope.library).then(
        function success (response) {
          $scope.library = response.data.user;
          $document.find("#hotModal").modal('hide');
          $scope.$emit('alert',{type:'success',msg:'Senha alterada'});
        }, function error () {
          $document.find("#hotModal").modal('hide');
          $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
        });

    }
  }

  init();

});
