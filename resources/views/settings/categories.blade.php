@extends('navbar')

@section('content')
    <script>
        function editCategory(id) {
            // fill input value
            document.getElementById('category').value = document.getElementById('category' + id).innerHTML;

            // set form action dynamically
            let form = document.getElementById('editCategoryForm');
            form.action = "/categories/" + id; // matches Route::put('/categories/{id}')

            // show modal (Bootstrap example)
            $('#edit-category').modal('show');
        }
    </script>



    <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">إضافة التصنيفات</h5>
                </div>

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i> التصنيف</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">تعديل التصنيفات</h5>
                </div>
                
                <form method="POST" action="{{ route('categories.store') }}" id="editCategoryForm">
                    @csrf
                    <div class="modal-body">
                            @method('PUT')
                            <div class="form-group">
                                <label for="category" class="col-form-label">
                                <i class="text-danger">*</i> التصنيف</label>
                                <input type="text" class="form-control" id="category" name="category" required>
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
                    <button class="badge badge-primary" data-bs-toggle="modal" data-bs-target="#add-category" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    التصنيفات
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>التصنيف</th>
                            <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($categories as $category)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td id="category{{ $category->id }}">{{ $category->category }}</td>
                          <td>
                            <button class="badge badge-warning"  onclick="editCategory({{ $category->id }})"><i class="fa fa-edit"></i></button>
                            <button class="badge badge-danger" onclick="destroyItem('{{ route('categories.destroy', $category->id) }}')"><i class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection