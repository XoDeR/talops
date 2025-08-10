<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Employee, EmployeeDisplay, PaginatedResponse, type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { computed } from 'vue';
import { columns } from './EmployeesDataTable/EmployeesDataTableColumns';
import EmployeesDataTable from './EmployeesDataTable/EmployeesDataTable.vue';
import Button from '@/components/ui/button/Button.vue';

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

const employeesDisplayData = computed<EmployeeDisplay[]>(() => {
  return props.employees.data.map((employee) => ({
    uuid: employee.uuid,
    name: employee.first_name + ' ' + employee.last_name,
    company: employee.company?.name ?? null,
    email: employee.email,
    phone: employee.phone,
  }))
})

const createNew = () => {
  router.visit(`/employees/create`, {
    method: 'get',
  })
}
</script>

<template>

  <Head title="Employees" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex items-center justify-start p-2">
      <Button variant="secondary" @click="createNew">
        Create a new employee
      </Button>
    </div>
    <EmployeesDataTable :data="employeesDisplayData" :columns="columns" :meta="props.employees.meta"
      :links="props.employees.links" />
  </AppLayout>
</template>
