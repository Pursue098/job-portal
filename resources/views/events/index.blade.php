
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
            @if(isset($events))
                @forelse($events as $event)

                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            ID:
                        </div>
                        <div class="col-xs-9">
                            {{ $event->id }}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Event Title:
                        </div>
                        <div class="col-xs-9">
                            {{ $event->name }}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Event Description:
                        </div>
                        <div class="col-xs-9">
                            {{ $event->description }}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Location:
                        </div>
                        <div class="col-xs-9">
                            {{ $event->location }}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Accessibility:
                        </div>
                        <div class="col-xs-9">
                            {{ $event->accessibility }}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Active:
                        </div>
                        <div class="col-xs-9">
                            {{ $event->active }}
                        </div>
                    </div>

                    <div class="col-xs-12">
                        @if( $event->id)
                            <div class="col-xs-8" style="margin-top: 20px;">

                                @if(isset($event->user))
                                    @if(count($event->user) > 0)

                                        @if($event->getSubscribed($event->id) == true)
                                            <a href="{!! URL::route('v1.client.event.show', ['id' => $event->id]) !!}" style="margin-left: 30px;">
                                                Unsubscribe
                                            </a>

                                            @if($event->getPosts($event->id) == true)
                                                <a href="{!! URL::route('v1.client.post.show', ['id' => $event->id]) !!}" style="margin-left: 20px;">
                                                    Its Post
                                                </a>
                                            @endif
                                        @elseif($event->getSubscribed($event->id) == false)
                                            <a href="{!! URL::route('v1.client.event.show', ['id' => $event->id]) !!}" style="margin-left: 30px;">
                                                Subscribe
                                            </a>
                                        @endif
                                    @else
                                        <a href="{!! URL::route('v1.client.event.show', ['id' => $event->id]) !!}" style="margin-left: 30px;">
                                            Subscribe
                                        </a>
                                    @endif
                                @else
                                    <a href="{!! URL::route('v1.client.event.show', ['id' => $event->id]) !!}" style="margin-left: 30px;">
                                        Subscribe
                                    </a>
                                @endif

                            </div>
                        @endif
                    </div>
                    <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb;margin-bottom: 20px;">

                @empty
                    <p>No event is created</p>
                @endforelse
            @endif
        </div>

    </div>
    @section('footer_scripts')
        <script>

            (function($) {

            })(jQuery);
    </script>
    @stop