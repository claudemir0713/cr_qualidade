<?php

use App\Http\Controllers\extrusora\extrusoraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Maquina\MaquinaController;
use App\Http\Controllers\menu\menuController;
use App\Http\Controllers\Produto\produtoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', function () {
    return view('auth/login');
});


Route::group(['middleware' => ['auth']], function () {

    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index']);


    /********************************** menu ***************************************************************/
    Route::group(['namespace' => 'menu'], function () {
        Route::get('menu',[menuController::class,'listAllmenu'])->name('menu.listAll');
        Route::get('menu/novo',[menuController::class,'formAddmenu'])->name('menu.formAddmenu');
        Route::get('menu/editar/{menu}',[menuController::class,'formEditmenu'])->name('menu.formEditmenu');
        Route::post('menu/store',[menuController::class,'stroremenu'])->name('menu.store');
        Route::patch('menu/edit/{menu}',[menuController::class,'edit'])->name('menu.edit');
        Route::delete('menu/destroy/{menu}',[menuController::class,'destroy'])->name('menu.destroy');

        Route::get('menu/menuUsuario',[MenuController::class,'menuUsuario'])->name('menu.menuUsuario');
        Route::post('menu/disponivel',[MenuController::class,'disponivel'])->name('menu.disponivel');
        Route::post('menu/menuLiberado',[MenuController::class,'menuLiberado'])->name('menu.menuLiberado');

        Route::post('menu/addMenuUsuario',[MenuController::class,'addMenuUsuario'])->name('menu.addMenuUsuario');
        Route::post('menu/removeMenuUsuario',[MenuController::class,'removeMenuUsuario'])->name('menu.removeMenuUsuario');

    });

    /********************************** Produto ***************************************************************/
    Route::group(['namespace' => 'produto'], function () {
        Route::get('produto',[produtoController::class,'listAll'])->name('produto.listAll');
        Route::get('produto/novo',[produtoController::class,'formadd'])->name('produto.add');
        Route::get('produto/editar/{produto}',[produtoController::class,'formEdit'])->name('produto.formEdit');
        Route::post('produto/store',[produtoController::class,'strore'])->name('produto.store');
        Route::patch('produto/edit/{produto}',[produtoController::class,'edit'])->name('produto.edit');
        Route::delete('produto/destroy/{produto}',[produtoController::class,'destroy'])->name('produto.destroy');
    });

    /********************************** Maquina ***************************************************************/
    Route::group(['namespace' => 'Maquina'], function () {
        Route::get('Maquina',[MaquinaController::class,'listAll'])->name('maquina.listAll');
        Route::get('Maquina/novo',[MaquinaController::class,'formadd'])->name('maquina.add');
        Route::get('Maquina/editar/{Maquina}',[MaquinaController::class,'formEdit'])->name('maquina.formEdit');
        Route::post('Maquina/store',[MaquinaController::class,'strore'])->name('maquina.store');
        Route::patch('Maquina/edit/{Maquina}',[MaquinaController::class,'edit'])->name('maquina.edit');
        Route::delete('Maquina/destroy/{Maquina}',[MaquinaController::class,'destroy'])->name('Maquina.destroy');
    });

/********************************** Extrusora ***************************************************************/
Route::group(['namespace' => 'extrusora'], function () {
    Route::get('extrusora',[extrusoraController::class,'listAll'])->name('extrusora.listAll');
    Route::get('extrusora/novo',[extrusoraController::class,'formadd'])->name('extrusora.add');
    Route::get('extrusora/editar/{extrusora}',[extrusoraController::class,'formEdit'])->name('extrusora.formEdit');
    Route::post('extrusora/store',[extrusoraController::class,'strore'])->name('extrusora.store');
    Route::patch('extrusora/edit/{extrusora}',[extrusoraController::class,'edit'])->name('extrusora.edit');
    Route::delete('extrusora/destroy/{extrusora}',[extrusoraController::class,'destroy'])->name('extrusora.destroy');
});

});

