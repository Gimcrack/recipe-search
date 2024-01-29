<script setup>
import {debounce} from "lodash-es";
import {watch} from "vue";
import {useFetch} from "#app";


// api helper
const {$api} = useNuxtApp();
const route = useRoute();
const router = useRouter();

// populate from api
const {data: recipes} = await useFetch($api.buildUrl('recipes'));

// filters
const ingredient = ref(route.query?.ingredient || '');
const email = ref(route.query?.email ||'');
const keyword = ref(route.query?.keyword ||'');

// watch filters for changes
watch(ingredient, () => {
    router.push({query : {...route.query, ingredient: ingredient.value}});
});
watch(email, () => {
    router.push({query : {...route.query, email: email.value}});
});
watch(keyword, () => {
    router.push({query : {...route.query, keyword: keyword.value}});
});

onMounted(() => {
    ingredient.value = route.query?.ingredient || '';
    email.value = route.query?.email || '';
    keyword.value = route.query?.keyword || '';
});

const resetFilters = function () {
    ingredient.value = '';
    email.value = '';
    keyword.value = '';

    debouncedFilterRecipes();
}

const filterRecipes = async function () {
    let qs = new URLSearchParams({ingredient: ingredient.value, email: email.value, keyword: keyword.value});
    await navigate($api.buildUrl('recipes?' + qs));
}

const debouncedFilterRecipes = debounce(filterRecipes, 300);

const navigate = async function (url) {
    const {data} = await useFetch(url);
    recipes.value = data.value

    window.scrollTo({top:0, left: 0, behavior: 'smooth'});
}

</script>

<template>
    <div class="text-xl flex flex-col mx-auto px-6">
        <h1 class="text-4xl mt-12 mb-6 font-semibold">Recipe Search 3000</h1>

        <!-- search -->
        <div class="text-lg">
            <div class="mt-2 mb-8 flex flex-col lg:flex-row lg:space-x-2 space-y-2 lg:space-y-0">
                <KeywordFilter v-model="keyword" @update:modelValue="debouncedFilterRecipes"/>

                <AuthorFilter v-model="email" @update:modelValue="debouncedFilterRecipes"/>

                <IngredientFilter v-model="ingredient" @update:modelValue="debouncedFilterRecipes" />

                <button @click="resetFilters"
                        class="whitespace-nowrap text-white font-semibold p-2 bg-emerald-500 hover:bg-emerald-700 rounded-md disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-transparent">
                    Reset
                </button>
            </div>
        </div>
        <RecipeIndex @navigate="navigate" v-bind="{recipes}"/>
    </div>
</template>
