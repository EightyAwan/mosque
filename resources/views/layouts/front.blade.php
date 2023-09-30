<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.5/flickity.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <title>Kingston Muslim Association</title>
</head>

<body>


    <!-- Navbar  -->
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('images/logo.png') }}" width="200px" alt="">
            </a>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown">Account</a>
                    <ul class="dropdown-menu">



                        @if (!Auth::user())

                            <li><a href="{{ route('login') }}" class="dropdown-item">Login </a></li>
                        @else
                            @if (Auth::user()->role_id === 0)
                                <li><a class="dropdown-item" href="{{ route('admin') }}">Dashboard</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                            @endif

                            <li><a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    Logout
                                </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>


                        @endif
                    </ul>
                </li>
            </ul>


        </div>
    </nav>



    @yield('content')




    <!-- footer section  -->

    <div class="footer-top-img text-center">
        <img src="images/footer-top.svg" class="img-fluid footer-top" alt="">
    </div>
    <div class="footer pb-3 pt-5 mt-0 text-light position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pe-5">
                    <div class="footer-logo">
                        <img src="images/logo.png" alt="" width="200px"
                            class="d-inline-block align-text-top img-fluid my-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="footer-copyright py-2 text-center">
        <p class="m-0 p-0">© Copyright 2023 by Dynalogies. All Rights Reserved</p>
    </div>






    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
        integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
        data-cf-beacon='{"rayId":"8069a0267f77d1d8","version":"2023.8.0","b":1,"token":"cd0b4b3a733644fc843ef0b185f98241","si":100}'
        crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.5/flickity.pkgd.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        async function getPrayers(selectedDay, tab = null) {
            $.ajax({
                url: '/get-prayers',
                method: 'get',
                data: {
                    date: selectedDay.toISOString().slice(0, 10),
                    tab
                },
                success: function(response) {
                    $("#prayer-section").html(response.data.prayers);

                    var imams_color = '<h3>Imams:</h3>';

                    for (let i = 0; i < response.data.imams.length; i++) {
                        imams_color +=
                            '<div class="d-flex align-items-center justify-content-between"> <b class="imam-name">' +
                            response.data.imams[i]['name'] +
                            '</b> <div class="imam-color1" style="background-color:' + response.data.imams[
                                i]['color'] + ';" ></div> </div>';
                    }

                    $(".imam-name-sec").html(imams_color);

                }
            });
        }
        const selected = localStorage.getItem("selectedDay");
        if (selected === null || selected === undefined) {
            var date = new Date();
        } else {
            var date = new Date(localStorage.getItem("selectedDay"));
        }
        const tab = localStorage.getItem("tab");
        getPrayers(date, tab);
    </script>
</body>

</html>
