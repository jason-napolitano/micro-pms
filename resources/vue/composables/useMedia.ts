export function useMedia() {
    function addPortToLocalhost(url: string, port) {
        try {
            const parsed = new URL(url)

            // Only modify localhost URLs
            if (parsed.hostname === 'localhost' || parsed.hostname === '127.0.0.1') {
                parsed.port = port
            }

            return parsed.toString()
        } catch (e) {
            console.error('Invalid URL:', url)
            return null
        }
    }

    const mediaURL = (media: any) => {
        return addPortToLocalhost(media.original_url, 8000)
    }

    return { mediaURL }
}
