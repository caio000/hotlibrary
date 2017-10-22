hotlibrary.directive('hotAlert',function ($timeout) {
  return {
    restrict: 'AE',
    replace: true,
    link: function (scope, element) {

      var close = function (callback) {
        $timeout(function () {
          if (callback)
            angular.element(element).hide('slow', callback());
          else
            angular.element(element).hide('slow');
        },4000);
      };

      scope.$on('alert', function (event, alertData) {
        scope.type  = alertData.type;
        scope.title = alertData.title;
        scope.msg   = alertData.msg;
        angular.element(element).show('slow', close(alertData.callback));
      });
    },
    template: `<div class="alert alert-{{ type }} text-center">
      <p><strong>{{ title }}</strong></p>
      <p>{{ msg }}</p>
    <div>`,
  }
});
