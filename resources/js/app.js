
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

Vue.component('roundComponent', require('./components/RoundComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
      parings: '',
      saveBtn: false,
      error: '',
      success: false,
      generate: false,
      loading: true
    },
    created: function() {
      var self = this
      axios.get('/parings_api/rounds/' + this.roundNum)
        .then(function(response){
          if (!self.errorEmpty(response.data.data.error)) {
            self.error = response.data.data.error
            self.generate = true
          }else{
            self.parings = response.data.data
          }
          self.loading = false
        })
    },
    computed: {
      generateBtn: function() {
        return this.success || this.generate
      },
      roundNum: function() {
        var indexOf = window.location.href.lastIndexOf('/');
        return window.location.href.substring(indexOf+1, window.location.href.length);
      },
    },
    methods: {
      drawParings: function() {
        var self = this
        axios.get('/parings_api/parings/draw')
          .then(function(response){
            console.log(response)
            if (!_.isEmpty(response.data.data.error)) {
              self.error = response.data.data.error
            }else{
              self.parings = response.data.data
              self.saveBtn = true
              self.error = ''
            }
          })
      },
      saveParings: function() {
        var self = this
        axios.post('/parings_api/parings', {
          data: this.parings
        }).then(function(response){
          if (!self.errorEmpty(response.data.data.error)) {
            self.error = response.data.data.error
            self.parings = ''
          }else{
            self.success = true
            self.saveBtn = false
            self.error = ''
            self.parings = response.data.data
          }
        })
      },
      getParings: function() {
        var self = this
        axios.get('/parings_api/')
          .then(function(response){
            self.parings = response.data.data
            self.saveBtn = true
          })
      },
      errorEmpty: function(val) {
        return _.isEmpty(val)
      }
    }
});
