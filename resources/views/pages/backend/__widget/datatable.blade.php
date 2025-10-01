@push('head')
<link rel="stylesheet" href="{{ env('APP_URL') }}{{ mix('css/datatable-index.css') }}">
@endpush

<div class="row">
  <div class="col-lg-12">
    <div class="card card-custom gutter-b" data-card="true" id="exilednoname_datatable">
      <div class="card-header">
        <div class="card-title">
          <h3 class="card-label"> Datatable </h3>
        </div>
        <div class="card-toolbar">
          <a href="javascript:void(0);" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle">
            <i class="fas fa-caret-down"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-separate table-head-custom table-checkable table-sm" id="exilednoname_table">
            <thead>
              <tr>
                <th> ID </th>
                <th> Nama </th>
                <th> Description </th>
                <th> Created At </th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
<script> var card = new KTCard('exilednoname_datatable'); </script>
<script src="{{ env('APP_URL') }}{{ mix('js/datatable-extensions.js') }}"></script>
<script>
  $(function () {
    $('#exilednoname_table').DataTable({
      serverSide: true,
      searching: false,
      lengthChange: false,
      paging: false,
      info: false,
      ajax: '/dashboard/widget/datatable',
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', 'className': 'align-middle text-nowrap text-center', orderable: false, searchable: false },
        { data: 'name', name: 'name', 'className': 'align-middle text-nowrap' },
        { data: 'description', name: 'description' },
        { data: 'created_at', name: 'created_at' }
      ],
      order: [3, 'asc']
    });
  });
</script>
@endpush
