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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('start')->middleware('auth');

Route::get('/changePassword', [App\Http\Controllers\HomeController::class, 'create'])->name('createPasswordForm')->middleware('auth');
Route::post('/changedPassword', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('changePassword')->middleware('auth');

Route::post('/createdCity', [App\Http\Controllers\CityController::class, 'store'])->name('cities.store')->middleware('auth');
Route::get('/board', [App\Http\Controllers\CityController::class, 'create'])->name('cities.create')->middleware('auth');

Route::get('/RATUSZ', [App\Http\Controllers\TownHallController::class, 'create'])->name('townhall.create')->middleware('auth');
Route::post('/updatePopulationRATUSZ', [App\Http\Controllers\TownHallController::class, 'store'])->name('townhall.store')->middleware('auth');

Route::get('/AKADEMIA', [App\Http\Controllers\UniversityController::class, 'create'])->name('university.create')->middleware('auth');
Route::post('/updateScientistsAKADEMIA', [App\Http\Controllers\UniversityController::class, 'store'])->name('university.store')->middleware('auth');
Route::post('/newUniversity/{slug}', [App\Http\Controllers\UniversityController::class, 'newUniversity'])->name('university.newUniversity')->middleware('auth');

Route::get('/MAGAZYN', [App\Http\Controllers\StoreController::class, 'create'])->name('store.create')->middleware('auth');
Route::post('/newStore/{slug}', [App\Http\Controllers\StoreController::class, 'newStore'])->name('store.newStore')->middleware('auth');


Route::get('/MUR', [App\Http\Controllers\WallController::class, 'create'])->name('wall.create')->middleware('auth');

Route::get('/DRWAL', [App\Http\Controllers\BonusBuildingController::class, 'woodcutter'])->name('bonusbuilding.woodcutter')->middleware('auth');
Route::post('/newWoodcutter/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newWoodcutter'])->name('bonusBuilding.newWoodcutter')->middleware('auth');

Route::get('/KAMIENIARZ', [App\Http\Controllers\BonusBuildingController::class, 'stonemason'])->name('bonusbuilding.stonemason')->middleware('auth');
Route::post('/newStonemason/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newStonemason'])->name('bonusBuilding.newStonemason')->middleware('auth');

Route::get('/MŁYN', [App\Http\Controllers\BonusBuildingController::class, 'mill'])->name('bonusbuilding.mill')->middleware('auth');
Route::post('/newMill/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newMill'])->name('bonusBuilding.newMill')->middleware('auth');

Route::get('/ARCHITEKT', [App\Http\Controllers\BonusBuildingController::class, 'architect'])->name('bonusbuilding.architect')->middleware('auth');
Route::post('/newArchitect/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newArchitect'])->name('bonusBuilding.newArchitect')->middleware('auth');

Route::get('/INŻYNIER', [App\Http\Controllers\BonusBuildingController::class, 'engineer'])->name('bonusbuilding.engineer')->middleware('auth');
Route::post('/newEngineer/{slug}', [App\Http\Controllers\BonusBuildingController::class, 'newEngineer'])->name('bonusBuilding.newEngineer')->middleware('auth');

Route::get('/STAJNIA', [App\Http\Controllers\StableController::class, 'create'])->name('stable.create')->middleware('auth');
Route::post('/newStable/{slug}', [App\Http\Controllers\StableController::class, 'newStable'])->name('stable.newStable')->middleware('auth');

Route::get('/KOSZARY', [App\Http\Controllers\ArmyController::class, 'create'])->name('army.create')->middleware('auth');
Route::post('/updateArmyKOSZARY', [App\Http\Controllers\ArmyController::class, 'store'])->name('army.store')->middleware('auth');
Route::post('/newArmy/{slug}', [App\Http\Controllers\ArmyController::class, 'newArmy'])->name('army.newArmy')->middleware('auth');

Route::get('/newBuild/{slug}',[App\Http\Controllers\BoardPositionController::class,'newBuild'])->name('boardPosition.newBuild')->middleware('auth');





