<div class="rounded bg-white mb-3 p-3">
    <div class="border-dashed d-flex align-items-center w-100 rounded p-md-5">
        @if(!Auth::user()->hasVerifiedEmail())
            <h2 class="text-muted center fw-light">
                Dear user!<br>
                You have not verified your email address. To use the site's services, you need to confirm your email first. For this, just <a href="{{route("verification.notice")}}">click here</a>.
            </h2>
        @endif
    </div>
</div>
