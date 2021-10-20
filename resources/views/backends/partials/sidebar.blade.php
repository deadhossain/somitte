<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Setups</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{route('user.index')}}">
                    <span class="pcoded-micon"><i class="fa fa-user-secret"></i></span>
                    <span class="pcoded-mtext">Users</span>
                </a>
            </li>
            <li>
                <a href="{{route('lookup.index')}}">
                    <span class="pcoded-micon"><i class="fa fa-sitemap"></i></span>
                    <span class="pcoded-mtext">Lookup</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Savings</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{route('scheme.index')}}">
                    <span class="pcoded-micon"><i class="fa fa-briefcase"></i></span>
                    <span class="pcoded-mtext">Scheme</span>
                </a>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{route('account.index')}}">
                    <span class="pcoded-micon"><i class="fa fa-briefcase"></i></span>
                    <span class="pcoded-mtext">Accounts</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Person</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{route('customer.index')}}">
                    <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                    <span class="pcoded-mtext">Customer</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    var path = window.location.href;
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);
    $(".pcoded-item a").each(function () {
        var href = $(this).attr('href');
        if (path === href) {
            $(this).parents('li').addClass('active');
        }
    });
</script>
