<script setup lang="ts">
import { ref } from 'vue'

const addLayout = ref([
  { x: 0, y: 0, w: 1, h: 1, i: 99 },
  { x: 1, y: 0, w: 1, h: 1, i: 1 },
  { x: 2, y: 0, w: 1, h: 1, i: 2 },
  { x: 3, y: 0, w: 1, h: 1, i: 3 },
  { x: 4, y: 0, w: 1, h: 1, i: 4 },
  { x: 5, y: 0, w: 1, h: 1, i: 5 },
  { x: 6, y: 0, w: 1, h: 1, i: 6 },
  { x: 7, y: 0, w: 1, h: 1, i: 7 },
  { x: 8, y: 0, w: 1, h: 1, i: 8 },
  { x: 9, y: 0, w: 1, h: 1, i: 9 },
  { x: 10, y: 0, w: 1, h: 1, i: 10 },
  { x: 11, y: 0, w: 1, h: 1, i: 11 },
  { x: 0, y: 1, w: 1, h: 1, i: 12 },
  { x: 1, y: 1, w: 1, h: 1, i: 13 },
  { x: 2, y: 1, w: 1, h: 1, i: 14 },
  { x: 3, y: 1, w: 1, h: 1, i: 15 },
  { x: 4, y: 1, w: 1, h: 1, i: 16 },
  { x: 5, y: 1, w: 1, h: 1, i: 17 },
  { x: 6, y: 1, w: 1, h: 1, i: 18 },
  { x: 7, y: 1, w: 1, h: 1, i: 19 },
  { x: 8, y: 1, w: 1, h: 1, i: 20 },
  { x: 9, y: 1, w: 1, h: 1, i: 21 },
  { x: 10, y: 1, w: 1, h: 1, i: 22 },
  { x: 11, y: 1, w: 1, h: 1, i: 23 },
  { x: 0, y: 2, w: 1, h: 1, i: 24 },
  { x: 1, y: 2, w: 1, h: 1, i: 25 },
  { x: 2, y: 2, w: 1, h: 1, i: 26 },
  { x: 3, y: 2, w: 1, h: 1, i: 27 },
  { x: 4, y: 2, w: 1, h: 1, i: 28 },
  { x: 5, y: 2, w: 1, h: 1, i: 29 },
  { x: 6, y: 2, w: 1, h: 1, i: 30 },
  { x: 7, y: 2, w: 1, h: 1, i: 31 },
  { x: 8, y: 2, w: 1, h: 1, i: 32 },
  { x: 9, y: 2, w: 1, h: 1, i: 33 },
  { x: 10, y: 2, w: 1, h: 1, i: 34 },
  { x: 11, y: 2, w: 1, h: 1, i: 35 },
  { x: 0, y: 3, w: 1, h: 1, i: 36 },
  { x: 1, y: 3, w: 1, h: 1, i: 37 },
  { x: 2, y: 3, w: 1, h: 1, i: 38 },
  { x: 3, y: 3, w: 1, h: 1, i: 39 },
  { x: 4, y: 3, w: 1, h: 1, i: 40 },
  { x: 5, y: 3, w: 1, h: 1, i: 41 },
  { x: 6, y: 3, w: 1, h: 1, i: 42 },
  { x: 7, y: 3, w: 1, h: 1, i: 43 },
  { x: 8, y: 3, w: 1, h: 1, i: 44 },
  { x: 9, y: 3, w: 1, h: 1, i: 45 },
  { x: 10, y: 3, w: 1, h: 1, i: 46 },
  { x: 11, y: 3, w: 1, h: 1, i: 47 },
  { x: 0, y: 4, w: 1, h: 1, i: 48 },
  { x: 1, y: 4, w: 1, h: 1, i: 49 },
  { x: 2, y: 4, w: 1, h: 1, i: 50 },
  { x: 3, y: 4, w: 1, h: 1, i: 51 },
  { x: 4, y: 4, w: 1, h: 1, i: 52 },
  { x: 5, y: 4, w: 1, h: 1, i: 53 },
  { x: 6, y: 4, w: 1, h: 1, i: 54 },
  { x: 7, y: 4, w: 1, h: 1, i: 55 },
  { x: 8, y: 4, w: 1, h: 1, i: 56 },
  { x: 9, y: 4, w: 1, h: 1, i: 57 },
  { x: 10, y: 4, w: 1, h: 1, i: 58 },
  { x: 11, y: 4, w: 1, h: 1, i: 59 },
  { x: 0, y: 5, w: 1, h: 1, i: 60 },
  { x: 1, y: 5, w: 1, h: 1, i: 61 },
  { x: 2, y: 5, w: 1, h: 1, i: 62 },
  { x: 3, y: 5, w: 1, h: 1, i: 63 },
  { x: 4, y: 5, w: 1, h: 1, i: 64 },
  { x: 5, y: 5, w: 1, h: 1, i: 65 },
  { x: 6, y: 5, w: 1, h: 1, i: 66 },
  { x: 7, y: 5, w: 1, h: 1, i: 67 },
  { x: 8, y: 5, w: 1, h: 1, i: 68 },
  { x: 9, y: 5, w: 1, h: 1, i: 69 },
  { x: 10, y: 5, w: 1, h: 1, i: 70 },
  { x: 11, y: 5, w: 1, h: 1, i: 71 },
])

import AddComponent from "@/components/AddComponent.vue";
import ComponentModal from "@/components/ComponentModal.vue";
import LayoutGrid from "@/components/LayoutGrid.vue";
import { Skeletor } from 'vue-skeletor';

const clickedX = ref<number | null>(null);
const clickedY = ref<number | null>(null);
const modalShown = ref<boolean>(false);
const showModal = (x: number, y: number) => {
  clickedX.value = x;
  clickedY.value = y;
  modalShown.value = true;
};

const closeModal = () => {
  clickedY.value = null;
  clickedX.value = null;
  modalShown.value = false;
};



</script>

<template>
  <div class="grid-layout-container">
    <Suspense>
      <template #default>
        <div>
          <grid-layout
            class="add-grids"
            v-model:layout="addLayout"
            :col-num="12"
            :row-height="50"
            :vertical-compact="true"
            style="z-index: 8"

          >
            <template #default="{ gridItemProps }">
              <!-- | gridItemProps props from GridLayout | -->
              <!--breakpointCols: props.cols-->
              <!--colNum: props.colNum-->
              <!--containerWidth: width.value-->
              <!--isDraggable: props.isDraggable-->
              <!--isResizable: props.isResizable-->
              <!--lastBreakpoint: lastBreakpoint.value-->
              <!--margin: props.margin-->
              <!--maxRows: props.maxRows-->
              <!--responsive: props.responsive-->
              <!--rowHeight: props.rowHeight-->
              <!--useCssTransforms: props.useCssTransforms-->
              <!--width: width.value-->
              <grid-item
                v-bind="gridItemProps"
                v-for="item in addLayout"
                :key="item.i"
                :x="item.x"
                :y="item.y"
                :w="item.w"
                :h="item.h"
                :i="item.i"
                :isDraggable="false"
                :isResizable="false"
              >
                <AddComponent @click="showModal(item.x, item.y)" />
              </grid-item>
            </template>
          </grid-layout>
          <LayoutGrid />
        </div>
      </template>

      <template #fallback>
        <Skeletor style="z-index: 100" height="400"/>
      </template>
    </Suspense>
  </div>

  <ComponentModal
    :show-model-el="modalShown"
    :selected-x="clickedX"
    :selected-y="clickedY"
    @close="closeModal"
  />
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