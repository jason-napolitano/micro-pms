<template>
    <small @click="toggleDialog" class="flex cursor-pointer items-center justify-start underline">
        <span> {{ truncate(props.item.notes ?? 'No Notes Available', 25) }}</span>
    </small>

    <el-dialog v-model="dialogOpen" width="700" :title="`${props.item.type['name']} Notes`" @closed="form.notes = ''">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col items-center justify-center gap-2" v-if="can('update_make_ready_item_notes')">
                <div class="flex gap-1">
                    <el-button-group>
                        <template-badge :form="form" text="Partial Paint" />
                        <template-badge :form="form" text="Full Paint" />
                        <template-badge :form="form" text="Standard Cleaning" />
                        <template-badge :form="form" text="Heavy Cleaning" />
                        <template-badge :form="form" text="Carpet Shampoo" />
                        <template-badge :form="form" text="Carpet Replacement" />
                    </el-button-group>
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
import TemplateBadge from '@/components/badges/make-ready-items/notes-template.vue'
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
