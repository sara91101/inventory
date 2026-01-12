@extends('navbar')

@section('content')
    <script>
        function addItem() {
            let wrapper = document.getElementById('items-wrapper');
            let firstRow = wrapper.querySelector('.item-row');
            let newRow = firstRow.cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelector('select').value = '';

            wrapper.appendChild(newRow);
            calculateInvoiceTotal();
        }

        function removeItem(btn) {
            let wrapper = document.getElementById('items-wrapper');
            let rows = wrapper.querySelectorAll('.item-row');

            if (rows.length === 1) {
                alert('لا يمكن حذف آخر عنصر');
                return;
            }

            btn.closest('.item-row').remove();
            calculateInvoiceTotal();
        }

        function selectPrice(select) {
            let price = select.options[select.selectedIndex].getAttribute('data-price');
            let row = select.closest('.item-row');
            row.querySelector('.unit-price').value = price || 0;
            calculateRowTotal(row);
        }

        function calculateTotal(input) {
            let row = input.closest('.item-row');
            calculateRowTotal(row);
        }

        function calculateRowTotal(row) {
            let price = parseFloat(row.querySelector('.unit-price').value) || 0;
            let qty = parseFloat(row.querySelector('.quantity').value) || 0;
            row.querySelector('.full-price').value = price * qty;
            calculateInvoiceTotal();
        }

        function calculateInvoiceTotal() {
            let total = 0;
            document.querySelectorAll('.full-price').forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            document.getElementById('full_amount').value = total;
        }
    </script>



    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a class="badge badge-primary" href="{{ route('sales.create') }}"><i class="fa fa-plus"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    إضافة المبيعات
                </h4>

                
            <form method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                    <div class="form-group col-4">
                        <label class="col-form-label">
                        <i class="text-danger">*</i>  التاريخ</label>
                        <input type="date" class="form-control" name="sale_date" required>
                    </div>
                    <div class="form-group col-4">
                        <label class="col-form-label">
                        <i class="text-danger">*</i>الزيون</label>
                        <select class="form-control" name="customer_id" required>
                                <option value="">...</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label class="col-form-label">
                        <i class="text-danger">*</i>  اجمالي الفاتوره</label>
                        <input type="number" step="any" class="form-control" name="full_amount" id="full_amount" required readonly>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" type="button" onclick="addItem()">
                                <i class="bx bx-plus"></i> عنصر أخر
                            </button>
                        </div>
                        
                        <div id="items-wrapper">
                            <div class="row item-row">
                                <div class="form-group col-5">
                                    <label class="col-form-label">
                                        <i class="text-danger">*</i> العنصر
                                    </label>
                                    <select class="form-control item-select" name="items[]" onchange="selectPrice(this)" required>
                                        <option value="">...</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-2">
                                    <label class="col-form-label">
                                        <i class="text-danger">*</i> السعر
                                    </label>
                                    <input type="number" class="form-control unit-price" name="unit_prices[]" readonly>
                                </div>

                                <div class="form-group col-2">
                                    <label class="col-form-label">
                                        <i class="text-danger">*</i> الكمية
                                    </label>
                                    <input type="number" class="form-control quantity" name="quantities[]" oninput="calculateTotal(this)" required>
                                </div>

                                <div class="form-group col-2">
                                    <label class="col-form-label">
                                        <i class="text-danger">*</i> الإجمالي
                                    </label>
                                    <input type="number" class="form-control full-price" name="full_prices[]" readonly>
                                </div>

                                <div class="form-group col-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="form-group col-12">
                        <label class="col-form-label">ملاحظات</label>
                        <textarea class="form-control" name="notes"></textarea>
                    </div>
                </div>
                <div class="card-footer" align="center">
                    <button class="btn btn-lg btn-block btn-primary" type="submit">حفظ</button>
                </div>
            </form>
            </div>
        </div>
    </div>



@endsection