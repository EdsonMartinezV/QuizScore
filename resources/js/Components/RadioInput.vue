<script setup>
const props = defineProps({
  value: {
    type: [Number, String],
    required: true
  }
})

const model = defineModel({
  type: [Number, String, null],
  required: true
});
</script>

<template>
  <input
    type="radio"
    v-model="model"
    :value="props.value"
    class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" >
</template>