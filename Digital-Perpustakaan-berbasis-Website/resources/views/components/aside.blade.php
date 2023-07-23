<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0">
            <img src="{{asset('assets/img/logo-ct-dark.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Soft UI Dashboard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  active-nav" href="{{route('books.index')}}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" id="books-library"><path d="M3 6c-.55 0-1 .45-1 1v13c0 1.1.9 2 2 2h13c.55 0 1-.45 1-1s-.45-1-1-1H5c-.55 0-1-.45-1-1V7c0-.55-.45-1-1-1zm17-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 9h-8c-.55 0-1-.45-1-1s.45-1 1-1h8c.55 0 1 .45 1 1s-.45 1-1 1zm-4 4h-4c-.55 0-1-.45-1-1s.45-1 1-1h4c.55 0 1 .45 1 1s-.45 1-1 1zm4-8h-8c-.55 0-1-.45-1-1s.45-1 1-1h8c.55 0 1 .45 1 1s-.45 1-1 1z"></path></svg>
                    </div>
                    <span class="nav-link-text ms-1">Library</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active-nav" href="{{route('books.userIndex')}}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" id="bookmark"><g fill="none" fill-rule="evenodd" stroke="#200E32" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(3.5 2)"><path d="M8.16475977,16.631579 L2.23340962,19.881007 C1.75983818,20.1271252 1.17640846,19.9529066 0.915331812,19.4874143 L0.915331812,19.4874143 C0.839799009,19.3432192 0.79904873,19.1833528 0.796338677,19.0205951 L0.796338677,4.62242565 C0.796338677,1.87643022 2.67276889,0.778032041 5.37299774,0.778032041 L11.7162472,0.778032041 C14.3340962,0.778032041 16.2929063,1.80320367 16.2929063,4.43935929 L16.2929063,19.0205951 C16.2929063,19.2803494 16.1897192,19.5294649 16.0060452,19.713139 C15.8223711,19.8968131 15.5732556,20.0000001 15.3135012,20.0000001 C15.1478164,19.9973723 14.9849578,19.9566576 14.8375287,19.881007 L8.86956526,16.631579 C8.64965001,16.5127732 8.38467502,16.5127732 8.16475977,16.631579 Z"></path><line x1="4.87" x2="12.165" y1="7.323" y2="7.323"></line></g></svg>
                    </div>
                    <span class="nav-link-text ms-1">myBooks</span>
                </a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link active-nav" href="{{route('categories.index')}}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" id="tag"><path d="M128 20v44a8.001 8.001 0 0 1-2.342 5.657l-56.002 56a8 8 0 0 1-11.312 0l-56-56a8 8 0 0 1 0-11.314l56-56A8 8 0 0 1 64 0h44a20.022 20.022 0 0 1 20 20zm-28 0a8 8 0 1 0 8-8 8 8 0 0 0-8 8z" data-name="Layer 2"></path></svg>
                    </div>
                    <span class="nav-link-text ms-1">Categories</span>
                </a>
            </li>
            @endif
        </ul>
    </div>


</aside>
