/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');
require('./components/whise/Data');
require('./components/whise/Form');
require('./components/whise/Tasks');
require('./components/whise/TaskHeader');
require('./components/whise/TaskItem');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();