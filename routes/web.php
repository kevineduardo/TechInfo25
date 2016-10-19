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
use App\Http\Middleware\VerifyTeacher;

Auth::routes();
Route::get('/início', 'SiteController@inicio')->name('inicio');
Route::get('/inicio', 'SiteController@inicio')->name('inicio');
Route::get('/', function () {
    return redirect()->route('inicio');
});

Route::get('/página/{id}', 'SiteController@pagina')->name('pagina');
Route::get('/página', function() {
	return redirect()->route('inicio');
});

Route::get('/foto/{id}', 'SiteController@foto')->name('foto');
Route::get('/foto', function() {
	return redirect()->route('inicio');
});

Route::get('/notícia/{id}', 'SiteController@noticia')->name('notícia');
Route::get('/notícia', function() {
	return redirect()->route('inicio');
});

//Route::get('/portal', 'HomeController@index');

// Rotas para o Portal
Route::group(['prefix' => 'portal'], function () {
	Route::get('início', 'PortalController@index')->name('portal_inicio');
	Route::get('/', function() {
	return redirect()->route('portal_inicio');
});
	Route::resource('/notas', 'PortalGradesController');
	Route::resource('/trabalhos', 'PortalHomeworksController');
	Route::resource('/notícias', 'PortalNewsController');
	Route::resource('/fotos', 'PortalPicturesController');
	Route::resource('/usuários', 'PortalUsersController');
	Route::resource('/configurações', 'PortalSettingsController@inicio');

	// Rotas de Buscas
	Route::post('/notícias/buscar', 'SearchController@newsSearch')->name('notícias.search');
	Route::get('/notícias/buscar', 'SearchController@newsSearch')->name('notícias.search');

	// Rotas Especiais - teachers only
	Route::resource('/notícias/alunos', 'PortalStudentNewsController');
	Route::post('/notícias/alunos/buscar', 'SearchController@newsSearch')->name('notícias.alunos.search')->middleware(VerifyTeacher::class);
	Route::get('/notícias/alunos/buscar', 'SearchController@newsSearch')->name('notícias.alunos.search')->middleware(VerifyTeacher::class);
	Route::post('/ajax/studentnews','PortalStudentNewsController@api')->middleware(VerifyTeacher::class);
});

// OAuth
Route::get('auth/facebook', 'OAuthController@redirectToProvider')->name('facebook');
Route::get('auth/facebook/callback', 'OAuthController@handleProviderCallback');
Route::post('auth/facebook/callback', 'OAuthController@handleProviderCallback');

// Rotas para o site
////$url = route('profile', ['id' => 1]);
//Route::get('/inicio', '');
//Route::get('/notícias', '');
//Route::get('/fotos', '');
//Route::get('/contato', '');
//Route::get('/horarios', '');
//Route::get('/historicoescolar', '');
//Route::get('/curso', '');
//Route::get('/calendario', '');