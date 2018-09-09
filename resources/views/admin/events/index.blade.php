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
                    {{ Form::image(url('assets/images/event/'.$event->image), 'p_old_image', array("class"=>"p_old_image", "style" => "width: 450px; height: 150px; margin-left:20px; border: 1px solid black;")) }}
                </div>
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
                        <a href="{!! URL::route('admin.event.show', ['id' => $event->id]) !!}" > {{ $event->name }}</a>
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
                        @if(isset($accessibility))
                            @if(isset($accessibility))
                                @foreach (array_values($accessibility) as $index => $value)
                                    @if($event->accessibility == $index)
                                        {!! $value !!}
                                    @elseif($event->accessibility == $index)
                                        {!! $value !!}
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Active:
                    </div>
                    <div class="col-xs-9">
                        @if(isset($active))
                            @if(isset($active))
                                @foreach (array_values($active) as $index => $value)
                                    @if($event->active == $index)
                                        {!! $value !!}
                                    @elseif($event->active == $index)
                                        {!! $value !!}
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="col-xs-3">
                        Its users:
                    </div>
                    <div class="col-xs-9">
                        @if(isset($event->user))
                            <a href="{!! URL::route('admin.event.list_subscribed_user', [$event->id]) !!}">
                                {{ count($event->user) }}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12">
                    @if( $event->id)
                        <div class="col-xs-12" style="margin-top: 20px;">
                            <a href="{!! URL::route('admin.event.edit', ['id' => $event->id]) !!}">
                                <i class="fa fa-pencil-square-o fa-2x"></i>
                            </a>

                            <a href="{!! URL::route('admin.post.create_post', ['id' => $event->id]) !!}" style="margin-left: 120px;">
                                Add New Post
                            </a>
                            @if($event->getPosts($event->id) == true)
                                <a href="{!! URL::route('admin.post.show', ['e_id' => $event->id, 'op_key' => $event->id]) !!}" style="margin-left: 20px;">
                                    Its Post
                                </a>
                            @endif

                            {!! Form::model($event, [ 'url' => URL::route('admin.event.destroy', ['id' => $event->id])] )  !!}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {!! Form::submit('Delete', array("class"=>"btn btn-info delete",
                             "style"=>"margin-left:65px;margin-top:-53px;")) !!}
                            {!! Form::close() !!}

                        </div>
                    @endif
                </div>

                <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb; margin-bottom: 20px;">

            @empty
                <p>No event is created</p>
            @endforelse
        @endif
    </div>

</div>
