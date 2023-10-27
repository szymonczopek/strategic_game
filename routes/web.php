<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'checkCityExists'])->name('home.checkCityExists')->middleware('auth');

Route::get('/changePassword', [App\Http\Controllers\HomeController::class, 'create'])->name('createPasswordForm')->middleware('auth');
Route::post('/changePassword', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('changePassword')->middleware('auth');

Route::post('/createCity', [App\Http\Controllers\CityController::class, 'createCity'])->name('cities.createCity')->middleware('auth');
Route::get('/board', [App\Http\Controllers\CityController::class, 'displayBoard'])->name('cities.displayBoard')->middleware('auth');

Route::get('/townhall', [App\Http\Controllers\TownHallController::class, 'displayTownhall'])->name('townhall.displayTownhall')->middleware('auth');
Route::post('/changeWorkersAmount', [App\Http\Controllers\TownHallController::class, 'changeWorkersAmount'])->name('townhall.changeWorkersAmount')->middleware('auth');

Route::get('/university', [App\Http\Controllers\UniversityController::class, 'create'])->name('university.create')->middleware('auth');
Route::post('/updateScientistsAKADEMIA', [App\Http\Controllers\UniversityController::class, 'store'])->name('university.store')->middleware('auth');
Route::post('/createUniversity/{slug}', [App\Http\Controllers\UniversityController::class, 'newUniversity'])->name('university.newUniversity')->middleware('auth');

Route::get('/store', [App\Http\Controllers\StoreController::class, 'create'])->name('store.create')->middleware('auth');
Route::post('/createStore/{slug}', [App\Http\Controllers\StoreController::class, 'newStore'])->name('store.newStore')->middleware('auth');


Route::get('/wall', [App\Http\Controllers\WallController::class, 'create'])->name('wall.create')->middleware('auth');
Route::get('/createBuild/wall', [App\Http\Controllers\WallController::class, 'newWall'])->name('wall.newWall')->middleware('auth');

Route::get('/woodcutter', [App\Http\Controllers\BonusBuildingController::class, 'woodcutter'])->name('bonusbuilding.woodcutter')->middleware('auth');
Route::post('/createWoodcutter/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newWoodcutter'])->name('bonusBuilding.newWoodcutter')->middleware('auth');

Route::get('/stonemason', [App\Http\Controllers\BonusBuildingController::class, 'stonemason'])->name('bonusbuilding.stonemason')->middleware('auth');
Route::post('/createStonemason/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newStonemason'])->name('bonusBuilding.newStonemason')->middleware('auth');

Route::get('/mill', [App\Http\Controllers\BonusBuildingController::class, 'mill'])->name('bonusbuilding.mill')->middleware('auth');
Route::post('/createMill/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newMill'])->name('bonusBuilding.newMill')->middleware('auth');

Route::get('/architect', [App\Http\Controllers\BonusBuildingController::class, 'architect'])->name('bonusbuilding.architect')->middleware('auth');
Route::post('/createArchitect/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newArchitect'])->name('bonusBuilding.newArchitect')->middleware('auth');

Route::get('/engineer', [App\Http\Controllers\BonusBuildingController::class, 'engineer'])->name('bonusbuilding.engineer')->middleware('auth');
Route::post('/createEngineer/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newEngineer'])->name('bonusBuilding.newEngineer')->middleware('auth');

Route::get('/stable', [App\Http\Controllers\StableController::class, 'displayStable'])->name('stable.displayStable')->middleware('auth');
Route::post('/createStable/{slug}', [App\Http\Controllers\StableController::class, 'newStable'])->name('stable.newStable')->middleware('auth');

Route::get('/army', [App\Http\Controllers\ArmyController::class, 'displayArmy'])->name('army.create')->middleware('auth');
Route::post('/updateArmy', [App\Http\Controllers\ArmyController::class, 'store'])->name('army.store')->middleware('auth');
Route::post('/createArmy/{slug}', [App\Http\Controllers\ArmyController::class, 'createArmy'])->name('army.createArmy')->middleware('auth');

Route::get('/newBuild/{slug}',[App\Http\Controllers\BoardPositionController::class,'newBuild'])->name('boardPosition.newBuild')->middleware('auth');





