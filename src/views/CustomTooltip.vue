<template>
  <div>
    <button v-tooltip="'Hi'">Hover me</button>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'TooltipButton',
});
</script>