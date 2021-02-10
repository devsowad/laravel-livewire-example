@section('title', 'Image')
@section('image', 'btn-light')

    <div>
        <div class="row mt-4 justify-content-center">
            <div class="d-flex w-50 justify-content-center py-4 align-items-center">
                <input wire:model='photo' id="photo" class="d-none" type="file">
                <label for="photo" class="btn btn-lg btn-secondary btn-block">
                    <i class="fa fa-upload mr-2" aria-hidden="true"></i>Choose file</label>
            </div>
        </div>
    </div>
