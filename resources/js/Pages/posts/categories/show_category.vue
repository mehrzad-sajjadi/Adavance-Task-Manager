<template>
    <Head title="Category detail" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                جزئیات پست : {{ $page.props.category.name }}
            </h2>
        </template>

        <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
            <div
                class="flex flex-row justify-between relative overflow-x-auto"
            ></div>

            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <div class="flex flex-row mr-5">
                    <UserIcon class="size-6 ml-2"></UserIcon>
                    {{ $page.props.user_name }}
                </div>

                <div>
                    <Link
                        :href="route('category.index')"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                    >
                        بازگشت
                    </Link>
                </div>
            </div>
            <ul v-for="(post, index) in $page.props.posts" :key="index">
                <li
                    class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-[#21252908]"
                >
                    <div class="content">
                        {{ post.name }}
                    </div>
                    <div class="min-w-max px-5 flex flex-row justify-between">
                        <!-- Show -->
                        <Link
                            :href="route('post.show', post.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 flex items-center m-2 text-sm text-indigo-100 transition-colors duration-150 bg-blue-500 hover:bg-blue-600 rounded-lg focus:shadow-outline"
                            >نمایش
                            <EyeIcon class="size-6"></EyeIcon>
                        </Link>

                        <!-- delete -->
                        <button
                            @click="remove(post.id)"
                            class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 border-red-600 border hover:border-black"
                            as="button"
                            type="button"
                        >
                            حذف
                            <TrashIcon class="size-6"></TrashIcon>
                        </button>

                        <!-- edit -->
                        <Link
                            :href="route('post.edit', post.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 m-2 flex items-center text-sm transition-colors duration-150 rounded-lg focus:shadow-outline bg-white hover:bg-black text-black hover:text-white border border-black hover:border-transparent"
                        >
                            ویرایش
                            <PencilSquareIcon class="size-6"></PencilSquareIcon>
                        </Link>
                    </div>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    TrashIcon,
    PencilSquareIcon,
    EyeIcon,
    UserIcon,
} from "@heroicons/vue/24/solid";
import Dashboard from "@/Pages/Dashboard.vue";
const props = defineProps({
    posts: Object,
    category: Object,
    user_name: String,
});
console.log(props.posts);
function remove(id) {
    if (confirm("آیا از حذف پست مطمئنید ؟")) {
        router.delete(route("post.destroy", id));
    }
}
</script>

<style></style>
