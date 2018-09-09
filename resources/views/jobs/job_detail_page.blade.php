<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Mobile Metas -->
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <title>-:| HealthGinie |:- Job detail page</title>

    <link rel="stylesheet" href="{{  asset('css/dropzone.css') }}"/>
    <link rel="stylesheet" href="{{  asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{  asset('css/tabs.css') }}"/>
    <link rel="stylesheet" href="{{  asset('css/theme-responsive.css') }}"/>
    <link rel="stylesheet" href="{{  asset('css/bootstrap.css') }}"/>

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
                    <li><a href="{!! URL::route('appliedJobsByApplicant') !!}">Applied Jobs</a></li>
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
                                <form>
                                    <!--<label for="developer">Developer: </label>-->
                                    <input autocomplete="off" class="ui-autocomplete-input"
                                           placeholder="Specialitiess, Doctor’s, Clinics, Labs" id="developer">
                                </form>
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
                            </div><!--list_outer-->

<span class="ui-helper-hidden-accessible" aria-relevant="additions" aria-live="assertive" role="status">
<div>2 results are available, use up and down arrow keys to navigate.</div></span>


                            <input name=" " type="button" class="btn" value=" ">
                        </li>
                    </ul>
                </form>

                <div class="list_outer">
                    <div id="myContent" class="clearfix">
                        <ul class="clearfix">
                            <li>
                                <h6>
                                    <div class="flag_img"><img src="{{  asset('images/img_01.jpg') }}" alt=""></div>
                                    Lorem ipsum
                                </h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                    <p class="other_cities"><a href="#">Other Cities</a></p>

                                </div>
                            </li>

                            <li>
                                <h6>
                                    <div class="flag_img"><img src="{{  asset('images/img_02.jpg') }}" alt=""></div>
                                    Lorem ipsum
                                </h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>

                            <li>
                                <h6>
                                    <div class="flag_img"><img src="{{  asset('images/img_03.jpg') }}" alt=""></div>
                                    Lorem ipsum
                                </h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>

                            <li>
                                <h6>
                                    <div class="flag_img"><img src="{{  asset('images/img_01.jpg') }}" alt=""></div>
                                    Lorem ipsum
                                </h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>

                            <li>
                                <h6>
                                    <div class="flag_img"><img src="{{  asset('images/img_02.jpg') }}" alt=""></div>
                                    Lorem ipsum
                                </h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>

                            <li>
                                <h6>
                                    <div class="flag_img"><img src="{{  asset('images/img_03.jpg') }}" alt=""></div>
                                    Lorem ipsum
                                </h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>

                            <li>
                                <h6>
                                    <div class="flag_img"><img src="{{  asset('images/img_01.jpg') }}" alt=""></div>
                                    Lorem ipsum
                                </h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                </div>
                            </li>

                            <li>
                                <h6>
                                    <div class="flag_img"><img src="{{  asset('images/img_02.jpg') }}" alt=""></div>
                                    Lorem ipsum
                                </h6>
                                <div class="text_block">
                                    <p><a href="#">Adipiscing</a></p>
                                    <p><a href="#">Consectetuer</a></p>
                                    <p class="other_cities"><a href="#">Other Cities</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>


        <div class="two_col_layout">
            <div class="detail_page">
                <div class="profile_container">
                    @if(isset($job) && count($job) > 0)
                        <h2>{!! $job->title !!}</h2>
                        <div class="jobs_apply_detail_block clearfix">
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
                            <div class="detail_block_outer">
                                <h3>Job Details</h3>
                                <p>Experience<span>{!! $job->experience !!} Years</span></p>
                                <p>Location<span>{!! $job->location !!}</span></p>
                                <p>Type<span>{!! $job->type !!}</span></p>
                                <p>Qualification<span>{!! $job->qualification !!}</span></p>
                                <p>Vacancies<span>{!! $job->vacancies !!}</span></p>

                                @if(isset($gender))
                                    <p>Gender<span>
                                        @if(isset($gender))
                                            @foreach (array_values($gender) as $index => $value)
                                                @if($job->gender == $index)
                                                    {!! $value !!}
                                                @elseif($job->gender == $index)
                                                    {!! $value !!}
                                                @endif
                                            @endforeach
                                        @endif
                                    </span></p>
                                @endif
                                @if(isset($travel))
                                    <p>Travel<span>
                                        @if(isset($travel))
                                            @foreach (array_values($travel) as $index => $value)
                                                @if($job->travel == $index)
                                                    {!! $value !!}
                                                @elseif($job->travel == $index)
                                                    {!! $value !!}
                                                @endif
                                            @endforeach
                                        @endif
                                    </span></p>
                                @endif

                                <p>Salary<span>{!! $job->salary_range !!}</span></p>
                                <p>Job Posted at<span class="created_at">{!! $job->created_at->toFormattedDateString() !!}</span></p>
                                <p>Last Date<span class="created_at">{!! $job->last_date->toFormattedDateString() !!}</span></p>

                                <h3>Job Description</h3>
                                <div>
                                    {!! $job->description !!}
                                </div>

                                <h3>Job Specifications</h3>
                                <div class="specification">
                                    {!! $job->specification !!}
                                </div>

                            </div>

                            @if($job->appliedOrNot($job->id) == false)

                                <div class="col-md-12 col-xs-12"  style="margin-top:10px; margin-bottom:20px; border: 1px solid rgba(134, 147, 163, 0.59); border-radius: 5px; padding-top: 10px; padding-bottom: 10px; padding-left: 43px; padding-right: 48px; ">

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
                                    {!! Form::open(array('route' => 'jobs.store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true)) !!}
                                    {{ Form::hidden('_method', 'POST') }}


                                <!-- cover_letter text field -->
                                    <div class="form-group">
                                        {!! Form::label('cover_letter', "Cover letter: ") !!}

                                        {!! Form::textarea('cover_letter', null, array('id' => 'cover_letter', 'class' => 'form-control', 'placeholder'   => 'Cover Letter', 'col'=>10, 'row'=>2)) !!}
                                        {{--                        {!! Form::file('cover_letter') !!}--}}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('cover_letter') !!}</span>

                                    <!-- cv_file text field -->
                                    @if(isset($user_cvs) && count($user_cvs) > 0)

                                        <div class="form-group">
                                            <label for="cv_id" id="cv_id" >Select CV: </label>
                                            {!! Form::select('cv_id', $user_cvs, null, ['id' => 'cv_id', 'class' => 'form-control']) !!}

                                        </div>
                                        <span class="text-danger">{!! $errors->first('name') !!}</span>


                                        <div class="form-group">
                                            <label for="name" id="name_lable" >Name: </label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="CV name">

                                        </div>
                                        <span class="text-danger">{!! $errors->first('name') !!}</span>

                                        <div class="form-group">
                                            <label for="description" id="description_lable" >Its descriptions: </label>
                                            <input type="text" name="description" id="description" class="form-control" placeholder="Write about it">

                                        </div>
                                        <span class="text-danger">{!! $errors->first('description') !!}</span>


                                        <div class="form-group">
                                            {!! Form::label('new_cv_file', "Or add new cv: ") !!}
                                            {!! Form::file('new_cv_file', array('id'=>'new_cv_file', 'class' => 'form-control')) !!}
                                        </div>
                                        <span class="text-danger">{!! $errors->first('new_cv_file') !!}</span>

                                    @else
                                        <div class="form-group">
                                            {!! Form::label('cv_file', "CV File: ") !!}
                                            {!! Form::file('cv_file', array('id'=>'cv_file', 'class' => 'form-control')) !!}
                                        </div>
                                        <span class="text-danger">{!! $errors->first('cv_file') !!}</span>

                                    @endif

                                    @if(isset($job))
                                        <input id="job_id" name="job_id" type="hidden" value="{{$job->id}}">
                                    @endif
                                    {!! Form::hidden('id') !!}
                                    {!! Form::hidden('form_name','Orders') !!}
                                    <div class="button">

                                        {!! Form::submit('Apply', array("class"=>"btn btn-info apply_job")) !!}
                                        <a href="{!! URL::route('jobs.index') !!}" style="float: right; ">
                                            Back
                                        </a>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                            @endif
                            <div class="button">

                                @if($job->appliedOrNot($job->id) == true)

                                    @foreach ($job->user as $user)
                                        @if(isset($logged_user) && $user->id == $logged_user)
                                            <a class="cancelApplication" href="{!! URL::route('cancelJobByApplicant', ['id' => $job->id]) !!}" >
                                                Cancel
                                            </a>
                                            <a href="{!! URL::route('jobs.index') !!}" >
                                                Back
                                            </a>
                                        @endif
                                    @endforeach

                                @endif

                            </div>
                        </div>

                    @else
                    Result not loaded. Sorry try again.
                    @endif

                </div>


                <div id="sidebar">
                    <div class="healthGinie_app_container">
                        <div class="health_consult">
                            <a href="#"><img src="{{  asset('images/HealthGinie_banner.png') }}" alt=""></a>
                        </div>

                        <div class="sidebar_links">
                            <h3>Dentists near Indiranagar</h3>
                            <ul>
                                <li><a href="#">Dentists in Indiranagar</a></li>
                                <li><a href="#">Dental Practitioners in HAL 2nd Stage</a></li>
                                <li><a href="#">Dental Clinics in HAL</a></li>
                                <li><a href="#">Teeth and Gum Doctors in HAL 3rd Stage</a></li>
                                <li><a href="#">Dentists in Domlur</a></li>
                            </ul>
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
                        <li><a href="#"><img src="{{  asset('images/social_fb.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{  asset('images/social_twitter.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{  asset('images/social_linkedin.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{  asset('images/social_instagram.png') }}" alt=""></a></li>
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
<script type="text/javascript" src="{{  asset('js/navigation.css') }}"></script>
<script type="text/javascript" src="{{  asset('js/tabs.css') }}"></script>

<script>
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

<script>

    $('#name_lable').hide();
    $('#name').hide();
    $('#description_lable').hide();
    $('#description').hide();

    $('#new_cv_file').live('change', function(){

        $('#name_lable').show();
        $('#name').show();
        $('#description_lable').show();
        $('#description').show();

    });

    $(function () {


        $(".cancelApplication").click(function () {

            return confirm("Are you sure to delete this item?");

        });

        $('.created_at').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date()
        });

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

        $('.office-title').click(function () {
            $(this).next('div').slideToggle();

            $(this).parent().siblings().children().next().slideUp();
            return false;
        });
    });

</script>
<script type="text/javascript" src="js/jquery-sticky-scroll.js"></script>
</body>
</html>