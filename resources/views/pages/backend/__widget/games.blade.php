<div class="row">
  <div class="col-lg-4">
    <div class="card card-custom gutter-b" data-card="true" id="exilednoname_score">
      <div class="card-header">
        <div class="card-title">
          <h3 class="card-label"> Score </h3>
        </div>
        <div class="card-toolbar">
          <a href="javascript:void(0);" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle">
            <i class="fas fa-caret-down"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-borderless table-sm" id="exilednoname_table_score">
          <tr>
            <th> {{ Auth::User()->name }} </th>
            <th class="text-right">
              @if(!empty(\DB::table('system_games')->where('id', Auth::User()->id)->first()->score))
              {{ \DB::table('system_games')->where('id', Auth::User()->id)->first()->score }}
              @endif
            </th>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card card-custom gutter-b" data-card="true" id="exilednoname_games">
      <div class="card-header">
        <div class="card-title">
          <h3 class="card-label"> Games </h3>
        </div>
        <div class="card-toolbar">
          <a href="javascript:void(0);" class="btn btn-icon btn-xs btn-hover-light-primary" data-card-tool="toggle">
            <i class="fas fa-caret-down"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table-sm">
            <tr>
              <td class="text-nowrap" width=""> Waktu </td>
              <td class="text-nowrap"> : <span class="time"><span><b>60</b> detik</span></span></td>
            </tr>
            <tr>
              <td class="text-nowrap" width=""> Kata Kunci </td>
              <td class="text-nowrap"> : <span class="word"></span></td>
            </tr>
          </table>
        </div>
        <hr>
        <input id="user" data-id="{{ Auth::User()->id }}" class="form-control" name="created_by" type="hidden" value="{{ Auth::User()->id }}">
        <div class="form-group row">
          <input id="gameInput" data-id="{{ Auth::User()->id }}" class="form-control" type="text" spellcheck="false" placeholder="Ketik Jawaban Disini" required>
        </div>
        <div class="form-group row form-horizontal">
          <button class="btn btn-success font-weight-bold mr-2 refresh-word"> Ke Pertanyaan Baru </button>
          <button id="gameButton" class="btn btn-success font-weight-bold check-word"> Cek Jawaban </button>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/games/word-scramble/js/words.js" defer></script>
<script src="{{ env('APP_URL') }}/assets/backend/games/word-scramble/js/script.js" defer></script>
<script>
  var input = document.getElementById("gameInput");
  input.addEventListener("keypress", function(event) { if (event.key === "Enter") { checkWord(); } });
</script>
<script>
  var card = new KTCard('exilednoname_score');
  var card = new KTCard('exilednoname_games');
</script>
@endpush
