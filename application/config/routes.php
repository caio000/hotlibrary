<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Template';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['template/view/(:any)'] = 'Template/getTemplate/$1';
$route['usuario/cadastrar'] = 'User/index';
$route['usuario/esqueceu/senha']['post'] = 'User/forgotPassword';
$route['usuario/existe/email']['post'] = 'User/existEmail';
$route['usuario/alterar/senha']['post'] = 'User/changePassword';
$route['usuarios/todos']['get'] = 'User/getAll';
$route['usuario/(:num)']['get'] = 'User/getById/$1';
$route['usuario/bloquear']['patch'] = 'User/block';
$route['usuario/desbloquear']['patch'] = 'User/unlock';
$route['usuario/editar']['patch'] = "User/edit";

$route['valida/token/(:any)'] = 'Token/checkToken/$1';
// Library routes ==============================================================
$route['biblioteca/(:num)']['get'] = 'Library/getAll/$1';
// Book route ==================================================================
$route['livro/cadastrar']['post'] = 'Book/save';
$route['livro/upload/capa']['post'] = 'Book/saveCover';
$route['livro/todos']['get'] = 'Book/getAll';
// PublishingCompany routes ====================================================
$route['editora/todos']['get'] = "PublishingCompany/getAll";
$route['editora/cadastrar']['post'] = "PublishingCompany/save";
$route['editora/deletar/(:num)']['delete'] = "PublishingCompany/delete/$1";
// Author routes ===============================================================
$route['autor/cadastrar']['post'] = "Author/save";
$route['autores/todos']['get'] = 'Author/getAll';
$route['autor/deletar/(:num)']['delete'] = "Author/delete/$1";
// Category routes =============================================================
$route['categoria/cadastrar']['post'] = 'Category/save';
$route['categoria/todos']['get'] = 'Category/getAll';
$route['categoria/deletar/(:num)']['delete'] = 'Category/delete/$1';
// Level routes ================================================================
$route['nivel/todos']['get'] = 'Level/getAll';
