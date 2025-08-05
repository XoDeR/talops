<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: '/dashboard',
  },
  {
    title: 'Companies',
    href: '/companies',
  },
  {
    title: 'Employees',
    href: '/employees',
  },
];
</script>

<template>

  <Head title="Employees" />

  <AppLayout :breadcrumbs="breadcrumbs">
    Employees
  </AppLayout>
</template>
