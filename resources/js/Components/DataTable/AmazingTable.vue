<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Members</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <button
                    @click.prevent="openDialog"
                    type="button"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Add user
                </button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                    <h3>Filters</h3>
                    <section class="grid grid-cols-5 gap-5 mb-2">
                        <input
                            type="text"
                            placeholder="Country"
                            v-model="filtersForm.filters.country"
                        />
                        <input
                            type="text"
                            placeholder="Region"
                            v-model="filtersForm.filters.region"
                        />

                        <button @click.prevent="applyFilters" type="button"
                                class="inline-flex justify-center px-4 py-2 border border bg-black text-white">
                            Filter
                        </button>
                    </section>

                    <section class="grid justify-end mb-2">
                        <input
                            type="text"
                            placeholder="Search"
                            v-model="searchTerm"
                        />
                    </section>
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Email
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Country
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Region
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="member in members" :key="member.email">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ member.name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ member.email }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ member.country }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ member.region }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button @click.prevent="openDialog(member)"
                                            class="text-indigo-600 hover:text-indigo-900">
                                        Edit <span class="sr-only">, {{ member.name }}</span>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <DefaultDialog
                            :open="dialogOpen"
                            @close="closeDialog()"
                        >
                            <template #default>

                                <input
                                    type="text"
                                    class="mt-1 block w-full px-3 py-2"
                                    v-model="form.member.name"
                                    placeholder="Name"
                                />

                                <input
                                    type="text"
                                    class="mt-1 block w-full px-3 py-2"
                                    v-model="form.member.email"
                                    placeholder="Email"
                                />

                                <input
                                    type="text"
                                    class="mt-1 block w-full px-3 py-2"
                                    v-model="form.member.country"
                                    placeholder="Country"
                                />

                                <input
                                    type="text"
                                    class="mt-1 block w-full px-3 py-2"
                                    v-model="form.member.region"
                                    placeholder="Region"
                                />

                            </template>

                            <template #buttons>
                                <button
                                    v-if="form.member.id"
                                    type="button"
                                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2"
                                    @click="update">Update
                                </button>
                                <button
                                    v-else
                                    type="button"
                                    class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2"
                                    @click="create">Create
                                </button>
                            </template>

                        </DefaultDialog>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref, watch} from "vue";
import DefaultDialog from "@/Components/Dialog/DefaultDialog.vue";
import {useForm} from "@inertiajs/vue3";
import {toast} from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const members = ref([]),
    dialogOpen = ref(false),
    form = useForm({member: {}}),
    searchTerm = ref(""),
    filtersForm = useForm({
        filters: {
            country: "",
            region: "",
        }
    });

const openDialog = (member) => {
    form.member = member ?? {};
    dialogOpen.value = true;
}

const closeDialog = () => {
    form.member = {};
    dialogOpen.value = false;
}

const applyFilters = () => {
    // show this be done via API too?
    if (filtersForm.filters.country === '' && filtersForm.filters.region === '') {
        getMembers(); // fake and gay I know.. but it's after 5pm now.
        return;
    }

    members.value = members.value.filter((member) => {
        return member.country.toLowerCase().includes(filtersForm.filters.country.toLowerCase()) &&
            member.region.toLowerCase().includes(filtersForm.filters.region.toLowerCase())
    })
}

const update = async () => {
    await fetch('/api/members/' + form.member.id, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(form.member)
    }).then((response) => response.json())
        .then((data) => {

            if (data.status === 'success') {
                toast(String(data.message), {
                    position: 'top-right',
                    theme: 'dark',
                    type: 'success'
                })
            } else {
                toast(String(data.message), {
                    position: 'top-right',
                    theme: 'dark',
                    type: 'error'
                })
            }

            getMembers();
        })

    closeDialog();
}

const create = async () => {
    await fetch('/api/members', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(form.member)
    }).then((response) => response.json())
        .then((data) => {

            if (data.status === 'success') {
                toast(String(data.message), {
                    position: 'top-right',
                    theme: 'dark',
                    type: 'success'
                })
            } else {
                toast(String(data.message), {
                    position: 'top-right',
                    theme: 'dark',
                    type: 'error'
                })
            }

            getMembers();
        })

    closeDialog();
}

watch([searchTerm], () => {
    members.value = members.value.filter((member) => {
        // should this search via API?
        return member.name.toLowerCase().includes(searchTerm.value.toLowerCase()) || member.email.toLowerCase().includes(searchTerm.value.toLowerCase()) || member.country.toLowerCase().includes(searchTerm.value.toLowerCase()) || member.region.toLowerCase().includes(searchTerm.value.toLowerCase())
    })
});

const getMembers = async () => {
    await fetch('/api/members')
        .then(response => response.json())
        .then((data) => {
            members.value = data.members;
        });
}

onMounted(() => getMembers());
</script>
