<template>
    <div class="profile-page">

    </div>
</template>

<script>

export default {
    middleware: 'redirect',
    layout:'HomeLayout',
    head: {
        title: 'Home',
        meta: [
            { name: 'description', content: 'Gihan Dilanka.' },
            { name: 'keywords', content: 'PHP, PHP Software engineers in Sri lanka, Fullstack Developers, PHP Lead Software Engineers, Technical Lead in PHP'},
            { property: 'robots', content: 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1' },
            { property: 'og:locale', content: 'en_US' },
            { property: 'og:type', content: 'article' },
            { property: 'og:title', content: 'Gihan Dilanka | Programmer'},
            { property: 'og:description', content: "Official Website of Gihan Dilanka"},
            { property: 'og:url', content: 'https://gihandilanka.com'},
            // { property: 'article:modified_time', content: '2020-11-14T19:09:55+00:00'},
            { property: 'og:image', content: 'https://gihandilanka.com/img/pages/og-home.png'},
            { property: 'og:image:width', content: '1200'},
            { property: 'og:image:height', content: '627'},
        ]
    },

    created() {
        this.$router.push('dashboard');
    }

}
</script>
<style scoped>
.card-profile{
    z-index: 1;
}
</style>
