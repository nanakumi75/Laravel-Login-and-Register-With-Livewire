<!DOCTYPE html>
<html lang="en">
<head>
    <x-header-component/>
</head>
<body>
   <x-navigation-component/>
   <div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center text-primary">Password Forget</h4>
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
           <form action="{{ URL::to('/forget') }}" method="post">
            @csrf
             <div class="my-3">
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Enter your email address...">
                </div>
                <div class="my-2">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
             </div>
             <div class="my-3">
                <input type="submit" value="Validate Your Email" class="form-control btn btn-lg btn-primary">
             </div>
           </form>
        </div>
    </div>
 </div>
   <x-footer-component/>
</body>
</html>