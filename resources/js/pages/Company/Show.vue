<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Company, SingleItemInertiaResponse, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Card from '@/components/ui/card/Card.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import CardContent from '@/components/ui/card/CardContent.vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Companies',
    href: '/companies',
  },
];

interface CompanyProps {
  company: SingleItemInertiaResponse<Company>
}

const props = defineProps<CompanyProps>()
</script>

<template>

  <Head title="Company" />
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
              {{ company.data.name }}
            </p>
            <img :src="`/storage/logos/${company.data.logo?.name}`" alt="Company Logo"
              class="w-20 h-20 rounded-full object-cover mb-4" />
          </div>
          <p class="my-4 italic">{{ company.data.address }}</p>
          <p class="my-4 text-cyan-800">{{ company.data.email }}</p>
          <p class="my-4">{{ company.data.website }}</p>
        </CardContent>
      </Card>

      <!-- Employees Panel -->
      <Card class="w-full md:w-2/3 h-full">
        <CardHeader>
          <CardTitle>Employees</CardTitle>
        </CardHeader>
        <CardContent>
          <ul>
            <li v-for="employee in company.data.employees" class="flex gap-1 py-1">
              <span class="w-1/3">
                {{ employee.first_name + " " + employee.last_name }}
              </span>
              <span class="w-1/3">
                {{ employee.email }}
              </span>
              <span class="w-1/3">
                {{ employee.phone }}
              </span>
            </li>
          </ul>
        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>