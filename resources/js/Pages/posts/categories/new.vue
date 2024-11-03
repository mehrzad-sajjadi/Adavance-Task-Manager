<template>
    <div
        class="fixed top-0 right-0 left-0 bottom-0 bg-[rgba(0,0,0,0.2)] p-10 z-10 flex flex-col justify-center align-center"
    >
        <div
            class="rounded-md m-auto flex flex-col justify-center align-center bg-white p-8 max-w-min min-h-min"
        >
            <slot />
            {{ count }}
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    count: Number,
});
</script>
