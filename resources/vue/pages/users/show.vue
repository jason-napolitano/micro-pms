<template>
    <dashboard-layout :title="props.user['name']">
        <template #headingRight v-if="props.user['id'] === $page.props.auth.user['id']">
            <el-button :icon="Lock" @click="logout()">Terminate Session</el-button>
        </template>
        <div class="flex gap-4">
            <aside class="w-1/4 md:w-1/5">
                <user-image :src="props.user['avatar']" :canUpload="can('update_profile_image')" />
            </aside>

            <div class="flex w-3/4 flex-col space-y-4 md:w-4/5">
                <el-tabs tab-position="top" type="border-card">
                    <el-tab-pane label="View Profile">
                        <div class="flex flex-col space-y-2">
                            <div>
                                <div class="font-bold">Username</div>
                                <div class="text-sm">{{ props.user['username'] }}</div>
                            </div>
                            <div>
                                <div class="font-bold">Full Name</div>
                                <div class="text-sm">{{ props.user['name'] }}</div>
                            </div>
                            <div>
                                <div class="font-bold">Email Address</div>
                                <div class="text-sm">{{ props.user['email'] }}</div>
                            </div>
                            <div>
                                <div class="font-bold">Member Since</div>
                                <div class="text-sm">{{ props.user['created_at'] }}</div>
                            </div>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="Edit Profile">
                        <edit-form :user="props.user" />
                    </el-tab-pane>
                    <el-tab-pane label="Security">
                        <password-form :user="props.user" />
                    </el-tab-pane>
                    <el-tab-pane label="Access Control" v-if="can('view_access_control')">
                        <div class="flex flex-col gap-4">
                            <el-divider> Property Access</el-divider>
                            <access-control-table :properties="props.properties" :user="props.user" />
                        </div>
                    </el-tab-pane>
                </el-tabs>
            </div>
        </div>
    </dashboard-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import AccessControlTable from '@/components/tables/users/access-control.vue'
import PasswordForm from '@/components/forms/users/password.vue'
import UserImage from '@/components/media/users/image.vue'
import EditForm from '@/components/forms/users/edit.vue'
import type { Property, User } from '@/types'
import { Lock } from 'lucide-vue-next'

// --------------------------------------------------------
// component props
const props = defineProps<{
    properties: Property[]
    user: User
}>()
// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// composables
const { logout } = useAuth()
</script>
