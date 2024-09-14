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
  teams: {
    type: Array,
    required: true
  },
  matchTypes: {
    type: [Array, Object],
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

const user = usePage().props.auth.user

/* ALERT MODAL */
const isSheila = ref(user.nickname == 'Sheila')
const showModal = defineModel('showModal')
function closeModal() {
  showModal.value = false
  if (isSheila.value) {
    isSheila.value = false
  } else {
    router.get(route('quizMatches.index'))
  }
}

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

/* SCORE FORM */
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
  if (user.is_able_to.quiz_matches.update) {
    currentMatch.value = match
    scoreForm.id = match.id
    scoreForm.local_score = currentMatch.value.local_score != null ? currentMatch.value.local_score : ''
    scoreForm.guest_score = currentMatch.value.guest_score != null ? currentMatch.value.guest_score : ''
    showScoreForm.value = true
  }
};

/* CREATE FORM */
const showCreateForm = ref(false)
const createForm = useForm({
  local_team_id: '',
  guest_team_id: '',
  type: ''
})

function submitCreate() {
  createForm.post(route('quizMatches.store'))
}
function closeCreateForm() {
  showCreateForm.value = false
};
</script>

<template>
  <Head title="Competencias"></Head>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Competencias</h2>
    </template>

    <!-- CREATE MODAL -->
    <Modal :show="showCreateForm" @close="closeCreateForm">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">Nueva competencia</h2>
        <form @submit.prevent="submitCreate" class="mt-4">
          <div class="flex gap-2">
            <div class="w-full">
              <InputLabel for="local_team_id" value="Equipo 1"/>
              <SelectInput
                id="local_team_id"
                class="w-full mt-1 block"
                v-model="createForm.local_team_id"
                :items="props.teams"
                :display-fields="['name']" />
              <InputError class="mt-2" :message="createForm.errors.local_team_id"/>
            </div>
            <div class="w-full">
              <InputLabel for="guest_team_id" value="Equipo 2"/>
              <SelectInput
                id="guest_team_id"
                class="w-full mt-1 block"
                v-model="createForm.guest_team_id"
                :items="props.teams"
                :display-fields="['name']" />
              <InputError class="mt-2" :message="createForm.errors.guest_team_id"/>
            </div>
          </div>

          <div class="w-full mt-2">
            <InputLabel for="type" value="Ronda"/>
            <SelectInput
              id="type"
              class="w-full mt-1 block"
              v-model="createForm.type"
              :is-from-d-b="false"
              :items="props.matchTypes" />
            <InputError class="mt-2" :message="createForm.errors.type"/>
          </div>

          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeCreateForm"> Cerrar </SecondaryButton>
            <PrimaryButton class="ms-4" :class="{ 'opacity-25': createForm.processing }" :disabled="createForm.processing">
                Guardar
            </PrimaryButton>
          </div>
        </form>
      </div>
    </Modal>

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
                required
                autofocus />
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
    <Modal :show="showModal || isSheila" @close="closeModal">
      <div class="p-6">
        <div v-if="user.nickname == 'Sheila'">
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">Hola amilla 🥺</h2>
          <p class="mt-1 text-sm text-gray-600 dark:text-gray-100">
            Antes que nada quiero pedirle disculpas una vez más, mi intención nunca fue hacerla
            enojar o sentir mal, pero a veces mi torpeza no me hace ver que lo que hago podría no
            resultar como esperaba, me siento como Calamardo cuando hace bromas y solo a el le
            dan risa, no haré más bromas así amilla, sentí feo hacerla sentir así 💔
            Mejor cambio las bromas por más coquitas y tlayudas 🤭 sin más por el momento deseo que
            siga pasando usted una bonita noche
            <br><br>
            Ahora si, si pone su teléfono en modo oscuro se ve más chido 🤭
          </p>
        </div>
        <div v-else>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">{{ props.modalTitle != null ? props.modalTitle : '' }}</h2>
          <p class="mt-1 text-sm text-gray-600 dark:text-gray-100">{{ props.modalMessage != null ? props.modalMessage : '' }}</p>
        </div>
          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeModal"> Cerrar </SecondaryButton>
          </div>
      </div>
    </Modal>

    <!-- OUTER CONTAINER -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">

        <!-- CREATE CONTAINER -->
        <div v-if="user.is_able_to.quiz_matches.create" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 flex gap-2 justify-start">
          <PrimaryButton @click="showCreateForm = true" class="flex gap-2">
            Nueva Competencia
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
          </PrimaryButton>
        </div>

        <!-- SEARCH CONTAINER -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 flex gap-2 justify-around">
          <TextInput
            id="search"
            type="text"
            class="w-full"
            v-model="q"
            placeholder="Buscar" />
          <PrimaryButton @click="resetQ" class="sm:!px-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
            </svg>
          </PrimaryButton>
        </div>

        <!-- MATCHES CONTAINERS -->
        <div v-for="match in filteredMatches" :key="match.id" class="flex gap-2">
          <div @click="prepareScoreForm(match)" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-tr-lg rounded-br-lg sm:rounded-lg p-4 flex flex-col gap-1 justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700 transition ease-in-out duration-150 w-full">
            <h3 v-if="match.type != 'regular'" class="text-lg font-bold text-pink-700 dark:text-pink-600 self-start">{{ match.locale_type }}</h3>
            <div class="flex w-full justify-between items-center">
              <p :class="{'text-teal-500': match.local_score > match.guest_score, 'dark:text-teal-300': match.local_score > match.guest_score}" class="text-gray-800 dark:text-gray-300 font-bold text-left">{{ match.local_team.name }}</p>
              <p v-if="match.local_score != null" class="text-teal-500 dark:text-teal-300 bg-gray-100 dark:bg-gray-900 px-2 py-1 text-center rounded-md">{{ match.local_score }}</p>
            </div>
            <div class="flex w-full justify-between items-center">
              <p :class="{'text-teal-500': match.guest_score > match.local_score, 'dark:text-teal-300': match.guest_score > match.local_score}" class="text-gray-800 dark:text-gray-300 font-bold text-right">{{ match.guest_team.name }}</p>
              <p v-if="match.guest_score != null" class="text-teal-500 dark:text-teal-300 bg-gray-100 dark:bg-gray-900 px-2 py-1 text-center rounded-md">{{ match.guest_score }}</p>
            </div>
          </div>
          <div v-if="user.is_able_to.quiz_matches.download" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-tl-lg rounded-bl-lg sm:rounded-lg px-4 flex gap-2 justify-around items-center w-fit">
            <a v-if="match.local_score != null && match.guest_score != null" :href="route('quizMatches.download', { matchId: match.id })" :class="[match.downloaded ? 'border border-amber-500' : '']" class="!p-2 inline-flex items-center bg-white dark:bg-gray-800 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fbbf24" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
            </a>
          </div>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
