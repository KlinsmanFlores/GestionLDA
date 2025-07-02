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
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\Admin\FlotaController;

// Página de bienvenida
Route::get('/inicio', function () {
    return view('welcome');
});

// Rutas de login para trabajadores (admin, transportistas, etc.)
Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'store']);

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

// Cerrar sesión del cliente
Route::post('/cliente/logout', [ClienteAuthController::class, 'logout'])
        ->name('cliente.logout')
        ->middleware('auth');


//rutas crear pedido
Route::middleware(['auth'])->group(function () {
    // Crear pedido
    Route::get('/cliente/pedido/crear', [PedidoController::class, 'crear'])
        ->name('cliente.pedido.crear');
    Route::post('/cliente/pedido/guardar', [PedidoController::class, 'guardar'])
        ->name('cliente.pedido.guardar');

    // Editar detalle de pedido
    Route::get(
        '/cliente/pedido/detalle/{detalle}/editar',
        [PedidoController::class, 'editarDetalle']
    )->name('cliente.pedido.editarDetalle');

    // Actualizar detalle de pedido
    Route::put(
        '/cliente/pedido/detalle/{detalle}',
        [PedidoController::class, 'actualizarDetalle']
    )->name('cliente.pedido.actualizarDetalle');

    // Eliminar detalle de pedido
    Route::delete(
        '/cliente/pedido/detalle/{detalle}',
        [PedidoController::class, 'eliminarDetalle']
    )->name('cliente.pedido.eliminarDetalle');
});


//rutas de facturacion
Route::middleware('auth')->prefix('cliente')->group(function () {
    // 1) Formulario de facturación
    Route::get(
        'pedido/{id}/facturar',
        [FacturacionController::class, 'formularioFacturar']
    )->name('cliente.facturar.form');
    // 2) Procesar pago y crear factura
    Route::post(
        'pedido/{id}/facturar',
        [FacturacionController::class, 'pagar']
    )->name('cliente.facturar.pagar');
    // 3) Mostrar factura en solo lectura
    Route::get(
        'factura/{id}',
        [FacturacionController::class, 'mostrarFactura']
    )->name('cliente.factura.mostrar');
});


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

//Administrador CRUD los vehiculos
Route::middleware(['auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function(){
            Route::resource('flota', FlotaController::class)
                ->parameters(['flota' => 'flota'])
                ->except(['show']);
    });






require __DIR__.'/auth.php';
