@extends('navbar')

@section('content')

    <script>
        function fetchBarcode() {
            $.ajax({
                url: "/itemBarcode",  // Laravel route
                type: "GET",
                dataType: "json",
                success: function(response) {
                    document.getElementById('barcode').value = response.code;
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        }
    </script>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary">
                    @if(!is_null($item->image))
                        <img src="/itemImages/{{ $item->image }}" class="img-lg rounded" />
                        &nbsp;&nbsp;
                    @endif
                    تعديل عنصر
                </h4>
            </div>
            <form method="POST" action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body row">
                    <div class="form-group col-6">
                        <label class="col-form-label">
                        <i class="text-danger">*</i> إسم العنصر</label>
                        <input type="text" class="form-control" name="name" value="{{ $item->name }}" required>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-form-label">
                        <i class="text-danger">*</i> سعر البيع</label>
                        <input type="number" step="any" class="form-control" name="price" value="{{ $item->price }}" required>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-form-label">
                        <i class="text-danger">*</i>  وحده القياس</label>
                        <select class="form-control" name="unit_id" required>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" @if($unit->id == $item->unit_id) selected @endif>{{ $unit->unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-form-label">
                        <i class="text-danger">*</i>التصنيف</label>
                        <select class="form-control" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $item->category_id) selected @endif>{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-form-label">
                        صوره توضيحيه</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                    <div class="form-group col-6">
                        <label class="col-form-label">
                            <button class="btn btn-sm btn-primary" onclick="fetchBarcode()" type="button"><i class="mdi mdi-barcode"></i></button>
                            &nbsp;&nbsp;&nbsp;
                            رمز الإستجابه السريع
                        </label>
                        <input type="text" class="form-control" name="barcode" value="{{ $item->barcode }}" id="barcode">
                    </div>
                    <div class="form-group col-12">
                        <label class="col-form-label">الوصف</label>
                        <textarea class="form-control" name="description">{{ $item->description }}</textarea>
                    </div>
                </div>
                <div class="card-footer" align="center">
                    <button class="btn btn-lg btn-block btn-primary" type="submit">تعديل</button>
                </div>
            </form>
        </div>
    </div>

@endsection