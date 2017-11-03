hotlibrary.controller('BookList',function($scope,books){

  var init = function () {
    $scope.Page = {title:'Hotlibrary - Todos os livros'};
    $scope.books = books.data;
  }

  init();
});
