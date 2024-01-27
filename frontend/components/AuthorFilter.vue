<template>
    <Combobox nullable as="div" :value="modelValue" @update:modelValue="(val) => $emit('update:model-value', val || '')">
        <div class="relative h-full">
            <ComboboxInput
                ref="inputEl"
                placeholder="Search By Author"
                class="w-64 rounded-md border-0 bg-white py-2.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-base sm:leading-6"
                :displayValue="(email) => email || ''"
                @change="query = $event.target.value || ''"/>
            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
            </ComboboxButton>

            <ComboboxOptions v-if="filteredPeople.length > 0"
                             class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                <ComboboxOption v-for="email in filteredPeople" :key="email" :value="email" as="template"
                                v-slot="{ active, selected }">
                    <li :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-emerald-600 text-white' : 'text-gray-900']">
                        <span :class="['block truncate', selected && 'font-semibold']">
                            {{ email }}
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

<script setup>
import {computed, ref, watch} from 'vue'
import {CheckIcon, ChevronUpDownIcon} from '@heroicons/vue/20/solid'
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from '@headlessui/vue'

const props = defineProps({
    authors: Array,
    modelValue: String
});

defineEmits([
    'update:model-value',
]);

watch(() => props.modelValue, (newVal) => {
    query.value = newVal || '';

    if (! newVal) {
        inputEl.value.$el.value='';
    }
});

const inputEl = ref(null);

const query = ref('')
const selectedPerson = ref(props.modelValue)
const filteredPeople = computed(() =>
    query.value === ''
        ? props.authors
        : props.authors.filter((email) => {
            return email.toLowerCase().includes(query.value.toLowerCase())
        })
)
</script>