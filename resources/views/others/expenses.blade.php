@extends('navbar')

@section('content')
    <script>
       function editExpenses(id) {
    // fill inputs
    document.getElementById('price').value = document.getElementById('price' + id).textContent.trim();
    document.getElementById('description').value = document.getElementById('description' + id).textContent.trim();

    // set selects by value (IDs stored in hidden spans)
    document.getElementById('branch_id').value = document.getElementById('branch' + id).textContent.trim();
    document.getElementById('warehouse_id').value = document.getElementById('warehouse' + id).textContent.trim();
    document.getElementById('expense_item_id').value = document.getElementById('item' + id).textContent.trim();

    // update form action
    let form = document.getElementById('editExpenseForm');
    form.action = "/expenses/" + id;

    // show modal
    $('#edit-expense').modal('show');
}

    </script>



    <div class="modal fade" id="add-expense" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">إضافة المصروفات</h5>
                </div>

                <form method="POST" action="{{ route('expenses.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i> التكلفه</label>
                            <input type="number" step="any" class="form-control" name="price" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><i class="text-danger">*</i>البند</label>
                            <select class="form-control" name="expense_item_id">
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">التفاصيل</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">الفرع</label>
                            <select class="form-control" name="branch_id">
                                <option value="">...</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">المخزن</label>
                            <select class="form-control" name="warehouse_id">
                                <option value="">...</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
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

    <div class="modal fade" id="edit-expense" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">تعديل المصروفات</h5>
                </div>

                <form method="POST" action="{{ route('expenses.store') }}" id="editExpenseForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i> التكلفه</label>
                            <input type="number" step="any" class="form-control" name="price" id="price" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><i class="text-danger">*</i>البند</label>
                            <select class="form-control" name="expense_item_id" id="expense_item_id">
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">التفاصيل</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">الفرع</label>
                            <select class="form-control" name="branch_id" id="branch_id">
                                <option value="">...</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">المخزن</label>
                            <select class="form-control" name="warehouse_id" id="warehouse_id">
                                <option value="">...</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
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

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <button class="badge badge-primary" data-bs-toggle="modal" data-bs-target="#add-expense" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    المصروفات
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped text-center" id="order-listing">
                      <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">البند</th>
                            <th class="text-center">التكلفه</th>
                            <th class="text-center">التفاصيل</th>
                            <th class="text-center">الفرع</th>
                            <th class="text-center">المحزن</th>
                            <th class="text-center">العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($expenses as $expense)
                            <span id="branch{{ $expense->id }}" style="display: none;">{{ $expense->branch_id }}</span>
                            <span id="warehouse{{ $expense->id }}" style="display: none;">{{ $expense->warehouse_id }}</span>
                            <span id="item{{ $expense->id }}" style="display: none;">{{ $expense->expense_item_id }}</span>

                            <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $expense->item }}</td>
                            <td id="price{{ $expense->id }}">{{ $expense->price }}</td>
                            <td id="description{{ $expense->id }}">{{ $expense->description }}</td>
                            <td>{{ $expense->branch }}</td>
                            <td>{{ $expense->name }}</td>
                            <td>
                                <button class="badge badge-warning" onclick="editExpenses({{ $expense->id }})"><i class="fa fa-edit"></i></button>
                                <button class="badge badge-danger" onclick="destroyItem('{{ route('expenses.destroy', $expense->id) }}')">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection