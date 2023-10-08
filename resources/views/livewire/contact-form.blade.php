<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-primary text-center">Contact Us</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto rounded bg-light p-4">
            <div class="my-3">
                @if(Session::has('success'))
                  <div class="alert alert-success">{{ Session::get('success') }}</div>
                @elseif(Session::has('fail'))
                  <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
               </div>
               <form wire:submit="SubmitContactForm" action="{{ URL::to('/contact') }}" method="post">
               @csrf
                <div class="my-3">
                    <label for="name">Full name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="name" wire:model.live="name" class="form-control form-control-lg" placeholder="Enter full name...">
                    </div>
                    <div class="my-2">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="my-3">
                    <label for="email">Email address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="text" name="email" wire:model.live="email" class="form-control form-control-lg" placeholder="Enter email address..">
                    </div>
                    <div class="my-2">
                        @error('email')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="my-3">
                    <label for="subject">Subject</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-question"></i></span>
                        <input type="text" name="subject" wire:model.live="subject" class="form-control form-control-lg" placeholder="Enter subject...">
                    </div>
                    <div class="my-2">
                        @error('subject')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="my-3">
                    <label for="message">Message</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                        <textarea name="message" wire:model.live="message" class="form-control form-control-lg" placeholder="Enter message.."></textarea>
                    </div>
                    <div class="my-2">
                        @error('message')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="my-3">
                    <input type="submit" value="Send Message" class="form-control btn btn-lg btn-primary">
                </div>
               </form>
        </div>
    </div>
</div>
