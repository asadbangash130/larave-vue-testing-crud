import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
// import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Companies from '../components/Companies';
import AddCompany from '../components/AddCompany';
import EditCompany from '../components/EditCompany';
import Employees from '../components/Employees';
import AddEmployee from '../components/AddEmployee';
import EditEmployee from '../components/EditEmployee';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'companies',
        path: '/companies',
        component: Companies
    },
    {
        name: 'addcompany',
        path: '/companies/add',
        component: AddCompany
    },
    {
        name: 'editcompany',
        path: '/companies/edit/:id',
        component: EditCompany
    },

    {
        name: 'employees',
        path: '/employees',
        component: Employees
    },
    {
        name: 'addemployee',
        path: '/employees/add',
        component: AddEmployee
    },
    {
        name: 'editemployee',
        path: '/editemployee',
        component: EditEmployee
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
