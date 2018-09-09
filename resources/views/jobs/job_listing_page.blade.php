<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Mobile Metas -->
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <title>-:| HealthGinie |:- Job listing page</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/theme-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>


    <link rel="stylesheet" href="{{  asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{  asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{  asset('css/theme-responsive.css') }}"/>


</head>

<body>
<div id="wrapper">
    <!--Wrapper starts here-->
    <!--Header starts here-->
    <header id="header">
        <div class="inner_container clearfix">
            <div class="location">
                <ul>
                    <li><a href="#"><img src="{{  asset('images/pakistan_flag.jpg') }}" alt=""> Karachi</a></li>
                </ul>
            </div>
            <nav>
                <div id="responsive-nav">
                    <div id="responsive-nav-button"><span id="responsive-nav-button-icon"></span></div>
                    <!-- responsive-nav-button -->
                </div>
                <ul id="main_menu">
                    <li><a href="#">HealthGinie for Doctors</a></li>
                    <li><a href="{!! URL::route('event.index') !!}">Events</a></li>
                    <li><a href="{!! URL::route('jobs.index') !!}">Jobs</a></li>
                    @if(isset($jobsByUser) && count($jobsByUser) > 0)
                        <li><a href="{!! URL::route('appliedJobsByApplicant') !!}">Applied Jobs</a></li>
                    @endif

                @if(isset($user) && count($user) > 0)

                        <li><a href="{!! URL::route('viewAllCvsByClient',[$user->id]) !!}">My cv</a></li>
                        <li><a href="{!! URL::route('user.login') !!}">{{$user->user_profile[0]->first_name}}</a></li>
                    @else

                        <li><a href="{!! URL::route('user.login') !!}">Login</a></li>
                        <li><a href="{!! URL::route('user.signup') !!}">Register</a></li>
                    @endif

                </ul>
            </nav>
        </div>
    </header>
    <!--Header ends here-->
    <!--Body starts here-->
    <section id="body">
        <div class="search_container inner_page">
            <div class="inner_container">
                <div class="inner_page_logo"><a href="index.html"><img src="{{  asset('images/inner_page_logo.png') }}" alt=""></a>
                </div>
                <form action="#" method="get">
                    <ul>
                        <li class="first">
                            <a class="area" href="javascript:toggleDiv('myContent');">Area</a>
                            <div class="city_name_outer"><input name="text" type="text" class="input"
                                                                placeholder="City">
                                <ul tabindex="0" id="ui-id-1"
                                    class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content ui-widget-content2">
                                    <li tabindex="-1" id="ui-id-2" class="ui-menu-item"> Islamabad</li>
                                    <li tabindex="-1" id="ui-id-3" class="ui-menu-item">Lahore</li>
                                    <li tabindex="-1" id="ui-id-4" class="ui-menu-item">Multan</li>
                                    <li tabindex="-1" id="ui-id-5" class="ui-menu-item">Karachi</li>
                                    <li tabindex="-1" id="ui-id-2" class="ui-menu-item"> Islamabad</li>
                                    <li tabindex="-1" id="ui-id-3" class="ui-menu-item">Lahore</li>
                                    <li tabindex="-1" id="ui-id-4" class="ui-menu-item">Multan</li>
                                    <li tabindex="-1" id="ui-id-5" class="ui-menu-item">Karachi</li>
                                </ul>
                            </div>
                        </li>
                        <li class="searchbar">
                            <!--<input name=" " type="text" class="search" value="Specialitiess, Doctor’s, Clinics, Labs">-->

                            <div class="ui-widget">

                                <!--<label for="developer">Developer: </label>-->
                                <input autocomplete="off" class="ui-autocomplete-input"
                                       placeholder="Specialitiess, Doctor’s, Clinics, Labs" id="developer">
                            </div>
                            <div class="list_outer">
                                <ul style="display: none; width: 142px; top: 27px; left: 76px;" tabindex="0"
                                    id="ui-id-1" class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content">
                                    <li tabindex="-1" id="ui-id-2" class="ui-menu-item">Facer possim assum <span>Nam liber</span>
                                    </li>
                                    <li tabindex="-1" id="ui-id-3" class="ui-menu-item">Eodem modo typi
                                        <span>Nam liber</span></li>
                                    <li tabindex="-1" id="ui-id-4" class="ui-menu-item">Facer possim assum <span>Nam liber</span>
                                    </li>
                                    <li tabindex="-1" id="ui-id-5" class="ui-menu-item">Eodem modo typi
                                        <span>Nam liber</span></li>
                                    <li tabindex="-1" id="ui-id-6" class="ui-menu-item">Facer possim assum <span>Nam liber</span>
                                    </li>
                                    <li tabindex="-1" id="ui-id-7" class="ui-menu-item">Eodem modo typi
                                        <span>Nam liber</span></li>
                                    <li tabindex="-1" id="ui-id-8" class="ui-menu-item">Facer possim assum <span>Nam liber</span>
                                    </li>
                                    <li tabindex="-1" id="ui-id-9" class="ui-menu-item">Eodem modo typi
                                        <span>Nam liber</span></li>
                                </ul>
                            </div>
                            <!--list_outer-->
              
              <span class="ui-helper-hidden-accessible" aria-relevant="additions" aria-live="assertive" role="status">
            2 results are available, use up and down arrow keys to navigate.
              </span>
                            <input name=" " type="button" class="btn" value=" ">
                        </li>
                    </ul>
                </form>
                <div class="list_outer">
                    <div id="myContent" class="clearfix">
                        <ul class="clearfix">
                            <li>
                                <h6>
                                    <img class="flag_img" src="{{  asset('images/img_01.jpg') }}" alt="">
                                    Lorem ipsum</h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                    <p class="other_cities"><a href="#">Other Cities</a></p>
                                </div>
                            </li>
                            <li>
                                <h6>
                                    <img class="flag_img" src="{{  asset('images/img_02.jpg') }}" alt="">
                                    Lorem ipsum</h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>
                            <li>
                                <h6>
                                    <img class="flag_img" src="{{  asset('images/img_03.jpg') }}" alt="">
                                    Lorem ipsum</h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>
                            <li>
                                <h6>
                                    <img class="flag_img" src="{{  asset('images/img_01.jpg') }}" alt="">
                                    Lorem ipsum</h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>
                            <li>
                                <h6>
                                    <img class="flag_img" src="{{  asset('images/img_02.jpg') }}" alt="">
                                    Lorem ipsum</h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>
                            <li>
                                <h6>
                                    <img class="flag_img" src="{{  asset('images/img_03.jpg') }}" alt="">
                                    Lorem ipsum</h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>
                            <li>
                                <h6>
                                    <img class="flag_img" src="{{  asset('images/img_01.jpg') }}" alt="">
                                    Lorem ipsum</h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>
                            <li>
                                <h6>
                                    <img class="flag_img" src="{{  asset('images/img_02.jpg') }}" alt="">
                                    Lorem ipsum</h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                    <p class="other_cities"><a href="#">Other Cities</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--list_outer-->

            </div>
        </div>
        <div class="two_col_layout">


            <div class="left_col_hide">

                <div class="responsive_bar clearfix">
                    <p>4454 matches found</p>
                    <div class="open_icon"><a href="javascript:toggleDiv('myContent2');"><img src="{{  asset('images/open_icon.png') }}"
                                                                                              alt=""></a></div>
                </div>

                <div id="myContent2" style="display:none;">
                    <div class="responsive_block"><a href="javascript:toggleDiv('myContent2');">Cancel</a> <a
                                class="apply" href="#">Apply</a></div>
                    <div class="left_col">
                        <form action="#" method="get">
                            <div class="filters_container">
                                <div class="filter">
                                    <h5 class="open dropped">Appointment
                                        <a href="#">
                                            <img src="{{  asset('images/help_icon.png') }}" alt="" class="help">
                                        </a>
                                    </h5>
                                    <ul class="fold">
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne"/>
                                                <label for="squaredOne"></label>
                                            </div>
                                            Instant Booking
                                        </li>
                                    </ul>
                                </div>
                                <div class="filter">
                                    <h5 class="open dropped">Location</h5>
                                    <ul>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne1"/>
                                                <label for="squaredOne1"></label>
                                            </div>
                                            Gulshan Iqbal
                                        </li>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne2"/>
                                                <label for="squaredOne2"></label>
                                            </div>
                                            Buffer Zone
                                        </li>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne3"/>
                                                <label for="squaredOne3"></label>
                                            </div>
                                            Gulshan Iqbal
                                        </li>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne4"/>
                                                <label for="squaredOne4"></label>
                                            </div>
                                            Tariq Road
                                        </li>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne5"/>
                                                <label for="squaredOne5"></label>
                                            </div>
                                            DHA Phase 1
                                        </li>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne6"/>
                                                <label for="squaredOne6"></label>
                                            </div>
                                            DHA Phase 2
                                        </li>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne7"/>
                                                <label for="squaredOne7"></label>
                                            </div>
                                            DHA Phase 3
                                        </li>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne8"/>
                                                <label for="squaredOne8"></label>
                                            </div>
                                            DHA Phase 4
                                        </li>
                                        <li>
                                            <div class="squaredTwo">
                                                <input type="checkbox" value="None" id="squaredOne9"/>
                                                <label for="squaredOne9"></label>
                                            </div>
                                            DHA Phase 5
                                        </li>
                                    </ul>
                                </div>
                                <div class="filter">
                                    <h5 class="open dropped">Availability</h5>
                                    <ul>
                                        <li>
                                            <ul class="days">
                                                <li><a href="#">Any</a></li>
                                                <li><a href="#">M</a></li>
                                                <li><a href="#">T</a></li>
                                                <li><a href="#">W</a></li>
                                                <li><a href="#">T</a></li>
                                                <li><a href="#">F</a></li>
                                                <li><a href="#">S</a></li>
                                                <li><a href="#">S</a></li>
                                            </ul>
                                        </li>
                                        <li>12:00am - 11:30pm</li>
                                        <li><img src="{{  asset('images/slider_range.png') }}" alt=""></li>
                                    </ul>
                                </div>
                                <div class="filter">
                                    <h5 class="open dropped">Consultation Fee</h5>
                                    <ul>
                                        <li>100 -1000 +</li>
                                        <li><img src="{{  asset('images/slider_range.png') }}" alt=""></li>
                                        <li>Most Searched Localities In Karachi</li>
                                        <li><a href="#">Dentists in DHA PHASE 1</a></li>
                                        <li><a href="#">Dental Practitioners in Gulshan</a></li>
                                        <li><a href="#">Dental Clinics in Buffer Zone</a></li>
                                        <li><a href="#">Teeth and Gum Doctors in Tariq Road</a></li>
                                        <li><a href="#">Dentists in Hsr Layout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div><!--left_col_hide -->


            <div class="right_col right_col_full_width">
                <div class="listing_row">
                    <h2>Job Listing</h2>
                    <div class="message-block">
                        <div class="col-sm-10 col-sm-offset-2">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissable flat">
                                    <a href="javascript:void(0); " class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissable flat">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <h4><i class="icon fa fa-check"></i> Success</h4>
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if($errors && ! $errors->isEmpty() )
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">{!! $error !!}</div>
                                @endforeach
                            @endif
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))

                                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if(isset($jobs) && count($jobs) > 0)
                        @forelse($jobs as $job)

                        <div class="jobs_apply_block clearfix">
                            <div class="inner_block">
                                <h3>
                                    <a href="{!! URL::route('jobs.show', ['id' => $job->id]) !!}">
                                        {!! $job->title !!}
                                    </a>
                                </h3>
                                <p>{{ strip_tags($job->description) }}</p>
                            </div>
                            <div class="date_block clearfix">
                                <div class="inner_block clearfix">
                                    <div class="date_text">
                                        <img src="{{ asset('images/calendar_icon.png') }}" alt=""><span style="font-family:Serif">Job Posted:{{ $job->created_at->toFormattedDateString() }}</span>
                                    </div>
                                    <div class="date_text">
                                        <img src="{{ asset('images/calendar_icon.png') }}" alt=""><span style="font-family:Serif">Last Date: {{ $job->last_date->toFormattedDateString() }}</span>
                                    </div>
                                    <div class="date_text">
                                        <img src="{{ asset('images/calendar_icon.png') }}" alt=""><span style="font-family:Serif">Exp: {{ $job->experience }}</span>
                                    </div>
                                    <div class="button">

                                        <a href="{!! URL::route('jobs.show', ['id' => $job->id]) !!}" style="margin-right: 20px;">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @empty
                            <p>No Job is posted</p>
                        @endforelse
                    @endif


                    <div class="row">
                        <div>
                            @if(isset($jobs) && count($jobs) > 0)

                                {{$jobs->render()}}
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--Footer starts here-->
    <footer id="footer">
        <div class="inner_container clearfix">
            <div class="footer_content">
                <div class="social_networking">
                    <ul>
                        <li><a href="#"><img src="{{ asset('images/social_fb.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('images/social_twitter.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('images/social_linkedin.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('images/social_instagram.png') }}" alt=""></a></li>
                    </ul>
                </div>
                <div class="footer_nav">
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><span>•</span></li>
                        <li><a href="#">Careers</a></li>
                        <li><span>•</span></li>
                        <li><a href="#">Press</a></li>
                        <li><span>•</span></li>
                        <li><a href="#">Blog</a></li>
                        <li><span>•</span></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><span>•</span></li>
                        <li><a href="#">Privacy &amp; Terms</a></li>
                        <li><span>•</span></li>
                        <li><a href="#">Healthcare Directory</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright"><span>all right reserved by health ginie 2016</span></div>
        </div>
    </footer>
    <!--Footer ends here-->
    <!--Wrapper ends here-->
</div>

<script type="text/javascript" src="{{  asset('js/jquery-1.11.js') }}"></script>
<script type="text/javascript" src="{{  asset('js/navigation.js') }}"></script>

<script>

    $(function () {

        $(".apply").click(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                }
            });

            var job_id =$(this).attr("data-id")

            console.log('job_id: ',job_id);

            $.ajax({
                type: "GET",
                url: '{{env('APP_URL')}}' + 'apply/' + job_id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                },
                error: function (data) {
                    console.log(data);
                    return;
                }
            }, "json");

            return;
        });
    });


    jQuery('.open').click(function () {
        if (jQuery(this).next('ul').is(':visible')) {
            jQuery(this).removeClass('dropped');
            jQuery(this).next('ul').hide();
        }
        else {
            jQuery(this).addClass('dropped');
            jQuery(this).next('ul').show();
        }
    });
</script>
<script type="text/javascript">
    function toggleDiv(divId) {
        $("#" + divId).toggle();
    }
</script>

<!--for responsive bar-->
<script type="text/javascript">
    function toggleDiv(divId) {
        $("#" + divId).toggle();
    }
</script>

</body>
</html>