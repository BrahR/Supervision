<script setup lang="ts">

import IconHumiditySensor from "@/components/icons/IconHumiditySensor.vue";
import IconTemperatureSensor from "@/components/icons/IconTemperatureSensor.vue";
import IconMotionSensor from "@/components/icons/IconMotionSensor.vue";
import IconProximitySensor from "@/components/icons/IconProximitySensor.vue";

const props = defineProps<{
  type: string
}>()


console.log(props.type);

</script>

<template>
  <IconTemperatureSensor v-if="props.type === 'Temperature'" />
  <IconHumiditySensor v-if="props.type === 'Humidity'" />
  <IconMotionSensor v-if="props.type === 'Motion'" />
  <IconProximitySensor v-if="props.type === 'Proximity'" />
</template>

<style scoped>

</style>