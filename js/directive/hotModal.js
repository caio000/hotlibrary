hotlibrary.directive('hotModal',function () {
  return {
    restrict: 'E',
    replace: true,
    transclude: true,
    link: function (scope, element, attrs) {
      element.on('hidden.bs.modal',scope.hiddenBsModal);
    },
    template: `
    <div id="hotModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content" ng-transclude>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->`,
  }
});
