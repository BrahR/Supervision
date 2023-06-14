<script setup lang="ts">
import Modal from '@/components/Modal.vue';
import InputLabel from '@/components/InputLabel.vue';
import SensorForm from "@/components/SensorForm.vue";
import ServerRackForm from "@/components/ServerRackForm.vue";
import SelectInput from "@/components/SelectInput.vue";

import { ref } from "vue";
import TextInput from "@/components/TextInput.vue";

const emits = defineEmits<{
  (event: 'close'): void;
}>();

defineProps<{
  showModelEl: boolean;
  selectedX: number | null;
  selectedY: number | null;
}>();

const closeModal = () => {
  emits('close');
  select.value = '1';
};

const options = [
  { value: 1, text: "Server rack" },
  { value: 2, text: "Sensor" },
];

const select = ref('');
const text = ref('')

</script>

<template>
  <Modal :show="showModelEl" @close="closeModal">
    <div class="p-6 text-gray-900">
      <h2 class="text-lg font-medium text-gray-900">Select a component type</h2>

      <p class="mt-1 text-sm text-gray-600">
        Select what component type you want to add.
      </p>

      <div class="mt-4 divide-dashed divide-y-2 divide-cyan-600">
        <div class="pb-4">
          <InputLabel for="component" value="Component type:" />

          <SelectInput
            id="component"
            v-model="select"
            select-text="Select a component type"
            :options="options"
          />
        </div>

        <div v-if="select">
          <ServerRackForm
            v-if="select == 1"
            :selected-x="selectedX"
            :selected-y="selectedY"
            @close="closeModal"
          />

          <SensorForm
            v-if="select == 2"
            :selected-x="selectedX"
            :selected-y="selectedY"
            @close="closeModal"
          />
        </div>
      </div>
    </div>
  </Modal>
</template>