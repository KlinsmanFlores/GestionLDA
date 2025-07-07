<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block mb-1 font-medium">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block mb-1 font-medium">Peso (kg)</label>
        <input type="number" step="0.01" name="peso" value="{{ old('peso', $producto->peso ?? '') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block mb-1 font-medium">Unidad</label>
        <input type="text" name="unidad_medida" value="{{ old('unidad_medida', $producto->unidad_medida ?? '') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block mb-1 font-medium">PVP (S/)</label>
        <input type="number" step="0.01" name="pvp" value="{{ old('pvp', $producto->pvp ?? '') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block mb-1 font-medium">Alto (cm)</label>
        <input type="number" name="alto" value="{{ old('alto', $producto->alto ?? '') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block mb-1 font-medium">Ancho (cm)</label>
        <input type="number" name="ancho" value="{{ old('ancho', $producto->ancho ?? '') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block mb-1 font-medium">Largo (cm)</label>
        <input type="number" name="largo" value="{{ old('largo', $producto->largo ?? '') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block mb-1 font-medium">Stock Mano</label>
        <input type="number" name="stock_mano" value="{{ old('stock_mano', $producto->stock_mano ?? '') }}" class="w-full border rounded p-2">
    </div>
    <div>
        <label class="block mb-1 font-medium">Stock Tránsito</label>
        <input type="number" name="stock_transito" value="{{ old('stock_transito', $producto->stock_transito ?? '') }}" class="w-full border rounded p-2">
    </div>
</div>
