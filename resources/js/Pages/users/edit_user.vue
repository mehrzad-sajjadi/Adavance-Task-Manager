<template>
    <Head title="Update Task" />

    <div
        class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
    >
        <div
            class="flex flex-row items-center w-full min-h-min bg-[#21252908] border-b-2"
        >
            <p class="px-4 m-2 text-xl">ویرایش کاربر</p>
        </div>
        <div class="flex flex-col justify-between">
            <div>
                <div class="mb-5 py-2 px-2 w-full">
                    <label
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                    >
                        نام
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>
            </div>
        </div>

        <div class="flex flex-row justify-between mb-4">
            <button
                @click="edit"
                class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-600 hover:border-transparent"
            >
                ویرایش
            </button>

            <Link
                :href="route('users.index')"
                type="submit"
                as="button"
                class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
            >
                انصراف
            </Link>
        </div>
    </div>
</template>

<script>
import { Head, useForm, Link, usePage, router } from "@inertiajs/vue3";
import Dashboard from "../Dashboard.vue";

export default {
    components: {
        Head,
        useForm,
        Link,
        usePage,
        router,
        Dashboard,
    },
    props: {
        user: Object,
    },
    setup(props) {
        const form = useForm({
            id: props.user.id,
            name: props.user.name,
            email: props.user.email,
        });

        function edit() {
            form.put(route("user.update", [props.user.id]), {});
        }

        return { form, edit };
    },
};
</script>
