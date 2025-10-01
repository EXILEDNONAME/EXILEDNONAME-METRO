<div class="row">
  <div class="col-lg-6">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-body d-flex align-items-center py-0 mt-2">
        <div class="d-flex flex-column flex-grow-1 py-lg-5">
          <a class="card-title font-weight-bolder text-dark-75 mb-2 text-hover-danger"> Welcome, {{ Auth::User()->name }} </a>
        </div>
        <img src="{{ env('APP_URL') }}/assets/backend/media/svg/avatars/029-boy-11.svg" alt="" class="align-self-end h-100px">
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-body d-flex align-items-center py-0 mt-2">
        <div class="d-flex flex-column flex-grow-1 py-lg-5">
          <a class="card-title font-weight-bolder mb-2 mt-2 text-info text-center"> TOTAL USERS </a>
          <a class="card-title font-weight-bolder text-dark-75 mb-4 text-center"> {{ \DB::table('users')->count() }} </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-body d-flex align-items-center py-0 mt-2">
        <div class="d-flex flex-column flex-grow-1 py-lg-5">
          <a class="card-title font-weight-bolder mb-2 mt-2 text-info text-center"> TOTAL DATABLE GENERALS </a>
          <a class="card-title font-weight-bolder text-dark-75 mb-4 text-center"> {{ number_format(\DB::table('system_application_table_generals')->count(), 0, ',', '.') }} </a>
        </div>
      </div>
    </div>
  </div>
</div>
