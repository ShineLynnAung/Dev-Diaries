import { createRouter, createWebHashHistory } from "vue-router";

const router = createRouter({
  history: createWebHashHistory(), 
  routes: [
    { path: "/", name: "home", component: () => import("../components/pages/Home.vue") },
    { path: "/admin", name: "admin", component: () => import("../components/pages/Admin.vue") },
    { path: "/create", name: "create", component: () => import("../components/pages/Create.vue") },
    { path: "/details/:id", name: "details", component: () => import("../components/pages/Details.vue") },
  ],
});

export default router;
