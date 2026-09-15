export function useDarkMode() {
    // is dark mode activated?
    const isDark = useDark()

    // toggleVisibility dark mode
    const toggleDarkMode = useToggle(isDark)

    return { isDark, toggleDarkMode }
}
