@section('title', 'Image')
@section('image', 'btn-light')

    <div>
        <div class="row mt-4 justify-content-center">

            <div class="d-flex align-items-center justify-content-center">
                <div id="dropArea" class="p-4 shadow-5 w-50 text-center bg-white">
                    <i class="fas fa-cloud-upload-alt mb-2" style="font-size:110px;"></i><br>
                    <p class="drag-text small-font">Drag & Drop to Upload File <br> OR</p>
                    <button class="btn btn-secondary">BROWSE FILE</button>
                </div>
            </div>

            <div class="d-flex w-50 justify-content-center py-4 align-items-center">
                <form wire:submit.prevent='save' class="w-100">

                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading=true"
                        x-on:livewire-upload-finish="isUploading=false" x-on:livewire-upload-error="isUploading=false"
                        x-on:livewire-upload-progress="progress=$event.detail.progress">

                        <div x-show="isUploading" class="w-100 mb-2">
                            <progress max="100" x-bind:value="progress" class="rounded-3 bg-secondary w-100"></progress>
                        </div>

                        {{-- Multiple image upload input --}}
                        <input multiple wire:target='photos' wire:loading.attr='disabled' wire:model='photos' id="photo"
                            class="d-none" type="file">
                        <label wire:target='photos' wire:loading.class='btn-light' for="photo"
                            class="btn btn-lg btn-secondary btn-block">
                            <i class="fa fa-upload mr-2" aria-hidden="true"></i>Choose file</label>

                        {{-- Photo temporary preview --}}
                        @if ($photos)
                            @foreach ($photos as $photo)
                                <div class="p-relative" wire:key='{{ $loop->index }}'>
                                    <button wire:click="remove({{ $loop->index }})" type="button"
                                        style="position:absolute;top:18px;right:10px;"
                                        class="btn btn-transparent btn-sm btn-floating">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                    <img src="{{ $photo->temporaryUrl() }}" alt="" class="img-fluid my-2 rounded-3">
                                </div>
                            @endforeach
                        @endif

                        {{-- Photo Error --}}
                        @error('photos.*')
                            <button type="button" class="btn btn-danger btn-block">{{ $message }}</button>
                        @enderror

                        {{-- Success message --}}
                        @if (session()->has('successMsg'))
                            <button type="button" class="btn btn-success btn-block">
                                <i class="fa fa-check-circle mr-2"
                                    aria-hidden="true"></i>{{ session()->get('successMsg') }}</button>
                        @endif

                        {{-- Image form submit button --}}
                        @if ($photos)
                            <button wire:loading.attr='disabled' class="btn btn-block btn-lg btn-primary mt-2"
                                type="submit">
                                <span wire:loading.class.remove='d-none'
                                    class="d-none mr-2 spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                                Save</button>
                        @endif
                </form>
            </div>
        </div>
    </div>

@section('extra-js')
    <script>
        document.addEventListener('turbolinks:load', () => {
            const dropArea = document.getElementById('dropArea');
            let files = [];

            dropArea.addEventListener('dragover', (event) => {
                event.preventDefault();
                dropArea.classList.add('active');
            });

            dropArea.addEventListener('dragleave', (event) => {
                event.preventDefault();
                dropArea.classList.remove('active');
            });

            dropArea.addEventListener('drop', (event) => {
                event.preventDefault();
                files = event.dataTransfer.files;
                const input = document.querySelector('input');
                // input.value(files)
            });
        });

    </script>
@endsection
