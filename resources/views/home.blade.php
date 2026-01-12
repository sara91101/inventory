@extends('navbar')

@section('content')
<script>

    let sales = @json($sales);
    let purchases = @json($purchases);
</script>
<div class="container">
    <div class="justify-content-center">
            <div class="card">
                <div class="card-header">المشتريات والمبيعات</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                                  <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                    <div class="me-3">
                                      <div id="marketingOverview-legend"></div>
                                    </div>
                                  </div>
                                  <div class="chartjs-bar-wrapper mt-3">
                                    <canvas id="marketingOverview"></canvas>
                                  </div>


            </div>
        </div>
    </div>
</div>
@endsection
