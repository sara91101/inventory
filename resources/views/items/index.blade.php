@extends('navbar')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a class="badge badge-primary" href="{{ route('items.create') }}">
                        <i class="fa fa-plus"></i>
                    </a>
                    &nbsp;&nbsp;&nbsp;
                    العناصر
                </h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped text-center" id="order-listing">
                      <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th class="text-center">الإسم</th>
                            <th class="text-center">وحده القياس</th>
                            <th class="text-center">الصنف</th>
                            <th class="text-center">السعر</th>
                            <th class="text-center">العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($items as $item)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>
                            @if(!is_null($item->image))
                              <img src="/itemImages/{{ $item->image }}" alt="profile" />
                              &nbsp;&nbsp;
                            @endif
                            {{ $item->name }}
                          </td>
                          <td>{{ $item->unit }}</td>
                          <td >{{ $item->category }}</td>
                          <td >{{ number_format($item->price,2) }}</td>
                          <td>
                            <a href="{{ route('items.edit', $item->id) }}" class="badge badge-warning"><i class="fa fa-edit"></i></a>
                            <button class="badge badge-danger" onclick="destroyItem('{{ route('items.destroy', $item->id) }}')"><i class="fa fa-trash-o"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@endsection