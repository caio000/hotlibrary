hotlibrary.controller('BookDetails',function ($scope,$rootScope,$location,book,bookAPI,libraryAPI) {

  var init = function () {
    $scope.book = book.data;
    $scope.Page = {title:$scope.book.name};
    $scope.btnBookDelete = {disabled: false, icon:'fa fa-trash'};
    $scope.delete = _delete;
    $scope.deleteBookFromLibrary = _deleteBookFromLibrary;
  }

  var _deleteBookFromLibrary = function (id) {
    $scope.btnBookDelete.disabled = true;
    $scope.btnBookDelete.icon = 'fa fa-spinner fa-pulse';

    libraryAPI.deleteBook(id).then(function success (response) {

      if (response.data.result) {
        config = {type:'success',msg:'livro deletado com sucesso',callback:function () {
          $location.path($rootScope.globals.currentUser.homePage);
        }};
      } else {
        config = {type:'danger',title:'Ops!',msg:'Ocorreu um erro ao deletar o livro'};
      }

      $scope.$emit('alert',config);
      $scope.btnBookDelete.disabled = false;
      $scope.btnBookDelete.icon = 'fa fa-trash';
    },function error () {
      $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde!'});
      $scope.btnBookDelete.disabled = false;
      $scope.btnBookDelete.icon = 'fa fa-trash';
    });
  }

  var _delete = function (id) {
    $scope.btnBookDelete.disabled = true;
    $scope.btnBookDelete.icon = 'fa fa-spinner fa-pulse';

    bookAPI.delete(id).then(function success (response) {

      if (response.data.result) {
        config = {
          type:'success',
          msg:'Livro excluido com sucesso',
          callback: function () {
            $location.path('/livro');
          }};
      } else {
        config = {type:'danger',title:'Ops',msg:response.data.msg};
      }

      $scope.$emit('alert',config);
      $scope.btnBookDelete.disabled = false;
      $scope.btnBookDelete.icon = 'fa fa-trash';
    }, function error (response) {
      $scope.$emit('alert',{type:'warning',title:'Ops',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
      $scope.btnBookDelete.disabled = false;
      $scope.btnBookDelete.icon = 'fa fa-trash';
    });
  }

  init();

});
