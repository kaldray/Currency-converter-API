import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/HomeView.vue";
import AdminView from "@/views/AdminView.vue";
import { useAuthStore } from "@/store";

const routes = [
  {
    path: "/",
    name: "Home",
    component: HomeView,
  },
  {
    path: "/admin",
    name: "Admin",
    component: AdminView,
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

router.beforeEach(async (to, from) => {
  const authStore = useAuthStore();
  if (authStore.user === null && to.name !== "Home") {
    return { name: "Home" };
  }
  if (authStore.user !== null && from.name !== "Home" && to.name === "Home") {
    return { name: "Admin" };
  }
});

export { router };
