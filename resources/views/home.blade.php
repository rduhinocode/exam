@extends("layouts.app")

@section("title", "Exam")

@push("css")
    {{--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">--}}
    <link rel="stylesheet" type="text/css" href="{{mix("/css/app.css")}}" />

@endpush

@push("js")
    <script type="text/javascript">
        window.countries = {!! json_encode($countries) !!};
    </script>
    <script type="text/javascript" src="{{mix("/js/app.js")}}"></script>
@endpush

@section("content")
    <div class="container p-5" >
        <div class="row">
            <div class="col-3 border p-0 m-2">
                <div class="p-2 pl-4 border-bottom">
                    <b>Select Country:</b>
                </div>
                <div class="p-2 pl-4 border-bottom">
                    <input v-model="searchCountry" type="text" class="form-control" name="searchCountry">
                </div>
                <div class="list" >
                    <div v-if="filteredCountries.length" v-for="country in filteredCountries" class="country p-2 pl-4 border-bottom cursor" @click="selectedCountry = country">@{{ country.flag }} @{{ country.name }}</div>
                    <div v-if="!filteredCountries.length" class="country p-2 pl-4 border-bottom"> No Country Found.</div>
                </div>

            </div>
            <div class="col-3 border p-0 m-2">
                <div class="p-2 pl-4 border-bottom">
                    <b>Select City from @{{ selectedCountry.name }}</b>
                </div>
                <div class="p-2 pl-4 border-bottom">
                    <input v-model="searchCity" type="text" class="form-control p-2" name="searchCity">
                </div>
                <div class="list">
                    <div v-if="filteredCities.length" v-for="city in filteredCities" class="p-2 pl-4 border-bottom">
                        @{{ city.name }}
                        <span class="glyphicon glyphicon-circle-arrow-right float-right cursor mr-2 mt-1" title="Get Weather" @click="getWeather(city)"></span>

                    </div>
                    <div v-if="!filteredCities.length" class="country p-2 pl-4 border-bottom"> No Cities Found.</div>
                </div>
            </div>

            <div class="col-5 border p-0 m-2">
                <div class="p-2 pl-4 border-bottom" v-for="value,index in weatherData">
                    @{{ index }}: @{{ value }}
                </div>
            </div>
        </div>
    </div>
@endsection
