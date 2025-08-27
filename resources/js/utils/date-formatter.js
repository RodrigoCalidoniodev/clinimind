export function getSystemLocale() {
    const browserLang = navigator.language || navigator.userLanguage;
    if(browserLang.startsWith('es')) return 'es-ES';
    if(browserLang.startsWith('en')) return 'en-US';
    return 'es-ES';
}

export function formatDate(dateString) {
    const locale = getSystemLocale();

    const [year, month, day] = dateString.split('-');
    const date = new Date(year, month - 1, day);

    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }

    const formatted = date.toLocaleDateString(locale, options);
    return formatted.charAt(0).toUpperCase() + formatted.slice(1);
}

export function formatTime(timeString) {
    const locale = getSystemLocale();
    const [hours, minutes] = timeString.split(':');
    const date = new Date();
    date.setHours(parseInt(hours), parseInt(minutes), 0);

    return date.toLocaleTimeString(locale, { hour: '2-digit', minute: '2-digit', hour12: true });
}