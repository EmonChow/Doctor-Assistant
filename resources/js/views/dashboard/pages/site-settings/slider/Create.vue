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
                image: {
                    label: 'Image',
                    type: 'file_field'
                },
                title: {
                    label: 'Title',
                    col: 12
                },
                description: {
                    label: 'Description',
                    type: 'text_field'
                },
            },
            formTitle: 'Create Slider',
            url: '/slider',
            method: 'post',
            reset: true,
            ajax: null
        }
    },
    beforeMount() {
        if (this.$route.params.id) {
            this.ajax = `/slider/${this.$route.params.id}`
        }
    },
    mounted() {
        if (this.$route.params.id) {
            this.url = `${this.url}/${this.$route.params.id}`
            this.method = 'put'
            this.reset = false
            this.formTitle = 'Update Slider'
        }
    }
}
</script>

<style scoped>

</style>
