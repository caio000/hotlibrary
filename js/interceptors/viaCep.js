hotlibrary.factory('viaCepRequest',function ($q) {
  return {
    request: function (config) {

      var url = config.url;

      if ( url.indexOf('viacep') > -1) delete(config.headers.Authorization);

      return config;
    }
  };
});
