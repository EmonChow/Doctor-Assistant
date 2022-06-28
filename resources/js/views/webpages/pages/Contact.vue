<template>
    <div class="page-banner"
         style="background-image: url('http://dap-demo.bcmedico.com/web/images/b8cb9975d682ff9c6c1aa57192db086e.jpg')">
        <h4 class="title text-center pt-4">
            Contact Us
            <span></span>
        </h4>
    </div>
    <div class="contact mt-5 mb-5">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-md-6">
                    <div v-html="$store.state.website_data.contact_text"></div>
                </div>
                <div class="col-md-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.278881196524!2d90.36338951498178!3d23.77308148457819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0aff5541897%3A0x16821aaca87209b!2sShyamoli%20Children%20Park!5e0!3m2!1sen!2sbd!4v1566675145034!5m2!1sen!2sbd"
                        width="100%" height="500PX" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Contact"
}
</script>

<style scoped>

</style>
