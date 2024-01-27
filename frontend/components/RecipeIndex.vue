<script setup>
import RecipePreview from "~/components/RecipePreview.vue";

const props = defineProps({
    recipes: Object
});
</script>

<template>
    <div v-if="recipes?.data.length" class="grid grid-cols-5 grid-rows-2 gap-4">
        <RecipePreview v-for="recipe in recipes.data" :recipe="recipe"/>
    </div>
</template>