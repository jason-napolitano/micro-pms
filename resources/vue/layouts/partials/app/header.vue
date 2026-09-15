<template>
    <header class="mb-4 flex items-center justify-between border-b border-b-stone-200 py-4">
        <!-- 'web' route -->
        <nav class="flex items-center gap-2">
            <span v-text="env('NAME')" />
        </nav>

        <!-- 'guest' routes -->
        <Link :href="route('login')" v-if="!$page.props.auth.user">Authenticate </Link>

        <!-- 'verified' route -->
        <div class="flex items-center justify-end gap-2" v-else>
            <Link :href="route('properties.index')" v-if="can('view_dashboard')"> Dashboard </Link>
            <span class="cursor-pointer" @click="logout">Logout</span>
        </div>
    </header>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { Link } from '@inertiajs/vue3'

// --------------------------------------------------------
// app name
const { env } = useApp()

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// auth actions
const { logout } = useAuth()
</script>
