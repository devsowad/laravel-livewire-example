@section('title', 'Register')
@section('register', 'btn-light')
  <div>
    <div class="row mt-4">
      <div class="d-flex justify-content-center">
        <div class="card shadow-2-strong rounded-3 w-50">
          <div class="card-body p-5">
            <h1 class="bigger-font text-uppercase text-center mb-4">Register</h1>
            <form wire:submit.prevent='submit'>
              @csrf
              <div class="form-group mb-4">
                <input wire:model='form.name' type="text" placeholder="Name" class="form-control" />
                @error('form.name')
                  <span class="smaller-font text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-4">
                <input wire:model='form.email' type="email" placeholder="Email" class="form-control" />
                @error('form.email')
                  <span class="smaller-font text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-4">
                <input wire:model='form.password' type="password" placeholder="Password" class="form-control" />
                @error('form.password')
                  <span class="smaller-font text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-4">
                <input wire:model='form.password_confirmation' type="password" placeholder="Password Confirmation"
                  class="form-control" />
              </div>
              <div class="d-flex justify-content-center">
                <button wire:target='submit' wire:loading.attr='disabled' type="submit"
                  class="btn btn-block btn-secondary">
                  <span wire:target='submit' wire:loading.class.remove='d-none'
                    class="mr-2 spinner-border d-none spinner-border-sm" role="status" aria-hidden="true"></span>
                  Regsiter</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
