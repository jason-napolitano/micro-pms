<template>
    <div class="flex flex-col gap-4">
        <el-alert> Use the form below to manage your security details. </el-alert>
        <el-form @submit.prevent="updateProfile(form, props.user)" label-position="top">
            <el-form-item label="Password">
                <el-input name="password" type="password" v-model="form.password" />
                <div v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</div>
            </el-form-item>
            <el-form-item label="Confirm Password">
                <el-input name="password_confirmation" type="password" v-model="form.password_confirmation" />
                <div v-if="form.errors.password_confirmation" class="text-red-500">{{ form.errors.password_confirmation }}</div>
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
// form data
const { updateProfile } = useUpdateProfile()

// --------------------------------------------------------
// form data
const form = useForm({
    password: '',
    password_confirmation: '',
})
</script>
