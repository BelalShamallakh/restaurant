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
                    {{ t('Items Table') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="{{ route('item.add') }}">
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

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ t('Category') }} </label>

                            <select class="form-control filter_category" name="filter_category" id="filter_category">
                                <option value="" disabled selected>{{ t('Category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group" align="center">
                            <button type="button" id="reset" class="btn btn-label-brand btn-icon-sm"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-history"></i>  {{ t('Reset') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>



                <table id="adminDataTable" class="datatable table table-bordered table-striped text-center ">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ t('Image') }} </th>
                    <th>{{ t('Name') }} </th>
                    <th>{{ t('Sub Category') }} </th>
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
        var url = "{{ route('item.delete',':id') }}";
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


    $(document).ready(function(){

    fill_datatable();

    function fill_datatable(filter_category = '')
    {
        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            ordering: false,
            info: false,
            searching:false,
            ajax:{
                url: "{{ route('item.getItemData') }}",
                data:{filter_category:filter_category}
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'sub_cateogry', name: 'sub_cateogry'},
                {data: 'category', name: 'category'},

                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

    }

    $('.filter_category').change(function(){
            var filter_category = $('.filter_category').val();

            if(filter_category != '')
            {
                $('.datatable').DataTable().destroy();
                fill_datatable(filter_category);
            }

        });
        $('#reset').click(function(){
            $('.filter_category').val('');
            $('.dataTable').DataTable().destroy();
            fill_datatable();
        });


    });
</script>


@else
<script type="text/javascript">


    $(document).ready(function(){

    fill_datatable();

    function fill_datatable(filter_category = '')
    {
        var table = $('.datatable').DataTable({
            language: {
                url: "{{asset('dashboard/assets/arabic.json')}}"
            },
            processing: true,
            serverSide: true,
            paging: true,
            ordering: false,
            info: false,
            searching:false,
            ajax:{
                url: "{{ route('item.getItemData') }}",
                data:{filter_category:filter_category}
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'sub_cateogry', name: 'sub_cateogry'},
                {data: 'category', name: 'category'},

                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });

    }

    $('.filter_category').change(function(){
            var filter_category = $('.filter_category').val();

            if(filter_category != '')
            {
                $('.datatable').DataTable().destroy();
                fill_datatable(filter_category);
            }

        });
        $('#reset').click(function(){
            $('.filter_category').val('');
            $('.dataTable').DataTable().destroy();
            fill_datatable();
        });


    });
</script>
@endif



@endpush
@endsection
