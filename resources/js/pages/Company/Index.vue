<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Company, CompanyDisplay, PaginatedResponse, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { columns } from './CompaniesDataTable/CompaniesDataTableColumns';
import CompaniesDataTable from '@/pages/Company/CompaniesDataTable/CompaniesDataTable.vue';

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



const companiesDisplayData = computed<CompanyDisplay[]>(() => {
  return props.companies.data.map((company) => ({
    uuid: company.uuid,
    name: company.name,
    logo: company.logo?.name ?? null,
    address: company.address,
    email: company.email,
  }))
})

console.log(companiesDisplayData.value);

</script>

<template>

  <Head title="Companies" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <CompaniesDataTable :data="companiesDisplayData" :columns="columns" />
  </AppLayout>
</template>
