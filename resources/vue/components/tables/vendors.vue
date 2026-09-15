<template>
    <div class="flex flex-col gap-4">
        <el-table :data="props.vendors['data']">
            <el-table-column label="Basic Information">
                <el-table-column label="Name">
                    <template #default="scope">
                        <page-link href="vendors.show" :data="scope.row" :text="scope.row['name']" />
                    </template>
                </el-table-column>
            </el-table-column>
            <el-table-column label="Chronology">
                <el-table-column label="Created" prop="created_at" />
                <el-table-column label="Updated" prop="updated_at" />
            </el-table-column>
            <el-table-column v-if="can('delete_vendor')">
                <el-table-column width="65">
                    <template #default="scope">
                        <el-button type="danger" :icon="Trash2" class="w-full" @click="deleteVendor(scope.row)" />
                    </template>
                </el-table-column>
            </el-table-column>
        </el-table>

        <div class="flex justify-center">
            <pagination :links="props.vendors['links']" />
        </div>
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import Pagination from '@/components/tables/pagination.vue'
import PageLink from '@/components/links/page-link.vue'
import { PaginatedVendors, Vendor } from '@/types'
import { router } from '@inertiajs/vue3'
import { Trash2 } from 'lucide-vue-next'

// --------------------------------------------------------
// component props
const props = defineProps<{
    vendors: PaginatedVendors
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// delete action
const deleteVendor = (vendor: Vendor) => {
    ElMessageBox.confirm("Are you sure you'd like to proceed?").then(() => {
        router.delete(route('vendors.destroy', vendor), {
            onSuccess: () => {
                ElNotification.success({
                    message: 'Vendor deleted successfully',
                    position: 'bottom-right',
                })
            },
        })
    })
}
</script>
