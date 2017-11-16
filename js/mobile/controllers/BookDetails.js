hotlibrary.controller('mBookDetails',function ($scope,$timeout,$document,book,clientAPI) {

  var init = function () {

    $scope.book = book.data;
    $scope.loan = {book:book.data};
    $scope.btnLoan = {disabled:false};
    $timeout(function () {
      $document.find('select').material_select();
      $scope.makeLoan = _makeLoan;
    }, 500);
  }

  var _makeLoan = function (loan) {
    if ($scope.formLoan.$valid) {
      $scope.btnLoan.disabled = true;
      clientAPI.loan(loan).then(function success (response) {
        $scope.btnLoan.disabled = false;
        Materialize.toast(response.data.msg,5000);
      },function error () {
        $scope.btnLoan.disabled = false;
        Materialize.toast('Função não disponível no momento',5000);
      });
    }
  }

  init();

});
