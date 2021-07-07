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

const app = new Vue({
    el: '#app',
    data () {
        return {
            selectedCountry: '',
            selectedCity: '',
            countries: [],
            cities: []
        }
    },
    mounted() {
        this.countries = window.countries;
    },
    watch: {
        selectedCountry(id) {
            if (id) {
                axios.get(dataRoute("countries", {"country": id}))
                    .then((res) => {
                        this.cities = res.data;
                    });
            }
        }
    }
});
