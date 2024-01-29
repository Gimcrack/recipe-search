<script setup>
import {ref} from 'vue'
import {CheckIcon, QuestionMarkCircleIcon, StarIcon, ChevronLeftIcon} from '@heroicons/vue/20/solid'
import {RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption} from '@headlessui/vue'
import {ShieldCheckIcon} from '@heroicons/vue/24/outline'

// api helper
const {$api} = useNuxtApp();
const route = useRoute();
const router = useRouter();

// populate from api
const {data: recipe} = await useFetch($api.buildUrl(`recipes/${route.params.slug}`));

// fake some data, this would normally be saved on the recipe model
const serves = ref(4);
const reviews = {average: 4, totalCount: 1624}

const tabs = [
    {name: 'Ingredients', href: '#ingredients'},
    {name: 'Directions', href: '#directions'},
]
const currentTab = ref(route.hash.replace('#','') || 'ingredients');

</script>

<template>
    <div v-if="recipe" class="text-xl flex flex-col mx-auto px-6 max-w-6xl">
        <h1 class="text-4xl mt-12 mb-6 font-semibold">Recipe Search 3000</h1>

        <div class="bg-white rounded-lg shadow-lg mb-12">
            <div
                class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">
                <div class="lg:max-w-lg lg:self-end">
                    <!-- Recipe image xs--md -->
                    <div class="lg:hidden -mx-4 sm:-mx-6 -mt-16 sm:-mt-24 ">
                        <div class="aspect-h-3 aspect-w-5 overflow-hidden rounded-t-lg">
                            <img :src="recipe.image" :alt="recipe.name"
                                 class="h-full w-full object-cover object-center"/>
                        </div>
                    </div>

                    <nav class="mt-4 lg:mt-0" aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-2 text-sm">
                            <li>
                                <a @click.prevent="router.back" href="/recipes" class="flex items-center whitespace-nowrap font-medium text-emerald-600 hover:text-emerald-500">
                                    <ChevronLeftIcon class="h-4 w-4"/>
                                    Recipes
                                </a>
                            </li>
                            <li>
                                <svg viewBox="0 0 20 20"
                                     fill="currentColor" aria-hidden="true"
                                     class="ml-2 h-5 w-5 flex-shrink-0 text-gray-300">
                                    <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z"/>
                                </svg>
                            </li>
                            <li>
                                <span class="font-medium text-gray-500 hover:text-gray-900">
                                    {{ recipe.name }}
                                </span>
                            </li>
                        </ol>
                    </nav>

                    <div class="mt-4">
                        <h1 class="text-xl font-bold tracking-tight text-slate-900 sm:text-2xl whitespace-nowrap">
                            {{ recipe.name }}</h1>

                        <h3 class="text-base text-slate-700 whitespace-nowrap mt-2">
                            By {{ recipe.author }}</h3>
                    </div>

                    <section aria-labelledby="information-heading" class="mt-4">
                        <h2 id="information-heading" class="sr-only">Recipe information</h2>

                        <div class="flex items-center">
                            <p class="text-lg text-gray-900 sm:text-xl">Main Course</p>

                            <div class="ml-4 border-l border-gray-300 pl-4">
                                <h2 class="sr-only">Reviews</h2>
                                <div class="flex items-center">
                                    <div>
                                        <div class="flex items-center">
                                            <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating"
                                                      :class="[reviews.average > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']"
                                                      aria-hidden="true"/>
                                        </div>
                                        <p class="sr-only">{{ reviews.average }} out of 5 stars</p>
                                    </div>
                                    <p class="ml-2 text-sm text-gray-500">{{ reviews.totalCount }} reviews</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 space-y-6">
                            <p class="text-base text-gray-500">{{ recipe.description }}</p>
                        </div>

                        <div class="mt-4 space-y-6">
                            <div class="flex items-center text-base text-slate-500 font-semibold">
                                Serves <input type="number" step="1" min="1" max="12" class="ml-1 px-2 py-1.5 rounded-md w-16" v-model="serves">
                            </div>
                        </div>
                    </section>

                    <section>
                        <!-- Tabs -->
                        <div class="mt-4">
                            <div class="sm:hidden">
                                <label for="tabs" class="sr-only">Select a tab</label>
                                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                                <select id="tabs" name="tabs" v-model="currentTab"
                                        class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-emerald-500 focus:outline-none focus:ring-emerald-500 sm:text-sm">
                                    <option :value="tab.name.toLowerCase()" v-for="tab in tabs" :key="tab.name">{{
                                            tab.name
                                        }}
                                    </option>
                                </select>
                            </div>
                            <div class="hidden sm:block">
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                        <button v-for="tab in tabs" :key="tab.name"
                                           @click="currentTab=tab.name.toLowerCase()"
                                           :class="[currentTab===tab.name.toLowerCase() ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium']"
                                           :aria-current="currentTab===tab.name.toLowerCase() ? 'page' : undefined">{{ tab.name }}
                                        </button>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Ingredients -->
                    <section v-show="currentTab==='ingredients'">
                        <div class="mt-6">
                            <div class="flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                <tr v-for="ing in recipe.ingredients" :key="ing.id">
                                                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-slate-500 sm:pl-0">
                                                        {{ (ing.pivot.amount * serves / 4).toFixed(2) }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-slate-900">
                                                        {{ ing.pivot.unit }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-2 py-2 text-sm text-slate-900">
                                                        {{ ing.name }}
                                                    </td>
                                                    <td class="px-2 py-2 text-xs text-slate-500">
                                                        {{ ing.pivot.notes }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Directions -->
                    <section v-show="currentTab==='directions'">
                        <div class="mt-6">
                            <div class="flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                <tr v-for="step in recipe.steps" :key="step">
                                                    <td class="py-4 pl-4 pr-3 text-lg text-slate-900 sm:pl-0">
                                                        {{ step }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Recipe image large view -->
                <div class="mt-10 hidden lg:block lg:col-start-2 lg:row-span-2 lg:mt-0 lg:self-start">
                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg">
                        <img :src="recipe.image" :alt="recipe.name"
                             class="h-full w-full object-cover object-center"/>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>


