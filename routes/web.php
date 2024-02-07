<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\menu\menuController;
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

});

