<script setup lang="ts">
import { Ref, ref, UnwrapRef } from 'vue'
import { TYPE, useToast } from 'vue-toastification'
import axios from 'axios'
import ToastNotification from '@/components/ToastNotification.vue'
import IconServerRack from "@/components/icons/IconServerRack.vue";
import IconHumiditySensor from "@/components/icons/IconHumiditySensor.vue";
import Sensor from "@/components/Sensor.vue";

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

const toast = useToast()

const getStuff = async (): Promise<Layout[]> => {
  const response = await fetch('//localhost:80/supervision/api/global/coords-relations.php')
  const json = await response.json()
  return json.data
}

const layout: Ref<UnwrapRef<Layout[]>> = ref(await getStuff())


const checkOverlap = (i: number, x: number, y: number) => {
  console.log('checkOverlap')
  return layout.value.find((item) => item.x === x && item.y === y && item.i !== i)
}

const overlap = ref(false)
const move = async (i: number, x: number, y: number) => {
  //console.log(i, x, y)
  if (checkOverlap(i, x, y)) {
    //console.log('overlap')
    //console.log(checkOverlap(i, x, y));
    overlap.value = true
  }
}

const moved = async (i: number, x: number, y: number) => {
  if (overlap.value) {
    layout.value = await getStuff()
    overlap.value = false

    toast({
      component: ToastNotification,
      props: {
        status: "Overlapped",
        message: "Elements overlapped all changes have been reverted!"
      }
    }, {
      type: TYPE.INFO
    })
    return
  }

  console.log(i, x, y)
  let l = layout.value.find((item) => item.i === i)
  if (!l) return

  let status: string
  let message: string
  const payload = {
    x: x,
    y: y,
    i: l.i
  }

  try {
    const movedResponse = await axios.post(
      '//localhost:80/supervision/api/global/coords-moved.php',
      payload
    )
    status = movedResponse.data.status
    message = movedResponse.data.message
  } catch (err) {
    status = err.response.data.status
    message = err.response.data.message
  }

  let content = {
    component: ToastNotification,
    props: {
      status: status,
      message: message
    }
  }

  toast(content, {
    type: status.toLowerCase() as TYPE
  })

  if (status === 'Error') {
    layout.value = await getStuff()
  }
}
</script>

<template>
  <grid-layout v-model:layout="layout" :col-num="12" :row-height="50" :vertical-compact="false">
    <template #default="{ gridItemProps }">
      <grid-item
        v-for="item in layout"
        :key="item.i"
        v-bind="gridItemProps"
        :x="item.x"
        :y="item.y"
        :w="1"
        :h="1"
        :i="item.i"
        :isDraggable="true"
        :isResizable="false"
        @moved="moved"
        @move="move"
        style="z-index: 9"
      >
<!--        {{  }}-->
        <IconServerRack v-if="item.source_table === 'server_rack'" />
        <Sensor v-if="item.source_table === 'sensor'" :type="item.source_type" />
      </grid-item>
    </template>
  </grid-layout>
</template>

<style scoped>
.vue-grid-item {
  background-color: #3f3f3f;
  display: flex;
  align-items: center;
  justify-content: center;
}

.grid-layout-container {
  background-color: #2f2f2f;
  border: 1px solid #1f1f1f;
  border-radius: 2px;
  margin: 0 auto;
  max-width: 1000px;
  padding: 1rem;
  width: 100%;
  position: relative;
}

.add-grids {
  position: absolute;
  width: calc(100% - 2rem);
  //top: 1rem;
  //right: 1rem;
  //z-index: 1;
}
</style>