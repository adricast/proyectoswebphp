<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
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
use App\Http\Controllers\RolesUsuarioController;
use App\Http\Controllers\SubcaracteristicasController;
use App\Http\Controllers\TipousuariosController;
=======
use App\Http\Controllers\{
    HomeController, NosotrosController, NoticiasController, TecnologiasController, ServiciosController,
    EmpleoController, ContactanosController, ContactoController, RegistroController, LoginController,
    LogoutController, PostController, RecursosController, ModulosController, MarcasController, CategoriasController,
    PerfilesController, UsuariosController, ProductosController, CaracteristicasController, SubcaracteristicasController,
    ChatsController, RolesUsuarioController, RolesusuariosController, TipousuariosController
};
>>>>>>> 7327fdf (07-06-2025 Roles Middleware y Rutas)

// Definición de la función crudRoutes ANTES de usarla
function crudRoutes($prefix, $controller) {
    Route::prefix($prefix)->controller($controller)->group(function () use ($prefix) {
        Route::get('/', 'index')->name("$prefix.index");
        Route::get('create', 'create')->name("$prefix.create");
        Route::post('create', 'store')->name("$prefix.store");
        Route::delete('delete/{id}', 'destroy')->name("$prefix.destroy");
        Route::get('show/{id}', 'show')->name("$prefix.show");
        Route::put('update/{id}', 'update')->name("$prefix.update");
        Route::get('buscar', 'buscarRegistros')->name("$prefix.buscar");
    });
}

// Rutas públicas (sin auth)
Route::get('/', [HomeController::class, 'inicio'])->name('paginas.inicio');
Route::get('/nosotros', [NosotrosController::class, 'nosotros'])->name('paginas.nosotros');
Route::get('/noticias', [NoticiasController::class, 'noticias'])->name('paginas.noticias');
Route::get('/tecnologias', [TecnologiasController::class, 'tecnologias'])->name('paginas.tecnologias');
Route::get('/servicios', [ServiciosController::class, 'servicios'])->name('paginas.servicios');
Route::get('/empleos', [EmpleoController::class, 'empleo'])->name('paginas.empleo');
<<<<<<< HEAD

Route::get('{directory}/{filename}', [RecursosController::class, 'show'])->name('recursos.show');
Route::post('/enviar-formulario', [ContactanosController::class, 'submit'])->name('enviarFormulario');

Route::get('/crearcuenta', [RegistroController::class, 'index'])->name('register');
Route::post('/crearcuenta', [RegistroController::class, 'store']);
Route::get('/home', [PostController::class, 'index'])->name('posts.index');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::get('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/contactanos', [ContactanosController::class, 'contactanos'])->name('paginas.contactanos');
Route::post('/contactanos', [ContactanosController::class, 'store'])->name('contactanos.store');
Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos.index');
Route::delete('/contactosdelete/{id}', [ContactoController::class, 'destroy'])->name('contactos.destroy');
Route::get('/contactos/show/{id}', [ContactoController::class, 'show'])->name('contactos.show');
Route::get('/contactosbuscar', [ContactoController::class, 'buscarRegistros'])->name('contactos.buscar');

/* AUTH */
Route::middleware(['auth'/*, 'verifica.modulo'*/])->group(function () {
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
    
    Route::get('productoscreate', [ProductosController::class, 'create'])->name('productos.create');
    Route::post('productoscreate', [ProductosController::class, 'store'])->name('productos.store');
    Route::delete('productosdelete/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
    Route::get('productosbuscarcodigo', [ProductosController::class, 'buscarCodigo'])->name('productos.buscarcodigo');
   Route::get('productosbuscar', [ProductosController::class, 'buscarRegistros'])->name('productos.buscar');

    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductosController::class, 'index'])->name('productos.index');
        Route::put('/update/{id}', [ProductosController::class, 'update'])->name('productos.update');
        Route::get('/show/{id}', [ProductosController::class, 'show'])->name('productos.show');
  });

    Route::get('/caracteristicas', [CaracteristicasController::class, 'index'])->name('caracteristicas.index');
    Route::get('/caracteristicas/buscarid/{id_producto}', [CaracteristicasController::class, 'consultarCaracteristicasProducto'])->name('caracteristicas.consultar');
    Route::get('/caracteristicas/agregar/{id_producto}', [CaracteristicasController::class, 'agregarcaracteristicas'])->name('caracteristicas.agregar');
    Route::get('/caracteristicas/eliminar/{id_caracteristica}', [CaracteristicasController::class, 'eliminarcaracteristicas'])->name('caracteristicas.eliminar');
    Route::post('/caracteristicas/actualizar/{id}', [CaracteristicasController::class, 'actualizarCaracteristica'])->name('caracteristicas.actualizar');
