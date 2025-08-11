<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { CompanySummary, MultipleItemInertiaResponse, type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3'
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { LoaderCircle, UploadCloudIcon } from 'lucide-vue-next';
import SelectCustom from '@/components/SelectCustom.vue';


const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Employees',
    href: '/employees',
  },
];

interface EmployeeProps {
  allCompanies: MultipleItemInertiaResponse<CompanySummary>
}

const props = defineProps<EmployeeProps>();

console.log(props.allCompanies.data);

const form = useForm({
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  company_uuid: '',
})

const submit = () => {
  form.post(route('employees.store'), {
    onSuccess: () => form.reset(),
  })
}
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">

    <Head title="Create Employee" />
    <div class="w-full lg:w-1/2 px-4 lg:mx-auto">
      <h1 class="font-bold text-2xl my-6">Create Employee</h1>
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
            Create
          </Button>

        </div>
      </form>
    </div>
  </AppLayout>
</template>
