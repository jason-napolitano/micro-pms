<template>
    <div class="flex flex-col gap-4">
        <el-table :data="props.properties['data']" border>
            <el-table-column label="Information">
                <el-table-column label="Property Name">
                    <template #default="scope">
                        <page-link href="properties.show" :text="scope.row['name']" :data="scope.row" />
                    </template>
                </el-table-column>
                <el-table-column label="Units">
                    <template #default="scope">
                        {{ scope.row['units'].length }}
                    </template>
                </el-table-column>
            </el-table-column>

            <el-table-column label="Chronology">
                <el-table-column label="Created">
                    <template #default="scope">
                        {{ scope.row['created_at'] }}
                    </template>
                </el-table-column>
                <el-table-column label="Updated">
                    <template #default="scope">
                        {{ scope.row['updated_at'] }}
                    </template>
                </el-table-column>
            </el-table-column>
            <el-table-column v-if="can('delete_property')">
                <el-table-column width="65">
                    <template #default="scope">
                        <el-button type="danger" :icon="Trash2" class="w-full" @click="deleteProperty(scope.row)" />
                    </template>
                </el-table-column>
            </el-table-column>
        </el-table>

        <div class="flex justify-center">
            <pagination :links="props.properties['links']" />
        </div>
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import Pagination from '@/components/tables/pagination.vue'
import PageLink from '@/components/links/page-link.vue'
import { PaginatedProperties, Property } from '@/types'
import { router } from '@inertiajs/vue3'
import { Trash2 } from 'lucide-vue-next'

// --------------------------------------------------------
// component props
const props = defineProps<{
    properties: PaginatedProperties
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// delete action
const deleteProperty = (property: Property) => {
    ElMessageBox.confirm("Are you sure you'd like to proceed?").then(() => {
        router.delete(route('properties.destroy', property), {
            onSuccess: () => {
                ElNotification.success({
                    message: 'Property deleted successfully',
                    position: 'bottom-right',
                })
            },
        })
    })
}
</script>
