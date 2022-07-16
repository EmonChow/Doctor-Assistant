<template>
    <sb-header type="compact" title="File Manger"/>
    <div class="container-xl px-4 mt-4">

        <nav class="nav nav-borders">
            <a class="nav-link ms-0" :class="show_files ? 'active': ''" @click="show_files = true">Files</a>
            <a class="nav-link ms-0" :class="!show_files ? 'active': ''" @click="show_files = false">Upload File</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="">
            <div class="d-flex align-content-start flex-wrap" v-if="show_files">
                <div v-for="file in file_list" @click="selectFile(file)" class="card file-card m-2"
                     :class="file.selected ? 'selected' : ''">
                    <img :src="file.thumbnail" class="img-fluid" alt="">
                    <p class="file-name">{{ file.name }}</p>
                </div>
            </div>

            <div v-else>
<!--                <Dropzone call_back="addFile"/>-->

            </div>
        </div>
    </div>
</template>

<script>
import axios from "../../../../services/apiService";
// import Dropzone from "../../../../components/dropzone/Dropzone";

export default {
    name: "FileManager",
    components: {
        // Dropzone
    },
    data() {
        return {
            show_files: true,
            file_list: []
        }
    },
    methods: {
        toggleModal() {
            let myOffcanvas = document.getElementById('fileOffcanvas' + this.fieldInfo.label.replace(/ /g, ''))
            let bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
            bsOffcanvas.toggle()
        },
        selectFile(file) {

        },
        addFile(file_manager) {
            this.file_list.push(file_manager);
        }
    },
    mounted() {
        axios.get('/files').then(({data}) => {
            this.file_list = data
        }).catch(error => {
            console.log(error)
        })
    }
}
</script>

<style scoped lang="scss">
.file-card {
    height: 10rem;
    width: 10rem;
    overflow: hidden;
    cursor: pointer;

    .file-name {
        position: absolute;
        bottom: 0;
        text-align: center;
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.5);
        color: #f1f1f1;
        width: 100%;
        margin-bottom: 0 !important;
    }

    &.selected {
        border: 4px solid red;
    }
}
</style>
