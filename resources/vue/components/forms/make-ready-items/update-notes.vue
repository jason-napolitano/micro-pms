<template>
    <small @click="toggleDialog" class="flex cursor-pointer items-center justify-start underline">
        <span> {{ truncate(props.item.notes ?? 'No Notes Available', 25) }}</span>
    </small>

    <el-dialog v-model="dialogOpen" width="600" :title="`${props.item.type['name']} Notes`">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col items-center justify-center gap-2" v-if="can('update_make_ready_item_notes')">
                <div class="flex gap-1">
                    <small class="template-badge" @click="form.notes = 'Partial Paint'">Partial Paint</small>
                    <small class="template-badge" @click="form.notes = 'Full Paint'">Full Paint</small>
                    <small class="template-badge" @click="form.notes = 'Standard Cleaning'">Standard Cleaning</small>
                    <small class="template-badge" @click="form.notes = 'Heavy Cleaning'">Heavy Cleaning</small>
                    <small class="template-badge" @click="form.notes = 'Carpet Shampoo'">Carpet Shampoo</small>
                    <small class="template-badge" @click="form.notes = 'Carpet Replacement'">Carpet Replacement</small>
                </div>
            </div>
            <el-form @submit.prevent="submitForm" :disabled="!can('update_make_ready_item_notes')">
                <el-form-item>
                    <el-input v-model="form.notes" type="textarea" resize="none" :rows="8" />
                </el-form-item>

                <el-form-item v-if="can('update_make_ready_item_notes')">
                    <el-button class="w-full" size="default" native-type="submit"> Update {{ props.item.type['name'] }} Notes </el-button>
                </el-form-item>
            </el-form>
        </div>
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { MakeReadyItem } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    item: MakeReadyItem
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// composables
const { truncate } = useString()

// --------------------------------------------------------
// dialog window
const dialogOpen = ref(false)

const toggleDialog = () => {
    dialogOpen.value = !dialogOpen.value
}

// --------------------------------------------------------
// form data
const form = useForm({
    notes: props.item.notes ?? null,
})

// --------------------------------------------------------
// form actions
const submitForm = () => {
    form.patch(route('make-ready.item.update-notes', props.item), {
        onSuccess: () => {
            ElNotification.success({
                message: 'Notes Updated Successfully',
                position: 'bottom-right',
            })
            toggleDialog()
        },
    })
}
</script>

<style scoped>
@reference "tailwindcss";

.template-badge {
    @apply cursor-pointer border border-zinc-200 bg-zinc-100 px-1 py-0.5 dark:border-zinc-600 dark:bg-zinc-700;
}
</style>
