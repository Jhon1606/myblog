{{-- Abrimos "{{ }}" para poder definir una variable y pasarsela cuando llamemos el partial y asi nos ahorramos codigo --}}
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modalLabel }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ $formAction }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $modalLabel }}">{{ $modalTitle }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            {{-- Aqui estamos utilizando el paquete laravel collective para formularios --}}
                            @csrf
                            @if ($methodPut)
                                @method('put')
                            @endif
                            
                            <div class="form-group">    
                                @if ($methodPut)
                                    <input type="hidden" name="id" id="{{ $fieldId }}">
                                @endif
                                <label for="{{ $fieldName }}">Nombre</label>
                                <input class="form-control" type="text" name="name" id="{{ $fieldName }}" placeholder="Ingrese el nombre de la categoria">
                            </div>
                            <div class="form-group">
                                <label for="color">Color: </label>
                                <select class="form-control" name="color" id="{{ $selectId }}">
                                    <option value=""></option>
                                </select>
                            </div>             
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">{{ $submitButton }}</button>
                </div>
            </form>   
        </div>
    </div>
</div>