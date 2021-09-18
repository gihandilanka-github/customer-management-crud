<template>
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="/img/brand/gapstars.png" class="navbar-brand-img" alt="...">
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <NuxtLink to="/dashboard" class="nav-link">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">{{$t('dashboard')}}</span>
                            </NuxtLink>
                        </li>
                        <li class="nav-item" v-for="(tab, index) in tabs" :key="index">
                            <a :class="['nav-link', mainMenuActive(tab.mainMenuId)? 'active' : '']" :href="'#navbar-'+index" data-toggle="collapse" role="button" :aria-expanded="mainMenuActive(tab.mainMenuId)" :aria-controls="'#navbar-'+index">
                                <i :class="['fa', 'text-primary', 'fa-'+tab.icon]"></i>
                                <span class="nav-link-text">{{tab.mainMenu}}</span>
                            </a>
                            <div :id="'navbar-'+index" :class="['collapse', mainMenuActive(tab.mainMenuId) ? 'show' : '']">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item" v-for="subMenu in tab.subMenu" :key="subMenu.route">
                                        <NuxtLink :to="subMenu.route" class="nav-link">
                                            <i :class="['fa', 'text-primary', 'fa-'+subMenu.icon]"></i>
                                            <span class="sidenav-normal"> {{ subMenu.name }} </span>
                                        </NuxtLink>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'DashboardLeftSideBar',
    components: {
    },

    data: () => ({
    }),

    computed: {
        ...mapGetters({
            user: 'auth/user'

        }),
        tabs () {
            return [
                {
                    mainMenu: this.$t('customers'),
                    mainMenuId: 'customers',
                    icon: 'users',
                    subMenu: [
                        {
                            icon: 'user-plus',
                            name: this.$t('customer')+" "+this.$t('create'),
                            route: '/customers/create'
                        },
                        {
                            icon: 'list',
                            name: this.$t('customers')+" "+this.$t('list'),
                            route: '/customers'
                        }
                    ]
                }
            ]
        },

    },


    methods: {
        async logout () {
            // Log out the user.
            await this.$store.dispatch('auth/logout')

            // Redirect to login.
            this.$router.push({ name: 'login' })
        },
        mainMenuActive(menuRoute){
            let segments = this.$route.path.substring(1).split("/");
            if(menuRoute == segments[0]) {
                return true;
            }else {
                return false;
            }
        }
    }
}
</script>

<style scoped>

</style>
