<template>
    <div class="flex flex-col gap-4">
        <el-table :data="props.units['data']" border>
            <el-table-column label="Information">
                <el-table-column label="Unit Number" prop="unit_number" />
            </el-table-column>

            <el-table-column label="Layout">
                <el-table-column label="Floor Plan">
                    <template #default="scope">
                        {{ scope.row.floor_plan['label'] }}
                    </template>
                </el-table-column>
                <el-table-column label="Size">
                    <template #default="scope">
                        <square-feet :value="scope.row.floor_plan['square_feet']" />
                    </template>
                </el-table-column>
                <el-table-column label="Bedrooms">
                    <template #default="scope">
                        {{ scope.row.floor_plan['bedrooms'] }}
                    </template>
                </el-table-column>
                <el-table-column label="Bathrooms">
                    <template #default="scope">
                        {{ scope.row.floor_plan['bathrooms'] }}
                    </template>
                </el-table-column>
            </el-table-column>

            <el-table-column label="Chronology">
                <el-table-column label="Created" prop="created_at" />
                <el-table-column label="Updated" prop="updated_at" />
            </el-table-column>
            <el-table-column>
                <el-table-column width="65">
                    <template #default="scope">
                        <el-button type="danger" :icon="Trash2" class="w-full" @click="deleteUnit(scope.row)" />
                    </template>
                </el-table-column>
            </el-table-column>
        </el-table>

        <div class="flex justify-center">
            <pagination :links="props.units['links']" />
        </div>
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import SquareFeet from '@/components/badges/square-feet.vue'
import Pagination from '@/components/tables/pagination.vue'
import { PaginatedUnits, Unit } from '@/types'
import { Trash2 } from 'lucide-vue-next'
import { router } from '@inertiajs/vue3'

// --------------------------------------------------------
// component props
const props = defineProps<{
    units: PaginatedUnits
}>()

// --------------------------------------------------------
// delete action
const deleteUnit = (unit: Unit) => {
    ElMessageBox.confirm("Are you sure you'd like to proceed?").then(() => {
        router.post(
            route('units.destroy', unit),
            {},
            {
                onSuccess: () => {
                    ElNotification.success({
                        message: 'Unit Deleted Successfully',
                        position: 'bottom-right',
                    })
                },
            },
        )
    })
}
</script>

<style scoped>
/* --- */
</style>
