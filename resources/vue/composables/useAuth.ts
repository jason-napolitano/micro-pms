import { usePage, router } from '@inertiajs/vue3'
import { ElMessageBox } from 'element-plus'
import { SharedData } from '@/types'

export function useAuth() {
    // ---------------------------------------------
    // page data
    const page = usePage<SharedData>()

    // ---------------------------------------------
    // auth object
    const { auth } = page.props

    /** --------------------------------------------
     * Can a user perform a certain action (or actions)?
     *
     * @param permissions {string|string[]}
     *
     * @returns {boolean}
     */
    function can(permissions: string[] | string): boolean {
        // if the permissions prop passed by inertia is not
        // an empty array
        if (auth.permissions.length) {
            // generate an empty data array
            const data: string[] = []

            // add permission names to that array
            auth.permissions.forEach((prop: { name: string }) => {
                data.push(prop.name.toLowerCase())
            })

            // if `permissions` is a string
            if (typeof permissions === 'string') {
                // run this check
                return data.includes(permissions) || data.includes('*')
            }
            // otherwise, run this check
            return permissions.every((permission: string) => data.includes(permission)) || data.includes('*')
        }
        // if the permissions prop passed by inertia is not set
        // default to false
        return false
    }

    function logout(): void {
        ElMessageBox.confirm('This action will terminate your current session. Continue?', 'Warning', {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning',
        }).then(() => {
            router.post(route('logout'))
        })
    }

    return { can, logout }
}
