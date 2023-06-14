<script setup lang="ts">
import TextInput from '@/components/TextInput.vue';
import InputLabel from '@/components/InputLabel.vue';
import InputError from '@/components/InputError.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import SelectInput from "@/components/SelectInput.vue";

import { Ref, ref, toRefs } from "vue";
import { useVuelidate, GlobalConfig, ValidationArgs, Validation } from "@vuelidate/core";
import { maxLength, minLength, helpers, required } from "@vuelidate/validators";
import { TYPE, useToast } from "vue-toastification";
import axios from "axios";
import ToastNotification from "@/components/ToastNotification.vue";

const toast = useToast();

type RackForm = {
  name: string;
  airConditioning: string;
  rackType: string;
  coolingMethod: string;
  selectedX: number | null;
  selectedY: number | null;
};

const emits = defineEmits<{
  (event: 'close'): void;
}>();

const props = defineProps<{
  selectedX: number | null;
  selectedY: number | null;
}>();

const closeModal = () => {
  emits('close');
};

const processing = ref(false);
const form: Ref<RackForm> = ref({
  name: 'Claire Potts',
  airConditioning: 'Split',
  rackType: 'Normal',
  coolingMethod: 'Raised floor',
  selectedX: props.selectedX,
  selectedY: props.selectedY,
});
const formRefs = toRefs(form.value);

const allowedAC = ['Split', 'Built-in', 'Portable']
const allowedRackType = ['Normal', 'Air-conditioned']
const allowedCoolingMethod = ['Raised floor', 'Ceiling cooling', 'In-row cooling', 'Water cooling']
const allowed = (array: string[]) => (value: string) => array.includes(value)
const optionFunc = (array: string[]) => array.map((value) => ({ text: value, value: value }))


const rules: ValidationArgs<RackForm> = {
  name: {
    required: helpers.withMessage('This field is required', required),
    minLength: minLength(3),
    maxLength: maxLength(255),
  },
  airConditioning: {
    required: helpers.withMessage('Please select an air conditioning type', required),
    allowed: helpers.withMessage('You can only select one of these values: ' + allowedAC.join(', '), allowed(allowedAC)),
  },
  rackType: {
    required: helpers.withMessage('Please select a rack type', required),
    allowed: helpers.withMessage('You can only select one of these values: ' + allowedRackType.join(', '), allowed(allowedRackType)),
  },
  coolingMethod: {
    required: helpers.withMessage('Please select a cooling method', required),
    allowed: helpers.withMessage('You can only select one of these values: ' + allowedCoolingMethod.join(', '), allowed(allowedCoolingMethod)),
  },
  selectedX: { required },
  selectedY: { required },
}

const config: GlobalConfig = {
  $autoDirty: true,
};

const v$ = useVuelidate(rules, formRefs, config) as Ref<Validation<RackForm>>;

console.log("rules", rules);
console.log("form", form);

async function submit() {
  processing.value = true;

  const isValid = await v$.value.$validate();
  // console.log("v$", v$);
  // console.log("isValid", isValid);
  if (isValid) {
    // console.log("result", JSON.stringify(form.value));
    // console.log(form.value);
    let status = ref('Error');
    let message = ref('Something went wrong');

    const content = {
      component: ToastNotification,
      props: {
        status: status,
        message: message,
      },
    }

    const result = await axios.post('//localhost:80/supervision/api/ServerRack/create.php', form.value)
      .then((res) => {
        status.value = res.data.status
        message.value = res.data.message
      })
      .catch((err) => {
        console.log(err);
        status.value = err.response.data.status
        message.value = err.response.data.message
      })

    toast(content, {
      type: status.value.toLowerCase() as TYPE,
    });
  }

  processing.value = false;
}

</script>

<template>
  <form @submit.prevent="submit">
    <h2 class="mt-2 text-lg font-medium text-gray-900">Create a server rack</h2>

    <p class="mt-1 text-sm text-gray-600">
      Fill the form to create a new server rack.
    </p>

    <div class="mt-6">
      <div>
        <InputLabel for="name" value="Rack name:" />

        <TextInput
          id="name"
          v-model="form.name"
          class="mt-1 block w-full"
          type="text"
          placeholder="Rack name"
        />

        <InputError :message="v$.name.$errors[0]?.$message" class="mt-2" />
      </div>

      <div class="mt-4">
        <InputLabel for="air-conditioning" value="Air Conditioning Type:" />

        <SelectInput
          id="air-conditioning"
          v-model="form.airConditioning"
          select-text="Select an air conditioning type"
          :options="optionFunc(allowedAC)"
        />

        <InputError :message="v$.airConditioning.$errors[0]?.$message" class="mt-2" />
      </div>

      <div class="mt-4">
        <InputLabel for="rack-type" value="Rack Type:" />

        <SelectInput
          id="rack-type"
          v-model="form.rackType"
          select-text="Select a rack type"
          :options="optionFunc(allowedRackType)"
        />

        <InputError :message="v$.rackType.$errors[0]?.$message" class="mt-2" />
      </div>

      <div class="mt-4">
        <InputLabel for="cooling-method" value="Cooling Method:" />

        <SelectInput
          id="cooling-method"
          v-model="form.coolingMethod"
          select-text="Select a cooling method"
          :options="optionFunc(allowedCoolingMethod)"
        />

        <InputError :message="v$.rackType.$errors[0]?.$message" class="mt-2" />
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
  </form>
</template>

<style scoped>

</style>