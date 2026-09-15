<template>
    <div class="flex flex-col gap-4">
        <el-table :data="props.users['data']">
            <el-table-column label="Basic Information">
                <el-table-column label="Name">
                    <template #default="scope">
                        <page-link href="users.show" :data="scope.row" :text="scope.row['name']" />
                    </template>
                </el-table-column>
                <el-table-column label="Email">
                    <template #default="scope">
                        <email-link :text="scope.row['email']" :email="scope.row['email']" />
                    </template>
                </el-table-column>

                <el-table-column label="Role">
                    <template #default="scope">
                        <span v-text="roleName(scope.row)" />
                    </template>
                </el-table-column>
            </el-table-column>
            <el-table-column label="Chronology">
                <el-table-column label="Created" prop="created_at" />
                <el-table-column label="Updated" prop="updated_at" />
            </el-table-column>
            <el-table-column v-if="can('delete_user')">
                <el-table-column width="65">
                    <template #default="scope">
                        <el-button type="danger" :icon="Trash2" class="w-full" @click="deleteUser(scope.row)" />
                    </template>
                </el-table-column>
            </el-table-column>
        </el-table>

        <div class="flex justify-center">
            <pagination :links="props.users['links']" />
        </div>
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import Pagination from '@/components/tables/pagination.vue'
import EmailLink from '@/components/links/email-link.vue'
import PageLink from '@/components/links/page-link.vue'
import { PaginatedUsers, User } from '@/types'
import { router } from '@inertiajs/vue3'
import { Trash2 } from 'lucide-vue-next'

// --------------------------------------------------------
// component props
const props = defineProps<{
    users: PaginatedUsers
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// string manipulation
const { toTitleCase, replace } = useString()

const roleName = (user: User) => computed(() => toTitleCase(replace(user.roles[0]['name'], '_', ' ')))

// --------------------------------------------------------
// delete action
const deleteUser = (user: User) => {
    ElMessageBox.confirm("Are you sure you'd like to proceed?").then(() => {
        router.delete(route('users.destroy', user), {
            onSuccess: () => {
                ElNotification.success({
                    message: 'User deleted successfully',
                    position: 'bottom-right',
                })
            },
        })
    })
}
</script>
