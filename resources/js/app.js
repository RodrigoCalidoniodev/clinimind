import './bootstrap';
import flatpickr from "flatpickr";

import { initializeFlatpickr, showAppointmentConfirmation, showAlert } from './components/appointment-modal';

window.initializeAppointmentFlatpickr = initializeFlatpickr;
window.showAppointmentConfirmation = showAppointmentConfirmation;
window.showAlert = showAlert;