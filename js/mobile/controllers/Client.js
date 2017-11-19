hotlibrary.controller('mClient',function ($scope,$document,currentLoan,openedLoan,canceledLoan,loanHistory) {
  var init = function () {
    $document.find('.collapsible').collapsible();
    $scope.client = {
      currentLoan: currentLoan.data,
      openedLoan: openedLoan.data,
      canceledLoan: canceledLoan.data,
      loanHistory: loanHistory.data,
    };

  }

  init();
});
