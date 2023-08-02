require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

import TaskList from './components/TaskList.vue';
import AddTask from './components/AddTask.vue';
import EditTask from './components/EditTask.vue';
import Login from './components/Login.vue';

Vue.use(VueRouter);

const routes = [
    { path: '/', component: TaskList },
    { path: '/add', component: AddTask },
    { path: '/edit/:id', component: EditTask },
    { path: '/login', component: Login },
];

const router = new VueRouter({
    routes,
});

const app = new Vue({
    el: '#app',
    router,
});