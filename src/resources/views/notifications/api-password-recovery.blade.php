@component('mail::message')
    {{__('greeting',['name'=>$name])}}

    {{__('intro')}}

    @component('mail::button', ['url' => $url])
        {{__('buttonText')}}
    @endcomponent

    {{__('outro')}}
    <p>Teste</p>

    {{__('regards')}},<br>
    {{ config('app.name') }}
@endcomponent
