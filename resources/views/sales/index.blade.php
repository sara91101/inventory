@extends('navbar')

@section('content')

<script>
function showSale(id) {
    fetch(`/sales/${id}`)
        .then(res => res.json())
        .then(data => {

            document.getElementById('m_sale_id').innerText = data.id;
            document.getElementById('m_sale_date').innerText = data.sale_date;
            document.getElementById('m_customer').innerText = data.customers.name;
            document.getElementById('m_total').innerText = data.full_amount;

            let rows = '';
            data.items.forEach(item => {
                rows += `
                    <tr>
                        <td>${item.items.name}</td>
                        <td>${item.unit_price}</td>
                        <td>${item.quantity}</td>
                        <td>${item.full_price}</td>
                    </tr>
                `;
            });

            document.getElementById('m_items').innerHTML = rows;

            $('#saleModal').modal('show');
        })
        .catch(() => alert('حدث خطأ أثناء تحميل البيانات'));
}
</script>

    <!-- View Sale Modal -->
    <div class="modal fade" id="saleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">تفاصيل الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p><strong>رقم الفاتورة:</strong> <span id="m_sale_id"></span></p>
                    <p><strong>التاريخ:</strong> <span id="m_sale_date"></span></p>
                    <p><strong>الزبون:</strong> <span id="m_customer"></span></p>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>العنصر</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th>الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody id="m_items"></tbody>
                    </table>

                    <br><br>

                    <h5 class="text-right">
                        الإجمالي: <span id="m_total"></span>
                    </h5>
                </div>

            </div>
        </div>
    </div>


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a class="badge badge-primary" href="{{ route('sales.create') }}"><i class="fa fa-plus"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    المبيعات
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الفاتوره</th>
                            <th>التاريخ</th>
                            <th>الزبون</th>
                            <th>عدد العناصر</th>
                            <th>الأجمالي</th>
                            <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sales as $sale)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>{{ $sale->id }}</td>
                          <td>{{ $sale->customers->name }}</td>
                          <td>{{ $sale->sale_date }}</td>
                          <td>{{ count($sale->items) }}</td>
                          <td>{{ number_format($sale->full_amount , 2) }}</td>
                          <td>
                            <button class="badge badge-info" onclick="showSale({{ $sale->id }})"><i class="fa fa-eye"></i></button>
                            <a class="badge badge-warning" href="{{route('sales.edit' ,  $sale->id) }}"><i class="fa fa-edit"></i></a>
                            <button class="badge badge-danger" onclick="destroyItem('{{ route('sales.destroy', $sale->id) }}')"><i class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection