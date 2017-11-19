hotlibrary.factory('clientAPI',function($http,Application) {

  var _loan = function (loan) {
    return $http.post(Application.baseURL + 'cliente/solicitar/emprestimo',loan);
  }

  var _myBooks = function () {
    return $http.get(Application.baseURL + 'cliente/meus/livros');
  }

  var _myOpenedLoan = function () {
    return $http.get(Application.baseURL + 'cliente/meus/emprestimos/em/aberto');
  }

  var _myCanceledLoan = function () {
    return $http.get(Application.baseURL + 'cliente/meus/emprestimos/cancelados');
  }

  var _myLoanHistory = function () {
    return $http.get(Application.baseURL + 'cliente/meu/historico/emprestimos');
  }

  return {
    loan:_loan,
    myBooks:_myBooks,
    myOpenedLoan: _myOpenedLoan,
    myCanceledLoan: _myCanceledLoan,
    myLoanHistory: _myLoanHistory,
  }
});
