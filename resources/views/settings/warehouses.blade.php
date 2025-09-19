@extends('navbar')

@section('content')
    <script>
    function editWarehouse(id) {
        // fill input values
        document.getElementById('warehouse').value = document.getElementById('warehouse' + id).innerHTML.trim();
        document.getElementById('address').value = document.getElementById('address' + id).innerHTML.trim();

        // get branch value from table cell
        var warehouseBranch = document.getElementById('branch' + id).innerHTML.trim();

        // set dropdown selected value
        let branches = document.getElementById('branch_id'); // <select>
        for (let i = 0; i < branches.options.length; i++) {
            if (branches.options[i].text.trim() === warehouseBranch) {
                branches.options[i].selected = true;
                break;
            }
        }

        // set form action dynamically
        let form = document.getElementById('editWarehouseForm');
        form.action = "/warehouses/" + id; // Route::put('/warehouses/{id}')

        // show modal (Bootstrap)
        $('#edit-warehouse').modal('show');
    }

    </script>



    <div class="modal fade" id="add-warehouse" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">إضافة المخازن</h5>
                </div>

                <form method="POST" action="{{ route('warehouses.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i>
                               الإسم
                            </label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">
                               العنوان
                            </label>
                            <input type="text" class="form-control" name="address">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><i class="text-danger">*</i>الفرع</label>
                            <select class="form-control" name="branch_id">
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-warehouse" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">تعديل المخازن</h5>
                </div>
                
                <form method="POST" action="{{ route('warehouses.store') }}" id="editWarehouseForm">
                    @csrf
                    <div class="modal-body">
                            @method('PUT')
                            <div class="form-group">
                                <label for="warehouse" class="col-form-label"> 
                                <i class="text-danger">*</i> وحده القياس</label>
                                <input type="text" class="form-control" id="warehouse" name="name">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">
                                العنوان
                                </label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"><i class="text-danger">*</i>الفرع</label>
                                <select class="form-control" name="branch_id" id="branch_id">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">تعديل</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <button class="badge badge-primary" data-bs-toggle="modal" data-bs-target="#add-warehouse" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    المخازن
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>العنوان</th>
                            <th>الفرع</th>
                            <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($warehouses as $warehouse)
                        <span id="branch{{ $warehouse->branch_id }}" style="display: none;">{{ $warehouse->branch_id }}</span>
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td id="warehouse{{ $warehouse->id }}">{{ $warehouse->name }}</td>
                          <td id="address{{ $warehouse->id }}">{{ $warehouse->address }}</td>
                          <td >{{ $warehouse->branch }}</td>
                          <td>
                            <button class="badge badge-warning"  onclick="editWarehouse({{ $warehouse->id }})"><i class="fa fa-edit"></i></button>
                            <button class="badge badge-danger" onclick="destroyItem('{{ route('warehouses.destroy', $warehouse->id) }}')"><i class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection