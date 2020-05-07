<?php

use App\Tournament;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');



Route::get('/igrac', 'PlayerController@show');
Route::get('/igrac/{id}', 'PlayerController@show');
Route::post('/igrac/dodaj', 'PlayerController@show');
Route::post('/igrac/izmeni/{id}', 'PlayerController@show');
Route::post('/igrac/obrisi/{id}', 'PlayerController@show');
Route::post('/igrac/prijavaNaTurnir', 'PlayerController@show');

Route::get('/turnir', 'TournamentController@show');
Route::get('/turnir/{id}', 'TournamentController@show');
Route::get('/turnir/dodaj', 'TournamentController@show');
Route::post('/turnir/dodaj', 'TournamentController@show');
Route::post('/turnir/izmeni/{id}', 'TournamentController@show');
Route::post('/turnir/obrisi/{id}', 'TournamentController@show');
Route::post('/turnir/dodajSudiju', 'TournamentController@show');
Route::post('/turnir/dodajRezultat', 'TournamentController@show');


Route::get('/klub', 'ClubController@show');
Route::get('/klub/{id}', 'ClubController@show');
Route::post('/klub/dodaj', 'ClubController@show');
Route::post('/klub/izmeni/{id}', 'ClubController@show');
Route::post('/klub/obrisi/{id}', 'ClubController@show');
Route::post('/klub/prijavaNaTurnir', 'ClubController@show');

Route::get('/sudija', 'PlayerController@show'); // prikazuje sve sudije
Route::get('/sudija/{id}', 'PlayerController@show'); // prikazuje detalje sudije

Route::post('/igrac/sudija/{id}', 'PlayerController@show'); // dodeljuje igracu status sudije
Route::get('/rokovi', 'AdminController@show'); // prikazuje trenutne rokove
Route::post('/dodajRok', 'AdminController@show'); // dodaje rok
Route::get('/korisnici', 'AdminController@show'); //dohvata korisnike koji cekaju da im se odobri registacija
