@component('mail::message')

{{trans('labels.name')}} : {{@$request['name']}} <br>
{{trans('labels.email')}} : {{@$request['email']}} <br>
{{trans('labels.telephone')}} : {{@$request['telephone']}} <br>

<hr>

{{trans('labels.subject')}} : {{@$request['subject']}} <br>
{{trans('labels.message')}} : <br>
{{@$request['message']}}

@endcomponent
