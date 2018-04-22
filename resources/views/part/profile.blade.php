<div class="card card-profile">
    <div class="card-header" style="background-image: url({{ asset('assets/images/cover.jpg') }});"></div>
    <div class="card-body text-center">
        <img class="card-profile-img" src="{{ Gravatar::src(Auth::user()->email) }}">
        <h3 class="mb-3">{{ Auth::user()->name }}</h3>
        <p class="mb-4">
            Backend Engineer :D
        </p>
        <button class="btn btn-outline-primary btn-sm">
            <span class="fa fa-pencil"></span> {{ __("Update Profile") }}
        </button>
    </div>
</div>