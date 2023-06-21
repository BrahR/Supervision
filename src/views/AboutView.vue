<template>
  <button ref="btn">Hi</button>
</template>

<script setup lang="ts">

import { Ref, ref } from "vue";
import { useTippy } from "vue-tippy";

const btn: Ref<HTMLButtonElement> = ref(null) as any;

useTippy(btn, {
  content: "Joe Mama",
})
</script>
