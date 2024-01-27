<script setup>
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
             shadow-lg shadow-slate-400 p-4 rounded-lg w-56 h-80
             hover:scale-110 group
        ">
        <NuxtLink class="font-semibold bg-gradient-to-t from-slate-50 from-15% rounded-b-lg
                text-slate-950 -m-4 py-2 px-3 text-lg h-full flex flex-col justify-end
                group-hover:from-emerald-100" :to="`recipes/${recipe.slug}`">
                {{ recipe.name }}
        </NuxtLink>
    </article>
</template>

