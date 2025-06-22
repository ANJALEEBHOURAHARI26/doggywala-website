@extends('front.layouts.app')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .calendar-popup {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            background: white;
            border: 2px solid #333;
            border-radius: 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            margin-top: 5px;
            width: fit-content;
            margin: 5px auto 0;
        }
        
        .date-input-container {
            position: relative;
        }
        
        .calendar-container {
            background: white;
            padding: 0;
            width: fit-content;
            margin: 0;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            color: #ff8c00;
            font-weight: bold;
            font-size: 14px;
            min-width: 245px;
        }
        
        .nav-btn {
            background: none;
            border: none;
            color: #ff8c00;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
        }
        
        .nav-btn:hover {
            color: #e67300;
        }
        
        .nav-btn:disabled {
            color: #ccc;
            cursor: not-allowed;
        }
        
        .calendar-table {
            border-collapse: collapse;
            width: -webkit-fill-available;
        }
        
        .day-header {
            text-align: center;
            font-weight: bold;
            color: #666;
            padding: 6px 8px;
            font-size: 12px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            width: 35px;
        }
        
        .day-cell {
            width: 35px;
            height: 35px;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid #ddd;
            background-color: white;
            position: relative;
            padding: 0;
        }
        
        .day-cell:hover {
            background-color: #f0f0f0;
        }
        
        .day-cell.available {
            background-color: #28a745;
            color: white;
        }
        
        .day-cell.available:hover {
            background-color: #218838;
        }
        
        .day-cell.selected {
            background-color: #ffc107;
            color: black;
            font-weight: bold;
        }
        
        .day-cell.unavailable {
            background-color: #dc3545;
            color: white;
            cursor: not-allowed;
        }
        
        .day-cell.other-month {
            color: #999;
            background-color: #f8f9fa;
        }
        
        .day-cell.not-applicable {
            background-color: #6c757d;
            color: white;
            cursor: not-allowed;
        }
        
        .legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 8px 10px;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
            font-size: 10px;
            gap: 5px;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            gap: 3px;
        }
        
        .legend-color {
            width: 10px;
            height: 10px;
        }
        
        .time-slots-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border: 2px solid #333;
            border-radius: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            z-index: 1001;
            width: 400px;
            max-width: 90vw;
        }
        
        .time-slots-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            font-size: 14px;
        }
        
        .time-slots-content {
            padding: 15px;
        }
        
        .time-slots-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .time-slot {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: center;
            cursor: pointer;
            background: white;
            transition: all 0.2s;
            font-size: 12px;
        }
        
        .time-slot:hover {
            background-color: #f8f9fa;
            border-color: #007bff;
        }
        
        .time-slot.selected {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        
        .booking-summary {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }
        
        .booking-summary div {
            text-align: center;
            font-size: 12px;
        }
        
        .booking-summary strong {
            display: block;
            margin-bottom: 5px;
        }
        
        .ok-btn {
            background-color: #d2691e;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }
        
        .ok-btn:hover {
            background-color: #b8621a;
        }
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }
    
/* Global Reset */
* {
  box-sizing: border-box;
}

.section-02 {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  min-height: 400px;
  padding: 60px 15px 40px;
  display: flex;
  align-items: center;
  position: relative;
}

h1.slide__text-heading {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.lead {
  font-size: 1.125rem;
  font-weight: 400;
  margin-bottom: 1rem;
}

.card:hover {
  transform: translateY(-5px);
  transition: all 0.3s ease-in-out;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

h2.display-5,
section h2 {
  font-size: 2.2rem;
  margin-bottom: 2rem;
}

p {
  font-size: 1rem;
  letter-spacing: 0.03em;
}

@media screen and (max-width: 768px) {
  h1.display-4 {
    font-size: 2rem;
  }
  h2.display-5,
  section h2 {
    font-size: 1.75rem;
  }
}

/* Position carousel controls outside the carousel container */
#servicesCarousel {
  position: relative;
  padding: 0 40px; /* add some padding to left and right for buttons */
}

#servicesCarousel .carousel-control-prev,
#servicesCarousel .carousel-control-next {
  width: 40px; /* smaller width for buttons */
  top: 50%;
  transform: translateY(-50%);
  opacity: 1;
}

#servicesCarousel .carousel-control-prev {
  left: 0;  /* move to extreme left outside cards */
}

