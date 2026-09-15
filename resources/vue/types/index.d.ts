import type { PageProps } from '@inertiajs/core'
import { str } from 'video.js'

export interface SharedData extends PageProps {
    auth: {
        permissions: Permission[] | []
        user: User | null
    }
}

export enum MakeReadyStatus {
    CANCELLED = 'cancelled',
    COMPLETED = 'completed',
    SCHEDULED = 'scheduled',
    PENDING = 'pending',
    ON_HOLD = 'on_hold',
}

export interface DatabaseRecord {
    id: string | number
    created_at: string
    updated_at: string
    deleted_at: string
    pivot: object
}

export interface PaginateData {
    links: PaginationLink[]
    data: DatabaseRecord[]
}

export interface Permission extends DatabaseRecord {
    name: string
}

export interface Role extends DatabaseRecord {
    permission: Permission
    name: string
}

export interface PaginationLink {
    url: string
    label: string
    active: boolean
}

export interface User extends DatabaseRecord {
    name: string
    email: string
    username: string
    avatar?: string
    website?: string
    email_verified_at: string | null
    properties: Property[]
    roles: Role
}

export interface PaginatedUsers extends PaginateData {
    data: User[]
}

export interface Media {
    id: number
    model_type: string
    model_id: string
    uuid: string
    collection_name: string
    name: string
    file_name: string
    mime_type: string | null
    disk: string
    conversions_disk: string | null
    size: number
    manipulations: Record<string, any>
    custom_properties: Record<string, any>
    generated_conversions: Record<string, boolean>
    responsive_images: Record<string, any>
    order_column: number | null
    created_at: string
    updated_at: string
    original_url?: string
    preview_url?: string
}

export interface Vendor extends DatabaseRecord {
    active: boolean | number
    contact_name: string
    phone: string
    email: string
    notes: string
    name: string
}

export interface PaginatedVendors extends PaginateData {
    data: Vendor[]
}

export interface Property extends DatabaseRecord {
    floor_plans: FloorPlan[]
    address: string
    image: string
    units: Unit[]
    users: User[]
    phone: string
    name: string
    code: string
}

export interface PaginatedProperties extends PaginateData {
    data: Property[]
}

export interface FloorPlan extends DatabaseRecord {
    square_feet: number
    bathrooms: number
    bedrooms: number
    label: string
}

export interface PaginatedFloorPlans extends PaginateData {
    data: FloorPlan[]
}

export interface Unit extends DatabaseRecord {
    make_ready: MakeReady
    floor_plan: FloorPlan
    unit_number: string
    property: Property
}

export interface PaginatedUnits extends PaginateData {
    data: Unit[]
}

export interface MakeReady extends DatabaseRecord {
    status: MakeReadyStatus
    items: MakeReadyItem[]
    completed_at: string
    expected_at: string
    started_at: string
    notes: string
    unit: Unit
}

export interface PaginatedMakeReadies extends PaginateData {
    data: MakeReady[]
}

export interface ItemType extends DatabaseRecord {
    description: string
    visible: boolean
    order: number
    name: string
}

export interface MakeReadyItem extends DatabaseRecord {
    scheduled_start_at: string
    scheduled_end_at: string
    status: MakeReadyStatus
    estimated_cost: string
    make_ready: MakeReady
    cancelled_at: string
    completed_at: string
    on_hold_at: string
    actual_cost: string
    started_at: string
    assignee: User
    vendor: Vendor
    type: ItemType
    due_at: string
    label: string
    notes: string
}
