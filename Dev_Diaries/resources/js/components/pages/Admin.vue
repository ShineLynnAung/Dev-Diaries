<template>
    <div>
        <h1 class="text-4xl text-center">Admin Panel</h1>
        <router-link to="/create" class="float-end">
            <i class="fa-solid fa-plus px-3"></i>Add New
        </router-link>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Content</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts" :key="post.id">
                    <td class="border px-4 py-2">
                        <img :src="post.path" :alt="post.title" class="w-[50px] h-[50px] object-cover">
                    </td>
                    <td class="border px-4 py-2">{{ post.title }}</td>
                    <td class="border px-4 py-2">{{ post.content.split(' ').slice(0, 15).join(' ') }}...</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "Admin",
    data() {
        return {
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

<style>

</style>