
    <div class="row">
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

        </div>
        <div class="col-md-12">
            {{--            {{dd($jobs)}}--}}
            @forelse($jobs as $job)

                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Job Title:
                    </div>
                    <div class="col-xs-9">
                        <a href="{!! URL::route('admin.jobs.show', ['id' => $job->id]) !!}">
                            {{ $job->title }}
                        </a>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="col-xs-3">
                        last Date:
                    </div>
                    <div class="col-xs-9">
                        {{ $job->last_date->toFormattedDateString() }}
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Total applications:
                    </div>
                    <div class="col-xs-9">
                        {{ count($job->user) }}
                    </div>
                </div>

                <div class="col-xs-12">
                    @if( $job->id)
                        <div class="col-xs-8" style="margin-top: 20px;">
                            <a href="{!! URL::route('admin.jobs.show', ['id' => $job->id]) !!}" class="btn btn-info" style="margin-left: 0px; margin-bottom:10px; padding: 5px; padding-left: 10px; padding-right: 10px;">
                                View
                            </a>
                            @if(isset($job->user) && count($job->user) > 0)
                                <a href="{!! URL::route('admin.jobs.show', ['id' => $job->id]) !!}" style="margin-left: 30px; padding: 5px; padding-left: 10px; padding-right: 10px;">
                                    Applications
                                </a>
                            @endif

                        </div>
                    @else
                        <i class="fa fa-times fa-2x light-blue"></i>
                        <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                    @endif
                </div>
                <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb;margin-bottom: 20px;">

            @empty
                <p>No Job is posted</p>
            @endforelse
        </div>

    </div>
    @section('footer_scripts')
        <script>

            (function($) {
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
            })(jQuery);
    </script>
    @stop