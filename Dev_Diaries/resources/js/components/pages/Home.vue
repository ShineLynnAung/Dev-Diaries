<template>
    <div class="mt-5 mb-6">
        <h1 class="text-3xl font-bold mb-6">Articles</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="post in posts" :key="post.id" class="border border-rounded border-lg shadow-lg overflow-hidden">
                <router-link :to="{ name: 'details', params: { id: post.id } }">
                    <img :src="post.path" :alt="post.title" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ post.title }}</h2>
                </div>
          </router-link>
                
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
   data() {
        return{
            posts: []
        };
    },
    mounted() {
        axios.get('api/posts')
        .then(response => {
            this.posts = response.data;
        });
      },
}
</script>