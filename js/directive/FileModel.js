hotlibrary.directive('fileModel',function ($parse) {
  return {
    restrict: "A",
    link: function (scope, element, attrs) {

      element.bind('change', function(event){
        var files = event.target.files;
        $parse(attrs.fileModel).assign(scope,files);
        scope.$apply();
      });
    }
  };
})
