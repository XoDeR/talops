<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuSeparator, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { router } from '@inertiajs/vue3'

defineProps<{
  employeeDisplay: {
    uuid: string
  }
}>()

function view(uuid: string) {
  router.visit(`/employees/${uuid}`, {
    method: 'get',
  })
}

function edit(uuid: string) {
  router.visit(`/employees/${uuid}/edit`, {
    method: 'get',
  })
}

function deleteItem(uuid: string) {
  if (confirm("Are you sure you want to delete this employee?")) {
    router.delete(`/employees/${uuid}`, {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        //console.log("Company deleted")
      },
    })
  } else {
    //console.log("Deletion cancelled")
  }
}
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="w-8 h-8 p-0">
        <span class="sr-only">Open menu</span>
        <MoreHorizontal class="w-4 h-4" />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuItem @click="view(employeeDisplay.uuid)">
        View
      </DropdownMenuItem>
      <DropdownMenuItem @click="edit(employeeDisplay.uuid)">
        Edit
      </DropdownMenuItem>
      <DropdownMenuSeparator />
      <DropdownMenuItem @click="deleteItem(employeeDisplay.uuid)">
        Delete
      </DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>