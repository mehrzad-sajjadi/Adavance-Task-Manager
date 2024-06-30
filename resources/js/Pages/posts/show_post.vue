<template>
    <Head title="Task detail" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                جزئیات پست : {{ $page.props.post.name }}
            </h2>
        </template>

        <div class="flex flex-col">
            <div
                class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
            >
                <div
                    class="flex flex-row items-center w-full min-h-min bg-[#21252908] border-b-2 py-3 px-3"
                >
                    <div class="flex flex-row mr-5">
                        <userIcon class="size-6 ml-2"></userIcon>
                        {{ $page.props.user_post }}
                    </div>
                    <div class="flex flex-row mr-5">
                        <InboxStackIcon class="size-6 ml-2"></InboxStackIcon>
                        {{ $page.props.category_post }}
                    </div>
                </div>
                <dir>
                    {{ $page.props.post.content }}
                </dir>
                <div
                    class="flex flex-row justify-between bg-[#21252908] mt-3 border-t-1 border-gray-500"
                >
                    <Link
                        :href="route('post_index')"
                        type="submit"
                        as="button"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                    >
                        بازگشت
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { UserIcon, InboxStackIcon } from "@heroicons/vue/24/solid";

export default {
    props: {
        category_post: String,
        user_post: String,
        post: Object,
    },
    components: {
        Head,
        Link,
        Dashboard,
        AuthenticatedLayout,
        UserIcon,
        usePage,
        InboxStackIcon,
    },
    setup(props) {},
};
</script>

<style></style>
