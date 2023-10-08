<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center text-primary">Create New Password</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto p-3 bg-light rounded border">
           <div class="my-3">
            @if(Session::has('success'))
              <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('fail'))
              <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
           </div>
           <form wire:submit="CreateNewPassword" action="{{ URL::to('/createnewpassword') }}" method="post">
            @csrf
             <div class="my-3">
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="text" wire:model.live="email" name="email" class="form-control form-control-lg" placeholder="Enter your email address...">
                </div>
                <div class="my-2">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
             </div>
             <div class="my-3">
                <label for="password">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" wire:model.live="password" name="password" class="form-control form-control-lg" placeholder="Password...">
                </div>
                <div class="my-2">
                    @error('password')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
             </div>
             <div class="my-3">
                <label for="password_confirmation">Password Confirmation</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" wire:model.live="password_confirmation" name="password_confirmation" class="form-control form-control-lg" placeholder="Password Confirmation...">
                </div>
                <div class="my-2">
                    @error('password_confirmation')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
             </div>
             <div class="my-3">
                <input type="submit" value="Save Password" class="form-control btn btn-lg btn-primary">
             </div>
           </form>
        </div>
    </div>
 </div>