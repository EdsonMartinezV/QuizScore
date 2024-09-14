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
  teams: {
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

const user = usePage().props.auth.user

/* ALERT MODAL */
const showModal = defineModel('showModal')
function closeModal() {
  showModal.value = false
  router.get(route('quizMatches.index'))
};
</script>

<template>
  <Head title="Competencias"></Head>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Equipos</h2>
    </template>

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

      <!-- CREATE CONTAINER -->
      <div v-if="user.is_able_to.teams.download" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 flex gap-2 justify-start">
        <a :href="route('teams.download')" class="border border-amber-500 !p-2 inline-flex items-center bg-white dark:bg-gray-800 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fbbf24" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
          </svg>
        </a>
      </div>

        <!-- TEAMS CONTAINERS -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 flex gap-2 justify-around">
          <div class="relative overflow-x-auto w-full shadow-md rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 dark:text-gray-400 uppercase bg-gray-100 dark:bg-gray-900 text-center">
                <th scope="col" class="px-2 py-3"></th>
                <th scope="col" class="px-2 py-3">Juegos</th>
                <th scope="col" class="px-2 py-3">Ganados</th>
                <th scope="col" class="px-2 py-3">Perdidos</th>
                <th scope="col" class="px-2 py-3">Empatados</th>
                <th scope="col" class="px-2 py-3 whitespace-nowrap">Puntos +</th>
                <th scope="col" class="px-2 py-3 whitespace-nowrap">Puntos -</th>
                <th scope="col" class="px-2 py-3">Diferencia</th>
              </thead>
              <tbody>
                <tr v-for="(team, index) in props.teams" :key="team.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th :class="[index < 8 ? 'text-teal-500 dark:text-teal-300' : 'text-gray-900 dark:text-white']" class="px-3 py-4 font-bold whitespace-nowrap" scope="row">{{ team.name }}</th>
                  <td class="p-2 text-center">{{ team.played_matches }}</td>
                  <td :class="[index < 8 ? 'text-pink-700 dark:text-pink-600' : '']" class="p-2 text-center font-bold">{{ team.won_matches }}</td>
                  <td class="p-2 text-center">{{ team.lost_matches }}</td>
                  <td class="p-2 text-center">{{ team.drawn_matches }}</td>
                  <td :class="[index < 8 ? 'text-yellow-600 dark:text-amber-400' : '']" class="p-2 text-center font-bold">{{ team.scored_points }}</td>
                  <td class="p-2 text-center">{{ team.conceded_points }}</td>
                  <td :class="[index < 8 ? 'text-yellow-600 dark:text-amber-400' : '']" class="p-2 text-center font-bold">{{ team.point_spread }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
