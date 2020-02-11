@component('mail::message')
    {{__('api-password-recovery.greeting',['name'=>$name])}}

    {{__('api-password-recovery.intro')}}

    @component('mail::button', ['url' => $url])
        {{__('api-password-recovery.buttonText')}}
    @endcomponent

    {{__('api-password-recovery.outro')}}


    {{__('api-password-recovery.regards')}},<br>
    {{ config('app.name') }}
@endcomponent
