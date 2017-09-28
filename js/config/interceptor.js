hotlibrary.config(function ($httpProvider) {
  $httpProvider.interceptors.push('error');
  $httpProvider.interceptors.push('viaCepRequest');
});
