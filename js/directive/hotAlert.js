hotlibrary.directive('hotAlert',function () {
  return {
    restrict: 'AE',
    replace: true,
    scope: {
      type: '@',
      title: '@',
      msg: '@',
    },
    template: `<div class="alert alert-{{ type }} text-center">
      <p><strong>{{ title }}</strong></p>
      <p>{{ msg }}</p>
    <div>`,
  }
});
