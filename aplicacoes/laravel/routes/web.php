<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware'=>'web'], function(){
   

Route::resource('/home', 'HomeController');

Route::resource('/fibonacci/index', 'FibonacciController');
Route::get('/fibonacci/fibonacciRecursive','FibonacciController@fibonacciRecursive');

Route::resource('/aluno/index', 'AlunoController');  
Route::get('/aluno/listar','AlunoController@listar_alunos');

Route::post('/aluno/cadastrar', 'AlunoController@create');
Route::get('/aluno/getall', 'AlunoController@getAll');
Route::post('/aluno/excluir', 'AlunoController@destroy');
Route::post('/aluno/editar', 'AlunoController@edit');
Route::post('/aluno/atualizar', 'AlunoController@update');

Route::resource('/disciplina/index', 'DisciplinaController'); 
Route::get('/disciplina/listar','DisciplinaController@listar_disciplinas');

Route::post('/disciplina/cadastrar', 'DisciplinaController@create');
Route::get('/disciplina/getall','DisciplinaController@getall');
Route::post('/disciplina/excluir', 'DisciplinaController@destroy');
Route::post('/disciplina/editar', 'DisciplinaController@edit');
Route::post('/disciplina/atualizar', 'DisciplinaController@update'); 


});
