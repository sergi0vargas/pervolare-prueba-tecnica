@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Products <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-success">+</button>
                </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Description</th>
                            <th>Attributes</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>SoftDelete</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->status ? 'Active' : 'Deleted' }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->value }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    @if ($item->attributes->count() > 0)
                                        @foreach ($item->attributes as $attr)
                                            {{ $attr->type }} - {{ $attr->name }} <br>
                                        @endforeach
                                    @else
                                        None
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->soft_delete }}</td>
                                <td>
                                    @if ($item->status)
                                        @if ($attributes->count() > 0)
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#addAttr" data-bs-nameprod="{{ $item->name }}"
                                                data-bs-idprod="{{ $item->id }}">Add
                                                Attribute</button>
                                        @endif
                                    @endif

                                </td>
                                <td>
                                    @if ($item->status)
                                        <form action="{{ url('/products', ['id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="Delete" />
                                        </form>
                                    @else
                                        <form action="{{ url('/products', ['id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input class="btn btn-success" type="submit" value="Activate" />
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Description</th>
                            <th>Attributes</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>SoftDelete</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Product -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="AddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAdd" class="basicform" action="{{ route('products.store') }}" class="basicform"
                        method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input class="form-control" type="number" min="1" name="value" id="value">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input class="form-control" type="text" minlength="10" maxlength="500" name="description"
                                id="description">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button form="formAdd" type="submit" class="btn btn-primary basicbtn">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Attribute -->
    <div class="modal fade" id="addAttr" tabindex="-1" aria-labelledby="AddAttrLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddAttrLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formaddAttr" class="basicform" action="" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="idprod" id="idprod">
                        <div class="form-group">
                            <label for="name">Attribute to add:</label>
                            <select required class="form-control" name="attribute" id="attribute">
                                @foreach ($attributes as $item)
                                    <option value="{{ $item->id }}">{{ $item->type }} - {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button form="formaddAttr" type="submit" class="btn btn-primary basicbtn">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var addAttr = document.getElementById('addAttr');
        addAttr.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var idprod = button.getAttribute('data-bs-idprod');

            var nameprod = button.getAttribute('data-bs-nameprod');
            var modalTitle = addAttr.querySelector('.modal-title');
            modalTitle.textContent = 'Add Attribute to ' + nameprod;

            var inputid = addAttr.querySelector('#idprod');
            inputid.value = idprod;

            var formAdd = addAttr.querySelector('#formaddAttr');
            formAdd.action = '/products/addAttr/' + idprod;
        })
    </script>
@endsection
