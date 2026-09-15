<template>
    <el-table :data="props.floor_plans">
        <el-table-column label="Information">
            <el-table-column label="Label" prop="label" width="150" />
        </el-table-column>

        <el-table-column label="Layout">
            <el-table-column label="Bedrooms" prop="bedrooms" sortable />
            <el-table-column label="Bathrooms" prop="bathrooms" sortable />
            <el-table-column label="Size">
                <template #default="scope">
                    <square-feet :value="scope.row['square_feet']" />
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
                    <el-button type="danger" :icon="Trash2" class="w-full" @click="deleteFloorPlan(scope.row)" />
                </template>
            </el-table-column>
        </el-table-column>
    </el-table>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import SquareFeet from '@/components/badges/square-feet.vue'
import { FloorPlan, Unit } from '@/types'
import { router } from '@inertiajs/vue3'
import { Trash2 } from 'lucide-vue-next'

// --------------------------------------------------------
// component props
const props = defineProps<{
    floor_plans: FloorPlan[]
}>()

// --------------------------------------------------------
// delete action
const deleteFloorPlan = (unit: Unit) => {
    ElMessageBox.confirm("Are you sure you'd like to proceed?").then(() => {
        router.post(
            route('floor-plans.destroy', unit),
            {},
            {
                onSuccess: () => {
                    ElNotification.success({
                        message: 'Floorplan deleted successfully',
                        position: 'bottom-right',
                    })
                },
            },
        )
    })
}
</script>
