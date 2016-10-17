<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::get('/início', 'SiteController@inicio')->name('inicio');
Route::get('/inicio', 'SiteController@inicio')->name('inicio');
Route::get('/', function () {
    return redirect()->route('inicio');
});
Route::get('/páginas/{id}', 'SiteController@pagina')->name('pagina');
Route::get('/páginas', function() {
	return redirect()->route('inicio');
});
Route::get('/paginas/{id}', 'SiteController@pagina');
Route::get('/paginas', function() {
	return redirect()->route('inicio');
});
Route::get('/foto/{id}', 'SiteController@foto')->name('foto');
Route::get('/foto', function() {
	return redirect()->route('inicio');
});

//Route::get('/portal', 'HomeController@index');

// Rotas para o Portal
Route::group(['prefix' => 'portal'], function () {
	Route::get('início', 'PortalController@index')->name('portal_inicio');
	Route::get('/', 'PortalController@index');
	Route::resource('/notas', 'PortalGradesController');
	Route::resource('/trabalhos', 'PortalHomeworksController');
	Route::resource('/notícias', 'NewsController');
	Route::resource('/fotos', 'PicturesController');
	Route::resource('/usuários', 'PortalUsersController');
	Route::resource('/configurações', 'PortalSettingsController@inicio');
});

// Rotas para o site
////$url = route('profile', ['id' => 1]);
//Route::get('/inicio', '');
//Route::get('/noticias', '');
//Route::get('/fotos', '');
//Route::get('/contato', '');
//Route::get('/horarios', '');
//Route::get('/historicoescolar', '');
//Route::get('/curso', '');
//Route::get('/calendario', '');