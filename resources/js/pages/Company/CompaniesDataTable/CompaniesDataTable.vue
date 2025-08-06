<script setup lang="ts" generic="TData, TValue">
import { router } from "@inertiajs/vue3";
import type { ColumnDef } from '@tanstack/vue-table'
import {
  FlexRender,
  getCoreRowModel,
  useVueTable,
} from '@tanstack/vue-table'

import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { PagesLinks, PagesMeta } from '@/types';
import { ChevronLeftIcon, ChevronRightIcon, ChevronsLeftIcon, ChevronsRightIcon } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'


const props = defineProps<{
  columns: ColumnDef<TData, TValue>[]
  data: TData[]
  meta: PagesMeta
  links: PagesLinks
}>()

const table = useVueTable({
  get data() { return props.data },
  get columns() { return props.columns },
  getCoreRowModel: getCoreRowModel(),
})

const updatePage = (url: string | null) => {
  router.get(
    url || "",
    {},
    { preserveState: true }
  )
}
</script>

<template>
  <div class="border rounded-md">
    <Table>
      <TableHeader class="border-b-2 border-t-2 border-black">
        <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
          <TableHead v-for="header in headerGroup.headers" :key="header.id">
            <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
              :props="header.getContext()" />
          </TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <template v-if="table.getRowModel().rows?.length">
          <TableRow v-for="row in table.getRowModel().rows" :key="row.id"
            :data-state="row.getIsSelected() ? 'selected' : undefined">
            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
              <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
            </TableCell>
          </TableRow>
        </template>
        <template v-else>
          <TableRow>
            <TableCell :colspan="columns.length" class="h-24 text-center">
              No results.
            </TableCell>
          </TableRow>
        </template>
      </TableBody>
    </Table>
  </div>
  <div class="flex items-center justify-between py-4 space-x-2">
    <div class="flex items-center space-x-6 lg:space-x-8">
      <div class="flex w-[100px] items-center justify-center text-sm font-medium">
        Page {{ meta.current_page }} of
        {{ meta.last_page }}
      </div>
      <div class="flex items-center space-x-2">
        <Button variant="outline" class="hidden h-8 w-8 p-0 lg:flex" :disabled="!links.first"
          @click="updatePage(links.first)">
          <span class="sr-only">Go to first page</span>
          <ChevronsLeftIcon class="h-4 w-4" />
        </Button>
        <Button variant="outline" class="h-8 w-8 p-0" :disabled="!links.prev" @click="updatePage(links.prev)">
          <span class="sr-only">Go to previous page</span>
          <ChevronLeftIcon class="h-4 w-4" />
        </Button>
        <Button variant="outline" class="h-8 w-8 p-0" :disabled="!links.next" @click="updatePage(links.next)">
          <span class="sr-only">Go to next page</span>
          <ChevronRightIcon class="h-4 w-4" />
        </Button>
        <Button variant="outline" class="hidden h-8 w-8 p-0 lg:flex" :disabled="!links.last"
          @click="updatePage(links.last)">
          <span class="sr-only">Go to last page</span>
          <ChevronsRightIcon class="h-4 w-4" />
        </Button>
      </div>
    </div>
  </div>
</template>