#servicesCarousel .carousel-control-next {
  right: 0; /* move to extreme right outside cards */
}

/* Optional: make icons bigger or change color */
#servicesCarousel .carousel-control-prev-icon,
#servicesCarousel .carousel-control-next-icon {
  background-size: 50px 50px;
  filter: invert(20%) sepia(100%) saturate(500%) hue-rotate(150deg); /* example color tweak */
}
 .read-more-btn {
    color: #007bff; /* Bootstrap primary */
    font-weight: 500;
  }

  .read-more-btn:hover {
    text-decoration: underline;
    color: #0056b3;

  }

  /**/

input#appointment_date {
    background-color: white;
    width: 107%;
    margin-left: -24px;
}
input#appointment_time {
    background-color: white;
    width: 107%;
    margin-left: -24px;
}

label.appointmentDate {
    margin-left: -20px;
}
label.appointmentTime {
    margin-left: -20px;
}

</style>

@section('main')
<section class="section-02" style="background-image: url('{{ asset('assets/images/pet-sitters-dog-boarding-dog-walkers-nearby.jpg') }}');">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-white">
        <h1 class="display-4 fw-bold mt-5">Welcome to Premium Pet Grooming</h1>
        <p class="lead">Get the best grooming services for your adorable pets. Book an appointment today!</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5" style="color:#1f2e4d; font-size: 2.5rem;">Our Premium Grooming Services</h2>

    {{-- 1. Dog Bath & Blow Dry --}}
    <div class="row align-items-center mb-5">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('assets/images/DogBath&BlowDry.jpg') }}" alt="Dog Bath & Blow Dry" class="img-fluid rounded shadow w-100" style="max-height: 400px; object-fit: cover;">
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold mb-3" style="color:#1f2e4d; font-size: 1.75rem;">Dog Bath & Blow Dry</h3>
        <p style="font-size: 1.15rem; line-height: 1.9; color:#555;">
          Treat your furry companion to a luxurious bath experience. Our gentle dog shampoo and warm water bath remove dirt and odors, while the blow dry and brushing leave their coat shiny and soft. Ideal for regular hygiene and coat care.
        </p>
        <!-- <a href="#" class="btn btn-outline-primary mt-3 px-4 py-2">View Details</a> -->
      </div>
    </div>

    {{-- 2. Haircut & Styling --}}
    <div class="row align-items-center mb-5 flex-md-row-reverse">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('assets/images/HairCut&styling.jpg') }}" alt="Haircut & Styling" class="img-fluid rounded shadow w-100" style="max-height: 400px; object-fit: cover;">
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold mb-3" style="color:#1f2e4d; font-size: 1.75rem;">Haircut & Styling</h3>
        <p style="font-size: 1.15rem; line-height: 1.9; color:#555;">
          From breed-specific cuts to personalized styling, our professional groomers provide precision grooming that keeps your dog looking sharp and feeling comfortable. We tailor each session to your pet’s coat type and personality.
        </p>
        <!-- <a href="#" class="btn btn-outline-success mt-3 px-4 py-2">View Details</a> -->
      </div>
    </div>

    {{-- 3. Nails, Ears & Hygiene --}}
    <div class="row align-items-center mb-5">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('assets/images/NailsCuting.jpg') }}" alt="Nails, Ears & Hygiene" class="img-fluid rounded shadow w-100" style="max-height: 400px; object-fit: cover;">
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold mb-3" style="color:#1f2e4d; font-size: 1.75rem;">Nails, Ears & Hygiene</h3>
        <p style="font-size: 1.15rem; line-height: 1.9; color:#555;">
          Keep your pet happy, clean, and healthy with our hygiene package. It includes nail clipping to prevent painful cracks, ear cleaning to avoid infections, and hygiene trimming for sensitive areas to maintain overall well-being.
        </p>
        <!-- <a href="#" class="btn btn-outline-danger mt-3 px-4 py-2">View Details</a> -->
      </div>
    </div>

  </div>
