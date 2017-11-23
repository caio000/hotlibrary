hotlibrary.controller('BookRegistration',function ($scope,$document,$location,$anchorScroll,authors,publishingCompanies,categories,bookAPI,publishingCompanyAPI,authorAPI,categoryAPI,$filter) {

  var init = function () {
    $document.find("#cover").fileinput({
      'showUpload':false,
      'language':'pt-BR',
      'browseClass':'btn btn-hotlibrary',
      'msgPlaceholder': 'Selecione o {files}'
    });
    $scope.isEdit = false;
    $scope.Page = {title: 'Hotlibrary - Cadastrar livro'};
    $scope.register = register;
    $scope.authors = _setFilter(authors.data);
    $scope.publishingCompanies = _setFilter(publishingCompanies.data);
    $scope.categories = _setFilter(categories.data);
    $scope.translation = {
      author: {
        selectAll:'Marcar todos',
        selectNone:'Desmarcar todos',
        reset: 'Reiniciar',
        search:'Busque os(as) autores(as)',
        nothingSelected:'Selecione os(as) autores(as)',
      },
      publishingCompany: {
        selectAll:'Marcar todos',
        selectNone:'Desmarcar todos',
        reset: 'Reiniciar',
        search:'Busque as editoras',
        nothingSelected:'Selecione a editora',
      },
      category: {
        selectAll:'Marcar todos',
        selectNone:'Desmarcar todos',
        reset: 'Reiniciar',
        search:'Busque as categorias',
        nothingSelected:'Selecione a categoria',
      }
    };

    $scope.btnAuthorRegistration = {icon:'fa fa-plus',disabled:false};
    $scope.authorRegistration = _authorRegistration;

    $scope.btnCategoryRegistration = {icon:'fa fa-plus',disabled:false};
    $scope.categoryRegistration = _categoryRegistration;

    $scope.btnPublishingCompanyRegistration = {icon:'fa fa-plus',disabled:false};
    $scope.publishingCompanyRegistration = _publishingCompanyRegistration;
  }

  var _publishingCompanyRegistration = function (publishingCompany,form) {
    if (form.$valid) {
      $scope.btnPublishingCompanyRegistration.disabled = true;
      $scope.btnPublishingCompanyRegistration.icon = 'fa fa-spinner fa-pulse';

      publishingCompanyAPI.save(publishingCompany).then(function success (response) {
        if (response.data.result) {
          config = {type:'success',msg:'Editora cadastrada com sucesso'};

          // recarrega a lista de editoras
          publishingCompanyAPI.getAll().then(function(response) {
            $scope.publishingCompanies = _setFilter(response.data);
          });
        } else {
          config = {type:'danger',title:'Ops!',msg:'Ocorreu um erro ao cadastrar a editora'};
        }

        $scope.btnPublishingCompanyRegistration.disabled = false;
        $scope.btnPublishingCompanyRegistration.icon = 'fa fa-plus';


        $document.find("#modalPublishingCompanyRegistration").modal('hide');
        $scope.$emit('alert',config);
        $location.hash('hotAlert');
        $anchorScroll();
      }, function error (response) {
        $scope.btnPublishingCompanyRegistration.disabled = false;
        $scope.btnPublishingCompanyRegistration.icon = 'fa fa-plus';

        $document.find("#modalPublishingCompanyRegistration").modal('hide');
        $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
      });
    }
  }

  var _categoryRegistration = function (category,form) {
    if (form.$valid) {
      $scope.btnCategoryRegistration.disabled = true;
      $scope.btnCategoryRegistration.icon = 'fa fa-spinner fa-pulse';

      categoryAPI.save(category).then(function success (response) {
        if (response.data.result) {
          config = {type:'success',msg:'categoria cadastrada com sucesso'};

          // recarrega a lista de categorias
          categoryAPI.getAll().then(function(response) {
            $scope.categories = _setFilter(response.data);
          });
        } else {
          config = {type:'danger',title:'Ops!',msg:'Ocorreu um erro ao cadastrar a categoria'};
        }

        $scope.btnCategoryRegistration.disabled = false;
        $scope.btnCategoryRegistration.icon = 'fa fa-plus';


        $document.find("#modalCategoryRegistration").modal('hide');
        $scope.$emit('alert',config);
        $location.hash('hotAlert');
        $anchorScroll();
      }, function error (response) {
        $scope.btnCategoryRegistration.disabled = false;
        $scope.btnCategoryRegistration.icon = 'fa fa-plus';

        $document.find("#modalCategoryRegistration").modal('hide');
        $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
      });
    }
  }

  var _authorRegistration = function (author,form) {
    if (form.$valid) {
      $scope.btnAuthorRegistration.disabled = true;
      $scope.btnAuthorRegistration.icon = 'fa fa-spinner fa-pulse';

      authorAPI.save(author).then(function success (response) {
        if (response.data.result) {
          config = {type:'success',msg:'Autor(a) cadastrado com sucesso'};

          // recarrega a lista de autores
          authorAPI.getAll().then(function(response) {
            $scope.authors = _setFilter(response.data);
          });
        } else {
          config = {type:'danger',title:'Ops!',msg:'Ocorreu um erro ao cadastrar o(a) autor(a)'};
        }

        $scope.btnAuthorRegistration.disabled = false;
        $scope.btnAuthorRegistration.icon = 'fa fa-plus';


        $document.find("#modalAuthorRegistration").modal('hide');
        $scope.$emit('alert',config);
        $location.hash('hotAlert');
        $anchorScroll();
      }, function error (response) {
        $scope.btnAuthorRegistration.disabled = false;
        $scope.btnAuthorRegistration.icon = 'fa fa-plus';

        $document.find("#modalAuthorRegistration").modal('hide');
        $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
      });
    }
  }

  // Busca o filtro "name" para ser aplicado em uma lista
  var _setFilter = function (authors) {
    authors.forEach(function(author){
      author.name = $filter('name')(author.name);
    });
    return authors;
  }

  // envia os dados para o cadastro do livro
  var register = function (book) {

    if ($scope.bookForm.$valid) {
      var formData = new FormData();
      var file = book.cover[0];
      formData.append('cover',file);
      book.cover = file.name;
      $scope.registration = true;

      // envia os dados do livro para serem salvos
      bookAPI.save(book).then(
        function success (response) {
          if (response.data.result) {
            if (file) {
              // Faz o upload da imagem
              bookAPI.saveCover(formData).then(function success (response) {
                var msg = (response.data.result) ? 'Livro cadastrado com sucesso' : 'Livro cadastrado, porém não foi possivel carregar a imagem';
                config = {type:'success',msg:msg};
                $scope.$emit('alert',config);
                $scope.registration = false;
              });
            } else {
              $scope.$emit('alert',{type:'success',msg:'Livro cadastrado com sucesso'});
              $scope.registration = false;
            }
            book.cover = {"0":file};
          } else {
            book.cover = {"0":file};
            $scope.$emit('alert',{type:'danger',title:'Ops!',msg:'Ocorreu um erro ao cadastrar um livro'});
            $scope.registration = false;
          }

      }, function error () {
        book.cover = {"0":file};
        $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
        $scope.registration = false;
      });
    }
  }

  init();
});
