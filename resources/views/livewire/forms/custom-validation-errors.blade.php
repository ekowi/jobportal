<div>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <div class="font-medium fw-semibold mb-1">{{ __('Whoops! Something went wrong.') }}</div>

            <ul class="list-disc list-inside mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
