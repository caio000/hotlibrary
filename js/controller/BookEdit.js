hotlibrary.controller('BookEdit',function ($scope,$document,$filter,bookAPI,book,authors,publishingCompanies,categories) {

  var init = function () {
    $scope.isEdit = true;
    $scope.Page = {title:'Hotlibrary - Editar livro'};
    $document.find("#cover").fileinput({
      'showUpload':false,
      'language':'pt-BR',
      'browseClass':'btn btn-hotlibrary',
      'msgPlaceholder': 'Selecione o {files}'
    });
    $scope.book = book.data;
    $scope.book.pages = parseInt(book.data.pages);
    $scope.book.edition = parseInt(book.data.edition);
    $scope.book.publishDate = $filter('date')(book.data.publishDate,'dd/MM/yyyy');
    $scope.authors = _setFilter(_preSelectedField($scope.book.authors,authors.data));
    $scope.publishingCompanies = _setFilter(_preSelectedField([$scope.book.publishingCompany],publishingCompanies.data));
    $scope.categories = _setFilter(_preSelectedField($scope.book.categories,categories.data));
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
    $scope.edit = _edit;
  }

  var _edit = function (book) {
    // verifica se o formulário está válido
    if ($scope.bookForm.$valid) {
      $scope.registration = true;

      if (typeof book.cover !== 'string') {
        var formData = new FormData();
        var file = book.cover[0];
        formData.append('cover',file);
        book.cover = file.name;
      }

      // atualiza os dados do livro
      bookAPI.edit(book).then(function (response){
        if (response.data.result) {
          // verifica se existe imagem para upload
          if (file) {
            // envia a imagem para o upload
            bookAPI.saveCover(formData).then(function (response) {
              if (response.data.result)
                config = {type:'success',msg:'Livro editado com sucesso'};
              else
                config = {type:'danger',title:'Ops!',msg:'Ocorreu um erro ao fazer o upoad da imagem'};

              $scope.$emit('alert',config);
              $scope.registration = false;
            },function (response){
              config = {type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'};
              $scope.$emit('alert',config);
              $scope.registration = false;
            });
          } else {
            config = {type:'success',msg:'Livro editado com sucesso'};
            $scope.$emit('alert',config);
            $scope.registration = false;
          }
        } else {
          config = {type:'danger',title:'Ops!',msg:response.msg};
          $scope.registration = false;
          $scope.$emit('alert',config);
        }
      },function () {
        $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
        $scope.registration = false;
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

  var _preSelectedField = function (myElements,fieldElements) {
    var hasNullElemnt = myElements.some(function (element) {
      return element == null;
    });

    if (hasNullElemnt) return fieldElements;
    // gera um array com os id's dos elementos
    var indexes = myElements.map(function(element){
      return element.id;
    });

    indexes.forEach(function(index){
      fieldElements.forEach(function(element) {
        if (element.id === index) element.isSelected = true;
      });
    });

    return fieldElements;
  }

  init();

});
