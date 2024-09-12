<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, watch } from 'vue';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
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
  },
  modalTitle: {
    type: String,
    required: false
  },
  modalMessage: {
    type: String,
    required: false
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
      return qWords.filter((word) => {
        return match.search_string.includes(word)
      }).length == qWords.length
    })
  }
})

/* SCORE MODAL */
const showScoreForm = ref(false)
const currentMatch = ref(null)
const scoreForm = useForm({
  _method: 'patch',
  id: '',
  local_score: '',
  guest_score: '',
})

function submitScore() {
  scoreForm.post(route('quizMatches.update'))
}
function closeScoreForm() {
  showScoreForm.value = false
}
function prepareScoreForm(match) {
  currentMatch.value = match
  scoreForm.id = match.id
  showScoreForm.value = true
};
</script>

<template>
  <Head title="Competencias"></Head>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Competencias</h2>
    </template>

    <!-- SCORE MODAL -->
    <Modal :show="showScoreForm" @close="closeScoreForm">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">Puntuación</h2>
        <form @submit.prevent="submitScore" class="mt-4">
          <div class="flex gap-4 justify-evenly">
            <div class="w-full">
              <InputLabel for="local_score" :value="currentMatch.local_team.name" />
              <TextInput
                id="local_score"
                type="number"
                step="1"
                class="block w-full mt-1"
                v-model="scoreForm.local_score"
                required />
              <InputError class="mt-2" :message="scoreForm.errors.local_score" />
            </div>
            <div class="w-full">
              <InputLabel for="guest_score" :value="currentMatch.guest_team.name" />
              <TextInput
                id="guest_score"
                type="number"
                step="1"
                class="block w-full mt-1"
                v-model="scoreForm.guest_score"
                required />
              <InputError class="mt-2" :message="scoreForm.errors.guest_score" />
              <InputError class="mt-2" :message="scoreForm.errors.id" />
            </div>
          </div>

          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeScoreForm"> Cerrar </SecondaryButton>
            <PrimaryButton class="ms-4" :class="{ 'opacity-25': scoreForm.processing }" :disabled="scoreForm.processing">
                Guardar
            </PrimaryButton>
          </div>
        </form>
      </div>
    </Modal>

    <!-- ALERT MODAL -->
    <Modal :show="showModal" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">{{ props.modalTitle != null ? props.modalTitle : '' }}</h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-100">{{ props.modalMessage != null ? props.modalMessage : '' }}</p>
          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeModal"> Cerrar </SecondaryButton>
          </div>
      </div>
    </Modal>

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
        <div v-for="match in filteredMatches" :key="match.id" @click="prepareScoreForm(match)" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 flex gap-2 justify-around hover:bg-gray-50 dark:hover:bg-gray-700 transition ease-in-out duration-150 active:ring-offset-2 dark:active:ring-offset-gray-800">
          <p class="text-gray-900 dark:text-gray-100">{{ match.local_team.name }}</p>
          <p v-if="match.local_score" class="text-gray-900 dark:text-gray-100">{{ match.local_score }}</p>
          <p class="text-gray-900 dark:text-gray-100">VS</p>
          <p v-if="match.guest_score" class="text-gray-900 dark:text-gray-100">{{ match.guest_score }}</p>
          <p class="text-gray-900 dark:text-gray-100">{{ match.guest_team.name }}</p>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>