
@extends('backend.layouts.master')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Brand /</span> All Brand</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">All Brand</h5>
                <a href="{{ route('brand.create') }}" class="btn btn-block btn-dark">Add Brand</a>
              </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>Title</th>
                  <th>Photo</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach ($brands as $item)
               
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> {{ $loop->iteration }} </td>
                  <td>{{ $item->title }}</td>
                  <td><img style="max-height:50px;max-width:150px;width:100%" src="{{ $item->photo }}" alt=""></td>
                  
                  <td>
                    <input type="checkbox" name="toggle" value="{{ $item->id }}" {{ $item->status =="active"? 'checked':" " }} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                </td>

                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" style="">
                        <a class="dropdown-item" href="{{ route('brand.edit',$item->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        {{-- <a class="dropdown-item" href="{{ route('brand.destroy',$item->id) }}"><i class="bx bx-trash me-1"></i> Delete</a> --}}
                        <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault();
                        document.getElementById('brand-delete-form').submit();">
                          <i class="bx bx-trash me-1"></i> Delete
                        </a>
                          <form id="brand-delete-form" action="{{ route('brand.destroy',$item->id)  }}" method="POST">
                            @csrf
                            @method('delete')
                          </form>
                      </div>
                    </div>
                  </td>
                </tr>
                     
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
       
      </div>
</div>
@endsection

@section('scripts')
    <script>
        $('input[name="toggle"]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                url: "{{ route('brand.status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    mode: mode,
                    id: id
                },
  
                success: function(data) {
                    console.log(data.success)
                }
            });
        })
    </script> 
@endsection
