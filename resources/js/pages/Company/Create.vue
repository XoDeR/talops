<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Companies',
    href: '/companies',
  },
];

const form = useForm({
  name: '',
  email: '',
})

function submit() {
  form.post('/companies', {
    onSuccess: () => form.reset(),
  })
}
</script>

<template>

  <Head title="Company" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div>
      <h1>Create Company</h1>

      <form @submit.prevent="submit">
        <div>
          <label>Name:</label>
          <input v-model="form.name" type="text" />
          <span v-if="form.errors.name">{{ form.errors.name }}</span>
        </div>

        <div>
          <label>Email:</label>
          <input v-model="form.email" type="email" />
          <span v-if="form.errors.email">{{ form.errors.email }}</span>
        </div>

        <button type="submit" :disabled="form.processing">Create</button>
      </form>
    </div>
  </AppLayout>
</template>
