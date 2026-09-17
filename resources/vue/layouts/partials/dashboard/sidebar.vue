<template>
    <aside class="flex-col border-r border-stone-200 transition-all duration-200 sm:w-16 md:flex md:w-28 dark:border-stone-700">
        <Link
            :href="route('properties.index')"
            class="flex h-16 items-center justify-center border-b border-stone-200 bg-[#F5F7FA] text-2xl font-thin dark:border-stone-700 dark:bg-stone-600/85 dark:text-slate-50"
        >
            {{ initials }}
        </Link>

        <nav class="flex-1 space-y-1 px-2 pt-2">
            <nav-item href="properties.index" pages="properties.*" :icon="Building2" v-if="can('view_properties')" />
            <nav-item href="users.index" pages="users.*" :icon="Users" v-if="can('view_users')" />
            <nav-item href="vendors.index" pages="vendors.*" :icon="HeartHandshake" v-if="can('view_vendors')" />
        </nav>
    </aside>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { Building2, Users, HeartHandshake } from 'lucide-vue-next'
import NavItem from './sidebar/nav-item.vue'

// --------------------------------------------------------
// auth check
const { can } = useAuth()

//
const { getInitials } = useInitials()
const { env } = useApp()

const initials = computed(() => getInitials(env('NAME')))
</script>
