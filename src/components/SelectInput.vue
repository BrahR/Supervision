<script setup lang="ts">
import { computed, onMounted, ref } from "vue";
import * as module from "module";

type Option = {
  value: number | string,
  text: number | string
}

type PropsType = {
  modelValue: string | number | boolean | null | undefined | string[],
  selectText?: string,
  options: Option[],
  disabled?: boolean,
}

// IDE ERROR
// @ts-ignore
const props = withDefaults(defineProps<PropsType>(), {
  modelValue: '',
  selectText: 'Select an option',
  options: [] as Option[],
  disabled: false
});

const emit = defineEmits<{
  (event: 'update:modelValue', value: string | number): void,
}>();

const input = ref<HTMLSelectElement | null>(null);

onMounted(() => {
  if (input.value?.hasAttribute('autofocus')) {
    input.value?.focus();
  }
});

defineExpose({ focus: () => input.value?.focus() });

const selected = computed(() => {
  return !props.options.find((option) => option.value === props.modelValue);
})
</script>

<template>
  <select
    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    :value="props.modelValue"
    :ref="input"
    :disabled="props.disabled !== undefined ? props.disabled : false"
    @input="$emit('update:modelValue', $event.target.value)"
  >
    <option :selected="selected" disabled value="">{{ selectText }}</option>
    <option v-for="option in options" :value="option.value">{{ option.text }}</option>
  </select>
</template>
