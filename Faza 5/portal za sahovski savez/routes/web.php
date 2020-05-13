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



Route::get('/igrac', 'PlayerController@getPlayers');
Route::get('/igrac/{id}', 'PlayerController@getPlayer')->where('id', '[0-9]+');
Route::get('/igrac/dodaj', 'PlayerController@addPlayer');
Route::post('/igrac/dodaj', 'PlayerController@addOrEditPlayerPost');
Route::get('/igrac/izmeni/{id}', 'PlayerController@editPlayer')->where('id', '[0-9]+');
Route::get('/igrac/obrisi/{id}', 'PlayerController@deletePlayer')->where('id', '[0-9]+');

Route::get('/turnir', 'TournamentController@index');
Route::get('/turnir/{id}', 'TournamentController@getTournament')->where('id', '[0-9]+');
Route::get('/turnir/dodaj', 'TournamentController@addTournament');
Route::post('/turnir/dodaj', 'TournamentController@addTournamentPost');
Route::post('/turnir/izmeni/{id}', 'TournamentController@show');
Route::post('/turnir/obrisi/{id}', 'TournamentController@show');
Route::post('/turnir/dodajSudiju', 'TournamentController@show');
Route::post('/turnir/dodajRezultat', 'TournamentController@show');
Route::post('turnir/{idTurnir}/prijavaIgraca/{idIgrac}', 'TournamentController@playerRegistration')->where('idTurnir', '[0-9]+')->where('idIgrac', '[0-9]+');
Route::post('turnir/{idTurnir}/prijavaKluba/{idKlub}', 'TournamentController@clubRegistration')->where('idTurnir', '[0-9]+')->where('idKlub', '[0-9]+');

Route::get('/klub', 'ClubController@getClubs');
Route::get('/klub/{id}', 'ClubController@getClub')->where('id', '[0-9]+');
Route::get('/klub/dodaj', 'ClubController@addClub');
Route::get('/klub/izmeni/{id}', 'ClubController@editClub')->where('id', '[0-9]+');
Route::get('/klub/obrisi/{id}', 'ClubController@deleteClub')->where('id', '[0-9]+');
Route::post('/klub/dodaj', 'ClubController@addClubPost');
Route::post('/klub/izmeni/{id}', 'ClubController@editClubPost')->where('id', '[0-9]+');
Route::post('/klub/{idKlub}/prijavaNaTurnir/{idTurnir}', 'ClubController@tournamentRegistration')->where('idKlub', '[0-9]+')->where('idTurnir', '[0-9]+');
Route::post('/klub/{idKlub}/dajOtkazIgracu/{idIgrac}', 'ClubController@firePlayer')->where('idKlub', '[0-9]+')->where('idIgrac', '[0-9]+');
Route::post('/klub/{idKlub}/odgovoriNaZahtev/{idIgrac}', 'ClubController@answerPlayer')->where('idKlub', '[0-9]+')->where('idIgrac', '[0-9]+');

Route::get('/sudija', 'PlayerController@show'); // prikazuje sve sudije
Route::get('/sudija/{id}', 'PlayerController@show'); // prikazuje detalje sudije

Route::post('/igrac/sudija/{id}', 'PlayerController@show'); // dodeljuje igracu status sudije
Route::get('/rokovi', 'AdminController@deadlines'); // prikazuje trenutne rokove
Route::get('/dodajRok', 'AdminController@addDeadline');
Route::post('/dodajRok', 'AdminController@addDeadlinePost'); // dodaje rok
Route::get('/korisnici', 'AdminController@show'); //dohvata korisnike koji cekaju da im se odobri registacija

Route::get('/korisnici/login', 'UsersController@login')->name("login");
Route::post('/korisnici/login', 'UsersController@verifyLogin');
Route::get('/korisnici/logout', 'UsersController@logout');
Route::get('/korisnici/registracija', 'UsersController@register');
Route::post('/korisnici/registracija', 'UsersController@registerPost');
