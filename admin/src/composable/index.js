import { ref } from "vue";
import { getPairs } from "@/api/index.js";

/**
 * @typedef {{ from: string,to: string,conversion_number:number,id:number }} Pair
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
