<template>
    <footer class="footer has-cards">
<!--    <footer class="footer">-->
<!--        <div class="container container-lg">-->

        <div class="container container-lg">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <div class="card card-lift--hover shadow border-0">
                        <NuxtLink to="/generate-qr-code-online" title="Generate QR Code">
                            <img src="/img/theme/qr_code_page.png" class="card-img">
                        </NuxtLink>
                    </div>
                </div>
                <div class="col-md-6 mb-5 mb-lg-0">
                    <div class="card card-lift--hover shadow border-0">
                        <NuxtLink to="/download-libreoffice-cv-templates" title="LibreOffice CV Templates">
                            <img src="/img/theme/libreoffice_cv_templates.jpeg" class="card-img">
                        </NuxtLink>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row row-grid align-items-center my-md">
                <div class="col-lg-6">
                    <h3 class="text-primary font-weight-light mb-2">{{$t('Thank')}} {{$t('you')}} {{$t('for')}} {{$t('visiting')}} {{$t('me')}}!</h3>
                    <h4 class="mb-0 font-weight-light">Let's get in touch on any of these platforms.</h4>
                </div>
                <div class="col-lg-6 text-lg-center btn-wrapper">
                    <a target="_blank" href="https://www.linkedin.com/in/gihan-dilanka" rel="nofollow" class="btn btn-icon-only btn-linkedin rounded-circle" data-toggle="tooltip" data-original-title="Linkedin">
                        <span class="btn-inner--icon"><i class="fa fa-linkedin"></i></span>
                    </a>
                    <a target="_blank" href="https://github.com/gihandilanka-github" rel="nofollow" class="btn btn-icon-only btn-github rounded-circle" data-toggle="tooltip" data-original-title="Github">
                        <span class="btn-inner--icon"><i class="fa fa-github"></i></span>
                    </a>
                    <a target="_blank" href="https://www.facebook.com/gihan.somarathne" rel="nofollow" class="btn-icon-only rounded-circle btn btn-facebook" data-toggle="tooltip" data-original-title="Facebook">
                        <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/gihandilanka" rel="nofollow" class="btn btn-icon-only btn-instagram rounded-circle" data-toggle="tooltip" data-original-title="Instagram">
                        <span class="btn-inner--icon"><i class="fa fa-instagram"></i></span>
                    </a>
                    <a target="_blank" href="https://twitter.com/gihan_dilanka" rel="nofollow" class="btn btn-icon-only btn-twitter rounded-circle" data-toggle="tooltip" data-original-title="Twitter">
                        <span class="btn-inner--icon"><i class="fa fa-twitter"></i></span>
                    </a>
                </div>
            </div>
            <hr>
            <div class="row align-items-center justify-content-md-between">
                <div class="col-md-6">
                    <div class="copyright">
                        &copy; {{ $moment().format('YYYY')}}
                        <router-link :to="{name:'welcome'}">
                            {{$t('Gihan Dilanka')}}
                        </router-link>.
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-footer justify-content-end">
<!--                        <li class="nav-item">-->
<!--                            <a href="" class="nav-link" target="_blank">{{$t('Apps')}}</a>-->
<!--                        </li>-->
                        <li class="nav-item">
                            <NuxtLink to="/contact-us" class="nav-link">
                                {{$t('Contact Us')}}
                            </NuxtLink>
                        </li>
                        <li class="nav-item">
                            <NuxtLink to="/privacy-policy" class="nav-link">
                                {{$t('Privacy Policy')}}
                            </NuxtLink>
                        </li>
                        <li class="nav-item">
                            <a href="https://blog.gihandilanka.com" class="nav-link" target="_blank">{{$t('Blog')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
  name: 'HomeFooter',

  components: {
  }
}
</script>
