<template>
    <header class="flex h-16 items-center justify-end gap-2 border-b border-stone-200 px-4 dark:border-stone-700 dark:text-slate-50 group">
        <Link :href="route('users.show')" class="hover:bg-primary flex items-center gap-1 group-hover:underline">
            <span> {{ $page.props.auth.user.email }}</span>
            <ChevronRight class="h-4" />
        </Link>
    </header>
</template>

<script setup>
import { ChevronRight } from 'lucide-vue-next'
</script>
