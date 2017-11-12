hotlibrary.controller('mBookDetails',function ($scope,book) {

  var init = function () {
    $scope.book = book.data;
    $scope.load = _loan;
  }

  var _loan = function (book) {
    // TODO: criar função para solicitar o empréstimo do livro
    Materialize.toast('Função não disponível',3000);
  }

  init();

});
