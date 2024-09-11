<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { watch } from 'vue';
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

const user = usePage().props.auth.user;
</script>

<template>
  <Head title="Competencias" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Competencias</h2>
    </template>

    <!-- OUTER CONTAINER -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- WHITE CONTAINER -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100"></div>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>