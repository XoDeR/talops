<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import SelectCustom from '@/components/SelectCustom.vue';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { CompanySummary, Employee, MultipleItemInertiaResponse, SingleItemInertiaResponse, type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Employees',
    href: '/employees',
  },
];

interface EmployeeProps {
  employee: SingleItemInertiaResponse<Employee>
  allCompanies: MultipleItemInertiaResponse<CompanySummary>
}

const props = defineProps<EmployeeProps>()

const form = useForm({
  first_name: props.employee.data.first_name,
  last_name: props.employee.data.last_name,
  email: props.employee.data.email,
  phone: props.employee.data.phone,
  company_uuid: props.employee.data.company?.uuid || '',
})

const submit = () => {
  form.put(route('employees.update', { employee: props.employee.data.uuid }), {
    onSuccess: () => form.reset(),
  })
}
</script>

<template>

  <AppLayout :breadcrumbs="breadcrumbs">

    <Head title="Edit Employee" />
    <div class="w-full lg:w-1/2 px-4 lg:mx-auto">
      <h1 class="font-bold text-2xl my-6">Edit Employee</h1>
      <form @submit.prevent="submit" class="w-full">
        <div class="grid gap-6">
          <div class="grid gap-2">
            <Label for="first_name">First Name:</Label>
            <Input id="first_name" type="text" name="first_name" autocomplete="text" v-model="form.first_name"
              class="mt-1 block w-full" />
            <InputError :message="form.errors.first_name" class="mt-2" />
          </div>

          <div class="grid gap-2">
            <Label for="last_name">Last Name:</Label>
            <Input id="last_name" type="text" name="last_name" autocomplete="text" v-model="form.last_name"
              class="mt-1 block w-full" />
            <InputError :message="form.errors.last_name" class="mt-2" />
          </div>

          <div class="grid gap-2">
            <p class="text-sm font-semibold">Company:</p>
            <SelectCustom v-model="form.company_uuid"
              :options="props.allCompanies.data.map(({ uuid, name }) => ({ uuid, name }))" />
            <InputError :message="form.errors.company_uuid" class="mt-2" />
          </div>

          <div class="grid gap-2">
            <Label for="email">Email:</Label>
            <Input id="email" type="email" name="email" autocomplete="email" v-model="form.email"
              class="mt-1 block w-full" />
            <InputError :message="form.errors.email" class="mt-2" />
          </div>

          <div class="grid gap-2">
            <Label for="phone">Phone:</Label>
            <Input id="phone" type="text" name="phone" autocomplete="text" v-model="form.phone"
              class="mt-1 block w-full" />
            <InputError :message="form.errors.phone" class="mt-2" />
          </div>

          <Button type="submit" class="mt-4 w-full" :disabled="form.processing">
            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
            Save
          </Button>

        </div>
      </form>
    </div>
  </AppLayout>
</template>
