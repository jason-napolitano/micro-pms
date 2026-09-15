<template>
    <dashboard-layout title="Viewing All Vendors">
        <template #headingRight v-if="can('create_vendor')">
            <create-vendor />
        </template>
        <vendors-table :vendors="props.vendors" />
    </dashboard-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import CreateVendor from '@/components/forms/vendors/create.vue'
import VendorsTable from '@/components/tables/vendors.vue'
import { PaginatedVendors } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    vendors: PaginatedVendors
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()
</script>
