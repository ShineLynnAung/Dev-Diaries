<template>
  <div class="my-5">
    <img key="post.id" :src="post.path" alt="post.title" class=" object-cover">
    <h1 class="text-3xl font-bold mt-6 mb-6">{{ post.title }}</h1>
    <p class="text-base/8">{{ post.content }}</p>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return{
            post: []
        };
    },
    mounted() {
        axios.get('api/posts/' + this.$route.params.id)
        .then(response => {
            this.post = response.data;
        });
      },
}
</script>

<style>

</style>