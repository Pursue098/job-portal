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
                    <li><a href="#">Consult</a></li>
                    <li><a href="#">HealthGinie for Doctors</a></li>
                    <li><a href="{!! URL::route('event.index') !!}">Events</a></li>
                    <li><a href="{!! URL::route('jobs.index') !!}">Jobs</a></li>
                    <li><a href="{!! URL::route('appliedJobsByApplicant') !!}">Applied Jobs</a></li>
                    <li><a href="{!! URL::route('user.login') !!}">Login</a></li>
                    <li><a href="{!! URL::route('user.signup') !!}">Register</a></li>
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
                    @if(count($event) > 0)
                        <h2>{!! $event->name !!}</h2>
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

                                @if(isset($event->image))
                                    {{ Form::image(url('assets/images/event/'.$event->image), 'e_image', array("class"=>"e_image", "style"=>"width:662px; height:300px;")) }}
                                @endif
                                @if(isset($accessibility))
                                    <div class="row">
                                        <div class="col-xs-12" style="margin-top: 10px;">
                                            @foreach (array_values($accessibility) as $index => $value)
                                                @if($event->accessibility == $index)
                                                    {!! $value !!}
                                                @elseif($event->accessibility == $index)
                                                    {!! $value !!}
                                                @endif
                                            @endforeach

                                            @if($event->getEventOwnerUser($event->user_id) != false)

                                                . Hosted by
                                                <a href="">
                                                    {{$event->getEventOwnerUser($event->user_id)->user_profile->first()->first_name}}
                                                    {{$event->getEventOwnerUser($event->user_id)->user_profile->first()->last_name}}
                                                </a>

                                            @endif

                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="jobs_apply_detail_block clearfix">
                            <div class="detail_block_outer">

                                <h3>Description</h3>
                                <div class="event-content-detail">
                                    <p>Event Name<span>
                                        <a href="">{!! $event->name !!}</a>
                                    </span>
                                    </p>
                                    <p>Date<span>
                                        {!! $event->created_at->toFormattedDateString() !!}
                                    </span>
                                    </p>
                                    <p>Location<span>
                                    {!! $event->location !!}
                                            <span style="margin-left: 10px;"> show map</span>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="jobs_apply_detail_block clearfix">
                            <div class="post_block_outer">
                                <h3>Recent posts</h3>

                                    @if(isset($event->posts) && count($event->posts) > 0)
                                        @foreach ($event->posts as $post)
                                            <div class="row post-content-block">
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="col-xs-2 user-profile-image">
                                                                @if($post->getPostUser($post->id) !== false)
                                                                    @if(isset($post->getPostUser($post->id)->user_profile[0]))
                                                                        {{ Form::image(url('packages/jacopo/laravel-authentication-acl/images/avatar.png'), 'p_image', array("class"=>"p_image", "style"=>"width:70px; height:60px; margin-left:-16px; float:left; border: 1px solid #fff0ff;")) }}
                                                                    @endif
                                                                @endif

                                                            </div>
                                                            <div class="col-xs-10 user-profile-content" style="line-height: 0px;">
                                                                @if($post->getPostUser($post->id) !== false)
                                                                    <p>{{$post->getPostUser($post->id)->user_profile[0]->first_name}}</p>
                                                                    <span class="post-text-date" style="font-size: 10px;">{{$post->created_at}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 post-content">
                                                            <span>
                                                                {{strip_tags($post->postText)}}
                                                            </span>
                                                            @if(isset($post->images[0]))
                                                                <span>
                                                                {{ Form::image(url('assets/images/post/'.$post->images->first()->name), 'p_image', array("class"=>"p_image", "style"=>"width:662px; height:250px; margin-top:4px;")) }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
{{ HTML::script('js/ckeditor/ckeditor.js') }}

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

    $(document).ready(function(){
        $(".more").toggle(function(){
            $('.event-desc-block').animate({height:40},200);
        },function(){
            $('.event-desc-block').animate({height:10},200);
        });
    });


    $(".more").toggle(function(){
        $(this).text("less..").siblings(".complete").show();
    }, function(){
        $(this).text("more..").siblings(".complete").hide();
    });

</script>

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

        $('.office-title').click(function () {
            $(this).next('div').slideToggle();

            $(this).parent().siblings().children().next().slideUp();
            return false;
        });

        CKEDITOR.replace( 'writePost',{
            width: '100%',
            height: 80,
            toolbar:  [
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                { name: 'styles', items: [ 'Styles', 'Format' ] },
            ]
        } );
    });

</script>
<script type="text/javascript" src="js/jquery-sticky-scroll.js"></script>
</body>
</html>