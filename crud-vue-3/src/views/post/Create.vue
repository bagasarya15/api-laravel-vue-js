<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Add Post</h4>
                        <hr>

                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Title</label>
                                <input type="text" class="form-control" v-model="post.title"
                                    placeholder="Masukkan Judul Post">
                                <!-- validation -->
                                <div v-if="validation.title" class="mt-2 alert alert-danger">
                                    {{ validation.title[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="font-weight-bold">Content</label>
                                <textarea class="form-control" rows="4" v-model="post.content"
                                    placeholder="Masukkan Konten Post"></textarea>
                                <!-- validation -->
                                <div v-if="validation.content" class="mt-2 alert alert-danger">
                                    {{ validation.content[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    name: 'PostCreate',
    setup() {
        let successMessage = ref('');
        //state posts
        const post = reactive({
            title: '',
            content: ''
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //method store
        function store() {

            let title = post.title
            let content = post.content

            axios.post('http://localhost:8000/api/post', {
                title: title,
                content: content
            }).then(response => {
                const message = response.data.message;
                successMessage = message;
                router.push({
                    name: 'PostIndex',
                });
            }).catch(error => {
                validation.value = error.response.data;
            });
        }

        return {
            post,
            validation,
            router,
            store,
            successMessage,
        }

    }

}
</script>

<style>
body {
    background: lightgray;
}
</style>