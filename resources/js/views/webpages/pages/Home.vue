<template>
    <section class="main-banner">
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra
                    attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger
                    container.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p>
            </div>
        </div>
    </section>

    <section class="mt-5 mb-5">
        <h1 class="title text-center">

        </h1>
        <div class="container">

        </div>
    </section>

    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="title">Title
                        <span>SubTitle</span></h1>
                    <div>Html Descirption</div>
                </div>
                <div class="col-md-6">
                    <img src="https://placeimg.com/800/520/tech?2" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!--    <h1>Hello world</h1>-->
    <!--    <router-link to='/dashboard'>Dashboard</router-link>-->
</template>

<script>


export default {
    name: 'Home',
    data() {
        return {
            sliders: [],
            doctors: []
        }
    },
    methods: {},
    mounted() {

    }
}
</script>

<style lang="scss">
.main-banner {
    height: 80vh;
    width: 100%;

    .carousel-item {
        height: 80vh;
    }
}

.title {
    font-weight: 700;
    font-size: 2.3rem;
    position: relative;
    line-height: 3.8rem;
    font-family: Montserrat, sans-serif !important;
    color: #404040;

    span {
        display: block;
        font-size: .9rem;
        line-height: 2.5rem;
        margin-top: -20px;
        font-weight: 300;
    }
}
</style>
