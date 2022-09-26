<?php
use Carbon\Carbon;
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

Route::get('/', 'Accueil\AccueilController@index')->name('accueil');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/register', 'Auth\AdminRegistreController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegistreController@register')->name('admin.register.submit');

});
Route::prefix('categorie')->group(function(){
    Route::get('/ajout', 'Categorie\CategorieController@showAddCategorieForm')->name('categorie.add');
    Route::post('/ajout', 'Categorie\CategorieController@ajoutCategorie')->name('categorie.add.submit');
    Route::get('/liste', 'Categorie\CategorieController@listeCategorie')->name('categorie.liste');
    Route::post('/update', 'Categorie\CategorieController@updateCategorie')->name('categorie.update');
    Route::get('/delete{id}', 'Categorie\CategorieController@deleteCat')->name('categorie.delete');

});

Route::prefix('consommation')->group(function(){
    Route::get('/listeClient', 'Consommation\ConsommationController@listeClient')->name('client.listecc');
    Route::get('/listeClient/search', 'Consommation\ConsommationController@searchClient')->name('client.liste_search');
    Route::get('/editCli/{id}', 'Consommation\ConsommationController@editConsommationCli')->name('consommation');
    Route::post('/ajout', 'Consommation\ConsommationController@ajoutConsommation')->name('consommation.add.submit');
    Route::get('/liste', 'Consommation\ConsommationController@listeConsommation')->name('consommation.liste');
    Route::get('/edit/{id}', 'Consommation\ConsommationController@editConsommation')->name('consommation.edit');
    Route::post('/edit', 'Consommation\ConsommationController@updateConsommation')->name('consommation.edit.submit');
    Route::get('/effacer/{id}', 'Consommation\ConsommationController@deleteConsommation')->name('consommation.delete');
    Route::get('/annuler/{id}', 'Consommation\ConsommationController@annulerConsommation')->name('consommation.annuler');
    Route::get('/liste/search', 'Consommation\ConsommationController@searchConsommation')->name('consommation.liste.search');
    Route::get('/liste/search/date', 'Consommation\ConsommationController@searchConsommationDate')->name('consommation.liste.searchDate');
    //consommation dans l'hotel
    Route::get('/ajout_cons', 'Consommation\ConsommationController@ajout')->name('cons.ajout');
    Route::post('/ajout_cons', 'Consommation\ConsommationController@ajoutCons')->name('cons.add.submit');
    Route::get('/liste_cons', 'Consommation\ConsommationController@listeCons')->name('cons.liste');
    Route::post('/edit_cons', 'Consommation\ConsommationController@updateCons')->name('cons.edit.submit');
    Route::get('/effacer_cons/{id}', 'Consommation\ConsommationController@deleteCons')->name('cons.delete');
    Route::get('/liste/search_cons', 'Consommation\ConsommationController@searchCons')->name('cons.liste.search');
    Route::get('/liste/search/date_cons', 'Consommation\ConsommationController@searchConsDate')->name('cons.liste.searchDate');
   
});
Route::prefix('prestation')->group(function(){
    Route::get('/listeClientp', 'Prestation\PrestationController@listeClient')->name('client.listec');
    Route::get('/listeClient/search', 'Prestation\PrestationController@searchClient')->name('client.liste_searchp');
    Route::get('/editCli/{id}', 'Prestation\PrestationController@editPrestationCli')->name('prestation');
    Route::post('/ajout', 'Prestation\PrestationController@ajoutPrestation')->name('prestation.add.submit');
    Route::get('/liste', 'Prestation\PrestationController@listePrestation')->name('prestation.liste');
    Route::get('/edit/{id}', 'Prestation\PrestationController@editPrestation')->name('prestation.edit');
    Route::post('/edit', 'Prestation\PrestationController@updatePrestation')->name('prestation.edit.submit');
    Route::get('/effacer/{id}', 'Prestation\PrestationController@deletePrestation')->name('prestation.delete');
    Route::get('/liste/search', 'Prestation\PrestationController@searchPrestation')->name('prestation.liste.search');
    Route::get('/liste/search/date', 'Prestation\PrestationController@searchPrestationDate')->name('prestation.liste.searchDate');

    //prestation dans l'hotel
    Route::get('/ajout_pres', 'Prestation\PrestationController@ajout')->name('pres.ajout');
    Route::post('/ajout_pres', 'Prestation\PrestationController@ajoutPres')->name('pres.add.submit');
    Route::get('/liste_pres', 'Prestation\PrestationController@listePres')->name('pres.liste');
    Route::post('/edit_pres', 'Prestation\PrestationController@updatePres')->name('pres.edit.submit');
    Route::get('/effacer_pres/{id}', 'Prestation\PrestationController@deletePres')->name('pres.delete');
    Route::get('/liste/search_cons', 'Prestation\PrestationController@searchPres')->name('pres.liste.search');
    Route::get('/liste/search/date_cons', 'Prestation\PrestationController@searchPresDate')->name('pres.liste.searchDate');
   
});
Route::prefix('chambre')->group(function(){
    Route::get('/ajout', 'Chambre\ChambreController@showAddChambreForm')->name('chambre.add')->middleware('auth:admin');
    Route::post('/ajout', 'Chambre\ChambreController@ajoutChambre')->name('chambre.add.submit')->middleware('auth:admin');
    Route::get('/liste', 'Chambre\ChambreController@listeChambre')->name('chambre.liste')->middleware('auth:admin');
    Route::get('/edit/{id}', 'Chambre\ChambreController@editChambre')->name('chambre.edit')->middleware('auth:admin');
    Route::post('/edit/{id}', 'Chambre\ChambreController@updateChambre')->name('chambre.edit.submit')->middleware('auth:admin');
    Route::get('/effacer/{id}', 'Chambre\ChambreController@deleteChambre')->name('chambre.delete')->middleware('auth:admin');
    Route::get('/liste/search', 'Chambre\ChambreController@searchChambre')->name('chambre.liste.search')->middleware('auth:admin');
    Route::get('/liste/une', 'Chambre\ChambreController@uneChambre')->name('chambre.uneLit')->middleware('auth:admin');
    Route::get('/liste/deux', 'Chambre\ChambreController@deuxChambre')->name('chambre.deuxLit')->middleware('auth:admin');
    Route::get('/liste/famille', 'Chambre\ChambreController@familleChambre')->name('chambre.familleLit')->middleware('auth:admin');
    Route::get('/liste/libre', 'Chambre\ChambreController@libreChambre')->name('chambre.libre')->middleware('auth:admin');
    Route::get('/liste/reserve', 'Chambre\ChambreController@reserveChambre')->name('chambre.reserve')->middleware('auth:admin');
    Route::get('/liste/searchparcat', 'Chambre\ChambreController@searchChambreCat')->name('chambre.liste.searchCat')->middleware('auth:admin');
//client
    Route::get('/liste_chambre', 'Chambre\ChambreController@liste_chambre')->name('liste_chambre');
    Route::get('/simple', 'Chambre\ChambreController@liste_simple')->name('liste_simple');
    Route::get('/double', 'Chambre\ChambreController@liste_double')->name('liste_double');
    Route::get('/luxe', 'Chambre\ChambreController@liste_luxe')->name('liste_luxe');
    Route::get('/une', 'Chambre\ChambreController@liste_une')->name('liste_une');
    Route::get('/deux', 'Chambre\ChambreController@liste_deux')->name('liste_deux');
    Route::get('/famille', 'Chambre\ChambreController@liste_famille')->name('liste_famille');
    Route::get('/libre', 'Chambre\ChambreController@liste_libre')->name('liste_libre');
    Route::get('/reserve', 'Chambre\ChambreController@liste_reserve')->name('liste_reserve');
    Route::get('/petage', 'Chambre\ChambreController@liste_petage')->name('liste_petage');
    Route::get('/detage', 'Chambre\ChambreController@liste_detage')->name('liste_detage');
    Route::get('/tetage', 'Chambre\ChambreController@liste_tetage')->name('liste_tetage');
    Route::get('/plus', 'Chambre\ChambreController@liste_plus')->name('liste_plus');
    Route::get('/liste_chambre/prix', 'Chambre\ChambreController@liste_chambre_prix')->name('liste_chambre_prix');
    Route::get('/liste_chambre/search', 'Chambre\ChambreController@liste_chambre_search')->name('liste_chambre_search');
    Route::get('/detail/{id}', 'Chambre\ChambreController@detailChambre')->name('chambre.detail');
    Route::get('/favorie/{id}', 'Chambre\ChambreController@favorieChambre')->name('chambre.favorie')->middleware('auth');
    
});
Route::prefix('membre_hotel')->group(function(){
  
    Route::get('/liste', 'Admin\AdminController@index')->name('membre.liste');

  
    
});
Route::prefix('reservation')->group(function(){
    Route::get('/id/{id}', 'Reservation\ReservationController@editReservationCli')->name('reservation')->middleware('auth');
    Route::post('/ajout', 'Reservation\ReservationController@ajoutReservation')->name('reservation.submit');
    Route::get('/detail', 'Reservation\ReservationController@reservationCli_detail')->name('reservation.detail')->middleware('auth');
    Route::get('/favories', 'Reservation\ReservationController@favorieCli_detail')->name('favorie.detail')->middleware('auth');
    Route::get('/effacer_fav/{id}', 'Reservation\ReservationController@deleteFavorie')->name('favorie.delete');
    Route::get('/effacer/{id}', 'Reservation\ReservationController@deleteReservation')->name('reservation.delete');
    Route::get('/print/{id}', 'Reservation\ReservationController@printReservation')->name('reservation.print');
    Route::get('/print_id/{id}', 'Reservation\ReservationController@printIdReservation')->name('reservation.print_id');
    //admin
    Route::get('/liste', 'Reservation\ReservationController@liste')->name('reservation.liste')->middleware('auth:admin');
    Route::get('/liste/accepte', 'Reservation\ReservationController@liste_accepte')->name('reservation.liste_accepte')->middleware('auth:admin');
    Route::get('/liste/annule', 'Reservation\ReservationController@liste_annule')->name('reservation.liste_annule')->middleware('auth:admin');
    Route::get('/liste/annule/attente', 'Reservation\ReservationController@liste_attente')->name('reservation.liste_attente')->middleware('auth:admin');
    Route::get('/liste/search', 'Reservation\ReservationController@liste_search')->name('reservation.liste_search')->middleware('auth:admin');
    Route::get('/liste/search/date', 'Reservation\ReservationController@liste_search_date')->name('reservation.liste_search_date')->middleware('auth:admin');
    Route::get('/liste/search/debut', 'Reservation\ReservationController@liste_search_debut')->name('reservation.liste_search_debut')->middleware('auth:admin');
    Route::get('/liste/search/fin', 'Reservation\ReservationController@liste_search_fin')->name('reservation.liste_search_fin')->middleware('auth:admin');
    Route::get('/liste/search/cli', 'Reservation\ReservationController@liste_search_cli')->name('reservation.liste_search_cli')->middleware('auth:admin');
    Route::get('/edit/{id}', 'Reservation\ReservationController@editReservation')->name('reservation.edit')->middleware('auth:admin');
    Route::post('/edit/{id}', 'Reservation\ReservationController@updateReservation')->name('reservation.edit.submit')->middleware('auth:admin');
    Route::get('/effacer_res/{id}', 'Reservation\ReservationController@deleteReservationAdmin')->name('reservation.deleteAdmin');
});
Route::prefix('client')->group(function(){
    Route::get('/liste', 'Client\ClientController@liste')->name('client.liste');
    Route::get('/delete/{id}', 'Client\ClientController@deleteClient')->name('client.delete');
    Route::get('/edit/{id}', 'Client\ClientController@editClient')->name('client.edit');
    Route::post('/edit/{id}', 'Client\ClientController@editClientSubmit')->name('clientc.edit.submit');
    Route::get('/search', 'Client\ClientController@search')->name('client.search');
    Route::get('/profile_cli', 'Profile\ProfileController@profile_cli')->name('client.profile_cli');
    Route::get('/activite/{id}', 'Client\ClientController@activiteClient')->name('client.activite');
    
});
Route::prefix('facture')->group(function(){
    Route::get('/gerer', 'Client\ClientController@gerer')->name('client.facture');
    Route::get('/facture', 'Client\ClientController@facture')->name('client.fac');
    Route::get('/print/{id_cli}/{id_res}', 'Client\ClientController@printFacture')->name('facture.print');
 
    
});

Route::get('/contacte', 'Chambre\ChambreController@contacte')->name('contacte');
Route::post('/contacte', 'Chambre\ChambreController@contacte_submit')->name('contacte.submit');
Route::get('/get-post-chart-data', 'AdminController@getMonthlyPostData');
Route::get('/statistique', 'Statistique\StatistiqueController@index')->name('statistique');


    
    
   


