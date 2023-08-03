<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <div v-if="successMessage" class="mt-2 alert alert-success">
                            {{ successMessage }}
                        </div>
                        <h4>DATA POST</h4>
                        <hr />
                        <router-link :to="{ name: 'PostCreate' }" class="btn btn-md btn-success">Create Post</router-link>

                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in posts" :key="post.id">
                                    <td>{{ post.title }}</td>
                                    <td>{{ post.content }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'PostEdit', params: { id: post.id } }"
                                            class="btn btn-sm btn-primary">Edit</router-link>
                                        <button @click.prevent="postDelete(post.id)"
                                            class="btn btn-sm btn-danger mx-2">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { useRoute } from 'vue-router';
import { onMounted, ref } from 'vue'

export default {
    name: 'PostIndex',

    setup() {
        let posts = ref([])
        const route = useRoute();
        let successMessage = ref(route.query.successMessage || '');
        let timer = null;

        onMounted(() => {
            axios.get('http://localhost:8000/api/post')
                .then(response => {
                    posts.value = response.data.result;

                    // Clear the success message after 3 seconds
                    clearMessage();
                })
                .catch(error => {
                    console.log(error.response.result)
                })
        })

        function postDelete(id) {
            axios.delete(`http://localhost:8000/api/post/${id}`)
                .then(() => {
                    posts.value.splice(posts.value.findIndex(post => post.id === id), 1);
                    successMessage.value = 'Post deleted successfully.';
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        }

        function clearMessage() {
            clearTimeout(timer);
            timer = setTimeout(() => {
                successMessage.value = '';
            }, 5000);
        }

        return {
            posts,
            postDelete,
            successMessage,
            clearMessage
        }
    }
}
</script>

<style>
body {
    background: lightgray;
}
</style>
