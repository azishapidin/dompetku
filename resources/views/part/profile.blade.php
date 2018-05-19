<div class="card card-user">
    <div class="image">
        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&amp;fm=jpg&amp;h=300&amp;q=75&amp;w=400" alt="...">
    </div>
    <div class="content">
        <div class="author">
            <img class="avatar border-gray" src="{{ Gravatar::src(Auth::user()->email, '400') }}" alt="{{ Auth::user()->name }}">
            <h4 class="title">{{ Auth::user()->name }}<br>
                <small>{{ Auth::user()->email }}</small>
            </h4>
        </div>
        <p class="description text-center">Backend Engineer :D</p>
        <hr>
        <div class="text-center">
            <br>
            <button class="btn btn-fill btn-primary btn-sm">
                <span class="fa fa-pencil"></span> {{ __("Update Profile") }}
            </button>
        </div>
    </div>
</div>