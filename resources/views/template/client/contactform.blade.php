@component('mail::message')
    <div class="row">
        <h1 class="text-dark">{{ $subject }}</h1>

        <h3>{{ $message }}</h3>

        <h4>You can reach me via mail : {{ $email }} or telephone {{ $telephone }}<br />
            Thanks
        </h4>
    </div>
    Thanks,<br>
    {{ $fullname }}

    {{ config('app.name') }}
@endcomponent
