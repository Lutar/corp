@extends(env('THEME').'.layouts.site')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
    <div id="content-index" class="content group">
        <img class="error-404-image group" src="{{ asset(env('THEME')) }}/images/features/404.png" title="Error 404" alt="404" />
        <div class="error-404-text group">
            <p>{{ trans('ru.not_exist') }}<br />{{ trans('ru.could') }} <a href="{{ route('home') }}">{{ trans('ru.home') }}</a>.</p>
        </div>
    </div>
@endsection

@section('footer')
    @include(env('THEME').'.footer')
@endsection

