@extends('layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Tipos de Usuarios</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Usuarios</li>
                <li class="breadcrumb-item active">Tipos de Usuarios</li>
            </ol>
        </nav>
    </div>
    <div class=" card">
        <div class="card-body">
            <div style="display: flex; justify-content: right;" class="py-3">
                <button onclick="showCreate()" class="btn btn-primary rounded-3"><i class="fa-solid fa-plus"></i> Crear</button>
            </div>
            <table id="user-types-table" class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-edit" tabindex="-1">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content rounded-5 px-4 py-2">
                <div class="modal-header">
                    <h5 class="modal-title ">Editar Registro</h5>
                    <button type="button" class="btn fw-bold" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body align-content-center">
                    <form class="row g-3 needs-validation" method="POST" novalidate id="form-edit">
                        @method('PUT')
                        @csrf
                        <div class="col-md-4 position-relative">
                            <h6 for="validationTooltip01" class="form-label">Descripción</h6>
                            <input name="description" type="text" class="form-control" id="edit-description" required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6 for="validationDefault04" class="form-label">Estado</h6>
                            <select name="active" class="form-select" id="edit-status" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel rounded-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-submit rounded-4" form="form-edit">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <div class="modal fade " id="modal-create" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-5 px-4 py-2">
                <div class="modal-header">
                    <h5 class="modal-title ">Nuevo Registro</h5>
                    <button type="button" class="btn fw-bold" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body align-content-center">
                    <form class="row g-3 needs-validation" method="POST" novalidate id="form-create">
                        @csrf
                        <div class="col-md-4 position-relative">
                            <h6 for="validationTooltip01" class="form-label">Descripción</h6>
                            <input name="description" type="text" class="form-control" id="create-description" required>
                            <div class="invalid-feedback">
                                Este campo es obligatorio.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6 for="validationDefault04" class="form-label">Estado</h6>
                            <select name="active" class="form-select" id="create-status" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel rounded-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-submit rounded-4" form="form-create">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="assets/js/users/types.js"></script>
@endpush
