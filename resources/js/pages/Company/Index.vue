<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Company, CompanyDisplay, PaginatedResponse, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { columns } from './CompaniesDataTable/CompaniesDataTableColumns';
import CompaniesDataTable from './CompaniesDataTable/CompaniesDataTable.vue';
import Button from '@/components/ui/button/Button.vue';
import { router } from '@inertiajs/vue3'

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

const createNew = () => {
  console.log("view")
  router.visit(`/companies/create`, {
    method: 'get',
  })
}

</script>

<template>

  <Head title="Companies" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex items-center justify-start p-2">
      <Button variant="secondary" @click="createNew">
        Create a new company
      </Button>
    </div>
    <CompaniesDataTable :data="companiesDisplayData" :columns="columns" :meta="props.companies.meta"
      :links="props.companies.links" />
  </AppLayout>
</template>
