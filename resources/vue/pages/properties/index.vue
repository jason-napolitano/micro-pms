<template>
    <dashboard-layout title="Viewing All Properties">
        <template #headingRight v-if="can('create_property')">
            <create-property />
        </template>
        <properties-table :properties="props.properties" />
    </dashboard-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import CreateProperty from '@/components/forms/properties/create.vue'
import PropertiesTable from '@/components/tables/properties.vue'
import { PaginatedProperties } from '@/types'

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// props
const props = defineProps<{
    properties: PaginatedProperties
}>()
</script>
