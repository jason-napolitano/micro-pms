<template>
    <el-dropdown trigger="click" size="small" placement="bottom-end" :disabled="unit.make_ready.status === 'completed'">
        <el-icon class="el-icon--right cursor-pointer">
            <Settings v-if="unit.make_ready.status !== 'completed'" />
            <CircleCheck v-if="unit.make_ready.status === 'completed'" />
            <CircleX v-if="unit.make_ready.status === 'cancelled'" />
        </el-icon>
        <template #dropdown>
            <el-dropdown-menu>
                <el-dropdown-item
                    :disabled="!itemsComplete(props.unit.make_ready.items) || !can('update_make_ready_status')"
                    @click="toggleStatusDialog"
                    :icon="CircleCheck"
                >
                    Update Status
                </el-dropdown-item>
            </el-dropdown-menu>
        </template>
    </el-dropdown>

    <el-dialog v-model="statusDialogOpen" width="350">
        <update-status :makeReady="props.unit.make_ready" @formUpdated="toggleStatusDialog" class="mt-2" />
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { Calendar, CircleCheck, Settings, CircleX } from 'lucide-vue-next'
import UpdateStatus from '@/components/forms/make-ready/update-status.vue'
import { Unit, MakeReadyItem } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    unit: Unit
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// dialog windows
const scheduleDialogOpen = ref(false)
const statusDialogOpen = ref(false)

const toggleScheduleDialog = () => (scheduleDialogOpen.value = !scheduleDialogOpen.value)
const toggleStatusDialog = () => (statusDialogOpen.value = !statusDialogOpen.value)

// --------------------------------------------------------
// item status check
const itemsComplete = (items: MakeReadyItem[]) => items.every((item) => item['status'] === 'completed' || item['status'] === 'cancelled')

// --------------------------------------------------------
// dropdown check
const dropdownCheck = computed(() => {
    return props.unit.make_ready.status === 'completed' || props.unit.make_ready['deleted_at']
})
</script>

<style scoped>
/* --- */
</style>
