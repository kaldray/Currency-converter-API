import axios, { AxiosError } from "axios";

import { router } from "@/router/index.js";
import { useAuthStore } from "@/store";

/**
 * @typedef {{ from: string,to: string,conversion_number:number,id:number,conversion_rate:number }} Pair
 *  @typedef {{data:Pair[]}} Pairs
 *  @typedef {{id: number,name: string,created_at: string,updated_at: string}} Devise
 *  @typedef {{data:Devise[]}} Devises
 * */

/** @typedef {object} ValidationError
 * @property {string} message
 * @property {object} errors
 * @property {string[] | undefined} errors.conversion_number
 * @property {string[] | undefined} errors.conversion_rate
 * @property {string[] | undefined} errors.from
 * @property {string[] | undefined} errors.to
 */

const apiClient = axios.create({
  baseURL: import.meta.env.VITE_API_ENDPOINT,
  withCredentials: true,
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
    "Access-Control-Allow-Origin": "*",
  },
});

apiClient.interceptors.response.use(
  (response) => response,
  /**
   * @param {AxiosError} error
   * @returns
   */
  (error) => {
    if (error.response) {
      /**
       * @constant {AxiosError} apiError
       */
      const apiError = error.response.data;
      if (error.response.status === 401) {
        const authStore = useAuthStore();
        authStore.user.value = null;
        authStore.error.value = null;
        router.replace("/");
        return Promise.reject(apiError);
      }
      return Promise.reject(apiError);
    }
    return Promise.reject(error);
  }
);

export const getCsrfToken = async () => {
  await axios.get(import.meta.env.VITE_API_BASEURL + "/sanctum/csrf-cookie");
};

/**
 *
 * @param {{ email:string,password:string }} credentials
 * @returns {Promise<{message:string,status:number,user:{email:string,name:string}}>}
 */
export const signIn = async (credentials) => {
  await getCsrfToken();
  const response = await apiClient.post("/login", credentials);
  return response.data;
};

export const signOut = async () => {
  const response = await apiClient.get("/logout");
  return response.data;
};

/**
 * Return the list of available paris
 * @returns {Promise<Pairs>}
 */
export const getPairs = async () => {
  const resonse = await apiClient.get("/devises/available");
  return resonse.data;
};

/**
 * Delete Pair
 * @param {number} id
 * @returns {Promise<any>}
 */
export const deletePairs = async (id) => {
  const response = await apiClient.delete(`/paire/${id}`);
  return response.data;
};

/**
 * Update pairs
 * @param {Pair} pair
 * @returns {Promise<{message:string,status:number}>}
 */
export const modifyPair = async (pair) => {
  const response = await apiClient.put(`/paire/${pair.id}`, pair);
  return response.data;
};

/**
 * Add pairs
 * @param {Pair} pair
 * @returns {Promise<{message:string,status:number}>}
 */
export const addPair = async (pair) => {
  const response = await apiClient.post(`/paire`, pair);
  return response.data;
};

/**
 * Get all devises
 * @returns {Promise<Devises>}
 */
export const getAllDevises = async () => {
  const response = await apiClient.get("/devises/all");
  return response.data;
};
