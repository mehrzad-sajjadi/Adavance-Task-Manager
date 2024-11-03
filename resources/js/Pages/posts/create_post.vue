<template>
    <Head title="Create new Post" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Post
            </h2>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div
                class="flex flex-row items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">ایجاد پست جدید</p>
            </div>
            <div class="flex flex-col justify-between">
                <div>
                    <div class="mb-5 py-2 px-2 w-full">
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            عنوان
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            autofocus
                        />
                        <p v-if="$page.props.errors.name" class="text-red-600">
                            {{ $page.props.errors.name }}
                        </p>
                    </div>
                    <div class="mb-5 py-2 px-2 w-full">
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            محتوا
                        </label>
                        <textarea
                            v-model="form.content"
                            type="text"
                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            autofocus
                        ></textarea>
                        <p
                            v-if="$page.props.errors.content"
                            class="text-red-600"
                        >
                            {{ $page.props.errors.content }}
                        </p>
                    </div>
                    <div class="flex flex-col justify-start">
                        <form class="max-w-sm mx-auto">
                            <label
                                for="countries"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >دسته بندی</label
                            >
                            <select
                                id="countries"
                                class="bg-gray-50 px-8 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                v-model="form.category_id"
                                placeholder="Select"
                            >
                                <option
                                    v-for="(category, index) in categories"
                                    :key="index"
                                    :value="category.id"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                            <p
                                v-if="$page.props.errors.category_id"
                                class="text-red-600"
                            >
                                {{ $page.props.errors.category_id }}
                            </p>
                        </form>
                    </div>
                </div>
                <div class="flex flex-row justify-between p-2 w-full">
                    <div>
                        <p
                            v-if="$page.props.crudOperation.errors"
                            class="text-red-600"
                        >
                            {{ $page.props.crudOperation.errors }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-row justify-between mb-4">
                    <button
                        @click="submit"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-600 hover:border-transparent"
                    >
                        ایجاد پست
                    </button>
                    <Link
                        :href="route('post_index')"
                        type="submit"
                        as="button"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                    >
                        انصراف
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    categories: Object,
    errors: Object,
});
const form = useForm({
    name: "",
    content: "",
    category_id: "",
});

function submit() {
    form.post(route("post_store"), {});
}
</script>

<style></style>
