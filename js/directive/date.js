hotlibrary.directive('date', function() {

  return {
    restrict: 'A',
    require:'ngModel',
    link: function(scope, element, attrs, model) {

      // adiciona a mascara ao valor do campo
      var _setMask = function (date) {
        if (date.length == 2) {
          date += '/';
        } else if (date.length == 5) {
          date += '/';
        } else if (date.length > 10) {
          date = date.substring(0,10);
        }
        return date;
      }

      // função que valida a data
      var _isValid = function (date) {
        // caso a data tenha sido informada pro completo, inicia a validação
        if (date.length === 10) {
          var temp = date.split('/');
          // valida o dia
          if (temp[0] < 1 || temp[0] > 31) return false;
          // valida o mês
          if (temp[1] < 1 || temp[1] > 12) return false;

          return true;
        }
        return false;
      }

      element.bind('keyup',function () {
        scope.$apply(function () {
          var date = model.$viewValue;
          date = _setMask(date);
          model.$setViewValue(date);
          model.$render();
          model.$setValidity('date',_isValid(date));
        });
      });
    }

  }
});
