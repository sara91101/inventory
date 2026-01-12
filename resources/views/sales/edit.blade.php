@extends('navbar')

@section('content')

<script>
function addItem() {
    let wrapper = document.getElementById('items-wrapper');
    let firstRow = wrapper.querySelector('.item-row');
    let newRow = firstRow.cloneNode(true);

    newRow.querySelectorAll('input').forEach(i => i.value = '');
    newRow.querySelector('select').value = '';

    wrapper.appendChild(newRow);
    calculateInvoiceTotal();
}

function removeItem(btn) {
    let rows = document.querySelectorAll('.item-row');
    if (rows.length === 1) {
        alert('لا يمكن حذف آخر عنصر');
        return;
    }
    btn.closest('.item-row').remove();
    calculateInvoiceTotal();
}

function selectPrice(select) {
    let price = select.options[select.selectedIndex].dataset.price || 0;
    let row = select.closest('.item-row');
    row.querySelector('.unit-price').value = price;
    calculateRowTotal(row);
}

function calculateTotal(input) {
    calculateRowTotal(input.closest('.item-row'));
}

function calculateRowTotal(row) {
    let price = parseFloat(row.querySelector('.unit-price').value) || 0;
    let qty = parseFloat(row.querySelector('.quantity').value) || 0;
    row.querySelector('.full-price').value = price * qty;
    calculateInvoiceTotal();
}

function calculateInvoiceTotal() {
    let total = 0;
    document.querySelectorAll('.full-price').forEach(i => {
        total += parseFloat(i.value) || 0;
    });
    document.getElementById('full_amount').value = total;
}
</script>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">تعديل فاتورة رقم {{ $sale->id }}</h4>

        <form method="POST" action="{{ route('sales.update', $sale->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-4">
                    <label>التاريخ</label>
                    <input type="date" name="sale_date" class="form-control"
                           value="{{ $sale->sale_date }}" required>
                </div>

                <div class="col-4">
                    <label>الزبون</label>
                    <select name="customer_id" class="form-control" required>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ $sale->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <label>إجمالي الفاتورة</label>
                    <input type="number" id="full_amount" name="full_amount"
                           class="form-control" readonly
                           value="{{ $sale->full_amount }}">
                </div>
            </div>

            <hr>

            <button type="button" class="btn btn-primary mb-2" onclick="addItem()">
                <i class="bx bx-plus"></i> عنصر آخر
            </button>

            <div id="items-wrapper">
                @foreach($sale->items as $row)
                <div class="row item-row">
                    <div class="col-5">
                        <label>العنصر</label>
                        <select class="form-control" name="items[]"
                                onchange="selectPrice(this)" required>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}"
                                    data-price="{{ $item->price }}"
                                    {{ $row->item_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2">
                        <label>السعر</label>
                        <input type="number" class="form-control unit-price"
                               name="unit_prices[]" value="{{ $row->unit_price }}" readonly>
                    </div>

                    <div class="col-2">
                        <label>الكمية</label>
                        <input type="number" class="form-control quantity"
                               name="quantities[]" value="{{ $row->quantity }}"
                               oninput="calculateTotal(this)" required>
                    </div>

                    <div class="col-2">
                        <label>الإجمالي</label>
                        <input type="number" class="form-control full-price"
                               name="full_prices[]" value="{{ $row->full_price }}" readonly>
                    </div>

                    <div class="col-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm"
                                onclick="removeItem(this)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-3">
                <label>ملاحظات</label>
                <textarea name="notes" class="form-control">{{ $sale->notes }}</textarea>
            </div>

            <button class="btn btn-success mt-3 w-100">تحديث</button>
        </form>
    </div>
</div>

@endsection
