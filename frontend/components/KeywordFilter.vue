<script setup>
import {XCircleIcon} from '@heroicons/vue/20/solid'

const props = defineProps({
    modelValue: String
});

defineEmits([
    'update:model-value'
]);

</script>

<template>
    <div class="flex flex-1 relative">
        <input @input="$emit('update:model-value', $event.target.value)" :value="modelValue" type="text" name="keyword"
               id="keyword"
               class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                               placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-base sm:leading-6"
               placeholder="Search By Keyword"/>
        <button v-if="!!modelValue" @click.prevent="$emit('update:model-value', '')"
                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
            <XCircleIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
        </button>
    </div>
</template>
