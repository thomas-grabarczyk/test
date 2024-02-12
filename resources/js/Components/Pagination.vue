<template>
    <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-5 py-5">
        <div class="-mt-px flex w-0 flex-1">
            <a v-if="currentPage > 1" href="#"
               class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                <ArrowLongLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true"/>
                Previous
            </a>
        </div>
        <div class="hidden md:-mt-px md:flex">
            <a
                v-for="page in pages"
                href="#"
                class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
            >
                {{ page }}
            </a>
        </div>
        <div class="-mt-px flex w-0 flex-1 justify-end">
            <a v-if="!currentPage !== lastPage" href="#"
               class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                Next
                <ArrowLongRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true"/>
            </a>
        </div>
    </nav>
</template>

<script setup>
import {ArrowLongLeftIcon, ArrowLongRightIcon} from '@heroicons/vue/20/solid'
import {onMounted, ref} from "vue";

const props = defineProps({
    currentPage: {
        type: Number,
        required: true
    },
    lastPage: {
        type: Number,
        required: true
    }
})

const pages = ref([]);

onMounted(() => {
    console.log(props.lastPage);
    for (let i = 1; i <= props.lastPage; i++) {
        pages.value.push(i);
    }
})
</script>
