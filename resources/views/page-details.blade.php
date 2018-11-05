@extends('layouts.app')
@section('title','Dotinsider')
@section('content')
    <section class="bg-section about">
        <div class="container">
            @include('layouts.partials.header')
            <div class="about-us to-hide">
                <div>
                    <div class="width-25">
                        <p class="zigzag main-title-font">{{$page->title}}</p>
                    </div>
                    <div class="width-75">
                        <p class="main-title-font smaller">
                            {{$page->excerpt}}
                        </p>
                        <span>
                            {{$page->content}}
                        </span>

                        <div class="channels-logo">
                            <a href="javascript:void(0)" id="channel1" class="active"><img src="img/Fel90.png"
                                                                                           alt=""></a>
                            <a href="javascript:void(0)" id="channel2"><img src="img/Ahadon%20Ahad.png" alt=""></a>
                            <a href="javascript:void(0)" id="channel3"><img src="img/w%20laken%20zorafa2.png"
                                                                            alt=""></a>
                            <a href="javascript:void(0)" id="channel4"><img src="img/seret%20Zayed.png" alt=""></a>
                        </div>

                        <div class="related-to-channel">
                            <div data-index="channel1">
                                <p class="main-title-font zigzag smaller">
                                    FEL 90
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                </p>
                                <ul class="social-icons">
                                    <li><a href="#" target="_blank">FACEBOOK</a></li>
                                    <li><a href="#" target="_blank">TWITTER</a></li>
                                    <li><a href="#" target="_blank">YOUTUBE</a></li>
                                </ul>
                            </div>
                            <div data-index="channel2">
                                <p class="main-title-font zigzag">
                                    AhadonAhad
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                </p>
                                <ul class="social-icons">
                                    <li><a href="#" target="_blank">FACEBOOK</a></li>
                                    <li><a href="#" target="_blank">TWITTER</a></li>
                                    <li><a href="#" target="_blank">YOUTUBE</a></li>
                                </ul>
                            </div>
                            <div data-index="channel3">
                                <p class="main-title-font zigzag">
                                    Lakn Zorafaa
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                </p>
                                <ul class="social-icons">
                                    <li><a href="#" target="_blank">FACEBOOK</a></li>
                                    <li><a href="#" target="_blank">TWITTER</a></li>
                                    <li><a href="#" target="_blank">YOUTUBE</a></li>
                                </ul>
                            </div>
                            <div data-index="channel4">
                                <p class="main-title-font zigzag">
                                    Seret Zayed
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut
                                </p>
                                <ul class="social-icons">
                                    <li><a href="#" target="_blank">FACEBOOK</a></li>
                                    <li><a href="#" target="_blank">TWITTER</a></li>
                                    <li><a href="#" target="_blank">YOUTUBE</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
@endsection
