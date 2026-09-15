<template>
    <div class="flex flex-col gap-4">
        <el-alert> Use the form below to manage your profile details. </el-alert>
        <el-form @submit.prevent="updateProfile(form, props.user)" label-position="top">
            <el-form-item label="Username" :error="form.errors.username">
                <el-input name="username" :placeholder="props.user['username']" v-model="form.username" />
            </el-form-item>
            <el-form-item label="Full Name" :error="form.errors.name">
                <el-input name="name" :placeholder="props.user['name']" v-model="form.name" />
            </el-form-item>
            <el-form-item label="Email Address" :error="form.errors.email">
                <el-input name="email" type="email" :placeholder="props.user['email']" v-model="form.email" />
            </el-form-item>
            <el-form-item>
                <el-button size="default" native-type="submit" class="w-full"> Submit Changes </el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { User } from '@/types'

// --------------------------------------------------------
// props
const props = defineProps<{
    user: User
}>()

// --------------------------------------------------------
// form submission
const { updateProfile } = useUpdateProfile()

// --------------------------------------------------------
// form data
const form = useForm({
    username: '',
    name: '',
    email: '',
})
</script>
