@extends('Manager.included.header')


@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    @include('Manager.included.notfication')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ t('Sub Categories Table') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="{{ route('sub_category.add') }}">
                            <button type="button" class="btn btn-brand btn-icon-sm"
                            aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon2-plus"></i>  {{ t('Add New') }}
                            </button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        {{-- التنبيهات --}}
        <div class="kt-portlet__body">



            {{-- For Notfication --}}
           @include('Manager.included.notfication')


            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded"
            id="local_data">








            <div class="card-body">
                <table id="adminDataTable" class="datatable table table-bordered table-striped text-center ">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ t('Name') }} </th>
                    <th>{{ t('Category') }} </th>
                    <th>{{ t('Action') }} </th>
                  </tr>
                  </thead>
                    <tbody>



                    </tbody>
                </table>




                <div id="confirmModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title"> {{ t('Confirmation') }} </h2>
                            </div>
                            <div class="modal-body">
                                <h4 align="center" style="margin:0;">{{ t('Are you sure you want to remove this item ?') }}  </h4>
                                <h4 align="center" style="margin:0;" class="text-danger">{{ t('If this item is deleted, all Items will be deleted') }}  </h4>

                            </div>
                            <div class="modal-footer">
                             <button type="button" name="ok_button" id="ok_button" style="background-color: rgb(236, 67, 67);color:white" class="btn ">{{ t('Delete') }}</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ t('Cancle') }}</button>
                            </div>
                        </div>
                    </div>
                </div>










            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>

@push('scripts')





{{-- For make Delete model --}}
<script type="text/javascript">

    var user_id;

    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function(){
        var url = "{{ route('sub_category.delete',':id') }}";
        url = url.replace(':id', user_id);
        $.ajax({
            url:url,
            type: "POST",

            success:function(data)
            {
                setTimeout(function(){
                $('#confirmModal').modal('hide');
                $('#adminDataTable').DataTable().ajax.reload();
                }, 500);
            }
        })
    });
 </script>

{{-- For Make yajara Datatable --}}
@if (app()->getlocale() == "en")
<script type="text/javascript">

    $(function () {

        var table = $('.datatable').DataTable({

            processing: true,
            serverSide: true,
            paging: false,
            ordering: false,
            info: false,
            searching:false,
            ajax: "{{ route('sub_category.getSubCategoryData') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'cateogry', name: 'cateogry'},

                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

    });
</script>
@else
<script type="text/javascript">

    $(function () {

        var table = $('.datatable').DataTable({
            language: {
                url: "{{asset('dashboard/assets/arabic.json')}}"
            },
            processing: true,
            serverSide: true,
            paging: false,
            ordering: false,
            info: false,
            searching:false,
            ajax: "{{ route('sub_category.getSubCategoryData') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'cateogry', name: 'cateogry'},

                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

    });
</script>
@endif



@endpush
@endsection
