@extends('navbar')

@section('content')
    <script>
        function editItem(id) {
            // fill input value
            document.getElementById('item').value = document.getElementById('item' + id).innerHTML;

            // set form action dynamically
            let form = document.getElementById('editItemForm');
            form.action = "/expenseItems/" + id; // matches Route::put('/items/{id}')

            // show modal (Bootstrap example)
            $('#edit-item').modal('show');
        }
    </script>



    <div class="modal fade" id="add-item" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">إضافة بنود الصرف</h5>
                </div>

                <form method="POST" action="{{ route('expenseItems.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i> بند الصرف</label>
                            <input type="text" class="form-control" name="item" required>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">تعديل بنود الصرف</h5>
                </div>
                
                <form method="POST" action="{{ route('expenseItems.store') }}" id="editItemForm">
                    @csrf
                    <div class="modal-body">
                            @method('PUT')
                            <div class="form-group">
                                <label for="item" class="col-form-label">
                                <i class="text-danger">*</i> بند الصرف</label>
                                <input type="text" class="form-control" id="item" name="item" required>
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
                    <button class="badge badge-primary" data-bs-toggle="modal" data-bs-target="#add-item" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    وحدات الصرف
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>بند الصرف</th>
                            <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($items as $item)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td id="item{{ $item->id }}">{{ $item->item }}</td>
                          <td>
                            <button class="badge badge-warning"  onclick="editItem({{ $item->id }})"><i class="fa fa-edit"></i></button>
                            <button class="badge badge-danger" onclick="destroyItem('{{ route('expenseItems.destroy', $item->id) }}')"><i class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection