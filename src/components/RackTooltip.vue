<template>
  <div class="wrapper" @click="console.log('3')">
    <div>Rack name: {{ source.source_name }} </div>
    <div>Rack air conditioning type: {{ source.source_air_cond }} </div>
    <div>Rack cooling method: {{ source.source_cooling_method }} </div>
    <div>Rack rack type: {{ source.source_type }}</div>
    <div class="join">
      <button class="btn join-item" @click="update">Update</button>
      <button class="btn join-item" @click="del">Delete</button>
    </div>
  </div>
  <div @click="console.log('3')">e</div>
</template>

<script setup lang="ts">

// const emits = defineEmits<{
//   update: () => void
//   delete: () => void
// }>()


const emits = defineEmits(
  ['update', 'delete']
)

const update = () => {
  emits('update')
}

const del = () => {
  console.log('update')
  emits('delete')
}
/*
    badge-success
    badge-warning
    badge-error
 */
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
}

defineProps<{
  source: Layout
}>()

</script>


<style scoped>
.join {
  width: 100%;
  display: flex;
}

.join button {
  flex-grow: 1;
  margin-top: 10px;
}

.wrapper {
  display: flex;
  flex-direction: column;
}
</style>