<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Employee, PaginatedResponse, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Employees',
    href: '/employees',
  },
];

interface EmployeesPageProps {
  employees: PaginatedResponse<Employee>
}

const props = defineProps<EmployeesPageProps>();
console.log(props);
</script>

<template>

  <Head title="Employees" />

  <AppLayout :breadcrumbs="breadcrumbs">
    Employees
  </AppLayout>
</template>
