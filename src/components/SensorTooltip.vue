<template>
  <div class="wrapper">
    <div>Sensor name: {{ source.source_name }} </div>
    <div>Sensor type: {{ source.source_type }} </div>
    <div>Sensor description: {{ source.source_description }} </div>
    <div class="m-auto badge badge-info gap-2">
      {{ source.tag }}
    </div>
  </div>
</template>

<script setup lang="ts">
/*
    badge-success
    badge-warning
    badge-error
 */

console.log(props.source.tag)

type Layout = {
  source_air_cond: string | null
  source_cooling_method: string | null
  source_description: string | null
  source_id: number
  source_name: string
  source_table: string
  source_type: string
  x: number
  y: number
  i: number
  h: number
  w: number
  tag: number
}

const props = defineProps<{
  source: Layout
}>()

</script>


<style scoped>
.wrapper {
  display: flex;
  flex-direction: column;
}
</style>