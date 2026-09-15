export function useChannel(echo: Ref) {
    const listen = <T = any>(channelName: string, event: string, callback: (data: T) => void) => {
        if (!echo.value) return

        echo.value.channel(channelName).listen(`.${event}`, (e: T) => {
            callback(e)
        })
    }

    const leave = (channelName: string) => {
        echo.value?.leave(channelName)
    }

    return {
        listen,
        leave,
    }
}