</section>

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color: #1f2e4d;">Our Grooming Services</h2>

    <div class="row g-4">
      {{-- Box 1 --}}
      <div class="col-md-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <a href="#" style="text-decoration: none; color: inherit;">
            <div class="card-body">
              <img src="{{ asset('assets/images/DogBath&BlowDry.jpg') }}" alt="Dog Bath & Blow Dry" class="img-fluid rounded mb-3">
              <h5 class="card-title">Dog Bath & Blow Dry</h5>
              <p class="card-text">
                Warm water bath, gentle shampoo, blow dry & brushing.
                <!-- <a href="#" class="read-more-btn">Read More</a> -->
              </p>
            </div>
          </a>
        </div>
      </div>

      {{-- Box 2 --}}
      <div class="col-md-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <a href="#" style="text-decoration: none; color: inherit;">
            <div class="card-body">
              <img src="{{ asset('assets/images/HairCut&styling.jpg') }}" alt="Haircut & Styling" class="img-fluid rounded mb-3">
              <h5 class="card-title">Haircut & Styling</h5>
              <p class="card-text">
                Breed-specific trims & customized grooming styles.
                <!-- <a href="#" class="read-more-btn">Read More</a> -->
              </p>
            </div>
          </a>
        </div>
      </div>

      {{-- Box 3 --}}
      <div class="col-md-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <a href="#" style="text-decoration: none; color: inherit;">
            <div class="card-body">
              <img src="{{ asset('assets/images/NailsCuting.jpg') }}" alt="Nails, Ears & Hygiene" class="img-fluid rounded mb-3">
              <h5 class="card-title">Nails, Ears & Hygiene</h5>
              <p class="card-text">
                Nail trim, ear cleaning & hygiene grooming.
                <!-- <a href="#" class="read-more-btn">Read More</a> -->
              </p>
            </div>
          </a>
        </div>
      </div>

      {{-- Box 4 --}}
       <div class="col-md-3">
          <div class="card h-100 shadow-sm text-center border-0">
            <a href="#" style="text-decoration: none; color: inherit;">
              <div class="card-body">
                <img src="{{ asset('assets/images/earcleaning.jpg') }}" alt="Ear Cleaning" class="img-fluid rounded mb-3">
                <h5 class="card-title">Ear Cleaning</h5>
                <p class="card-text">
                  Gentle ear cleaning to remove wax, prevent infections, and ensure your pet stays comfortable and healthy.
                  {{-- <a href="#" class="read-more-btn">Read More</a> --}}
                </p>
              </div>
            </a>
          </div>
        </div>
  </div>
</section>

