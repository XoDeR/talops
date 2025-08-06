<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Companies',
    href: '/companies',
  },
];
</script>

<template>

  <Head title="Company" />
  <AppLayout :breadcrumbs="breadcrumbs">
    Company
  </AppLayout>
</template>
