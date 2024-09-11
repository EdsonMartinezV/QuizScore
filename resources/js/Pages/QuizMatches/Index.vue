<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, watch } from 'vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import SearchInput from '@/Components/SearchInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
  matches: {
    type: Array,
    required: true
  },
  matchTypes: {
    type: Array,
    required: true
  }
})

/* ALERT MODAL */
const showModal = defineModel('showModal')
function closeModal() {
  showModal.value = false
  router.get(route('quizMatches.index'))
}

const user = usePage().props.auth.user

/* SEARCH */
const filteredMatches = ref(props.matches)
const q = ref('')
function resetQ() {
  q.value = ''
}

watch(q, (newQ) => {
  if (newQ == '') {
    filteredMatches.value = props.matches
  } else {
    let qWords = newQ.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").split(' ')
    filteredMatches.value = props.matches.filter((match) => {
      /* return match.search_string.includes(newQ) */
      return qWords.filter((word) => {
        return match.search_string.includes(word)
      }).length == qWords.length
    })
  }
});
</script>

<template>
  <Head title="Competencias"></Head>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Competencias</h2>
    </template>

    <!-- OUTER CONTAINER -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">

        <!-- SEARCH CONTAINER -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 flex gap-2 justify-around">
          <TextInput
            id="search"
            type="text"
            class="w-full"
            v-model="q"
            placeholder="Buscar" />
          <PrimaryButton @click="resetQ">Reestablecer</PrimaryButton>
        </div>

        <!-- MATCHES CONTAINERS -->
        <div v-for="match in filteredMatches" :key="match.id" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 flex gap-2 justify-around">
          <p class="text-gray-900 dark:text-gray-100">{{ match.local_team.name }}</p>
          <p class="text-gray-900 dark:text-gray-100">VS</p>
          <p class="text-gray-900 dark:text-gray-100">{{ match.guest_team.name }}</p>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>