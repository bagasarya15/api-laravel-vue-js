<template>
    <h1>Halaman Home</h1>
    <div>
        <button class="btn btn-sm btn-primary" @click="post()">Post</button>
    </div>
</template>

<script>
export default {
    name: 'IndexHome',
    methods: {
    post() {
      this.$router.push('/post');
    },
  },
}
</script>