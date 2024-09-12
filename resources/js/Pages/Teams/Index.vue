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

        <!-- TEAMS CONTAINERS -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 flex gap-2 justify-around">
          <div class="relative overflow-x-auto w-full shadow-md rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 dark:text-gray-400 uppercase bg-gray-100 dark:bg-gray-900 text-center">
                <th scope="col" class="px-2 py-3"></th>
                <th scope="col" class="px-2 py-3">Juegos</th>
                <th scope="col" class="px-2 py-3">Ganados</th>
                <th scope="col" class="px-2 py-3">Perdidos</th>
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