<section class="py-5" style="background-color: #f3f6fa;">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color: #1f2e4d;">Book a Grooming Appointment</h2>
    <div class="row justify-content-center">
      <div class="col-md-8">

        @if(session('success'))
          <div class="alert alert-success mt-3">
              {{ session('success') }}
          </div>
        @endif

        <form id="bookingForm" action="{{ route('booking.submit') }}" method="POST" onsubmit="handleSubmit(this)">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
            <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9]{10}" maxlength="10" minlength="10" title="Please enter a 10-digit phone number">
          </div>

          <div class="mb-3">
            <label for="service" class="form-label">Select Service <span class="text-danger">*</span></label>
            <select class="form-select" id="service" name="service" required="">
              <option value="" disabled="" selected="">-- Select Service--</option>
                <option value="All Services">All Services</option>
                <option value="Nail Clipping">Nail Clipping</option>
                <option value="Nails Ears Hygiene">Nails Ears Hygiene</option>
                <option value="Haircut & Styling">Haircut & Styling</option>
                <option value="Dog Bath & Blow Dry">Dog Bath & Blow Dry</option>
              </select>
          </div>

        
      <div class="container mt-6">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-3 date-input-container">
                    <label for="appointment_date" class="form-label appointmentDate">Select Date <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="appointment_date" name="appointment_date" readonly placeholder="Click to select date" required>
                    
                    <!-- Calendar Popup -->
                    <div class="calendar-popup" id="calendarPopup" style="display: none;">
                        <div class="calendar-container">
                            <div class="calendar-header">
                                <button type="button" class="nav-btn" id="prevMonth">‹</button>
                                <span id="currentMonth">JUNE 2025</span>
                                <button type="button" class="nav-btn" id="nextMonth">›</button>
                            </div>
                            <table class="calendar-table">
                                <thead>
                                    <tr>
                                        <th class="day-header">SUN</th>
                                        <th class="day-header">MON</th>
                                        <th class="day-header">TUE</th>
                                        <th class="day-header">WED</th>
                                        <th class="day-header">THU</th>
                                        <th class="day-header">FRI</th>
                                        <th class="day-header">SAT</th>
                                    </tr>
                                </thead>
                                <tbody id="calendarDates">
                                </tbody>
                            </table>
                            <div class="legend">
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #28a745;"></div>
                                    <span>Available</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #dc3545;"></div>
                                    <span>Unavailable</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #6c757d;"></div>
                                    <span>Not Applicable</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #ffc107;"></div>
                                    <span>Selected</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="appointment_time" class="form-label appointmentTime">Select Time <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="appointment_time" name="appointment_time" readonly placeholder="Time will appear after date selection" required>
                </div>
            </div>
        </div>
    </div>

    <!-- Time Slots Modal -->
    <div class="modal-overlay" id="modalOverlay" style="display: none;"></div>
    <div class="time-slots-container" id="timeSlotsContainer" style="display: none;">
        <div class="time-slots-header">
            <span id="selectedDateDisplay">26-06-2025</span>
        </div>
        <div class="time-slots-content">
            <div class="time-slots-grid" id="timeSlots"></div>
            <div class="booking-summary">
                <div>
                    <strong>Selected Time</strong>
                    <span id="selectedTimeDisplay">--</span>
                </div>
                <div>
                    <strong>Total Available</strong>
                    <span id="totalAvailable">--</span>
                </div>
            </div>
            <button type="button" class="ok-btn" onclick="confirmTimeSelection()">OK</button>
        </div>
    </div>

          <div class="mb-3">
            <label for="message" class="form-label">Message (Optional)</label>
            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
          </div>

          <button type="submit" class="btn btn-success w-100" id="submitBtn">
            <span id="btnText">Book Now</span>
            <span id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
          </button>
        </form>

      </div>
    </div>
  </div>
</section>

<script>
let currentDate = new Date();
let selectedDate = null;
let selectedTime = null;

const allTimeSlots = [
    '6:00', '6:30', '7:00', '7:30', '8:00', '8:30', '9:00', '9:30',
    '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
    '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30',
    '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00'
];

const availabilityCache = {};

async function getAvailableSlots(dateStr) {
    if (availabilityCache[dateStr]) {
        return availabilityCache[dateStr];
    }
    
    try {
        const response = await fetch(`/available-slots/${dateStr}`);
        const data = await response.json();
        
        if (data.success) {
            // Cache the result
            availabilityCache[dateStr] = data.available_slots;
            return data.available_slots;
        } else {
            console.error('Failed to fetch available slots:', data.message);
            return [];
        }
    } catch (error) {
        console.error('Error fetching available slots:', error);
        return [];
    }
}

async function hasAvailableSlots(dateStr) {
    const availableSlots = await getAvailableSlots(dateStr);
    return availableSlots.length > 0;
}

