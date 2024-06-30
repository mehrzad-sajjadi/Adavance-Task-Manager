<template>
    <Head title="User" />
    <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
        <div
            class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
        >
            <p class="px-4 m-2 text-xl">لیست کاربران</p>

            <div>
                <Link
                    as="button"
                    type="button"
                    class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#6c757d] hover:bg-[#757b80] text-white border border-[#6c757d] hover:border-transparent"
                >
                    ایجاد کاربر جدید
                </Link>
                <Link
                    :href="route('dashboard')"
                    type="submit"
                    as="button"
                    class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                >
                    بازگشت
                </Link>
            </div>
        </div>
        <ul v-for="(user, index) in users" :key="index">
            <li
                class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-neutral-100"
            >
                <div class="content">
                    {{ user.name }}
                </div>
                <div class="min-w-max px-5 flex flex-row justify-between">
                    <!-- delete -->
                    <button
                        class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 border-red-600 border hover:border-black"
                        as="button"
                        type="button"
                        @click="remove(user.id)"
                    >
                        <TrashIcon class="size-6"></TrashIcon>
                    </button>

                    <!-- edit -->
                    <Link
                        :href="route('users.edit', user.id)"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 flex items-center text-sm transition-colors duration-150 rounded-lg focus:shadow-outline bg-white hover:bg-black text-black hover:text-white border border-black hover:border-transparent"
                    >
                        <PencilSquareIcon class="size-6"></PencilSquareIcon>
                    </Link>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { Link, router, usePage, Head } from "@inertiajs/vue3";
import dashboard from "../Dashboard.vue";

import {
    TrashIcon,
    DocumentCheckIcon,
    EyeIcon,
    PencilSquareIcon,
} from "@heroicons/vue/24/solid";

export default {
    components: {
        Link,
        usePage,
        router,
        Head,
        dashboard,
        TrashIcon,
        DocumentCheckIcon,
        EyeIcon,
        PencilSquareIcon,
    },
    props: {
        users: Object,
    },
    setup(props) {
        console.log(props.users);
        function remove(id) {
            if (confirm("آیا از حذف کاربر مطمئنید ؟")) {
                router.delete(route("users.destroy", id));
            }
        }

        return { remove };
    },
};
</script>

<style></style>
