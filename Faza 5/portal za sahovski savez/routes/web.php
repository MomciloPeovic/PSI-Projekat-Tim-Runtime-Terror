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
Route::post('/igrac/zahtev_za_klub', 'PlayerController@sendRequestToClub');
Route::get('/igrac/moj_klub/{id}', 'PlayerController@myClub')->where('id', '[0-9]+');
Route::get('/igrac/napusti_klub/{id}', 'PlayerController@leaveClub')->where('id', '[0-9]+');
Route::post('/igrac', 'PlayerController@getPlayersPost');


Route::get('/turnir', 'TournamentController@index');
Route::get('/turnir/{id}', 'TournamentController@getTournament')->where('id', '[0-9]+');
Route::get('/turnir/dodaj', 'TournamentController@addTournament');
Route::post('/turnir/dodaj', 'TournamentController@addTournamentPost');
Route::get('turnir/{id}/sudije', 'TournamentController@arbiters')->where('id', '[0-9]+');
Route::post('turnir/{id}/dodajSudiju', 'TournamentController@addArbiter')->where('id', '[0-9]+');
Route::post('turnir/{id}/ukloniSudiju', 'TournamentController@removeArbiter')->where('id', '[0-9]+');
Route::post('turnir/{idTurnir}/prijavaIgraca/{idIgrac}', 'TournamentController@playerRegistration')->where('idTurnir', '[0-9]+')->where('idIgrac', '[0-9]+');
Route::post('turnir/{idTurnir}/prijavaKluba/{idKlub}', 'TournamentController@clubRegistration')->where('idTurnir', '[0-9]+')->where('idKlub', '[0-9]+');

Route::get('/klub', 'ClubController@getClubs');
Route::get('/klub/{id}', 'ClubController@getClub')->where('id', '[0-9]+');
Route::get('/klub/dodaj', 'ClubController@addClub');
Route::get('/klub/obrisi/{id}', 'ClubController@deleteClub')->where('id', '[0-9]+');
Route::get('/klub/izmeni/{id}', 'ClubController@editClub')->where('id', '[0-9]+');
Route::post('/klub/dodaj', 'ClubController@addOrEditClubPost');
Route::post('/klub', 'ClubController@getClubsPost');
Route::post('/klub/{idKlub}/dajOtkazIgracu/{idIgrac}', 'ClubController@firePlayer')->where('idKlub', '[0-9]+')->where('idIgrac', '[0-9]+');
Route::post('/klub/{idKlub}/odgovoriNaZahtev/{idIgrac}', 'ClubController@answerPlayer')->where('idKlub', '[0-9]+')->where('idIgrac', '[0-9]+');
//TODO(David): Dodaje se zahtev u tabelu
Route::get('/klub/{idKlub}/posaljiZahtevIgracu/{idIgrac}', 'ClubController@requestPlayer')->where('idKlub', '[0-9]+')->where('idIgrac', '[0-9]+');



Route::get('/sudija', 'PlayerController@referees'); // prikazuje sve sudije

Route::get('/igrac/sudija/{id}', 'PlayerController@promote');
Route::post('/igrac/sudija/{id}', 'PlayerController@promotePost'); // dodeljuje igracu status sudije
Route::get('/rokovi', 'AdminController@deadlines'); // prikazuje trenutne rokove
Route::get('/dodajRok', 'AdminController@addDeadline');
Route::post('/dodajRok', 'AdminController@addDeadlinePost'); // dodaje rok
Route::get('/korisnici', 'AdminController@getPendingRegs'); //dohvata korisnike koji cekaju da im se odobri registacija

Route::get('/korisnici/login', 'UsersController@login')->name("login");
Route::post('/korisnici/login', 'UsersController@verifyLogin');
Route::get('/korisnici/logout', 'UsersController@logout');
Route::get('/korisnici/registracija', 'UsersController@register');
Route::post('/korisnici/registracija', 'UsersController@registerPost');
