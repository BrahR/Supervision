<script setup lang="ts">
import Modal from '@/components/Modal.vue';
import InputLabel from '@/components/InputLabel.vue';
import SensorForm from "@/components/SensorForm.vue";
import ServerRackForm from "@/components/ServerRackForm.vue";
import SelectInput from "@/components/SelectInput.vue";

import { computed, ComputedRef, onMounted, Ref, ref } from "vue";
import TextInput from "@/components/TextInput.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import { helpers, maxLength, minLength, required } from "@vuelidate/validators";
import { GlobalConfig, useVuelidate, Validation, ValidationArgs } from "@vuelidate/core";
import axios from "axios";
import ToastNotification from "@/components/ToastNotification.vue";
import { TYPE, useToast } from "vue-toastification";
import InputError from "@/components/InputError.vue";

const toast = useToast()

const emits = defineEmits<{
  (event: 'close'): void;
}>();

const props = defineProps<{
  rackId: number | null;
  showModelEl: boolean;
  selectedX: number | null;
  selectedY: number | null;
}>();

type EquipmentForm = {
  name: string;
  description: string;
  type: string;
  unitSize: number;
  selectedX: number | null;
  selectedY: number | null;
  rackId: number | null;
};

const form: Ref<EquipmentForm> = ref({
  name: '',
  description: '',
  type: '',
  unitSize: '' as number,
  selectedX: props.selectedX,
  selectedY: props.selectedY,
  rackId: props.rackId,
})

const formRefs = ref(form.value)

const typeOptions = [
  { value: 'Server', text: 'Server'},
  { value: 'Switch', text: 'Switch'},
  { value: 'Firewall', text: 'Firewall'},
  { value: 'Router', text: 'Router'},
  { value: 'UPS', text: 'UPS'},
  { value: 'PDU', text: 'PDU'},
  { value: 'KVM', text: 'KVM'},
  { value: 'Other', text: 'Other'},
]

const sizeOptions = [
  { value: '1', text: '1U'},
  { value: '2', text: '2U'},
  { value: '3', text: '3U'},
  { value: '4', text: '4U'},
]

const types = typeOptions.map((option) => option.value)
const size = sizeOptions.map((option) => option.value)

const allowed = (array: string[]) => (value: string) => array.includes(value)
const optionFunc = (array: string[]) => array.map((value) => ({ text: value, value: value }))

const rules: ValidationArgs<EquipmentForm> = {
  name: {
    required: helpers.withMessage('This field is required', required),
    minLength: minLength(3),
    maxLength: maxLength(255),
  },
  description: {
    required: helpers.withMessage('This field is required', required),
    minLength: minLength(3),
    maxLength: maxLength(255),
  },
  type: {
    required: helpers.withMessage('Please select a rack type', required),
    allowed: helpers.withMessage('You can only select one of these values: ' +
      types.join(', '), allowed(types)
    ),
  },
  unitSize: {
    required: helpers.withMessage('Please select a cooling method', required),
    allowed: helpers.withMessage('You can only select one of these values: ' +
      sizeOptions.map((option) => option.text).join(', '), allowed(size as string[])
    ),
  },
  selectedX: { required },
  selectedY: { required },
  rackId: { required },
}

const config: GlobalConfig = {
  $autoDirty: true,
};

const v$ = useVuelidate(rules, formRefs, config) as Ref<Validation<EquipmentForm>>;
const closeModal = () => {
  emits('close');
};

const processing = ref(false)

async function submit() {
  processing.value = true;

  const isValid = await v$.value.$validate();
  console.log(isValid);
  console.log(v$.value);
  if (isValid) {
    console.log(3);

    let status: string;
    let message: string;

    console.log(form.value);

    const result = await axios.post('//localhost:80/supervision/api/Equipment/create.php', form.value)
      .then((res) => {
        status = res.data.status
        message = res.data.message
      })
      .catch((err) => {
        console.log(err);
        status = err.response.data.status
        message = err.response.data.message
      })

    toast({
      component: ToastNotification,
      props: {
        status: status,
        message: message,
      },
    }, {
      type: status.toLowerCase() as TYPE,
    });

    closeModal()
    // Reset form
    form.value = {
      name: '',
      description: '',
      type: '',
      unitSize: '' as number,
      selectedX: props.selectedX,
      selectedY: props.selectedY,
      rackId: props.rackId,
    }
  }

  processing.value = false;
}

</script>

<template>
  <Modal :show="showModelEl" @close="closeModal">
    <form @submit.prevent="submit">
      <div class="p-6 text-gray-900">
        <h2 class="text-lg font-medium text-gray-900">Create an equipment</h2>

        <p class="mt-1 text-sm text-gray-600">
          Fill the form to create a new equipment.
        </p>

        <div class="mt-6">
          <div>
            <InputLabel for="equipment-name" value="Equipment name:" />

            <TextInput
              id="equipment-name"
              v-model="form.name"
              class="mt-1 block w-full"
              type="text"
              placeholder="Equipment name"
            />

            <InputError :message="v$.name.$errors[0]?.$message" class="mt-2" />
          </div>

          <div class="mt-4">
            <InputLabel for="equipment-description" value="Equipment description:" />

            <TextInput
              id="equipment-description"
              v-model="form.description"
              class="mt-1 block w-full"
              type="text"
              placeholder="Equipment description"
            />

            <InputError :message="v$.description.$errors[0]?.$message" class="mt-2" />
          </div>

          <div class="mt-4">
            <InputLabel for="equipment-type" value="Equipment type:" />

            <SelectInput
              id="equipment-type"
              v-model="form.type"
              select-text="Select an equipment type"
              :options="typeOptions"
            />

            <InputError :message="v$.type.$errors[0]?.$message" class="mt-2" />
          </div>

          <div class="mt-4">
            <InputLabel for="equipment-size" value="Equipment size:" />

            <SelectInput
              id="equipment-size"
              v-model="form.unitSize"
              select-text="Select an equipment size"
              :options="sizeOptions"
            />

            <InputError :message="v$.unitSize.$errors[0]?.$message" class="mt-2" />
          </div>
        </div>
        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

          <PrimaryButton
            class="ml-4"
            :class="{ 'opacity-25': processing }"
            :disabled="processing"
          >
            Register
          </PrimaryButton>
        </div>
      </div>
    </form>
  </Modal>
</template>