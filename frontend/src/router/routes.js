import BasePage from '@/views/Painel/BasePainel.vue';
import Employees from '@/views/Painel/Employees.vue';
import Employee from '@/views/Painel/Employee.vue';

import Login from '@/views/Auth/Login.vue';
import SignUp from '@/views/Auth/SignUp.vue';

export default [
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false,
        },
    },
    {
        path: '/sign-up',
        name: 'sign-up',
        component: SignUp,
        meta: {
            auth: false,
        },
    },

    {
        path: '/',
        component: BasePage,
        meta: {
            auth: true,
        },
        children: [
            {
                path: '/employees',
                name: 'employees',
                component: Employees,
            },
            {
                path: '/employee/:id',
                name: 'edit-employee',
                component: Employee,
            },
            {
                path: '/employee',
                name: 'new-employee',
                component: Employee,
            },
        ],
    },
];

