hotlibrary.factory('clientAPI',function($http,Application) {

  var _loan = function (loan) {
    return $http.post(Application.baseURL + 'cliente/solicitar/emprestimo',loan);
  }

  return {
    loan:_loan,
  }
});
