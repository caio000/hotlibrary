hotlibrary.controller("Menu", function ($scope,$document,$interval,$rootScope,$filter,Auth,$location,libraryAPI) {

  $scope.today = new Date();
  $scope.notifications = {};
  $scope.btnConfirmLoan = {
    disabled: false,
    icon:'fa fa-thumbs-up',
  };
  $scope.setCurrentNotification = function (notification) {
    $scope.currentNotification = notification;
  }

  $scope.confirmLoanFun = function (loan,form) {
    if (form.$valid) {
      $scope.btnConfirmLoan.disabled = true;
      $scope.btnConfirmLoan.icon = 'fa fa-spinner fa-pulse';

      loan.returnDateTxt = $filter("date")(loan.returnDate,'dd/MM/yyyy');

      libraryAPI.confirmLoan(loan).then(function (response) {
        $scope.btnConfirmLoan.disabled = false;
        $scope.btnConfirmLoan.icon = 'fa fa-thumbs-up';
        $document.find("#modalConfirmLoan").modal('hide');

        if (response.data.result) {
          config = {type:'success',msg:response.data.msg};
        } else {
          config = {type:'danger',title:'Ops!',msg:response.data.msg};
        }

        $scope.$emit('alert',config);
      },function (response) {
        $scope.btnConfirmLoan.disabled = false;
        $scope.btnConfirmLoan.icon = 'fa fa-thumbs-up';
        $document.find("#modalConfirmLoan").modal('hide');
        $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
      });
    }
  }

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
