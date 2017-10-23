hotlibrary.controller('BookRegistration',function ($scope,$document) {

  var init = function () {
    $document.find("#cover").fileinput({'showUpload':false});
    $scope.isEdit = false;
    $scope.Page = {title: 'Hotlibrary - Cadastrar livro'};
    $scope.register = register;
  }


  var register = function (book) {
    console.log(book);

    // TODO: Criar função para cadastrar livro
  }

  init();
});
