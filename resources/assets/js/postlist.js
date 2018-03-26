
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
  el: '#app',
    
  data: {
    items: [],
    message: 'Hi Vue!',
    hasError: true,
  },
  mounted : function(){
        this.getVueItems();
  },
  methods : {
        getVueItems: function(){
            axios.get('/vue/items').then(response => {
            this.items = response.data;
            
          });
        },
  }
});
