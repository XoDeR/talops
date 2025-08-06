import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

interface Logo {
    name: string;
    original_name: string;
}

interface CompanySummary {
    name: string;
    address?: string;
    email?: string;
    phone?: string;
}

interface Employee {
    first_name: string;
    last_name: string;
    email?: string;
    phone?: string;
    company?: CompanySummary;
}

interface Company {
    name: string;
    address?: string;
    email?: string;
    phone?: string;
    logo?: Logo;
    employees?: Employee[];
}

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
