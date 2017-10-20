hotlibrary.directive('getAddressByZipcode', function(viaCep) {

  return {
    restrict: "A",
    require: "ngModel",
    link: function (scope, element, attrs, ctrl) {

      element.on('blur', function () {
        scope.search = true;
        scope.zipcodeError = false;
        var zipcode = ctrl.$viewValue;

        viaCep.get(zipcode).then(function (response) {
          scope.User.Address.City.name = response.localidade;
          scope.User.Address.Neighborhood.name = response.bairro;
          scope.User.Address.State.initials = response.uf;
          scope.User.Address.publicPlace = response.logradouro;

          scope.search = false;
        }, function () {
          scope.zipcodeError = true;
          scope.search = false;
        });
      });
    }
  }
})
