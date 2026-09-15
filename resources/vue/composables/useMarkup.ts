import { useRoute } from './useRoute'
import DOMPurify from 'dompurify'

export function useMarkup() {
    // ---------------------------------------------
    // current route
    const { current } = useRoute()

    /** --------------------------------------------
     * Returns a class name if the route passed through
     * matches th current route
     *
     * @param route       {string}
     * @param activeClass {string}
     *
     * @returns {string}
     */
    const activeClass = (route: string, activeClass: string = 'is-active'): string => (current(route) ? activeClass : '')

    /**
     * Sanitize a markup string
     *
     * @param string
     */
    const sanitize = (string: string): string => DOMPurify.sanitize(string)

    return { activeClass, sanitize }
}
