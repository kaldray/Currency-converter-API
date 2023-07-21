import axios, { AxiosError } from "axios";

const apiClient = axios.create({
  baseURL: import.meta.env.VITE_API_ENDPOINT,
  withCredentials: true,
  headers: {
    Accept: "Content-Type",
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
      return Promise.reject(apiError);
    }
    return Promise.reject(error);
  },
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
 * @typedef {{ from: string,to: string,conversion_number:number,id:number }} Pair
 *  @typedef {{data:Pair[]}} Pairs
 * */

/**
 * Return the list of available paris
 * @returns {Promise<Pairs>}
 */
export const getPairs = async () => {
  const resonse = await apiClient.get("/devises/available");
  return resonse.data;
};

/**
 *
 * @param {number} id
 * @returns {Promise<any>}
 */
export const deletePairs = async (id) => {
  const response = await apiClient.delete(`/pairs/${id}`);
  return response.data;
};
