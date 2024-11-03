<template>
    <Head title="Post" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Post
            </h2>
        </template>

        <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">لیست پست ها</p>
                <div>
                    <Link
                        :href="route('post.create')"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#6c757d] hover:bg-[#757b80] text-white border border-[#6c757d] hover:border-transparent"
                    >
                        ایجاد پست جدید
                    </Link>
                    <Link
                        :href="route('dashboard')"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                    >
                        بازگشت
                    </Link>
                </div>
            </div>
            <ul>
                <li
                    v-for="(post, index) in posts.data"
                    :key="index"
                    class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-[#21252908]"
                >
                    <div class="content">
                        {{ post.name }}
                        {{ post.category.name }}
                    </div>
                    <div class="min-w-max px-5 flex flex-row justify-between">
                        <!-- Show -->
                        <Link
                            :href="route('post.show', post.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 flex items-center m-2 text-sm text-indigo-100 transition-colors duration-150 bg-blue-500 hover:bg-blue-600 rounded-lg focus:shadow-outline"
                        >
                            show
                            <EyeIcon class="size-6"></EyeIcon>
                        </Link>

                        <!-- delete -->
                        <button
                            @click="remove(post.id)"
                            class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 border-red-600 border hover:border-black"
                            as="button"
                            type="button"
                        >
                            delete
                            <TrashIcon class="size-6"></TrashIcon>
                        </button>

                        <!-- edit -->
                        <Link
                            :href="route('post.edit', post.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 m-2 flex items-center text-sm transition-colors duration-150 rounded-lg focus:shadow-outline bg-white hover:bg-black text-black hover:text-white border border-black hover:border-transparent"
                            >edit
                            <PencilSquareIcon class="size-6"></PencilSquareIcon>
                        </Link>
                    </div>
                </li>
            </ul>
        </div>
        <p
            class="flex flex-row justify-center text-xl text-center"
            v-if="$page.props.crudOperation.success"
        >
            {{ $page.props.crudOperation.success }}
        </p>
        <pagination :links="posts.links"></pagination>
    </AuthenticatedLayout>
</template>

<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";

import { TrashIcon, EyeIcon, PencilSquareIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
    posts: Object,
});
function remove(id) {
    if (confirm("آیا از حذف پست مطمئنید ؟")) {
        router.delete(route("post.destroy", id));
    }
}

if (usePage().props.crudOperation.success) {
    window.setTimeout(function () {
        window.alert(usePage().props.crudOperation.success);
    }, 500);
}
</script>

<style></style>
