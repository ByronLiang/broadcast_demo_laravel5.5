const lazyLoading = (name) => process.env.NODE_ENV === 'development' ?
    () => import(`../pages/${name}.vue`) : require(`../pages/${name}.vue`);
// const Loading = (name, index = false) => require(`../pages/${name}.vue`);

const DefaultIndex = {template: '<router-view :key="$route.fullpath"></router-view>'};

module.exports = {
    base: '/',
    // history,hash
    mode: 'history',
    routes: [
        {
            path: '/welcome',
            name: 'Welcome',
            component: lazyLoading('Welcome'),
        }, {
            path: '/',
            component: require('../components/layout/Container.vue'),
            redirect: {
                name: 'Dashboard',
            },
            children: [
                {
                    name: 'Dashboard',
                    path: 'dashboard',
                    component: lazyLoading('Dashboard'),
                    meta: {
                        title: '信息面板',
                    },
                },
            ],
        }, {
            path: '*',
            redirect: '/',
        },
    ],
};
