<template>
    <el-dropdown trigger="click" size="small" placement="bottom-end" :disabled="dropdownCheck">
        <el-icon class="el-icon--right cursor-pointer">
            <Calendar v-if="!dropdownCheck" />
            <CircleCheck v-if="props.item.status === 'completed'" />
            <CircleX v-if="props.item.status === 'cancelled'" />
        </el-icon>
        <template #dropdown>
            <el-dropdown-menu>
                <el-dropdown-item :icon="Calendar" @click="toggleScheduleDialog" :disabled="!can('schedule_make_ready_item')">
                    Schedule Item
                </el-dropdown-item>
                <el-dropdown-item :icon="CircleCheck" @click="toggleStatusDialog" :disabled="!can('update_make_ready_item_status')">
                    Update Status
                </el-dropdown-item>
                <el-dropdown-item :icon="Users" @click="toggleAssigneeDialog" :disabled="!can('assign_make_ready_item')">
                    Assign Work
                </el-dropdown-item>
            </el-dropdown-menu>
        </template>
    </el-dropdown>

    <el-dialog v-model="assigneeDialogOpen" width="450">
        <update-assignee :technicians="props.technicians" :item="props.item" :vendors="props.vendors" @formUpdated="toggleAssigneeDialog" />
    </el-dialog>

    <el-dialog v-model="scheduleDialogOpen" width="352">
        <update-schedule :item="props.item" @formUpdated="toggleScheduleDialog" class="mt-2" />
    </el-dialog>

    <el-dialog v-model="statusDialogOpen" width="350">
        <update-status :item="props.item" @formUpdated="toggleStatusDialog" class="mt-2" />
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import UpdateSchedule from '@/components/forms/make-ready-items/update-schedule.vue'
import UpdateAssignee from '@/components/forms/make-ready-items/update-assignee.vue'
import UpdateStatus from '@/components/forms/make-ready-items/update-status.vue'
import { Calendar, CircleCheck, Users, CircleX } from 'lucide-vue-next'
import { MakeReadyItem, User, Vendor } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    technicians: User[]
    item: MakeReadyItem
    vendors: Vendor[]
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// dialog windows
const assigneeDialogOpen = ref(false)
const scheduleDialogOpen = ref(false)
const statusDialogOpen = ref(false)

const toggleAssigneeDialog = () => (assigneeDialogOpen.value = !assigneeDialogOpen.value)
const toggleScheduleDialog = () => (scheduleDialogOpen.value = !scheduleDialogOpen.value)
const toggleStatusDialog = () => (statusDialogOpen.value = !statusDialogOpen.value)

// --------------------------------------------------------
// dropdown check
const dropdownCheck = computed(() => {
    return props.item.status === 'completed' || props.item.status === 'cancelled'
})
</script>

<style scoped>
/* --- */
</style>
