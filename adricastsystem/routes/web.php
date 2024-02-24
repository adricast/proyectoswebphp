<?php

use App\Models\Caracteristica;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmpleoController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\RecursosController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ReikosoftController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\TecnologiasController;
use App\Http\Controllers\CaracteristicasController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\SubcaracteristicasController;
use App\Http\Controllers\TipousuariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'inicio'])->name('paginas.inicio');
Route::get('/nosotros', [NosotrosController::class, 'nosotros'])->name('paginas.nosotros');
Route::get('/noticias', [NoticiasController::class, 'noticias'])->name('paginas.noticias');
Route::get('/tecnologias', [TecnologiasController::class, 'tecnologias'])->name('paginas.tecnologias');
Route::get('/nosotros', [NosotrosController::class, 'nosotros'])->name('paginas.nosotros');
Route::get('/servicios', [ServiciosController::class, 'servicios'])->name('paginas.servicios');
Route::get('/trabajaconnosotros', [EmpleoController::class, 'empleo'])->name('paginas.empleo');

Route::get('{directory}/{filename}', [RecursosController::class, 'show'])->name('recursos.show');
Route::post('/enviar-formulario', [ContactanosController::class, 'submit'])->name('enviarFormulario');

Route::get('/crearcuenta', [RegistroController::class, 'index'])->name('register');
Route::post('/crearcuenta', [RegistroController::class, 'store']);
Route::get('/reikosoft', [PostController::class, 'index'])->name('posts.index');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/reikomodulos', [ModulosController::class, 'index'])->name('cmodulos.index');
Route::get('/moduloscreate', [ModulosController::class, 'create'])->name('cmodulos.create');
Route::post('/moduloscreate', [ModulosController::class, 'store'])->name('cmodulos.store');
Route::delete('/modulosdelete/{id}', [ModulosController::class, 'destroy'])->name('cmodulos.destroy');
Route::get('/reikomodulos/modulosshow/{id}', [ModulosController::class, 'show'])->name('cmodulos.show');
Route::put('/reikomodulos/modulosupdate/{id}', [ModulosController::class, 'update'])->name('cmodulos.update');

Route::get('/marcas', [MarcasController::class, 'index'])->name('marcas.index');
Route::get('/marcascreate', [MarcasController::class, 'create'])->name('marcas.create');
Route::post('/marcascreate', [MarcasController::class, 'store'])->name('marcas.store');
Route::delete('/marcasdelete/{id}', [MarcasController::class, 'destroy'])->name('marcas.destroy');
Route::get('/marcas/show/{id}', [MarcasController::class, 'show'])->name('marcas.show');
Route::put('/marcas/update/{id}', [MarcasController::class, 'update'])->name('marcas.update');
Route::get('/marcasbuscar', [MarcasController::class, 'buscarRegistros'])->name('marcas.buscar');

Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('/categoriascreate', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('/categoriascreate', [CategoriasController::class, 'store'])->name('categorias.store');
Route::delete('/categoriasdelete/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
Route::get('/categorias/show/{id}', [CategoriasController::class, 'show'])->name('categorias.show');
Route::put('/categorias/update/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
Route::get('/categoriasbuscar', [CategoriasController::class, 'buscarRegistros'])->name('categorias.buscar');

Route::get('/perfiles', [PerfilesController::class, 'index'])->name('perfiles.index');
Route::put('/perfilesupdate/', [PerfilesController::class, 'update'])->name('perfiles.update');

Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/usuarioscreate', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarioscreate', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::delete('/usuariosdelete/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/usuarios/show/{id}', [UsuariosController::class, 'show'])->name('usuarios.show');
Route::put('/usuarios/update/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::get('/usuariosbuscar', [UsuariosController::class, 'buscarRegistros'])->name('usuarios.buscar');

Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::get('/productoscreate', [ProductosController::class, 'create'])->name('productos.create');
Route::post('/productoscreate', [ProductosController::class, 'store'])->name('productos.store');
Route::delete('/productosdelete/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
Route::get('/productos/show/{id}', [ProductosController::class, 'show'])->name('productos.show');
Route::put('/productos/update/{id}', [ProductosController::class, 'update'])->name('productos.update');
Route::get('/productosbuscar', [ProductosController::class, 'buscarRegistros'])->name('productos.buscar');
Route::get('/productosbuscarcodigo', [ProductosController::class, 'buscarCodigo'])->name('productos.buscarcodigo');

Route::get('/caracteristicas', [CaracteristicasController::class, 'index'])->name('caracteristicas.index');
Route::get('/caracteristicas/buscarid/{id_producto}', [CaracteristicasController::class, 'consultarCaracteristicasProducto'])->name('caracteristicas.consultar');
Route::get('/caracteristicas/agregar/{id_producto}', [CaracteristicasController::class, 'agregarcaracteristicas'])->name('caracteristicas.agregar');
Route::get('/caracteristicas/eliminar/{id_caracteristica}', [CaracteristicasController::class, 'eliminarcaracteristicas'])->name('caracteristicas.eliminar');
Route::post('/caracteristicas/actualizar/{id}', [CaracteristicasController::class, 'actualizarCaracteristica'])->name('caracteristicas.actualizar');

Route::get('/contactanos', [ContactanosController::class, 'contactanos'])->name('paginas.contactanos');
Route::post('/contactanos', [ContactanosController::class, 'store'])->name('contactanos.store');

Route::get('/subcaracteristicas/buscarid/{id_caracteristica}', [SubcaracteristicasController::class, 'consultarsubcaracteristicas'])->name('subcaracteristicas.consultar');
Route::get('/subcaracteristicas/agregar/{id_caracteristica}', [SubcaracteristicasController::class, 'agregarsubcaracteristica'])->name('subcaracteristicas.agregar');
Route::get('/subcaracteristicas/eliminar/{id_caracteristica}', [SubcaracteristicasController::class, 'eliminarsubcaracteristica'])->name('subcaracteristicas.eliminar');
Route::post('/subcaracteristicas/actualizar/{id}', [SubcaracteristicasController::class, 'actualizarsubcaracteristica'])->name('subcaracteristicas.actualizar');

Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos.index');
Route::delete('/contactosdelete/{id}', [ContactoController::class, 'destroy'])->name('contactos.destroy');
Route::get('/contactos/show/{id}', [ContactoController::class, 'show'])->name('contactos.show');
Route::get('/contactosbuscar', [ContactoController::class, 'buscarRegistros'])->name('contactos.buscar');

Route::get('/chats', [ChatsController::class, 'index'])->name('chats.index');
Route::post('/chats/store', [ChatsController::class, 'store'])->name('chats.store');
Route::get('/chats/show/{id}', [ChatsController::class, 'show'])->name('chats.show');

Route::get('/tipousuarios', [TipousuariosController::class, 'index'])->name('tipousuarios.index');
Route::get('/tipousuarioscreate', [TipousuariosController::class, 'create'])->name('tipousuarios.create');
Route::post('/tipousuarioscreate', [TipousuariosController::class, 'store'])->name('tipousuarios.store');
Route::delete('/tipousuariosdelete/{id}', [TipousuariosController::class, 'destroy'])->name('tipousuarios.destroy');
Route::get('/tipousuarios/show/{id}', [TipousuariosController::class, 'show'])->name('tipousuarios.show');
Route::put('/tipousuarios/update/{id}', [TipousuariosController::class, 'update'])->name('tipousuarios.update');


