<script setup lang="ts">

defineProps<{
  status: string
  message: string
}>()

</script>

<template>
  <div>
    <h3 class="font-bold text-lg">{{ status }}!</h3>
    <div class="text-sm">{{ message }}</div>
  </div>
</template>