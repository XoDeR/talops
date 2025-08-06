import { CompanyDisplay } from '@/types';
import type { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';

export const columns: ColumnDef<CompanyDisplay>[] = [
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left' }, 'Name'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, row.getValue('name'));
        },
    },
    {
        accessorKey: 'logo',
        header: () => h('div', { class: 'text-left' }, 'Logo'),
        cell: ({ row }) => {
            return h('img', {
                src: `/storage/logos/${row.getValue('logo')}`,
                alt: 'Company Logo',
                class: 'w-8 h-8 rounded-full object-cover',
            });
        },
    },
    {
        accessorKey: 'address',
        header: () => h('div', { class: 'text-left' }, 'Address'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, row.getValue('address'));
        },
    },
    {
        accessorKey: 'email',
        header: () => h('div', { class: 'text-left' }, 'Email'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, row.getValue('email'));
        },
    },
];
