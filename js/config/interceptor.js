hotlibrary.config(function ($httpProvider) {
  $httpProvider.interceptors.push('error');
});
