<script setup>
import RecipePreview from "~/components/RecipePreview.vue";
import {ChevronDoubleLeftIcon, ChevronLeftIcon, ChevronRightIcon, ChevronDoubleRightIcon} from "@heroicons/vue/24/solid/index.js";

const props = defineProps({
    recipes: Object
});

defineEmits([
    'navigate'
]);

</script>

<template>
    <div class="wrapper">
        <div v-if="recipes?.data.length"  class="results">
            <!-- pagination -->
            <div
                class="mx-auto flex px-3.5 py-2.5 bg-slate-50 rounded-lg items-center justify-between space-x-4 mb-7 font-semibold">
                <span>Showing Results {{ recipes.from }}-{{ recipes.to }} of {{ recipes.total }}</span>
                <div class="flex space-x-1.5 items-center">
                    <button @click="$emit('navigate', recipes.first_page_url)"
                            :disabled="recipes.current_page === 1"
                            class="p-2 border border-slate-400 hover:bg-emerald-100 rounded-md bg-white disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-transparent">
                        <ChevronDoubleLeftIcon class="w-4 h-4"/>
                    </button>
                    <button @click="$emit('navigate', recipes.prev_page_url)"
                            :disabled="recipes.current_page === 1"
                            class="p-2 border border-slate-400 hover:bg-emerald-100 rounded-md bg-white disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-transparent">
                        <ChevronLeftIcon class="w-4 h-4"/>
                    </button>
                    <span class="font-semibold px-4">Page {{ recipes.current_page }} of {{ recipes.last_page }}</span>
                    <button @click="$emit('navigate', recipes.next_page_url)"
                            :disabled="recipes.current_page === recipes.last_page"
                            class="p-2 border border-slate-400 hover:bg-emerald-100 rounded-md bg-white disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-transparent">
                        <ChevronRightIcon class="w-4 h-4"/>
                    </button>
                    <button @click="$emit('navigate', recipes.last_page_url)"
                            :disabled="recipes.current_page === recipes.last_page"
                            class="p-2 border border-slate-400 hover:bg-emerald-100 rounded-md bg-white disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-transparent">
                        <ChevronDoubleRightIcon class="w-4 h-4"/>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
                <RecipePreview v-for="recipe in recipes.data" :recipe="recipe"/>
            </div>
        </div>
        <div v-else>
            <!-- pagination -->
            <div
                class="mx-auto flex px-3.5 py-2.5 bg-slate-50 rounded-lg items-center justify-center space-x-4 mb-7 font-semibold">
                <span>I didn't find anything matching that criteria</span>
            </div>
        </div>
    </div>
</template>