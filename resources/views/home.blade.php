@extends("layouts.app")

@section("title", "Exam")

@push("css")
    <link rel="stylesheet" type="text/css" href="{{mix("/css/app.css")}}" />
@endpush

@push("js")
    <script type="text/javascript">
        window.countries = {!! json_encode($countries) !!};
    </script>
    <script type="text/javascript" src="{{mix("/js/app.js")}}"></script>
@endpush

@section("content")
    <form method="POST" action="/">
        @if (\Session::has('message'))
            <div class="note">
                <p>{!! \Session::get('message') !!}</p>
            </div>
        @endif
        {!! csrf_field() !!}
        @if($errors->any())
            <div class="errors-container">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            <i class="icon fas fa-exclamation-circle"></i>
                            {!! $error !!}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-form">
            <div class="form-element">
                <select v-model="selectedCountry" name="country">
                    <option v-for="country in countries" :value="country.id">@{{ country.name }}</option>
                </select>
            </div>
            <div class="form-element">
                <select v-model="selectedCity" name="country">
                    <option v-for="city in cities" :value="city.code">@{{ city.name }}</option>
                </select>
            </div>
        </div>
    </form>
@endsection
