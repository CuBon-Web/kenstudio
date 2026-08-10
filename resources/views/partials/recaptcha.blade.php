@php
    $recaptchaSiteKey = config('services.recaptcha.site_key');
@endphp
@if($recaptchaSiteKey)
<div class="form-group row recaptcha-wrap">
    <div class="col-md-12">
        <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
        @error('g-recaptcha-response')
            <div class="text-danger mt-2" style="font-size:14px;">{{ $message }}</div>
        @enderror
    </div>
</div>
@once
    @push('vr-scripts')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endpush
@endonce
@endif
