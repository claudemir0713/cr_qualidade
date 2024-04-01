<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Maquina\MaquinaController;
use App\Http\Controllers\menu\menuController;
use App\Http\Controllers\Produto\ProdutoController;
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
    Route::group(['namespace' => 'Produto'], function () {
        Route::get('Produto',[ProdutoController::class,'listAll'])->name('Produto.listAll');
        Route::get('Produto/novo',[ProdutoController::class,'formadd'])->name('Produto.add');
        Route::get('Produto/editar/{Produto}',[ProdutoController::class,'formEdit'])->name('Produto.formEdit');
        Route::post('Produto/store',[ProdutoController::class,'strore'])->name('Produto.store');
        Route::patch('Produto/edit/{Produto}',[ProdutoController::class,'edit'])->name('Produto.edit');
        Route::delete('Produto/destroy/{Produto}',[ProdutoController::class,'destroy'])->name('Produto.destroy');
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

});

