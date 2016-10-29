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

Route::get('/docentes', 'TeachersController@index')->name('docentes');
Route::get('/docentes/{id}', 'TeachersController@show');

Route::get('/calendário', 'CalendarController@index')->name('calendário');


//Route::get('/portal', 'HomeController@index');

// Rotas para o Portal
Route::group(['prefix' => 'portal'], function () {
	Route::get('início', 'PortalController@index')->name('portal_inicio');
	Route::get('/', function() {
		return redirect()->route('portal_inicio');
	});

	Route::resource('/notas', 'PortalGradesController');
	Route::resource('/trabalhos', 'PortalHomeworksController');
	Route::resource('/fotos', 'PortalPicturesController');

	//Route::resource('/usuários', 'PortalUsersController');
	Route::get('/usuários/{id}', 'PortalUsersController@show')->name('usuários.show');
	Route::get('/usuários', 'PortalUsersController@index')->name('usuários.index');
	Route::put('/usuários', 'PortalUsersController@update')->name('usuários.update');
	Route::resource('/configurações', 'PortalSettingsController@inicio');

	//Route::resource('/notícias', 'PortalNewsController');
	Route::get('/notícias', 'PortalNewsController@index')->name('notícias.index');
	Route::post('/notícias', 'PortalNewsController@store')->name('notícias.store');
	Route::get('/notícias/{id}', 'PortalNewsController@show')->name('notícias.show');
	Route::put('/notícias', 'PortalNewsController@update')->name('notícias.update');
	Route::delete('/notícias/{id}', 'PortalNewsController@destroy')->name('notícias.destroy');

	// Rotas de Buscas
	Route::post('/notícias/buscar', 'SearchController@newsSearch')->name('notícias.search');
	Route::get('/notícias/buscar', 'SearchController@newsSearch')->name('notícias.search');
	Route::post('/usuários/buscar', 'SearchController@newsSearch')->name('usuários.search');
	Route::get('/usuários/buscar', 'SearchController@newsSearch')->name('usuários.search');

	// Rotas de calendario
	Route::get('/calendário', 'PortalCalendarController@index')->name('calendário.index');
	Route::get('/calendário/{id}', 'PortalCalendarController@show');
	Route::put('/calendário', 'PortalCalendarController@update')->name('calendário.update');

	// Fotos
	Route::get('/fotos','PortalPicturesController@index');

	// Rotas Especiais - teachers only
	//Route::resource('/notícias-alunos', 'PortalStudentNewsController');
	Route::get('/notícias-alunos', 'PortalStudentNewsController@index')->name('notícias-alunos.index');

	//Route::post('/notícias-alunos', 'PortalStudentNewsController@store')->name('notícias-alunos.store');
	Route::get('/notícias-alunos/{id}', 'PortalStudentNewsController@show')->name('notícias-alunos.show');
	Route::put('/notícias-alunos', 'PortalStudentNewsController@update')->name('notícias-alunos.update');
	Route::delete('/notícias-alunos/{id}', 'PortalStudentNewsController@destroy')->name('notícias.destroy');
	
	Route::post('/notícias-alunos/buscar', 'SearchController@newsSearch')->name('notícias.alunos.search')->middleware(VerifyTeacher::class);
	Route::get('/notícias-alunos/buscar', 'SearchController@newsSearch')->name('notícias.alunos.search')->middleware(VerifyTeacher::class);
	// ainda não foi implementado
	//Route::get('/usuários-alunos', 'PortalUsersController@alunos')->name('usuários.alunos');
	//Route::post('/usuários-alunos/buscar', 'SearchController@alunosUserSearch')->name('usuários.alunos.search');
	//Route::get('/usuários-alunos/buscar', 'SearchController@alunosUserSearch')->name('usuários.alunos.search');
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