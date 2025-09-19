@extends('navbar')

@section('content')
    <script>
        function editBranch(id) {
            // fill input value
            document.getElementById('branch').value = document.getElementById('branch' + id).innerHTML;

            // set form action dynamically
            let form = document.getElementById('editBranchForm');
            form.action = "/branches/" + id; // matches Route::put('/branches/{id}')

            // show modal (Bootstrap example)
            $('#edit-branch').modal('show');
        }
    </script>



    <div class="modal fade" id="add-branch" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">إضافة الفروع</h5>
                </div>

                <form method="POST" action="{{ route('branches.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i> الفرع</label>
                            <input type="text" class="form-control" name="branch" required>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-branch" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">تعديل الفروع</h5>
                </div>
                
                <form method="POST" action="{{ route('branches.store') }}" id="editBranchForm">
                    @csrf
                    <div class="modal-body">
                            @method('PUT')
                            <div class="form-group">
                                <label for="branch" class="col-form-label">
                                <i class="text-danger">*</i> الفرع</label>
                                <input type="text" class="form-control" id="branch" name="branch" required>
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
                    <button class="badge badge-primary" data-bs-toggle="modal" data-bs-target="#add-branch" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    الفروع
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>الفرع</th>
                            <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($branches as $branch)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td id="branch{{ $branch->id }}">{{ $branch->branch }}</td>
                          <td>
                            <button class="badge badge-warning"  onclick="editBranch({{ $branch->id }})"><i class="fa fa-edit"></i></button>
                            <button class="badge badge-danger" onclick="destroyItem('{{ route('branches.destroy', $branch->id) }}')"><i class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection