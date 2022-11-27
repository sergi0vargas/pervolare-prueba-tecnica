@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Attributes <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-success">+</button></h2>
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
                            <th>Type</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>SoftDelete</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->status ? 'Active' : 'Deleted' }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->soft_delete }}</td>
                                <td>
                                    @if ($item->status)
                                        <form action="{{ url('/attributes', ['id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="Delete" />
                                        </form>
                                    @else
                                        <form action="{{ url('/attributes', ['id' => $item->id]) }}" method="post">
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
                            <th>Type</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>SoftDelete</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Agregar -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="AddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAdd" class="basicform" action="{{ route('attributes.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input required class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select required class="form-control" name="type" id="type">
                                <option value="Color">Color</option>
                                <option value="Talla">Talla</option>
                                <option value="Marca">Marca</option>
                                <option value="Fabrica">Fabrica</option>
                            </select>
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
@endsection
