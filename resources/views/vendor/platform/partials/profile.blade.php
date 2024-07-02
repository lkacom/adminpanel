{{--<div class="logout-container align-items-stretch rounded lh-sm position-relative overflow-hidden justify-content-center">--}}
{{--    <form method="POST" action="{{ route('logout') }}">--}}
{{--        @csrf--}}
{{--        <button type="submit" class="btn btn-default btn-block p-3 no-border no-bg text-white fw-semibold">--}}
{{--            <x-orchid-icon path="bs.box-arrow-left" class="small me-2"/>--}}
{{--            {{ __('Log Out') }}--}}
{{--        </button>--}}
{{--    </form>--}}
<div class="profile-container d-flex align-items-stretch p-3 rounded lh-sm position-relative overflow-hidden">
    <a href="{{ route(config('platform.profile', 'platform.profile')) }}" data-turbo="false" class="col-10 d-flex align-items-center me-3">
        @if($image = Auth::user()->presenter()->image())
            <img src="{{$image}}"  alt="{{ Auth::user()->presenter()->title()}}" class="thumb-sm avatar b me-3" type="image/*">
        @endif

        <small class="d-flex flex-column lh-1 col-9">
            <span class="text-ellipsis text-white">{{Auth::user()->presenter()->title()}}</span>
            <span class="text-ellipsis text-muted">{{Auth::user()->presenter()->subTitle()}}</span>
        </small>
    </a>

    <x-orchid-notification/>

</div>
