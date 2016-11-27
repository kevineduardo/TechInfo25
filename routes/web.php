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
	Route::resource('/fotos', 'PortalPicturesController');
	//Route::resource('/usuários', 'PortalUsersController');
	Route::get('/usuários/{id}', 'PortalUsersController@show')->name('usuários.show');
	Route::get('/usuários', 'PortalUsersController@index')->name('usuários.index');
	Route::put('/usuários', 'PortalUsersController@update')->name('usuários.update');
	//Route::resource('/usuários-alunos', 'PortalUsersController');
	Route::get('/usuários-convite/{id}', 'PortalStudentUsersController@show')->name('usuários-alunos.show');
	Route::get('/usuários-convite', 'PortalStudentUsersController@index')->name('usuários-alunos.index');
	Route::put('/usuários-convite', 'PortalStudentUsersController@update')->name('usuários-alunos.update');
	Route::post('/usuários-convite', 'PortalStudentUsersController@store')->name('usuários-alunos.store');
	Route::resource('/configurações', 'PortalSettingsController');
	Route::resource('/professor', 'TeacherDashboardController');

	// gambiarras de leve
	Route::get('/ajax/turma', 'PortalSettingsController@turma')->name('ajax.turma');
	Route::get('/ajax/turma/{id}', 'PortalSettingsController@turma');
	Route::get('/ajax/mturma', 'TeacherDashboardController@turma')->name('ajax.mturma');
	Route::get('/ajax/mturma/{id}', 'TeacherDashboardController@turma');
	Route::get('/ajax/materia', 'PortalSettingsController@materia')->name('ajax.materia');
	Route::get('/ajax/materia/{id}', 'PortalSettingsController@materia');
	Route::get('/ajax/foto', 'PortalPicturesController@foto')->name('ajax.foto');
	Route::get('/ajax/foto/{id}', 'PortalPicturesController@foto');
	Route::get('/ajax/nota', 'PortalGradesController@grade')->name('ajax.nota');
	Route::get('/ajax/nota/{id}', 'PortalGradesController@grade');
	// fim das gambiarras de leve
	//Route::resource('/notícias', 'PortalNewsController');
	Route::get('/notícias', 'PortalNewsController@index')->name('notícias.index');
	Route::post('/notícias', 'PortalNewsController@store')->name('notícias.store');
	Route::get('/notícias/{id}', 'PortalNewsController@show')->name('notícias.show');
	Route::put('/notícias', 'PortalNewsController@update')->name('notícias.update');
	Route::delete('/notícias/{id}', 'PortalNewsController@destroy')->name('notícias.destroy');

	// Rotas de Buscas
	Route::post('/notícias/buscar', 'SearchController@newsSearch')->name('notícias.search');
	Route::get('/notícias/buscar', 'SearchController@newsSearch')->name('notícias.search');
	Route::post('/usuários/buscar', 'SearchController@usersSearch')->name('usuários.search');
	Route::get('/usuários/buscar', 'SearchController@usersSearch')->name('usuários.search');


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
	Route::post('/usuários-convite/buscar', 'SearchController@studentUsersSearch')->name('usuários-alunos.search');
	Route::get('/usuários-convite/buscar', 'SearchController@studentUsersSearch')->name('usuários-alunos.search');
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