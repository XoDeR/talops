import { CompanyDisplay } from '@/types';
import type { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';

export const columns: ColumnDef<CompanyDisplay>[] = [
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-right' }, 'Name'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, row.getValue('name'));
        },
    },
];
