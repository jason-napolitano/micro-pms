<template>
    <header class="flex h-16 items-center justify-end gap-2 border-b border-stone-200 px-4 dark:border-stone-700 dark:text-slate-50">
        <Link :href="route('users.show')" class="hover:bg-primary flex items-center gap-1">
            <!-- CircleUserRoundIcon class="mb-0.5 h-4" / -->
            <span> {{ $page.props.auth.user.email }}</span>
        </Link>
    </header>
</template>

<script setup>
import { CircleUserRoundIcon } from 'lucide-vue-next'
</script>
