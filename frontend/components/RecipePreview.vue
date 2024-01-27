<script setup>
const props = defineProps({
    recipe: Object
});

//
</script>

<template>
    <article :style="`background:url('https://source.unsplash.com/400x600?salmon?${recipe.id}') no-repeat center;background-size:cover`"
             class="flex flex-col justify-end space-y-4 bg-slate-300 shadow p-4 rounded-lg w-48 h-64">
        <div class="bg-gradient-to-t from-slate-50 from-50% rounded-b-lg text-slate-950 -m-4 p-2 text-lg h-2/3 flex flex-col justify-end">
            {{ recipe.name }}

<!--            <div class="text-xs">-->
<!--                {{ recipe.description }}-->
<!--            </div>-->
        </div>
    </article>
</template>

