<template>
    <div class="mt-5">
        <h1 class="text-3xl font-bold mb-6">Create Post</h1>
        <form @submit.prevent="createPost" enctype="multipart/form-data">
            <div class="flex gap-4">
                <div>
                    <!-- Title Input -->
                    <input
                        v-model="title"
                        type="text"
                        class="w-full border p-2 mb-4"
                        placeholder="Title"
                        required
                    />

                    <!-- Image Upload -->
                    <input
                        type="file"
                        class="w-full border p-2 mb-4"
                        @change="previewImage"
                        ref="image"
                        required
                    />

                    <!-- Image Preview -->
                    <img
                        :src="imageUrl || defaultImage"
                        alt="Image Preview"
                        class="h-40 mb-4"
                    />
                </div>

                <!-- Content Textarea -->
                <textarea
                    v-model="content"
                    class="w-full border border-gray-500 rounded-md p-2 mb-4"
                    placeholder="Content"
                    required
                ></textarea>
            </div>

            
            <button class="bg-blue-500 text-white p-2 rounded-md" type="submit">
                Create
            </button>
        </form>

        <!-- Success Message -->
        <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            title: '',
            content: '',
            image: null,
            imageUrl: null,
            successMessage: '',
            defaultImage:
                'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAANlBMVEX///+/v7+8vLzKysr8/Pzg4ODFxcXb29vT09Pj4+P4+PjBwcH6+vry8vLY2NjIyMjs7Ozo6Oia8u11AAAEdUlEQVR4nO2d65bqIAxGp/Smrb34/i971KqlEC7FGuJZ3/7dKewJBgK4/PsDAAAAAAAAAAAAAAAA4KUam5+i3m94UsUPoVoYwlA6MIShfGAIQ/nAEIbyOcBQSeNww9NZGOXBhuq8+w1fxugfDG1gmB0YBoFhdmAYBIbZgWEQGGYHhkFgmB0YBoFhdmAYBIbZyWB4qVI6mgyv4WUeH7u007lL7vFeWA3n8rUFrZqWK5KchnWvPapOTGFkNDQPOJrhk45Hw2d4Ns+oVPlRz2NhMxyawkTtv2OWAJvhSBwzfjBO2+g/5TLs7BDeSF4eDP0Y+yiX4UydFKtT4pRxa3SKTcVchtQgLYrobhq0Kj7+XIb0aX+fZtipHfH/ScPlZZG5Jq9hk2RYP96lTnFPcxnWpGF52d2eNrPGPc5lOJC5NDrl65Sv1fs16nEuw8v20sdCP+9uTh8NZVSuYVvTnKlBmjAdaqu/uH8Qm2FVWuNUJYSwOu3tLV9tcelNw5SF9yZjRaVixvpwbrZRTKnyuyKysRXOGn/QBqpK25QzptVm9598eyfqXDaPnah+GlNmwr/aGOcqYl3DvJtYzXU7jvU1bbVmVdExE+pP7Qjb6TiiOBFmOPuyD7XyC+djWYadGt2KxE5PzMpWluHtXc6KQZ/rNYK5RpThfWXnrGzp6iRcQ0ky7KbHK+iBup3rtQZD6wZJhq+9HDIsri89BBsUZPguIal0Y871K6ECRY6hXkFaimQeXQjVUHIMNwWkuVax5/q1xcC6Rozh0G+7vYmidaqzCaJ/whBjaEZJr608Y7QIHvBIMbR3/dfB55jr3/hrKCGGxMHN+vmi53rtSW+uEWLYUj1/dsY1169tetc1MgwHaw9HU3TN9Svec0huw4os6CZHcO7dcc/163O+XMNteC0JRfdk0Aby6BNfDcW9i1EquzedI4R36vAYLfy5htnwtnBRvaHo/SZxjN8Nz7UO5ltf97WnMgbqHCfhRbmHKa/hdXl2qxjzQQsaunMNr+FzUlD62W8bORD9TM4gshpe3xVg+Z7BonJlmN55mMhpWGkV4GughtacsbgvLnAa6hXga6B666I9OGsoRsPtMbCa7l2q6OVaAs6uMxpejXDdd+SPSTMP+vyGdri6+bAQui8u8BmaIbwxUdcXkg0dNRTjOf6BNiSOGirrXYxjcXQ+632ag6EPE7kMiU/h4dA1FJfhgUnTzZTRkCOEt8apYcpj+P1E6u4+j+H3E+kCdUmKxZAjkS4QrbMY8nwKC7qGYjFkSaQL9rqGw5AthORhIoMhUyJ9ksPwsDI+Brv97xtWY8mJNUwZYtixYu0qyjhd+yYwDALD7MAwCAyzA8MgMMwODIPAMDtHGxZ1JYvjDRvWajCC7SYRfhsBhvKBIQzlA0MYygeGMJQPDGEoHxjCUD4whKF8YAhD+cAQhvKBIQzlA0MYygeGMJQPDGEoHxjCUD4whKF8YAhD+cAQhvJJM/wpEgyv9U+R8iNaAAAAAAAAAAAAAAAAAP4r/gEYCYE2Xwz6DQAAAABJRU5ErkJggg==',
        };
    },
    methods: {
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.image = file;
                this.imageUrl = URL.createObjectURL(file);
            } else {
                this.image = null;
                this.imageUrl = null;
            }
        },

        async createPost() {
            try {
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('content', this.content);
                formData.append('path', this.image);

                const response = await axios.post('/api/posts', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' },
                });

                this.successMessage = response.data.message;
                this.resetForm();
            } catch (error) {
                console.error('Error creating post:', error.response?.data || error);
            }
        },

        resetForm() {
            this.title = '';
            this.content = '';
            this.image = null;
            this.imageUrl = null;
            this.$refs.image.value = null; 
        },
    },
};
</script>
