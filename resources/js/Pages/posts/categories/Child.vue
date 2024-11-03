<template>
    <div
        class="fixed top-0 right-0 left-0 bottom-0 bg-[rgba(0,0,0,0.2)] p-10 z-10 flex flex-col justify-center align-center"
    >
        <div
            class="rounded-md m-auto flex flex-col justify-center align-center bg-white p-8 max-w-min min-h-min"
        >
            <slot />
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useKeypress } from "vue3-keypress";

const target = ref("false");
const props = defineProps({
    count: Number,
});

const emit = defineEmits("closeBtn");
function send() {
    emit("closeBtn");
    console.log("Close");
}
function send2() {
    emit("closeBtn");
    console.log("OK");
}

useKeypress({
    keyEvent: "keydown",
    keyBinds: [
        {
            keyCode: "esc",
            success: send,
            preventDefault: true,
        },
        {
            keyCode: "enter",
            success: send2,
            preventDefault: true,
        },
    ],
});
</script>
