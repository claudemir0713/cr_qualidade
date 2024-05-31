<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Maquina\MaquinaController;
use App\Http\Controllers\menu\menuController;
use App\Http\Controllers\Produto\produtoController;
use App\Http\Controllers\extrusora\extrusoraController;
use App\Http\Controllers\cargavagao\cargavagaoController;
use App\Http\Controllers\forno\fornoController;
use App\Http\Controllers\historico\historicoController;
use App\Http\Controllers\laboratorio\laboratorioController;
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

        Route::get('extrusora/extrusoraAnexo/{extrusora}',[extrusoraController::class,'extrusoraAnexo'])->name('extrusora.extrusoraAnexo');
        Route::post('extrusora/upload',[extrusoraController::class,'upload'])->name('extrusora.upload');
        Route::delete('extrusora/destroyAnexo/{id}',[extrusoraController::class,'destroyAnexo'])->name('extrusora.destroyAnexo');
    });

    /********************************** CargaVagao ***************************************************************/
    Route::group(['namespace' => 'cargavagao'], function () {
        Route::get('cargavagao',[cargavagaoController::class,'listAll'])->name('cargavagao.listAll');
        Route::get('cargavagao/novo',[cargavagaoController::class,'formadd'])->name('cargavagao.add');
        Route::get('cargavagao/editar/{cargavagao}',[cargavagaoController::class,'formEdit'])->name('cargavagao.formEdit');
        Route::post('cargavagao/store',[cargavagaoController::class,'strore'])->name('cargavagao.store');
        Route::patch('cargavagao/edit/{cargavagao}',[cargavagaoController::class,'edit'])->name('cargavagao.edit');
        Route::delete('cargavagao/destroy/{cargavagao}',[cargavagaoController::class,'destroy'])->name('cargavagao.destroy');

        Route::get('cargavagao/cargavagaoAnexo/{cargavagao}',[cargavagaoController::class,'cargavagaoAnexo'])->name('cargavagao.cargavagaoAnexo');
        Route::post('cargavagao/upload',[cargavagaoController::class,'upload'])->name('cargavagao.upload');
        Route::delete('cargavagao/destroyAnexo/{id}',[cargavagaoController::class,'destroyAnexo'])->name('cargavagao.destroyAnexo');
    });

    /********************************** Forno ***************************************************************/
    Route::group(['namespace' => 'forno'], function () {
        Route::get('forno',[fornoController::class,'listAll'])->name('forno.listAll');
        Route::get('forno/novo',[fornoController::class,'formadd'])->name('forno.add');
        Route::get('forno/editar/{forno}',[fornoController::class,'formEdit'])->name('forno.formEdit');
        Route::post('forno/store',[fornoController::class,'strore'])->name('forno.store');
        Route::patch('forno/edit/{forno}',[fornoController::class,'edit'])->name('forno.edit');
        Route::delete('forno/destroy/{forno}',[fornoController::class,'destroy'])->name('forno.destroy');

        Route::get('forno/fornoAnexo/{forno}',[fornoController::class,'fornoAnexo'])->name('forno.fornoAnexo');
        Route::post('forno/upload',[fornoController::class,'upload'])->name('forno.upload');
        Route::delete('forno/destroyAnexo/{id}',[fornoController::class,'destroyAnexo'])->name('forno.destroyAnexo');
    });
    /********************************** Historico ***************************************************************/
    Route::group(['namespace' => 'historico'], function () {
        Route::get('historico',[historicoController::class,'listAll'])->name('historico.listAll');
        Route::get('historico/novo',[historicoController::class,'formadd'])->name('historico.add');
        Route::get('historico/editar/{historico}',[historicoController::class,'formEdit'])->name('historico.formEdit');
        Route::post('historico/store',[historicoController::class,'strore'])->name('historico.store');
        Route::patch('historico/edit/{historico}',[historicoController::class,'edit'])->name('historico.edit');
        Route::delete('historico/destroy/{historico}',[historicoController::class,'destroy'])->name('historico.destroy');
    });

    /********************************** Laboratorio ***************************************************************/
    Route::group(['namespace' => 'laboratorio'], function () {
        Route::get('laboratorio',[laboratorioController::class,'listAll'])->name('laboratorio.listAll');
        Route::get('laboratorio/novo',[laboratorioController::class,'formadd'])->name('laboratorio.add');
        Route::get('laboratorio/editar/{laboratorio}',[laboratorioController::class,'formEdit'])->name('laboratorio.formEdit');
        Route::post('laboratorio/store',[laboratorioController::class,'strore'])->name('laboratorio.store');
        Route::patch('laboratorio/edit/{laboratorio}',[laboratorioController::class,'edit'])->name('laboratorio.edit');
        Route::delete('laboratorio/destroy/{laboratorio}',[laboratorioController::class,'destroy'])->name('laboratorio.destroy');

        Route::get('laboratorio/laboratorioAnexo/{laboratorio}',[laboratorioController::class,'laboratorioAnexo'])->name('laboratorio.laboratorioAnexo');
        Route::post('laboratorio/upload',[laboratorioController::class,'upload'])->name('laboratorio.upload');
        Route::delete('laboratorio/destroyAnexo/{id}',[laboratorioController::class,'destroyAnexo'])->name('laboratorio.destroyAnexo');
    });

});

