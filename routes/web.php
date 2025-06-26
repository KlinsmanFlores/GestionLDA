<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\UsuarioInternoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ClienteAuthController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\LogisticaController;
use App\Http\Controllers\ChoferController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas de login para trabajadores (admin, transportistas, etc.)
Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'store']);

// Redirección por roles
//Route::get('/admin/usuarios/crear', [UsuarioInternoController::class, 'create'])
//    ->middleware('auth')->name('admin.usuarios.create');

//Route::post('/admin/usuarios/crear', [UsuarioInternoController::class, 'store'])
//    ->middleware('auth')->name('admin.usuarios.store');


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // 1. Selector de rol
    Route::get('usuarios/roles', [UsuarioInternoController::class, 'chooseRole'])
        ->name('usuarios.roles');

    // 2. Formulario de creación de usuario (recibe id_rol en la URL)
    Route::get('usuarios/crear/{id_rol}', [UsuarioInternoController::class, 'createByRole'])
        ->where('id_rol', '[345]')
        ->name('usuarios.create');

    // 3. Store de usuario: crea el registro en usuarios y redirige
    Route::post('usuarios/crear/{id_rol}', [UsuarioInternoController::class, 'store'])
        ->where('id_rol', '[345]')
        ->name('usuarios.store');

    // 4. Flujo de tablas hijas, por separado:

    // 4a. Choferes
    // Mostrar formulario para completar datos de chofer tras crear el usuario
    Route::get('choferes/crear/{usuario}', [ChoferController::class, 'create'])
        ->name('choferes.create');
    // Guardar datos de chofer
    Route::post('choferes', [ChoferController::class, 'store'])
        ->name('choferes.store');

    // 4b. Vendedores
    Route::get('vendedores/crear/{usuario}', [VendedorController::class, 'create'])
        ->name('vendedores.create');
    Route::post('vendedores', [VendedorController::class, 'store'])
        ->name('vendedores.store');

    // 4c. Logísticas
    Route::get('logisticas/crear/{usuario}', [LogisticaController::class, 'create'])
        ->name('logisticas.create');
    Route::post('logisticas', [LogisticaController::class, 'store'])
        ->name('logisticas.store');

});








//rutas para registro del cliente
Route::get('/cliente/registro', [ClienteAuthController::class, 'showRegisterForm'])->name('cliente.register.form');
Route::post('/cliente/registro', [ClienteAuthController::class, 'register'])->name('cliente.register');

//rutas para el iniisond e sesion
Route::get('/cliente/login', [ClienteAuthController::class, 'showLoginForm'])->name('cliente.login.form');
Route::post('/cliente/login', [ClienteAuthController::class, 'login'])->name('cliente.login');












//rutas crear pedido
Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/pedido/crear', [PedidoController::class, 'crear'])->name('cliente.pedido.crear');
    Route::post('/cliente/pedido/guardar', [PedidoController::class, 'guardar'])->name('cliente.pedido.guardar');
});












//rutas de facturacion
Route::post('/cliente/facturar/{id}', [PedidoController::class, 'facturar'])->name('cliente.facturar');
Route::get('/cliente/facturar/{id}', [PedidoController::class, 'formularioFacturar'])->name('cliente.facturar.form');













//ruta del factrua pendiente en el vendedor
Route::middleware('auth')->group(function () {
    //vendedor
    Route::get('/vendedor/pedidos', [VendedorController::class, 'pedidosPendientes'])->name('vendedor.pedidos');
    Route::post('/vendedor/pedidos/{id}/confirmar', [VendedorController::class, 'confirmarFactura'])->name('vendedor.confirmar.factura');
    

    

    //logistica page principal
    Route::get('/logistica/pedidos', [LogisticaController::class, 'pedidosPendientes'])->name('logistica.pedidos');

    Route::post('/logistica/pedidos/{id}/enviar', [LogisticaController::class, 'marcarComoEnviado'])->name('logistica.enviar.pedido');

    Route::post('/logistica/asignar-camion/{id}', [LogisticaController::class, 'asignarCamion'])->name('logistica.asignar.camion');
});


// Módulo del chofer
Route::middleware('auth')->group(function () {
    Route::get('/chofer/guias', [ChoferController::class, 'guiasAsignadas'])->name('chofer.guias');
    Route::get('/chofer/guias/{id}', [ChoferController::class, 'verGuia'])->name('chofer.guia.detalle');
    Route::post('/chofer/pedido/{id}/entregado', [ChoferController::class, 'marcarEntregado'])->name('chofer.pedido.entregado');
    Route::post('/chofer/pedido/{id}/cancelado', [ChoferController::class, 'marcarCancelado'])->name('chofer.pedido.cancelado');
});


Route::middleware('auth')->group(function () {
    Route::get('/chofer/guias', [ChoferController::class, 'guiasAsignadas'])->name('chofer.guias');
    Route::get('/chofer/guias/{id}', [ChoferController::class, 'verGuia'])->name('chofer.guia.detalle');
    Route::post('/chofer/pedido/{id}/entregado', [ChoferController::class, 'marcarEntregado'])->name('chofer.pedido.entregado');
    Route::post('/chofer/pedido/{id}/cancelado', [ChoferController::class, 'marcarCancelado'])->name('chofer.pedido.cancelado');
});





require __DIR__.'/auth.php';
