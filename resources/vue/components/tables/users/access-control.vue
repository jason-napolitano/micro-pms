<template>
    <el-table :data="props.properties">
        <el-table-column label="Name" prop="name" />
        <el-table-column label="Code" prop="code" />
        <el-table-column label="Address" prop="address" />
        <el-table-column width="125">
            <template #header>
                <div class="flex items-center justify-center">Has Access?</div>
            </template>
            <template #default="scope">
                <assign-property :property="scope.row" :user="props.user" />
            </template>
        </el-table-column>
    </el-table>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import AssignProperty from '@/components/forms/users/assign-property.vue'
import { Property, User } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    properties: Property[]
    user: User
}>()

</script>

<style scoped>
/* --- */
</style>
