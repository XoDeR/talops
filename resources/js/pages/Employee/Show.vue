<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Employee, SingleItemInertiaResponse, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Employees',
    href: '/employees',
  },
];

interface EmployeeProps {
  employee: SingleItemInertiaResponse<Employee>
}

const props = defineProps<EmployeeProps>()
</script>

<template>

  <Head title="Employee" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col md:flex-row gap-4 h-full">
      <!-- Info Panel -->
      <Card class="w-full md:w-1/3 h-full">
        <CardHeader>
          <CardTitle>Info</CardTitle>
        </CardHeader>
        <CardContent>
          <div class="flex flex-col gap-4">
            <p class="text-xl font-bold">
              {{ employee.data.first_name }} {{ employee.data.last_name }}
            </p>
            <p class="text-base">
              {{ employee.data.company?.name }}
            </p>
          </div>
          <p class="my-4 text-cyan-800">{{ employee.data.email }}</p>
          <p class="my-4">{{ employee.data.phone }}</p>
        </CardContent>
      </Card>

      <!-- Company Panel -->
      <Card class="w-full md:w-2/3 h-full">
        <CardHeader>
          <CardTitle>Company</CardTitle>
        </CardHeader>
        <CardContent>
          <p class="text-base">
            {{ employee.data.company?.name }}
          </p>
        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>
