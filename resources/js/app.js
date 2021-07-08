/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.dataRoute = function (name, routeObject = {}) {
    if (window.routeList.hasOwnProperty(name)) {
        let rawUrl = window.routeList[name];
        let compareUrl = rawUrl;
        const params = [];

        _.forEach(routeObject, (value, key) => {
            rawUrl = rawUrl.replace(`{${key}}`, value);

            // if the url didn't change, it needs to be added as a param
            if (compareUrl === rawUrl) {
                params.push(encodeURIComponent(key) + "=" + encodeURIComponent(value));
            }

            compareUrl = rawUrl;
        });

        if (params.length > 0) {
            rawUrl += "?" + params.join("&");
        }

        return rawUrl;
    }

    // TODO: Throw an exception here instead?
    console.error(`No known route: ${name}`);
    return "";
};

// Add a response interceptor
axios.interceptors.response.use(function (response) {
    // Do something with response data
    return response;
}, function (error) {
    if (error.response && error.response.data) {
        return Promise.reject(error.response.data);
    }

    return Promise.reject(error);
});


const app = new Vue({
    el: '#app',
    data () {
        return {
            selectedCountry: '',
            countries: [],
            cities: [],
            searchCountry: "",
            searchCity: "",
            weatherData: {}
        }
    },
    computed: {
        filteredCountries() {
            let country =  this.countries;
            if (this.searchCountry) {
                country = country.filter((c) => {
                    return c.name.toLowerCase().includes(this.searchCountry.toLowerCase());
                });
            }

            return country;
        },
        filteredCities() {
            let cities =  this.cities;
            if (this.searchCity) {
                cities = cities.filter((c) => {
                    return c.name.toLowerCase().includes(this.searchCity.toLowerCase());
                });
            }

            return cities;
        }
    },
    mounted() {
        this.countries = window.countries;
    },
    watch: {
        selectedCountry(country) {
            if (country) {
                axios.get(dataRoute("countries", {"country": country.id}))
                    .then((res) => {
                        this.cities = res.data;
                    });
            }
        }
    },
    methods: {
        getWeather(city) {
            axios.post(dataRoute("weather"), {"city": city.id})
                .then((res) => {
                    this.weatherData = res.data;
                }).catch((res) => {
                    this.errors = res.errors;
                });
        }
    }
});
