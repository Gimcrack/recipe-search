<script setup>
import {UserIcon, StarIcon} from "@heroicons/vue/24/solid";

const props = defineProps({
    recipe: Object
});

//
</script>

<template>
    <article :style="`background:url('${recipe.image}') no-repeat center;background-size:cover`"
             class="flex flex-col justify-end space-y-4 bg-slate-300
             transition-all duration-150
             cursor-pointer
             shadow-lg shadow-slate-400 p-4 rounded-lg w-64 h-80
             hover:scale-110 group relative
        ">
        <NuxtLink class="font-semibold bg-gradient-to-t from-slate-50/95 from-25% rounded-b-lg
                text-slate-950 -m-4 py-2 px-3 text-lg h-full flex flex-col justify-end
                group-hover:from-emerald-100" :to="{ name: 'recipes-slug', params: {slug : recipe.slug} }">
            {{ recipe.name }}
            <br>
            <span class="flex items-center font-normal text-slate-500 text-base mt-1">
                <UserIcon class="h-4 w-4 mr-1"/>
                {{ recipe.author }}
            </span>
        </NuxtLink>
        <div class="absolute flex items-center -top-2 bg-slate-800/80 p-1 rounded-full w-[90%] left-[5%] shadow">
            <div class="text-white text-sm mx-2 font-semibold flex-1">Serves 4</div>
            <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating"
                      :class="[4 > rating ? 'text-yellow-400' : 'text-slate-100', 'h-5 w-5 flex-shrink-0']"
                      aria-hidden="true"/>
        </div>
    </article>
</template>

