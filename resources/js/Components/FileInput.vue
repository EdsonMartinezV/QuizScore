<script setup>
import { ref } from 'vue';

const props = defineProps({
  hint: {
    type: String,
    default: 'Selecciona un archivo'
  },
  multiple: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['fileSelected'])

const fileNames = ref()

function showFileName(e) {
  const inputFiles = [...e.target.files]

  if (inputFiles ) {
    fileNames.value = inputFiles.map((file) => {
      return file.name
    })

    if (props.multiple)
      emit('fileSelected', inputFiles)
    else
      emit('fileSelected', inputFiles[0])

  }
};
</script>

<template>
  <label class="w-full h-1/2 text-gray-700 bg-slate-100 border-slate-400 rounded-md border-dashed border-2 hover:bg-slate-200 active:bg-slate-300 flex flex-col items-center justify-center px-2 transition-all">
    <p v-if="fileNames" class="text-center">
      <template v-for="name in fileNames" :key="name">
        {{ name }}<br>
      </template>
    </p>
    <p v-else class="text-center">{{ props.hint }}</p>
    <input v-if="props.multiple" type="file" class="opacity-0" multiple accept="image/*" capture="environment" @change="showFileName">
    <input v-else type="file" class="opacity-0" accept="image/*" capture="environment" @change="showFileName">
  </label>
</template>
