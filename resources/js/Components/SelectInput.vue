<script setup>
const props = defineProps({
  isFromDB: {
    type: Boolean,
    default: true
  },
  items: {
    type: Array,
    required: true
  },
  idName: {
    type: String,
    default: 'id',
  },
  displayFields: {
    type: Array,
    required: false
  }
})

const model = defineModel({
  type: [Number, null, String],
  required:true
})

const getDisplayLabel = (item) => {
  let label = ''
  if (props.isFromDB) {
    props.displayFields.forEach((field) => {
      label += item[field] + ' '
    })
  }

  return label
};
</script>

<template>
  <select v-if="props.isFromDB" v-model.number="model" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
    <option v-for="item in props.items" :key="item[props.idName]" :value="item[props.idName]" class="ring-1 ring-black ring-opacity-5 p-2 hover:bg-indigo-100">{{ getDisplayLabel(item) }}</option>
  </select>
  <select v-else v-model="model" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
    <option v-for="item in props.items" :key="item" :value="item" class="ring-1 ring-black ring-opacity-5 p-2 hover:bg-indigo-100 capitalize">{{ item }}</option>
  </select>
</template>