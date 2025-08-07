<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3'
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue'
import axios from 'axios';
import { onUnmounted } from 'vue'

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Companies',
    href: '/companies',
  },
];

const form = useForm({
  name: '',
  address: '',
  email: '',
  website: '',
  logo_uuid: null,
})

const submit = () => {
  form.post(route('companies.store'), {
    onSuccess: () => form.reset(),
  })
}

const uploading = ref(false)

const previewUrl = ref<string | null>(null)

async function handleLogoUpload(event: Event) {
  const target = event.target as HTMLInputElement
  const file = target.files?.[0]
  if (!file) return

  if (previewUrl.value) {
    URL.revokeObjectURL(previewUrl.value)
  }
  previewUrl.value = URL.createObjectURL(file)

  const data = new FormData()
  data.append('image', file)
  data.append('original_name', file.name)

  uploading.value = true

  try {
    const response = await axios.post('/logos', data)
    form.logo_uuid = response.data.uuid
  } catch (error) {
    console.error('Upload failed:', error)
  } finally {
    uploading.value = false
  }
}

onUnmounted(() => {
  if (previewUrl.value) {
    URL.revokeObjectURL(previewUrl.value)
  }
})
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">

    <Head title="Create Company" />
    <div class="w-full lg:w-1/2 px-4 lg:mx-auto">
      <h1 class="font-bold text-2xl my-6">Create Company</h1>
      <form @submit.prevent="submit" class="w-full">
        <div class="grid gap-6">
          <div class="grid gap-2">
            <Label for="name">Name:</Label>
            <Input id="name" type="text" name="name" autocomplete="text" v-model="form.name"
              class="mt-1 block w-full" />
            <InputError :message="form.errors.name" class="mt-2" />
          </div>

          <div class="grid gap-2">
            <Label for="logo">Logo:</Label>
            <input id="logo" type="file" name="logo" accept="image/png, image/jpeg, image/jpg" class="mt-1 block w-full"
              @change="handleLogoUpload" />
            <div v-if="previewUrl">
              <img :src="previewUrl" alt="Preview" class="h-20 w-20" />
            </div>
            <LoaderCircle v-if="uploading" class="h-4 w-4 animate-spin" />
          </div>

          <div class="grid gap-2">
            <Label for="address">Address:</Label>
            <Input id="address" type="text" name="address" autocomplete="text" v-model="form.address"
              class="mt-1 block w-full" />
            <InputError :message="form.errors.address" class="mt-2" />
          </div>

          <div class="grid gap-2">
            <Label for="email">Email:</Label>
            <Input id="email" type="email" name="email" autocomplete="email" v-model="form.email"
              class="mt-1 block w-full" />
            <InputError :message="form.errors.email" class="mt-2" />
          </div>

          <div class="grid gap-2">
            <Label for="website">Website:</Label>
            <Input id="website" type="text" name="website" autocomplete="text" v-model="form.website"
              class="mt-1 block w-full" />
            <InputError :message="form.errors.website" class="mt-2" />
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
