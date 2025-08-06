<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Employees',
    href: '/employees',
  },
];
</script>

<template>

  <Head title="Employee" />
  <AppLayout :breadcrumbs="breadcrumbs">
    Employee
  </AppLayout>
</template>
