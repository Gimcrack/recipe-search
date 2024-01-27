<script setup>
import axios from "axios";

const recipes = ref(null);

const state = ref({
    params: {
        ingredient: '',
        email: '',
        keyword: ''
    }
})

const fetchRecipes = async function() {
    let qs = new URLSearchParams(state.value.params);

    let resp = await axios.get('http://recipe-search-3000.test/api/recipes?' + qs, {
        data: state.value.params
    });
    recipes.value = resp.data;
}

onMounted(fetchRecipes);


</script>

<template>
    <div class="w-full h-screen grid place-content-center">
        <div class="text-xl flex flex-col">
            <div class="text-lg">
                <label for="keyword" class="block text-sm font-medium leading-6 text-gray-900">Search</label>
                <div class="my-4 flex space-x-2">
                    <input @input="fetchRecipes" v-model="state.params.keyword" type="keyword" name="keyword" id="keyword"
                           class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                           placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           placeholder="Search By Keyword"/>

                    
                </div>
            </div>
            <RecipeIndex :recipes="recipes"/>
        </div>
    </div>
</template>