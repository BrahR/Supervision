<script setup lang="ts">
import TextInput from '@/components/TextInput.vue';
import InputLabel from '@/components/InputLabel.vue';
import InputError from '@/components/InputError.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import SelectInput from "@/components/SelectInput.vue";
import ToastNotification from "@/components/ToastNotification.vue";

import { computed, ComputedRef, onMounted, Ref, ref, toRefs, watch } from "vue";
import { useVuelidate, GlobalConfig, ValidationArgs, Validation, ValidationRuleWithParams } from "@vuelidate/core";
import { maxLength, minLength, helpers, required } from "@vuelidate/validators";
import { TYPE, useToast } from "vue-toastification";
import axios from "axios";

const toast = useToast();

const sensorRequest = async (): Promise<string[]> => {
  try {
    const response = await axios.get('//localhost:80/supervision/api/SensorType/read.php');
    return response.data.data.map((sensorType) => sensorType.name)
  } catch (err) {

    let content = {
      component: ToastNotification,
      props: {
        status: err.response.data.status,
        message: err.response.data.message,
      },
    }

    toast(content, {
      type: err.response.data.status.toLowerCase(),
    });
    return []
  }
};

type SensorForm = {
  name: string;
  description: string;
  sensorType: string;
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
const form: Ref<SensorForm> = ref({
  name: 'Claire Potts',
  description: 'Split',
  sensorType: 'Temperature',
  selectedX: props.selectedX,
  selectedY: props.selectedY,
});
const formRefs = toRefs(form.value);

const allowedSensors: Ref<string[]> = ref([])

const sensors = computed({
  get: () => Object.values(allowedSensors.value),
  set: (value: string[]) => allowedSensors.value = value,
})

const allowed = (array: string[]) => (value: string) => array.includes(value)
const optionFunc = (array: string[]) => array.map((value) => ({ text: value, value: value }))

const textRule = {
  required: helpers.withMessage('This field is required', required),
  minLength: minLength(3),
  maxLength: maxLength(255),
}

onMounted(async () => {
  sensors.value = await sensorRequest()
})

const seperated = computed(() => sensors.value.join(', '))

const rules: ComputedRef<ValidationArgs<SensorForm>> = computed(() => {
  const computedAllowed = (value) => allowed(sensors.value)(value)

  return {
    name: textRule,
    description: textRule,
    sensorType: {
      required: helpers.withMessage('Please select a sensor type', required),
      allowed: helpers.withMessage(() => 'You can only select one of these: ' + seperated.value , computedAllowed)
    },
    selectedX: { required },
    selectedY: { required },
  }
})

const config: GlobalConfig = {
  $autoDirty: true,
};

const v$ = useVuelidate(rules.value as ValidationArgs<SensorForm>, formRefs, config) as Ref<Validation<SensorForm>>;
async function submit() {
  processing.value = true;

  const isValid = await v$.value.$validate();
  if (isValid) {
    let status: string;
    let message: string;

    const result = await axios.post('//localhost:80/supervision/api/Sensor/create.php', form.value)
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
        <InputLabel for="name" value="Rack name:" />

        <TextInput
          id="name"
          v-model="form.description"
          class="mt-1 block w-full"
          type="text"
          placeholder="Rack name"
        />

        <InputError :message="v$.description.$errors[0]?.$message" class="mt-2" />
      </div>

      <div class="mt-4">
        <InputLabel for="air-conditioning" value="Air Conditioning Type:" />

        <SelectInput
          id="air-conditioning"
          v-model="form.sensorType"
          select-text="Select an air conditioning type"
          :options="optionFunc(sensors)"
        />

        <InputError :message="v$.sensorType.$errors[0]?.$message" class="mt-2" />
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
