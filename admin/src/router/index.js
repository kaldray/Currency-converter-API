import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/HomeView.vue";
import AdminView from "@/views/AdminView.vue";
import UpdateView from "@/views/UpdateView.vue";
import CreateView from "@/views/CreateView.vue";
import DocsView from "@/views/DocsView.vue";
import { useAuthStore } from "@/store";

/**
 * @typedef {import('vue-router').RouteRecordNormalized} RouteRecordNormalized
 * @typedef {import('vue-router').RouteRecordName} RouteRecordName
 * @typedef {import('vue-router')._RouteRecordBase} RouteRecordBase
 */

/**
 *
 * @param {RouteRecordNormalized} from
 * @returns {{name:RouteRecordName}}
 */
const isAuthenticated = (from) => {
  const authStore = useAuthStore();
  if (authStore.user === null) {
    return { name: from.name };
  }
};

/**
 *
 * @type {RouteRecordBase[]}
 */
const routes = [
  {
    path: "/",
    name: "Login",
    component: HomeView,
  },
  {
    path: "/list",
    name: "Admin",
    component: AdminView,
    /**
     *
     * @param {RouteRecordNormalized} to
     * @param {RouteRecordNormalized} from
     * @returns {{name:RouteRecordName}}
     */
    beforeEnter: (to, from) => {
      return isAuthenticated(from);
    },
  },
  {
    path: "/update",
    name: "AdminUpdate",
    component: UpdateView,
    /**
     *
     * @param {RouteRecordNormalized} to
     * @param {RouteRecordNormalized} from
     * @returns {{name:RouteRecordName}}
     */
    beforeEnter: (to, from) => {
      return isAuthenticated(from);
    },
  },
  {
    path: "/create",
    name: "AdminCreate",
    component: CreateView,
    /**
     *
     * @param {RouteRecordNormalized} to
     * @param {RouteRecordNormalized} from
     * @returns {{name:RouteRecordName}}
     */
    beforeEnter: (to, from) => {
      return isAuthenticated(from);
    },
  },
  {
    path: "/docs",
    name: "Docs",
    component: DocsView,
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export { router };
