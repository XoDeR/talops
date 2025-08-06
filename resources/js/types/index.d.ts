import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

interface CompanyDisplay {
    uuid: string;
    name: string;
    logo: string | null;
    address?: string;
    email?: string;
}

export interface PagesMeta {
    current_page: number;
    from: number;
    last_page: number;
    links: { url: string | null; label: string; active: boolean }[];
    path: string;
    per_page: number;
    to: number;
    total: number;
    [key: string]: any; // optional
}
export interface PagesLinks {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
    [key: string]: any;
}

export interface PaginatedResponse<T> {
    data: T[];
    meta: {
        current_page: number;
        from: number;
        last_page: number;
        links: { url: string | null; label: string; active: boolean }[];
        path: string;
        per_page: number;
        to: number;
        total: number;
        [key: string]: any; // optional
    };
    links: {
        first: string;
        last: string;
        prev: string | null;
        next: string | null;
        [key: string]: any;
    };
}

// Meta is not used, just an example
type Meta = {
    current_page: number;
    from: number;
    last_page: number;
    links: { url: string | null; label: string; active: boolean }[];
    path: string;
    per_page: number;
    to: number;
    total: number;
};

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
    uuid: string;
    first_name: string;
    last_name: string;
    email?: string;
    phone?: string;
    company?: CompanySummary;
}

interface Company {
    uuid: string;
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
