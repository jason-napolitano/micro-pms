import { SharedData, User } from '@/types'

export function useUpdateProfile() {
    // --------------------------------------------------------
    // page data
    const { auth } = usePage<SharedData>().props

    // --------------------------------------------------------
    // form submission
    const updateProfile = (form: any, user: User) => {
        form.patch(route('users.update', user), {
            onSuccess: () => {
                ElNotification.success({
                    message: 'Profile updated successfully',
                    position: 'bottom-right',
                    showClose: false,
                })
                form.reset()
            },
        })
    }

    return { updateProfile }
}