async function generateCalendar() {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    const monthNames = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
                       'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];
    document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;
    
    const prevBtn = document.getElementById('prevMonth');
    const todayMonth = today.getFullYear() * 12 + today.getMonth();
    const currentMonth = year * 12 + month;
    prevBtn.disabled = currentMonth <= todayMonth;
    
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startDate = new Date(firstDay);
    startDate.setDate(startDate.getDate() - firstDay.getDay());
    
    const datesContainer = document.getElementById('calendarDates');
    datesContainer.innerHTML = '';
    
    // Show loading indicator
    const loadingRow = document.createElement('tr');
    const loadingCell = document.createElement('td');
    loadingCell.colSpan = 7;
    loadingCell.textContent = 'Loading availability...';
    loadingCell.style.textAlign = 'center';
    loadingCell.style.padding = '20px';
    loadingRow.appendChild(loadingCell);
    datesContainer.appendChild(loadingRow);
    
    const datePromises = [];
    const dateElements = [];
    
    for (let week = 0; week < 6; week++) {
        const row = document.createElement('tr');
        
        for (let day = 0; day < 7; day++) {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + (week * 7) + day);
            // Set time to start of day for proper comparison
            date.setHours(0, 0, 0, 0);
            
            const dayCell = document.createElement('td');
            dayCell.className = 'day-cell';
            dayCell.textContent = date.getDate().toString().padStart(2, '0');
            
            const dateStr = date.toISOString().split('T')[0];
            
            if (date.getMonth() !== month) {
                dayCell.classList.add('other-month');
            } else if (date < today) {
                // Past dates - not applicable (today is selectable)
                dayCell.classList.add('not-applicable');
            } else {
                // For current and future dates, check availability
                dateElements.push({ element: dayCell, date: date, dateStr: dateStr });
                datePromises.push(hasAvailableSlots(dateStr));
            }
            
            if (selectedDate && dateStr === selectedDate.toISOString().split('T')[0]) {
                dayCell.classList.remove('available');
                dayCell.classList.add('selected');
            }
            
            row.appendChild(dayCell);
        }
        
        dateElements.push({ row: row });
    }
    
    try {
        const availabilityResults = await Promise.all(datePromises);
        
        datesContainer.innerHTML = '';
        
        let resultIndex = 0;
        for (let week = 0; week < 6; week++) {
            const row = document.createElement('tr');
            
            for (let day = 0; day < 7; day++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + (week * 7) + day);
                date.setHours(0, 0, 0, 0);
                
                const dayCell = document.createElement('td');
                dayCell.className = 'day-cell';
                dayCell.textContent = date.getDate().toString().padStart(2, '0');
                
                const dateStr = date.toISOString().split('T')[0];
                
                if (date.getMonth() !== month) {
                    dayCell.classList.add('other-month');
                } else if (date < today) {
                    dayCell.classList.add('not-applicable');
                } else {
                    // Apply availability result
                    const hasSlots = availabilityResults[resultIndex];
                    resultIndex++;
                    
                    if (!hasSlots) {
                        dayCell.classList.add('unavailable');
                    } else {
                        dayCell.classList.add('available');
                        dayCell.addEventListener('click', () => selectDate(date));
                    }
                }
                
                if (selectedDate && dateStr === selectedDate.toISOString().split('T')[0]) {
                    dayCell.classList.remove('available');
                    dayCell.classList.add('selected');
                }
                
                row.appendChild(dayCell);
            }
            
            datesContainer.appendChild(row);
        }
    } catch (error) {
        console.error('Error generating calendar:', error);
        datesContainer.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 20px; color: red;">Error loading calendar</td></tr>';
    }
}

function selectDate(date) {
    selectedDate = date;
    selectedTime = null;
    
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    document.getElementById('appointment_date').value = `${day}-${month}-${year}`;
    
    document.getElementById('appointment_time').value = '';
    
    document.getElementById('calendarPopup').style.display = 'none';
    
    showTimeSlots(date);
}

document.getElementById('appointment_date').addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    const popup = document.getElementById('calendarPopup');
    if (popup.style.display === 'none' || popup.style.display === '') {
        popup.style.display = 'block';
        generateCalendar();
    } else {
        popup.style.display = 'none';
    }
});

document.getElementById('appointment_time').addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    
    if (selectedDate) {
        showTimeSlots(selectedDate);
    } else {
        const popup = document.getElementById('calendarPopup');
        popup.style.display = 'block';
        generateCalendar();
    }
});

document.addEventListener('click', (e) => {
    const popup = document.getElementById('calendarPopup');
    const dateInput = document.getElementById('appointment_date');
    const timeInput = document.getElementById('appointment_time');
    
    if (!popup.contains(e.target) && !dateInput.contains(e.target) && !timeInput.contains(e.target)) {
        popup.style.display = 'none';
    }
});

