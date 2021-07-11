@section('title', 'Home')
@section('home', 'btn-light')
  <div>

    <div class="row mt-4">
      <div class="col-md-5 col-sm-12">
        @livewire('tickets')
      </div>
      <div class="col-md-7 col-sm-12">
        @livewire('comments')
      </div>
    </div>
  </div>
