@php
    $users= \App\Models\User::where('id', '!=', auth()->user()->id)->get();
    $time= now()->subMinutes(10);

    $active_users= \App\Models\User::where('last_login', '>=', $time)->pluck('id')->toArray();
@endphp

<div class="col-sm-3 chat-users">
    <div class="row">
        <h3>Active Users</h3>
    </div>
    <div class="row">
        @foreach($users as $user)
        <div class="col-sm-12 chat-user
            @if(in_array($user->id, $active_users))
                online
            @endif
        ">
            <a href="#">
                <img src="{{asset($user->image)?? '/images/no_user.jpg'}}" class="pull-left"/>
                &nbsp;
                {{$user->fname.' '.$user->lname}}
            </a>
        </div>
        @endforeach

    </div>
</div>
