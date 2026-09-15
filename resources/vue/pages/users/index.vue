<template>
    <dashboard-layout title="Viewing All Users">
        <template #headingRight v-if="can('create_user')">
            <create-user :roles="props.roles" />
        </template>
        <users-table :users="props.users" />
    </dashboard-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import CreateUser from '@/components/forms/users/create.vue'
import UsersTable from '@/components/tables/users.vue'
import { PaginatedUsers, Role } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    users: PaginatedUsers
    roles: Role[]
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()
</script>
