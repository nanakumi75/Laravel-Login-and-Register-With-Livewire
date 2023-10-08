<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="/" class="navbar-brand">
         <img src="{{ URL('images/logo.jpg') }}" alt="" id="logo">
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
          <span class="navbar-toggle-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            @if(Session::has('id'))
             <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a href="/employees" class="nav-link">Search Employees</a>
                </li>
             </ul>
             <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/account" class="nav-link">My Account</a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">Logout</a>
                </li>
             </ul>
            @elseif(!Session::has('i'))
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a href="/employees" class="nav-link">Search Employees</a>
                </li>
             </ul>
             <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/register" class="nav-link">Create Account</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="nav-link">Login</a>
                </li>
             </ul>
            @endif
        </div>
    </div>
</nav>