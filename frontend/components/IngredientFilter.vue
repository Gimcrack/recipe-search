<script setup>
import {computed, ref, watch} from 'vue'
import {CheckIcon, ChevronUpDownIcon, XCircleIcon} from '@heroicons/vue/20/solid'
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from '@headlessui/vue'

// api helper
const {$api} = useNuxtApp();
const {data: ingredients} = await useFetch($api.buildUrl('ingredients'));

const props = defineProps({
    modelValue: {}
});

const inputEl = ref(null);
const query = ref(props.modelValue || '')
const selectedItem = ref(props.modelValue)
const filteredIngredients = computed(() =>
    query.value === ''
        ? (ingredients.value || [])
        : (ingredients.value || []).filter((ingredient) => {
            return ingredient.toLowerCase().includes(query.value.toLowerCase())
        })
)

defineEmits([
    'update:model-value',
]);

watch(() => props.modelValue, (newVal) => {
    query.value = newVal || '';

    inputEl.value.$el.value = query.value;

    selectedItem.value = props.modelValue;
});

onMounted(() => {
    getCurrentInstance().emit("update:model-value", selectedItem.value);
    query.value = props.modelValue;

    inputEl.value.$el.value = props.modelValue;

    selectedItem.value = props.modelValue;
});
</script>

<template>
    <Combobox nullable as="div" :value="modelValue"
              @update:modelValue="(val) => $emit('update:model-value', val || '')">
        <div class="relative h-full">
            <ComboboxInput
                ref="inputEl"
                placeholder="Search By Ingredient"
                class="w-full lg:w-64 rounded-md border-0 bg-white py-2.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-base sm:leading-6"
                :displayValue="(ingredient) => ingredient || ''"
                @change="query = $event.target.value || ''"/>
            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
            </ComboboxButton>
            <button v-if="!!selectedItem" @click.prevent="$emit('update:model-value', '')"
                            class="absolute inset-y-0 right-6 flex items-center rounded-r-md px-2 focus:outline-none">
                <XCircleIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
            </button>

            <ComboboxOptions v-if="filteredIngredients.length > 0"
                             class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                <ComboboxOption v-for="ingredient in filteredIngredients" :key="ingredient" :value="ingredient"
                                as="template"
                                v-slot="{ active, selected }">
                    <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-emerald-600 text-white' : 'text-gray-900']">
                        <span :class="['block truncate', selected && 'font-semibold']">
                            {{ ingredient }}
                        </span>

                        <span v-if="selected"
                              :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-emerald-600']">
                            <CheckIcon class="h-5 w-5" aria-hidden="true"/>
                        </span>
                    </li>
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>
</template>