async function showTimeSlots(date) {
    const container = document.getElementById('timeSlotsContainer');
    const overlay = document.getElementById('modalOverlay');
    const slotsGrid = document.getElementById('timeSlots');
    const dateDisplay = document.getElementById('selectedDateDisplay');
    
    // Format date
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    const dateStr = `${year}-${month.padStart(2, '0')}-${day}`;
    dateDisplay.textContent = `${day}-${month}-${year}`;
    
    slotsGrid.innerHTML = '<div style="text-align: center; padding: 20px; grid-column: 1/-1;">Loading time slots...</div>';
    
    overlay.style.display = 'block';
    container.style.display = 'block';
    
    try {
        const availableSlots = await getAvailableSlots(dateStr);
        
        // Clear loading message
        slotsGrid.innerHTML = '';
        
        if (availableSlots.length === 0) {
            slotsGrid.innerHTML = '<div style="text-align: center; padding: 20px; grid-column: 1/-1; color: #666;">No available time slots for this date</div>';
        } else {
            availableSlots.forEach(time => {
                const slot = document.createElement('div');
                slot.className = 'time-slot';
                slot.textContent = time;
                slot.addEventListener('click', () => selectTime(time, slot));
                slotsGrid.appendChild(slot);
            });
        }
        
        document.getElementById('totalAvailable').textContent = availableSlots.length;
        document.getElementById('selectedTimeDisplay').textContent = selectedTime || '--';
        
        if (selectedTime) {
            const timeSlots = document.querySelectorAll('.time-slot');
            timeSlots.forEach(slot => {
                if (slot.textContent === selectedTime) {
                    slot.classList.add('selected');
                }
            });
        }
        
    } catch (error) {
        console.error('Error loading time slots:', error);
        slotsGrid.innerHTML = '<div style="text-align: center; padding: 20px; grid-column: 1/-1; color: red;">Error loading time slots</div>';
        document.getElementById('totalAvailable').textContent = '0';
    }
}

function selectTime(time, element) {
    document.querySelectorAll('.time-slot').forEach(slot => {
        slot.classList.remove('selected');
    });
    
    element.classList.add('selected');
    selectedTime = time;
    
    document.getElementById('selectedTimeDisplay').textContent = time;
}

function confirmTimeSelection() {
    if (selectedTime && selectedDate) {
        document.getElementById('appointment_time').value = selectedTime;
        
        document.getElementById('modalOverlay').style.display = 'none';
        document.getElementById('timeSlotsContainer').style.display = 'none';
        
    } else {
        alert('Please select a time slot first.');
    }
}

document.getElementById('modalOverlay').addEventListener('click', () => {
    document.getElementById('modalOverlay').style.display = 'none';
    document.getElementById('timeSlotsContainer').style.display = 'none';
});

document.getElementById('prevMonth').addEventListener('click', (e) => {
    e.preventDefault();
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const todayMonth = today.getFullYear() * 12 + today.getMonth();
    const currentMonth = currentDate.getFullYear() * 12 + currentDate.getMonth();
    
    // Don't go back if already at current month
    if (currentMonth > todayMonth) {
        currentDate.setMonth(currentDate.getMonth() - 1);
        generateCalendar();
    }
});

document.getElementById('nextMonth').addEventListener('click', (e) => {
    e.preventDefault();
    currentDate.setMonth(currentDate.getMonth() + 1);
    generateCalendar();
});

async function refreshDateAvailability(dateStr) {
    // Clear cache for this date
    delete availabilityCache[dateStr];
    
    await generateCalendar();
}

function clearAvailabilityCache() {
    Object.keys(availabilityCache).forEach(key => delete availabilityCache[key]);
}

// Initialize calendar on page load
document.addEventListener('DOMContentLoaded', function() {
    generateCalendar();
});

window.addEventListener('online', function() {
    console.log('Network connection restored');
    clearAvailabilityCache();
    generateCalendar();
});

window.addEventListener('offline', function() {
    console.log('Network connection lost - using cached data');
});
</script>

<script>
  function handleSubmit(form) {
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    btnText.classList.add('d-none');
    btnLoader.classList.remove('d-none');
    document.getElementById('submitBtn').disabled = true;
  }


  @if(session('success'))
    toastr.success("{{ session('success') }}");
  @elseif(session('error'))
    toastr.error("{{ session('error') }}");
  @endif

</script>
@endsection


    