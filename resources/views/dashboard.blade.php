@extends('layouts.main')

@section('center')
    <div class="col-sm-6">
        <div class="post col-sm-12" id="new_post">
            <div class="row post-heading" style="background: #2d9a40;">
                <div class="col-sm-12">
                    <h4 id="post-header">Create New Post</h4><br/>

                </div>
            </div>
            <div class="row" style="padding: 10px;">
                <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea name="status" placeholder="Whats up?" maxlength="250"></textarea>

                        @if($errors->has('status'))
                            <div class="alert alert-danger">
                                {{$errors->first('status')}}
                            </div>
                        @endif
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="pull-left">
                            <label class="btn btn-success"><input name="image" type="file" style="display: none;"/>Add Image</label>
                            @if($errors->has('image'))
                                <div class="alert alert-danger">
                                    {{$errors->first('image')}}
                                </div>
                            @endif
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-primary">POST</button>
                        </div>
                        <br>
                    </div>
                </form>
            </div>

        </div>

        @foreach($posts as $post)
            <div class="post col-sm-12" id="post_1">
                <div class="row post-heading">
                    <div class="col-sm-12">
                        <a href="{{route('profile.index')}}">
                            <img src="{{asset(auth()->user()->image)?? '/images/no_user.jpg'}}" class="profile-picture pull-left"/>
                            &nbsp;
                            <span class="post-user-name">{{$post['user']->fname.' '.$post['user']->lname}}</span><br/>
                            &nbsp;
                            <small class="post-date text-mute">{{$post['created_at']}}</small>
                        </a>
                    </div>
                </div>
                <div class="row post-body">
                    <div class="col-sm-12">
                        {{$post['status']}}
                    </div>
                    <div class="col-sm-12">
                        <img src="{{$post['photo']}}" height="200" width="300">
                    </div>
                </div>
                <div class="row post-action">
                    <ul class="post-action-menu">
                        <li><a href="javascript:void(0);" class="text-mute" onclick="like({{$post['id']}});">Like</a></li>
                        <li><a href="javascript:void(0);" class="text-mute" onclick="share({{$post['id']}});">Share</a></li>
                        <li><a href="javascript:void(0);" class="text-mute" onclick="comment({{$post['id']}});">Comment</a></li>
                        <li class="pull-right"><a href="#" class="text-mute"><span id="post_share_count_1">{{$post['shares']}}</span> Shares</a></li>
                        <li class="pull-right"><a href="#" class="text-mute"><span id="post_comment_count_1">{{$post['comments']}}</span> Comments</a></li>
                        <li class="pull-right"><a href="#" class="text-mute"><span id="post_like_count_1">{{$post['likes']}}</span> Likes</a></li>
                    </ul>
                </div>

                <div class="post-comment" id="post_comment_{{$post['id']}}" style="display: none;">
                    @php
                        $all_comments= \App\Models\Comment::where('post_id', $post['id'])->get();
                    @endphp

                    @foreach($all_comments as $comm)
                        @php
                            $user= \App\Models\User::where('id', $comm->user_id)->first();
                        @endphp
                        <div class="row">
                            <div class="col-sm-1">
                                <a href="javascript:void(0);">
                                    <img src="{{asset($user->image)}}" class="profile-picture-small pull-left"/>
                                </a>
                            </div>

                            <div class="col-sm-11">
                                <a href="javascript:void(0);">
                                    <span class="post-user-name">{{$user->fname.' '.$user->lname}}</span>
                                </a>
                                {{$comm->comment}}
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <form action="{{route('saveComment')}}" method="POST">
                            @csrf
                            <div class="col-sm-1 form-group">
                                <a href="profile.html">
                                    <img src="{{asset(auth()->user()->image ?? '/images/no_user.jpg')}}" class="profile-picture-small pull-left"/>
                                </a>
                            </div>

                            <div class="col-sm-9 form-group">
                                <textarea rows="1" name="comment" class="comment-text" placeholder="Add Comment" oninput="auto_height(this)"></textarea>
                            </div>

                            <div class="col-sm-2 form-group">
                                <input type="hidden" name="post_id" value="{{$post['id']}}">
                                <button type="submit" class="btn btn-success btn-xs">Comment</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    function like(post_id){
        var elem = document.getElementById("post_like_count_"+post_id);
        var count = parseInt(elem.innerHTML);

        $.ajax({
            url: '{{route('updateLikes')}}',
            type: 'POST',
            dataType: 'json',
            async: false,
            data: {
                post_id: post_id,
                _token: '{{csrf_token()}}'
            },
            success: function (data){
                if(data.success){
                    elem.innerHTML = count + parseInt(data.result);
                    highlight(elem);
                }
            }

        });



    }
    function share(id){
        var elem = document.getElementById("post_share_count_"+id);
        var count = parseInt(elem.innerHTML);
        elem.innerHTML = count+1;
        highlight(elem);
    }

    function comment(post_id){
        var elem = $('#post_comment_'+post_id);

        if(elem.is(":visible")){
            elem.hide();
        } else{
            elem.show();
        }

    }
    function highlight(elem){
        elem.style.color = "red";
        elem.parentElement.parentElement.style.transform="scale(1.5)";
        setTimeout(function(){
            elem.style.color="";
            elem.parentElement.parentElement.style.transform="scale(1)";
        },300);
    }
</script>
@endpush
