<header class="p-3 border-bottom bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ route('memo.index') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                &lowast; Simple ToDo Memo &lowast;
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"></ul>

            <div class="dropdown text-end">
                <a href="#" class="d-block text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item">ログアウト</button>
                        </form>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>