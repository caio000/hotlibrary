if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('serviceWorker.js').then(function (registration){
    console.log('serviceWorker registrado');
  }).catch(function (error) {
    console.log('erro ao registrar o serviceWorker ' + error);
  });
}
