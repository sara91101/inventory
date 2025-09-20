@extends('navbar')

@section('content')
    <script>
        function editCustomer(id) {
            // fill input value
            document.getElementById('name').value = document.getElementById('name' + id).innerHTML;
            document.getElementById('phone').value = document.getElementById('phone' + id).innerHTML;
            document.getElementById('email').value = document.getElementById('email' + id).innerHTML;
            document.getElementById('address').value = document.getElementById('address' + id).innerHTML;

            // set form action dynamically
            let form = document.getElementById('editCustomerForm');
            form.action = "/customers/" + id; // matches Route::put('/customers/{id}')

            // show modal (Bootstrap example)
            $('#edit-customer').modal('show');
        }
    </script>



    <div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">إضافة الزبائن</h5>
                </div>

                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i> الإسم</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">
                                <i class="text-danger">*</i> الهاتف</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">
                                 البريد الإكتروني</label>
                            <input type="email" class="form-control" name="email" >
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">
                                 العنوان</label>
                            <input type="text" class="form-control" name="address" >
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-customer" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">تعديل الزبائن</h5>
                </div>
                
                <form method="POST" action="{{ route('customers.store') }}" id="editCustomerForm">
                    @csrf
                    <div class="modal-body">
                            @method('PUT')
                            <div class="form-group">
                                <label for="customer" class="col-form-label">
                                <i class="text-danger">*</i> الإسم</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">
                                    <i class="text-danger">*</i> الهاتف</label>
                                <input type="text" class="form-control" name="phone" id="phone" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">
                                    البريد الإكتروني</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">
                                    العنوان</label>
                                <input type="text" class="form-control" name="address" id="address">
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
                    <button class="badge badge-primary" data-bs-toggle="modal" data-bs-target="#add-customer" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    الزبائن
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped text-center" id="order-listing">
                      <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">الإسم</th>
                            <th class="text-center">الهاتف</th>
                            <th class="text-center">البريد الإلكتروني</th>
                            <th class="text-center">العنوان</th>
                            <th class="text-center">العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($customers as $customer)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td id="name{{ $customer->id }}">{{ $customer->name }}</td>
                          <td id="phone{{ $customer->id }}">{{ $customer->phone }}</td>
                          <td id="email{{ $customer->id }}">{{ $customer->email }}</td>
                          <td id="address{{ $customer->id }}">{{ $customer->address }}</td>
                          <td>
                            <button class="badge badge-warning"  onclick="editCustomer({{ $customer->id }})"><i class="fa fa-edit"></i></button>
                            <button class="badge badge-danger" onclick="destroyItem('{{ route('customers.destroy', $customer->id) }}')"><i class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection