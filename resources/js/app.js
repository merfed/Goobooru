/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

var fecthMasonry = function (container, items, columns) {
    var CONTAINER_EL = document.querySelector("#" + container);
    var WRAPPER_CONTAINER_EL = CONTAINER_EL.parentNode;
    var ITEMS_ELS = document.querySelectorAll("." + items);
    CONTAINER_EL.parentNode.removeChild(CONTAINER_EL);
    var NEW_CONTAINER_EL = document.createElement('div');
    NEW_CONTAINER_EL.setAttribute('id', container);
    NEW_CONTAINER_EL.classList.add('masonry-layout', "columns-" + columns);
    WRAPPER_CONTAINER_EL.appendChild(NEW_CONTAINER_EL);
    for (var i = 1; i <= columns; i++) {
        var COLUMN = document.createElement('div');
        COLUMN.classList.add("masonry-column-" + i);
        NEW_CONTAINER_EL.appendChild(COLUMN);
    }
    var countColumn = 1;
    ITEMS_ELS.forEach(function (item) {
        var col = document.querySelector("#" + container + " > .masonry-column-" + countColumn);
        col.appendChild(item);
        countColumn = countColumn < columns ? countColumn + 1 : 1;
    });
};

fecthMasonry('masonry', 'image', 3);
