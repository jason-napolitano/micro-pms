<template>
    <tbody>
        <tr v-for="unit in props.units" :key="unit['id']">
            <td class="flex h-full flex-col justify-between">
                <div class="flex items-center justify-between">
                    <div>{{ unitLabel(unit) }}</div>
                    <make-ready-dropdown :unit="unit" v-if="can('update_make_ready_status')" />
                </div>
                <div class="flex flex-col">
                    <span>Started: {{ unit.make_ready['started_at'] }}</span>
                    <span v-if="unit.make_ready['status'] !== 'completed'">Expected: {{ unit.make_ready['expected_at']  }}</span>
                    <span v-if="unit.make_ready['status'] === 'completed'">Completed: {{ unit.make_ready['completed_at']  }}</span>
                </div>
            </td>

            <td
                v-for="item in unit.make_ready.items"
                :class="{
                    'bg-green-100/75 dark:bg-emerald-400/5': item.status === 'completed',
                    'bg-yellow-100/50 dark:bg-yellow-400/5': item.status === 'on_hold',
                    'bg-blue-100/75 dark:bg-sky-400/5': item.status === 'scheduled',
                    'bg-red-100/50 dark:bg-red-400/5': item.status === 'cancelled',
                }"
            >
                <div class="flex h-28 flex-col justify-between">
                    <div class="flex justify-between">
                        <div class="flex flex-col">
                            <span>{{ toTitleCase(replace(item.status, '_', ' ')) }}</span>
                            <strong>{{ statusDate(item) }}</strong>
                            <span>{{ assignedTo(item) }}</span>
                        </div>
                        <make-ready-item-dropdown
                            v-if="can('update_make_ready')"
                            :technicians="props.technicians"
                            :vendors="props.vendors"
                            :item="item"
                        />
                    </div>
                    <div class="flex items-center justify-between">
                        <update-notes :item="item" />
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import MakeReadyItemDropdown from '@/components/dropdowns/make-ready-item.vue'
import UpdateNotes from '@/components/forms/make-ready-items/update-notes.vue'
import MakeReadyDropdown from '@/components/dropdowns/make-ready.vue'
import { MakeReadyItem, Unit, User, Vendor } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    technicians: User[]
    vendors: Vendor[]
    units: Unit[]
}>()

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// actions
const unitLabel = (unit: Unit) =>
    computed(() => {
        return `${unit['unit_number']} - ${unit.floor_plan['label']} (${unit.floor_plan['bedrooms']}x${unit.floor_plan['bathrooms']})`
    })

// --------------------------------------------------------
// item status
const { replace, toTitleCase } = useString()

const statusDate = (item: MakeReadyItem) =>
    computed(() => {
        if (item.status === 'cancelled') return item['cancelled_at']
        else if (item.status === 'completed') return item['completed_at']
        else if (item.status === 'scheduled') return item['scheduled_start_at']
        else if (item.status === 'on_hold') return item['on_hold_at']
        else if (item.status === 'pending') return item['created_at']
        else return item['created_at']
    })

const assignedTo = (item: MakeReadyItem) => {
    let assignee = null
    if (item['assigned_to']) {
        assignee = item['assignee']
    }

    if (item['vendor_id']) {
        assignee = item['vendor']
    }

    return assignee ? assignee['name'] : 'Unassigned'
}
</script>

<style scoped>
@reference "tailwindcss";

td {
    @apply h-32 flex-1 border border-zinc-200 p-2 align-top first:border-t-0 first:border-r-0 first:border-l first:bg-zinc-50 dark:border-zinc-700 first:dark:bg-zinc-900;
}
</style>
