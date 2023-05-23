<div class="col-md-6 position-relative">
    <h6 class="form-label">Nombre</h6>
    <input name="name" type="text" class="form-control" id="name" required>
    <div class="invalid-feedback">
        Este campo es obligatorio.
    </div>
</div>
<div class="col-md-3">
    <h6 class="form-label">Estado</h6>
    <select name="active" class="form-select" id="active" required>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>
    <div class="invalid-feedback">
        Campo obligatorio.
    </div>
</div>
<div class="col-md-3">
    <h6 class="form-label">Color</h6>
    <input name="color" type="text" id="colorPicker" required>
    <div class="invalid-feedback">
        Este campo es obligatorio.
    </div>
</div>
<div class="col-md-6">
    <h6 class="form-label">Logo</h6>
    <input name="image" type='file' class="form-control" id="image" required />
    <br>
    <img id="blah" style="width: 200px; height: 200px" alt="Preview" />
    <div class="invalid-feedback">
        Este campo es obligatorio.
    </div>
</div>
