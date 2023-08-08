import { ref } from "vue";
import { getPairs, getAllDevises } from "@/api/index.js";

/**
 * @typedef {{ from: string,to: string,conversion_number:number,id:number,conversion_rate:number }} Pair
 *  @typedef {{data:Pair[]}} Pairs
 * */

/**
 *
 * @returns {{error: *, pairs: Pairs}}
 */
export const usePairs = () => {
  const pairs = ref(null);
  const error = ref(null);
  async function fetchData() {
    try {
      const response = await getPairs();
      pairs.value = response;
    } catch (err) {
      error.value = err;
    }
  }
  fetchData();

  return { pairs, error };
};

/**
 *
 * @returns {{error: unknown, devises: import("../api/index.js").Devises}}
 */
export const useUnusedDevises = () => {
  const devise = ref(null);
  const error = ref(null);

  async function fetchData() {
    try {
      const response = await getAllDevises();
      devise.value = response;
    } catch (err) {
      error.value = err;
    }
  }
  fetchData();
  return { devise, error };
};
