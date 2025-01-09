@extends('doctor.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('doctor.layouts.notification')
         </div>
     </div>
     
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Danh sách bệnh nhân</h6>
      <a href="{{route('patients.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Thêm bệnh nhân"><i class="fas fa-plus"></i> Thêm bệnh nhân</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="patient-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Ngày nhập viện</th>
              <th>Tên bệnh nhân</th>
              <th>Bác sĩ phụ trách</th>
              <th>Bệnh</th>
              <th>Trạng thái</th>
              <th>Số phòng</th>
              <th>Hoạt động</th>
            </tr>
          </thead>
          <tbody>
            @foreach($patients as $patient)   
                <tr>
                    <td>{{$patient->id}}</td>
                    <td>{{$patient->date_check_in}}</td>
                    <td>{{$patient->patient_name}}</td>
                    <td>{{$patient->doctor_assigned}}</td>
                    <td>{{$patient->disease}}</td>
                    <td>
                        @if($patient->status == 'Đang điều trị')
                            <span class="badge badge-success">{{$patient->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$patient->status}}</span>
                        @endif
                    </td>
                    <td>{{$patient->room_no}}</td>
                    <td>
                        <a href="{{route('patients.edit', $patient->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Chỉnh sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('patients.destroy',[$patient->id])}}">
                          @csrf 
                          @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id="{{$patient->id}}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$patients->links()}}</span>
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .sidebar {
        background-color: #0924ec !important;
        background-image: linear-gradient(113deg, #314aff 10%, #60616f 100%) !important;
        background-size: cover !important;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#patient-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[6,7]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              e.preventDefault();
              swal({
                    title: "Bạn có chắc không?",
                    text: "Sau khi xóa, bạn sẽ không thể khôi phục dữ liệu này!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Dữ liệu của bạn an toàn!");
                    }
                });
          })
      })
  </script>
@endpush
