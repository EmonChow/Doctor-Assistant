<template>
    <sb-header type="overlap" :title="formTitle"
               description="....."/>
    <div class="container-xl px-4 mt-n10">
        <sb-form :title="formTitle" :fields="fields" :url="url"
                 :method="method"
                 :resetForm="reset"
                 :ajax="ajax"
        />
    </div>
</template>

<script>
export default {
    name: "Create",
    data() {
        return {
            fields: {
                logo: {
                    label: 'Website Logo',
                    type: 'file_field'
                },
                featured_doc_title: {
                    label: 'Feature Doctor Title',
                },
                featured_doc_sub_title: {
                    label: 'Feature Doctor Sub title'
                },
                about_title: {
                    label: 'About Title'
                },
                about_sub_title: {
                    label: 'About Sub Title'
                },
                about_text: {
                    label: 'About Us Text',
                    type: 'text_field'
                },
                about_image: {
                    label: 'About Us Image',
                    type: 'file_field'
                },
                contact_text: {
                    label: 'Contact Text',
                    type: 'text_field'
                },
                map: {
                    label: 'Google Map Code',
                    type: 'text_field'
                },
                appointment_call: {
                    label: 'Appointment Phone Number',
                    col: 12
                },
                appointment_text: {
                    label: 'Appointment Text'
                }
            },
            formTitle: 'Create Website Data',
            url: '/website-data',
            method: 'post',
            reset: true,
            ajax: null
        }
    },
    beforeMount() {
        if (this.$route.params.id) {
            this.ajax = `${this.url}/${this.$route.params.id}`
        }
    },
    mounted() {
        if (this.$route.params.id) {
            this.url = `${this.url}/${this.$route.params.id}`
            this.method = 'put'
            this.reset = false
            this.formTitle = 'Website Data'
        }
    }
}
</script>

<style scoped>

</style>
