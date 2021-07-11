<div style="position:relative;">
  <div style="position:absolute;top:0;right:0;left:0;bottom:24px;background:#e0a9f77a;"
    class="z-9 rounded-3 {{ $ticketId == '' ? '' : 'd-none' }}"></div>
  @if (session()->has('successMsg'))
    <button class="btn btn-success btn-block mb-2">
      {{ session()->get('successMsg') }}
    </button>
  @endif
  <div class="card w-100 shadow-1-strong rounded-3 mb-4">
    <div class="card-body p-4 m-4">
      @if ($image)
        <img class="img-fluid mb-2" src="{{ $image->temporaryUrl() }}" />
      @endif

      <input id="image" wire:model="image" name="image" class="d-none" type="file">


      <label for="image" class="btn btn-secondary btn-block mb-3">
        Choose file</label>

      <form class="form-inline d-flex" wire:submit.prevent="addComment">
        <div class="form-group w-100">
          <input wire:model="comment" type="text" name="comment" id="comment" class="form-control
                                @error('comment') is-invalid @elseif($comment!='') is-valid @enderror">
        </div>
        <div class="form-group">
          <button @error('comment') disabled @enderror wire:loading.attr='disabled' wire:target='addComment'
            {{ $comment == '' ? 'disabled' : '' }} type="submit" class="btn btn-secondary d-flex">
            <span wire:target='addComment' wire:loading.class.remove='d-none'
              class="d-none spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
            submit
          </button>
        </div>
      </form>
      @error('comment')
        <span class="text-danger smaller-font">{{ $message }}</span>
      @enderror
      @error('image')
        <span class="text-danger smaller-font">{{ $message }}</span>
      @enderror
    </div>
  </div>
  @foreach ($comments as $comment)
    <div class="card shadow-5 mb-4 w-100 rounded-3">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between">
          <p class="text-dark small-font f-500">
            {{ $comment->creator->name }}
          </p>
          <div class="d-flex ">
            <p class="text-gray smaller-font">
              {{ $comment->created_at->diffForHumans() }}
            </p>
            <button wire:click="remove({{ $comment->id }})" class="shadow-0 btn btn-white ml-2 btn-floating btn-sm">
              <span wire:target='remove({{ $comment->id }})' wire:loading.class.remove='d-none'
                class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              <i wire:target='remove({{ $comment->id }})' wire:loading.class='d-none' class="fa fa-times"
                aria-hidden="true"></i>
            </button>
          </div>
        </div>
        <p class="text-gray mt-2">
          {{ $comment->body }}
        </p>
        @if ($comment->image != '')
          <img src="{{ asset('storage') . '/' . $comment->image }}" class="img-fluid" />
        @endif
      </div>
    </div>
  @endforeach
  <div class="d-flex justify-content-center align-items-center">
    {{ $comments->links('pagination-links') }}
  </div>
</div>

<script>
  window.livewire.on('fileChoosen', () => {
    const inputField = document.getElementById('image');
    const file = inputField.files[0];

    let reader = new FileReader();
    reader.onloadend = () => {
      window.livewire.emit('fileUpload', reader.result);
    }

    reader.readAsDataURL(file);
  });

</script>
