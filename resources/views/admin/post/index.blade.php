
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
            @if(isset($posts))
                @forelse($posts as $post)

                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Your Text:
                        </div>
                        <div class="col-xs-9">
                            {{ strip_tags($post->postText) }}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-3">
                            Its Photos:
                        </div>
                        <div class="col-xs-9">

                            @if(isset($post->images))
                                @forelse($post->images as $image)
                                    @if(isset($image->name))
                                        {{ Form::image(url('assets/images/post/'.$image->name), 'p_old_image', array("class"=>"p_old_image", "style" => "margin-bottom:20px; margin-top:10px; width: 150px; height: 70px; margin-left:20px; border: 1px solid black;")) }}
                                    @endif
                                @empty
                                    <p style="color: red;">This post haven't any image.</p>
                                @endforelse
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        @if( $post->id)
                            <div class="col-xs-3">
                                Operations:
                            </div>
                            <div class="col-xs-9">

                                <a href="{!! URL::route('admin.post.edit', ['id' => $post->id]) !!}">
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                </a>

                                {!! Form::model($post, [ 'url' => URL::route('admin.post.destroy', ['id' => $post->id])] )  !!}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {!! Form::submit('Delete', array("class"=>"btn btn-info delete",
                                 "style"=>"margin-left:65px;margin-top:-50px;")) !!}
                                {!! Form::close() !!}

                            </div>
                        @else
                            <h2>Azam</h2>
                        @endif
                    </div>
                    <hr style="background-color: #a0b8cb; display: block; border: 1px solid #a0b8cb;margin-bottom: 20px;">

                @empty
                    <p>No post exist</p>
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