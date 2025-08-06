import { CompanyDisplay } from '@/types';
import type { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import CompaniesActions from './CompaniesActions.vue';

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
            // <img :src="`/storage/logos/${logoName}`" alt="Company Logo" class="w-12 h-12 rounded-full object-cover" />
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
    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            const companyDisplay = row.original;

            return h(
                'div',
                { class: 'relative' },
                h(CompaniesActions, {
                    companyDisplay,
                }),
            );
        },
    },
];
