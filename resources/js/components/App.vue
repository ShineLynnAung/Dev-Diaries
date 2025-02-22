<template>
   <!-- <div class="fixed top-0 w-full"> -->
   <div :class="theme" class=" mx-8">
      <div class="flex justify-between items-center py-4 text-4xl">
         <router-link to="/"><h1 class="font-bold">Dev Daries</h1></router-link>
      <button @click="toggleTheme" class="float-end">
         <i :class="theme === 'light' ? 'fas fa-moon' : 'fas fa-sun'"></i>
      </button>
      
   </div>
      <router-view />
   </div>
</template>

<script>
export default {
   data() {
      return {
         theme: localStorage.getItem("theme") || "light",
      };
   },
   methods: {
      toggleTheme() {
         this.theme = this.theme === "light" ? "dark" : "light";
         localStorage.setItem("theme", this.theme); 
         document.documentElement.className = this.theme; 
      },
   },
   mounted() {
      document.documentElement.className = this.theme; // Apply saved theme on load
   },
};
</script>

<style>
.light {
   background-color: white;
   color: black;
}

.dark {
   background-color: black;
   color: white;
}

button {
   background: none;
   border: none;
   cursor: pointer;
   font-size: 24px;
}
</style>