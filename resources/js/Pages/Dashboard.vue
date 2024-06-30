<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
            <div class="flex flex-row justify-between relative overflow-x-auto">
                <table
                    class="min-w-full text-center text-sm font-light text-surface dark:text-white"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">تعداد کاربران</th>
                            <th scope="col" class="px-6 py-3">
                                تعداد پست های شما
                            </th>
                            <th scope="col" class="px-6 py-3">
                                تعداد دسته بندی های شما
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="border-b border-neutral-200 dark:border-white/10"
                        >
                            <!-- user -->
                            <td class="whitespace-nowrap px-6 py-4">
                                {{ userCount }}
                            </td>
                            <!-- Post -->
                            <td class="whitespace-nowrap px-6 py-4">
                                {{ postCount }}
                            </td>
                            <!-- Category -->
                            <td class="whitespace-nowrap px-6 py-4">
                                {{ categoryCount }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, router, usePage, Head } from "@inertiajs/vue3";
import "../../css/font.css";

export default {
    components: {
        Link,
        usePage,
        router,
        Head,
        AuthenticatedLayout,
    },
    props: {
        post: Object,
        user: Object,
        category: Object,
    },
    setup(props) {
        let categoryCount = props.category.length;
        let userCount = props.user.length;
        let postCount = props.post.length;

        console.log(categoryCount);
        console.log(userCount);
        console.log(postCount);

        return { categoryCount, userCount, postCount };
    },
};
</script>
