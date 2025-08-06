<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Company, PaginatedResponse, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Companies',
    href: '/companies',
  },
];

//interface Props {
//  companies: Company[]
//}

//const props = defineProps<Props>();

interface CompaniesPageProps {
  companies: PaginatedResponse<Company>
}

const props = defineProps<CompaniesPageProps>()

//console.log(props);
console.log(props.companies.data);
console.log(props.companies.meta);

// // With default values
// const props = withDefaults(defineProps<Props>(), {
//   age: 18,
//   isAdmin: false
// })
</script>

<template>

  <Head title="Companies" />

  <AppLayout :breadcrumbs="breadcrumbs">
    Companies
  </AppLayout>
</template>
