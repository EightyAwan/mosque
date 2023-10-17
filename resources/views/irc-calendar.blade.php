@extends('layouts.front')
@section('content')
    <!-- Hero section  -->



    <section class="prayer-calendar">
        <h2 class="text-center bottom-line">IRC Calendar</h2>
        <div class="container align-items-center"> 
        </div>
        <div class="calendar-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <section class="ftco-section">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="elegant-calencar">
                                        <div class="calendar-wrap">
                                            <div class="blur-background">


                                                <div class="wrap-heade text-center my-cl-header">
                                                    <p id="reset" class="d-none">Today</p>
                                                    <div id="header" class="p-0">
                                                        <div class="head-info">
                                                            <div class="head-month"></div>
                                                            <div class="head-day d-none"></div>
                                                        </div>
                                                    </div>
                                                </div>

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
                                                            <th>Mon</th>
                                                            <th>Tue</th>
                                                            <th>Wed</th>
                                                            <th>Thu</th>
                                                            <th>Fri</th>
                                                            <th>Sat</th>
                                                            <th>Sun</th>
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
                    <div class="col-lg-8">
                        <div class="wrap-heade text-center">
                            <p id="reset" class="d-none">Today</p>
                            <div id="header" class="p-0">
                                <div class="head-info">
                                    <div class="head-month" id="calender-date"></div>
                                    <div class="head-day d-none"></div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table pray-times m-0" id="irc-section">
                            </table>
                        </div>
                        <div id="target-services"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs content -->
@endsection
