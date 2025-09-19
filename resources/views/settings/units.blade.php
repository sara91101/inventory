@extends('navbar')

@section('content')
    <script>
        function editUnit(id) {
            // fill input value
            document.getElementById('unit').value = document.getElementById('unit' + id).innerHTML;

            // set form action dynamically
            let form = document.getElementById('editUnitForm');
            form.action = "/units/" + id; // matches Route::put('/units/{id}')

            // show modal (Bootstrap example)
            $('#edit-unit').modal('show');
        }
    </script>



    <div class="modal fade" id="add-unit" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">إضافة وحدات القياس</h5>
                </div>

                <form method="POST" action="{{ route('units.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i>
                                وحده القياس
                            </label>
                            <input type="text" class="form-control" name="unit" required>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-unit" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">تعديل وحدات القياس</h5>
                </div>
                
                <form method="POST" action="{{ route('units.store') }}" id="editUnitForm">
                    @csrf
                    <div class="modal-body">
                            @method('PUT')
                            <div class="form-group">
                                <label for="unit" class="col-form-label">
                                <i class="text-danger">*</i> وحده القياس</label>
                                <input type="text" class="form-control" id="unit" name="unit">
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
                    <button class="badge badge-primary" data-bs-toggle="modal" data-bs-target="#add-unit" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    وحدات القياس
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>الوحدة</th>
                            <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($units as $unit)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td id="unit{{ $unit->id }}">{{ $unit->unit }}</td>
                          <td>
                            <button class="badge badge-warning"  onclick="editUnit({{ $unit->id }})"><i class="fa fa-edit"></i></button>
                            <button class="badge badge-danger" onclick="destroyItem('{{ route('units.destroy', $unit->id) }}')"><i class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection