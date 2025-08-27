import Swal from 'sweetalert2';
import { formatDate, formatTime } from '../utils/date-formatter';

export function initializeFlatpickr(elementId, livewireComponent) {
    flatpickr(`#${elementId}`, {
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1),
        disable: [
            function(date) {
                return date.getDay() === 0;
            }
        ],
        onChange: function(selectedDates, dateStr, instance) {
            livewireComponent.set('updateDate', dateStr);
        }
    });
}

export function showAppointmentConfirmation(servicio, fechaRaw, horaRaw, translations) {

    const fechaFormateada = formatDate(fechaRaw);
    const horaFormateada = formatTime(horaRaw);
    
    const isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

    return Swal.fire({
        title: translations.confirmTitle,
        html: `
            <div class="text-center">
                <p class="mb-3"><strong>${translations.service}:</strong> ${servicio}</p>
                <p class="mb-3"><strong>${translations.date}:</strong> ${fechaFormateada}</p>
                <p class="mb-3"><strong>${translations.hour}:</strong> ${horaFormateada}</p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: translations.confirm,
        cancelButtonText: translations.cancel,
        background: isDark ? '#172325' : '#fff',
        color: isDark ? '#fff' : '#000',
        customClass: {
            title: 'text-2xl text-lime-400',
            confirmButton: 'bg-lime-400 hover:bg-lime-600 text-[#172325] px-4 py-2 rounded mr-2',
            cancelButton: 'bg-gray-400 hover:bg-gray-600 text-white px-4 py-2 rounded ml-2'
        },
        buttonsStyling: false
    });
}

export function showAlert(type, title, message) {
    const isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

    return Swal.fire({
        title: title,
        text: message,
        icon: type,
        confirmButtonText: 'OK',
        background: isDark ? '#172325' : '#fff',
        color: isDark ? '#fff' : '#000',
        customClass: {
            title: 'text-2xl text-lime-400',
            confirmButton: 'bg-lime-400 hover:bg-lime-600 text-[#172325] px-4 py-2 rounded'
        },
        buttonsStyling: false
    });
}