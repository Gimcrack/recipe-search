<script setup>
import {debounce} from "lodash";
import IngredientFilter from "~/components/IngredientFilter.vue";

// api helper
const {$api} = useNuxtApp();

// will populate from api
const recipes = ref(null);
const authors = ref([]);
const ingredients = ref([]);

// filters
const ingredient = ref('');
const email = ref('');
const keyword = ref('')


const resetFilters = function () {
    ingredient.value = '';
    email.value = '';
    keyword.value = '';

    debouncedFetchRecipes();
}

const fetchRecipes = async function () {
    let qs = new URLSearchParams({ingredient: ingredient.value, email: email.value, keyword: keyword.value});

    let resp = await $api.get('recipes?' + qs);
    recipes.value = resp.data;
}

const debouncedFetchRecipes = debounce(fetchRecipes, 300);

const fetchAuthors = async function () {
    let resp = await $api.get('authors');
    authors.value = resp.data;
}

const fetchIngredients = async function () {
    let resp = await $api.get('ingredients');
    ingredients.value = resp.data;
}

const navigate = async function (url) {
    let resp = await $api.getUrl(url);
    recipes.value = resp.data;
}


// perform initial fetches
onMounted(fetchRecipes);
onMounted(fetchAuthors);
onMounted(fetchIngredients);


</script>

<template>
    <div class="text-xl flex flex-col mx-auto px-6">
        <h1 class="text-4xl mt-12 mb-6 font-semibold">Recipe Search 3000</h1>

        <!-- search -->
        <div class="text-lg">
            <label for="keyword" class="block text-sm font-medium leading-6 text-gray-900">Search</label>
            <div class="mt-2 mb-8 flex space-x-2">
                <input @input="debouncedFetchRecipes" v-model="keyword" type="text" name="keyword" id="keyword"
                       class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                           placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-base sm:leading-6"
                       placeholder="Search By Keyword"/>

                <AuthorFilter v-model="email" @update:modelValue="debouncedFetchRecipes" v-if="authors.length"
                              :authors="authors"/>

                <IngredientFilter v-model="ingredient" @update:modelValue="debouncedFetchRecipes"
                                  v-if="ingredients.length" :ingredients="ingredients"/>

                <button @click="resetFilters"
                        class="whitespace-nowrap text-white font-semibold p-2 bg-emerald-500 hover:bg-emerald-700 rounded-md disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-transparent">
                    Reset Filters
                </button>
            </div>
        </div>
        <RecipeIndex @navigate="navigate" v-bind="{recipes}"/>
    </div>
</template>
