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
    <title>IslamicSite</title>
</head>

<body>


    <!-- Navbar  -->
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" width="60px" alt="">
            </a>
            @if(!Auth::user())
            <a href="{{ route('login') }}" class="navbar-brand">
                Login / Register
            </a>
            @else
            <a href="{{ route('logout') }}" class="navbar-brand">
                Profile
            </a> 

            <a href="{{ route('logout') }}" class="navbar-brand" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
               {{ Auth::user()->name }} / Logout
            </a>    
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @endif
        </div>
    </nav>


    <!-- Hero section  -->



    <section class="prayer-calendar">
        <h2 class="text-center bottom-line">Daily Prayer Times</h2>
        <div class="calendar-sec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <section class="ftco-section">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="elegant-calencar d-md-flex">
                                        <div class="wrap-header d-flex align-items-center img">
                                            <p id="reset">Today</p>
                                            <div id="header" class="p-0">

                                                <div class="head-info">
                                                    <div class="head-month"></div>
                                                    <div class="head-day"></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="calendar-wrap">
                                            <div class="blur-background">

                                                <div class="w-100 button-wrap">
                                                    <div
                                                        class="pre-button d-flex align-items-center justify-content-center">
                                                        <i class="fa fa-chevron-left"></i>
                                                    </div>
                                                    <div
                                                        class="next-button d-flex align-items-center justify-content-center">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </div>
                                                </div>
                                                <table id="calendar">
                                                    <thead>
                                                        <tr>
                                                            <th>Sun</th>
                                                            <th>Mon</th>
                                                            <th>Tue</th>
                                                            <th>Wed</th>
                                                            <th>Thu</th>
                                                            <th>Fri</th>
                                                            <th>Sat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <table class="table table-responsive pray-times m-0" id="prayer-section">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">PRAYERS</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            
                        </table>
                        <div id="target-services"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- footer section  -->

    <div class="footer-top-img text-center">
        <img src="images/footer-top.svg" class="img-fluid footer-top" alt="">
    </div>
    <div class="footer pb-3 pt-5 mt-0 text-light position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pe-5">
                    <div class="footer-logo">
                        <img src="images/logo.png" alt="" width="50"
                            class="d-inline-block align-text-top img-fluid my-3">
                    </div>
                    <div class="footer-content">
                        <p class="text-light py-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean
                            sodales dictum viverra. Nam gravida Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Aenean sodales dictum viverra. Nam gravida dignissim eros dignissim eros</p>
                         
                    </div>
                </div> 
            </div>
        </div>
    </div>
    </div>

    
    <div class="footer-copyright py-2 text-center">
        <p class="m-0 p-0">© Copyright 2023 by Refsnes Data. All Rights Reserved. IslamicSite.</p>
    </div>






    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
        integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
        data-cf-beacon='{"rayId":"8069a0267f77d1d8","version":"2023.8.0","b":1,"token":"cd0b4b3a733644fc843ef0b185f98241","si":100}'
        crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.5/flickity.pkgd.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
    function getPrayers(selectedDay){
        $.ajax({
            url:'/get-prayers',
            method:'get',
            data:{
                date:selectedDay.toISOString().slice(0, 10)
            },
            success:function(response){  
                $("#prayer-section").html(response.data);
            }
        });
    }
    const currentDate = new Date();
    getPrayers(currentDate);

    </script>
</body>

</html>