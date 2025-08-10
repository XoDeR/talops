import { EmployeeDisplay } from '@/types';
import type { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import EmployeesActions from './EmployeesActions.vue';

export const columns: ColumnDef<EmployeeDisplay>[] = [
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-left' }, 'Name'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, row.getValue('name'));
        },
    },
    {
        accessorKey: 'company',
        header: () => h('div', { class: 'text-left' }, 'Company'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, row.getValue('company'));
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
        accessorKey: 'phone',
        header: () => h('div', { class: 'text-left' }, 'Phone'),
        cell: ({ row }) => {
            return h('div', { class: 'text-left font-medium' }, row.getValue('phone'));
        },
    },
    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            const employeeDisplay = row.original;

            return h(
                'div',
                { class: 'relative' },
                h(EmployeesActions, {
                    employeeDisplay,
                }),
            );
        },
    },
];