=======
Route::get('/contactanos', [ContactanosController::class, 'contactanos'])->name('paginas.contactanos');
Route::post('/contactanos', [ContactanosController::class, 'store'])->name('contactanos.store');

Route::get('{directory}/{filename}', [RecursosController::class, 'show'])->name('recursos.show');

// Registro y login (sin auth)
Route::get('/crearcuenta', [RegistroController::class, 'index'])->name('register');
Route::post('/crearcuenta', [RegistroController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::get('/logout', fn() => redirect('/login'));

// Rutas que requieren autenticación agrupadas con middleware 'auth'
Route::middleware(['auth',''])->group(function () {
    
    // Home después del login
    Route::get('/home', [PostController::class, 'index'])->name('posts.index');

    // Rutas de módulos
    Route::prefix('reikomodulos')->controller(ModulosController::class)->group(function () {
        Route::get('/', 'index')->name('cmodulos.index');
        Route::get('/modulosshow/{id}', 'show')->name('cmodulos.show');
        Route::put('/modulosupdate/{id}', 'update')->name('cmodulos.update');
    });
    Route::get('/moduloscreate', [ModulosController::class, 'create'])->name('cmodulos.create');
    Route::post('/moduloscreate', [ModulosController::class, 'store'])->name('cmodulos.store');
    Route::delete('/modulosdelete/{id}', [ModulosController::class, 'destroy'])->name('cmodulos.destroy');
>>>>>>> 7327fdf (07-06-2025 Roles Middleware y Rutas)

    // CRUDs protegidos usando la función crudRoutes
    crudRoutes('marcas', MarcasController::class);
    crudRoutes('categorias', CategoriasController::class);
    crudRoutes('usuarios', UsuariosController::class);
    crudRoutes('productos', ProductosController::class);
    crudRoutes('contactos', ContactoController::class);

<<<<<<< HEAD
    Route::get('/subcaracteristicas/buscarid/{id_caracteristica}', [SubcaracteristicasController::class, 'consultarsubcaracteristicas'])->name('subcaracteristicas.consultar');
    Route::get('/subcaracteristicas/agregar/{id_caracteristica}', [SubcaracteristicasController::class, 'agregarsubcaracteristica'])->name('subcaracteristicas.agregar');
    Route::get('/subcaracteristicas/eliminar/{id_caracteristica}', [SubcaracteristicasController::class, 'eliminarsubcaracteristica'])->name('subcaracteristicas.eliminar');
    Route::post('/subcaracteristicas/actualizar/{id}', [SubcaracteristicasController::class, 'actualizarsubcaracteristica'])->name('subcaracteristicas.actualizar');

    Route::prefix('chats')->group(function () {
        Route::get('/contadorconversation/aqui', [ChatsController::class, 'contadorConversaciones']);

        Route::get('/', [ChatsController::class, 'index'])->name('chats.index');
        Route::post('/store', [ChatsController::class, 'store'])->name('chats.store');
        Route::get('/show/{id}', [ChatsController::class, 'show'])->name('chats.show');
        
        Route::delete('/delete-conversation/{userId}', [ChatsController::class, 'deleteConversation']);
        Route::delete('/ocultar-conversation/{userId}', [ChatsController::class, 'ocultarConversacion']);
        Route::delete('/delete-message/{id}', [ChatsController::class, 'destroyMessage']);
        
        // Ocultar mensaje enviado (solo para el usuario que envió)
        Route::patch('/ocultar-enviado/{id}', [ChatsController::class, 'ocultarMensajeEnviado']);
        // Ocultar mensaje recibido (solo para el receptor)
        Route::patch('/ocultar-recibido/{id}', [ChatsController::class, 'ocultarMensajeRecibido']);
        Route::patch('/marcar-leidos/{userId}', [ChatsController::class, 'marcarLeidos']);
    });

    Route::get('/rolusuario', [RolesUsuarioController::class, 'index'])->name('rolusuario.index');
    Route::post('/rolusuario/store', [RolesUsuarioController::class, 'store'])->name('rolusuario.store');

    Route::get('/tipousuarios', [TipousuariosController::class, 'index'])->name('tipousuarios.index');
    Route::get('/tipousuarioscreate', [TipousuariosController::class, 'create'])->name('tipousuarios.create');
    Route::post('/tipousuarioscreate', [TipousuariosController::class, 'store'])->name('tipousuarios.store');
    Route::delete('/tipousuariosdelete/{id}', [TipousuariosController::class, 'destroy'])->name('tipousuarios.destroy');
    Route::get('/tipousuarios/show/{id}', [TipousuariosController::class, 'show'])->name('tipousuarios.show');
    Route::put('/tipousuarios/update/{id}', [TipousuariosController::class, 'update'])->name('tipousuarios.update');
=======
    Route::get('/productosbuscarcodigo', [ProductosController::class, 'buscarCodigo'])->name('productos.buscarcodigo');

    // Características
    Route::prefix('caracteristicas')->controller(CaracteristicasController::class)->group(function () {
        Route::get('/', 'index')->name('caracteristicas.index');
        Route::get('buscarid/{id_producto}', 'consultarCaracteristicasProducto')->name('caracteristicas.consultar');
        Route::get('agregar/{id_producto}', 'agregarcaracteristicas')->name('caracteristicas.agregar');
        Route::get('eliminar/{id_caracteristica}', 'eliminarcaracteristicas')->name('caracteristicas.eliminar');
        Route::post('actualizar/{id}', 'actualizarCaracteristica')->name('caracteristicas.actualizar');
    });

    // Subcaracterísticas
    Route::prefix('subcaracteristicas')->controller(SubcaracteristicasController::class)->group(function () {
        Route::get('buscarid/{id_caracteristica}', 'consultarsubcaracteristicas')->name('subcaracteristicas.consultar');
        Route::get('agregar/{id_caracteristica}', 'agregarsubcaracteristica')->name('subcaracteristicas.agregar');
        Route::get('eliminar/{id_caracteristica}', 'eliminarsubcaracteristica')->name('subcaracteristicas.eliminar');
        Route::post('actualizar/{id}', 'actualizarsubcaracteristica')->name('subcaracteristicas.actualizar');
    });

    // Perfiles
    Route::get('/perfiles', [PerfilesController::class, 'index'])->name('perfiles.index');
    Route::put('/perfilesupdate', [PerfilesController::class, 'update'])->name('perfiles.update');

    // Tipos de usuario
    Route::get('/tipousuarios', [TipousuariosController::class, 'index'])->name('tipousuarios.index');

    // Chats
    Route::prefix('chats')->controller(ChatsController::class)->group(function () {
        Route::get('/', 'index')->name('chats.index');
        Route::post('/store', 'store')->name('chats.store');
        Route::get('/show/{id}', 'show')->name('chats.show');
        Route::get('/contadorconversation/aqui', 'contadorConversaciones');
        Route::delete('/delete-conversation/{userId}', 'deleteConversation');
        Route::delete('/ocultar-conversation/{userId}', 'ocultarConversacion');
        Route::delete('/delete-message/{id}', 'destroyMessage');
        Route::patch('/ocultar-enviado/{id}', 'ocultarMensajeEnviado');
        Route::patch('/ocultar-recibido/{id}', 'ocultarMensajeRecibido');
        Route::patch('/marcar-leidos/{userId}', 'marcarLeidos');
    });

    // Roles usuario
    Route::get('/rolusuario', [RolesusuariosController::class, 'index'])->name('rolusuario.index');
    Route::post('/rolusuario/store', [RolesusuariosController::class, 'store'])->name('rolusuario.store');

    // Enviar formulario (solo usuarios autenticados)
    Route::post('/enviar-formulario', [ContactanosController::class, 'submit'])->name('enviarFormulario');
>>>>>>> 7327fdf (07-06-2025 Roles Middleware y Rutas)

});
