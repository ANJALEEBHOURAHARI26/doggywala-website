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

 * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
  }

  .pet-walking-section {
      padding: 3rem 2.5rem;
  }

  .section-header {
      text-align: center;
      margin-bottom: 2.5rem;
  }

  .section-title {
      font-size: 2.5rem;
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 1rem;
      position: relative;
      display: inline-block;
  }

  .section-title::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: linear-gradient(135deg, #3498db, #2ecc71);
      border-radius: 2px;
  }

  .section-description {
    font-size: -5.9rem;
    color: #555;
    line-height: 1.8;
    text-align: justify;
    max-width: 1083px;
    margin: 0 auto;
  }

  @media (max-width: 768px) {
      body {
          padding: 1rem;
      }
      
      .pet-walking-section {
          padding: 2rem 1.5rem;
      }
      
      .section-title {
          font-size: 2rem;
      }
      
      .section-description {
          font-size: 1rem;
          text-align: left;
      }
  }

  @media (max-width: 480px) {
      .section-title {
          font-size: 1.8rem;
      }
  }
  .book-now-btn {
      display: block;
      width: 200px;
      margin: 2rem auto;
      padding: 15px 30px;
      background: linear-gradient(135deg, #3498db, #2ecc71);
      color: white;
      text-decoration: none;
      border-radius: 50px;
      font-size: 1.1rem;
      font-weight: bold;
      text-align: center;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
  }

  .book-now-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
      background: linear-gradient(135deg, #2980b9, #27ae60);
  }

</style>

@section('main')
<section class="section-02" style="background-image: url('{{ asset('uploads/pet-walking/petbacker-dog-walking-1800x450.jpg') }}');">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-white">
        <h1 class="display-4 fw-bold mt-5">Professional Pet Walking Services</h1>
        <p class="lead">Reliable and caring pet walking services for busy pet owners. Keep your pets healthy, happy, and active!</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-5" style="color:#1f2e4d; font-size: 2.5rem;">Our Premium Pet Walking Services</h2>

    <div class="row align-items-center mb-5">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('uploads/pet-walking/pexels-mart-production-8434708.jpg') }}" alt="Daily Pet Walking" class="img-fluid rounded shadow w-100" style="max-height: 400px; object-fit: cover;">
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold mb-3" style="color:#1f2e4d; font-size: 1.75rem;">Daily Dog Walking</h3>
        <p style="font-size: 1.15rem; line-height: 1.9; color:#555;">
          Regular daily walks to keep your dog healthy and happy while you're at work. Our experienced walkers provide 30-60 minute walks with proper exercise, bathroom breaks, and fresh air. We follow your pet's routine and provide updates with photos after each walk.
        </p>
      </div>
    </div>

    <div class="row align-items-center mb-5 flex-md-row-reverse">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('uploads/pet-walking/pexels-blue-bird-7210727.jpg') }}" alt="Group Pet Walks" class="img-fluid rounded shadow w-100" style="max-height: 400px; object-fit: cover;">
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold mb-3" style="color:#1f2e4d; font-size: 1.75rem;">Group Walking & Socialization</h3>
        <p style="font-size: 1.15rem; line-height: 1.9; color:#555;">
          Perfect for social dogs who enjoy company! Our supervised group walks allow your pet to exercise and socialize with other friendly dogs. We carefully select compatible pets and maintain small groups for safety and individual attention during the walk.
        </p>
      </div>
    </div>

    <div class="row align-items-center mb-5">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('uploads/pet-walking/pexels-diego-f-parra-33199-15452239.jpg') }}" alt="Pet Exercise Activities" class="img-fluid rounded shadow w-100" style="max-height: 400px; object-fit: cover;">
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold mb-3" style="color:#1f2e4d; font-size: 1.75rem;">Exercise & Play Sessions</h3>
        <p style="font-size: 1.15rem; line-height: 1.9; color:#555;">
          More than just walking! We provide active play sessions, fetch games, and interactive activities to keep your pet mentally and physically stimulated. Perfect for high-energy dogs or pets that need extra exercise beyond regular walks.
        </p>
      </div>
    </div>

  </div>
</section>

<section class="pet-walking-section">
    <div class="section-header">
        <h2 class="section-title">Why Choose Professional Pet Walking?</h2>
    </div>
    
    <div class="section-description">
        Busy work schedules and long hours can leave pet owners struggling to provide adequate exercise and outdoor time for their beloved pets. Many dogs and cats suffer from lack of physical activity, leading to behavioral problems, weight gain, anxiety, and decreased overall health. Our professional pet walking services solve this problem by providing reliable, scheduled walks and exercise sessions tailored to your pet's specific needs. Our experienced and trusted pet walkers are fully insured, bonded, and trained to handle pets of all sizes and temperaments. We understand that every pet has unique requirements - from energetic puppies needing vigorous exercise to senior pets requiring gentle, shorter walks. Unlike informal arrangements, we provide consistent service with backup walkers, detailed reports, GPS tracking, and photo updates so you know your pet is getting the care they deserve. Rain or shine, we're committed to keeping your pet healthy, happy, and well-exercised while giving you peace of mind during your busy day.
    </div>
    <a href="#booking-form" class="book-now-btn" onclick="scrollToForm()">Book Pet Walk</a>
</section>

<section class="py-5" style="background-color: #f9fff9;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color: #1f2e4d;">Our Pet Walking Services</h2>

    <div class="row g-4">
      {{-- Box 1 --}}
      <div class="col-md-3">
        <div class="card h-100 shadow-sm text-center border-0">
          <a href="#" style="text-decoration: none; color: inherit;">
            <div class="card-body">
              <img src="{{ asset('uploads/pet-walking/pexels-michael-morse-2414845.jpg') }}" alt="Regular Dog Walking" class="img-fluid rounded mb-3">
              <h5 class="card-title">Regular Dog Walking</h5>
              <p class="card-text">
                Daily scheduled walks for your dog with consistent timing and personalized care.
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
              <img src="{{ asset('uploads/pet-walking/pexels-blue-bird-7210727.jpg') }}" alt="Puppy Walking" class="img-fluid rounded mb-3">
              <h5 class="card-title">Puppy Walking</h5>
              <p class="card-text">
                Gentle walks and potty breaks for puppies with shorter duration and frequent visits.
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
              <img src="{{ asset('uploads/pet-walking/pexels-marie-francoise-bastien-1479969797-32138086.jpg') }}" alt="Senior Pet Walking" class="img-fluid rounded mb-3">
              <h5 class="card-title">Senior Pet Walking</h5>
              <p class="card-text">
                Specialized gentle walks for senior pets with mobility considerations and comfort breaks.
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
                <img src="{{ asset('uploads/pet-walking/pexels-blue-bird-7210695.jpg') }}" alt="Group Pet Walking" class="img-fluid rounded mb-3">
                <h5 class="card-title">Group Pet Walking</h5>
                <p class="card-text">
                  Social walks with other friendly pets for dogs who enjoy company and interaction.
                </p>
              </div>
            </a>
          </div>
        </div>
  </div>
</section>


<section class="py-5 booking-form-section" style="background-color: #f3f6fa;" id="booking-form">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color: #1f2e4d;">Book Pet Walking Service</h2>
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
            <label for="service" class="form-label">Select Pet Walking Service <span class="text-danger">*</span></label>
            <select class="form-select" id="service" name="service" required="">
              <option value="" disabled="" selected="">-- Select Pet Walking Service --</option>
               <option value="Daily Dog Walking (30 minutes)">Daily Dog Walking (30 minutes)</option>
                <option value="Daily Dog Walking (60 minutes)">Daily Dog Walking (60 minutes)</option>
                <option value="Puppy Walking & Potty Breaks">Puppy Walking & Potty Breaks</option>
                <option value="Senior Pet Walking">Senior Pet Walking</option>
                <option value="Group Pet Walking">Group Pet Walking</option>
                <option value="Weekend Pet Walking">Weekend Pet Walking</option>
                <option value="Emergency Pet Walking">Emergency Pet Walking</option>
                <option value="Cat Walking & Outdoor Time">Cat Walking & Outdoor Time</option>
                <option value="Exercise & Play Sessions">Exercise & Play Sessions</option>
                <option value="Multiple Pet Walking">Multiple Pet Walking</option>
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
            <label for="message" class="form-label">Special Instructions for Pet Walking (Optional)</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Tell us about your pet's walking preferences, energy level, any health concerns, or special requirements..."></textarea>
          </div>

          <button type="submit" class="btn btn-success w-100" id="submitBtn">
            <span id="btnText">Book Pet Walking Service</span>
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

// Check if date has any available slots
async function hasAvailableSlots(dateStr) {
    const availableSlots = await getAvailableSlots(dateStr);
    return availableSlots.length > 0;
}

// Generate calendar with dynamic availability
async function generateCalendar() {
    const today = new Date();
    // Set time to start of day for proper comparison
    today.setHours(0, 0, 0, 0);
    
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    // Update header
    const monthNames = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
                       'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];
    document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;
    
    // Disable prev button if current month
    const prevBtn = document.getElementById('prevMonth');
    const todayMonth = today.getFullYear() * 12 + today.getMonth();
    const currentMonth = year * 12 + month;
    prevBtn.disabled = currentMonth <= todayMonth;
    
    // Get first day of month and number of days
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startDate = new Date(firstDay);
    startDate.setDate(startDate.getDate() - firstDay.getDay());
    
    // Clear previous dates
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
    
    // Generate 6 weeks of dates
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
    
    // Wait for all availability checks to complete
    try {
        const availabilityResults = await Promise.all(datePromises);
        
        // Clear loading indicator
        datesContainer.innerHTML = '';
        
        // Apply availability results
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
    
    // Update date input field
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    document.getElementById('appointment_date').value = `${day}-${month}-${year}`;
    
    // Clear time field
    document.getElementById('appointment_time').value = '';
    
    // Hide calendar popup
    document.getElementById('calendarPopup').style.display = 'none';
    
    // Show time slots modal
    showTimeSlots(date);
}

// Show/hide calendar popup
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

// Add time field click handler to show time slots for already selected date
document.getElementById('appointment_time').addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    
    // If date is already selected, show time slots without clicking date again
    if (selectedDate) {
        showTimeSlots(selectedDate);
    } else {
        // If no date selected, show calendar first
        const popup = document.getElementById('calendarPopup');
        popup.style.display = 'block';
        generateCalendar();
    }
});

// Hide calendar when clicking outside
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
    
    // Show loading
    slotsGrid.innerHTML = '<div style="text-align: center; padding: 20px; grid-column: 1/-1;">Loading time slots...</div>';
    
    // Show modal first
    overlay.style.display = 'block';
    container.style.display = 'block';
    
    try {
        // Get available slots for this date from API
        const availableSlots = await getAvailableSlots(dateStr);
        
        // Clear loading message
        slotsGrid.innerHTML = '';
        
        if (availableSlots.length === 0) {
            slotsGrid.innerHTML = '<div style="text-align: center; padding: 20px; grid-column: 1/-1; color: #666;">No available time slots for this date</div>';
        } else {
            // Generate available time slots
            availableSlots.forEach(time => {
                const slot = document.createElement('div');
                slot.className = 'time-slot';
                slot.textContent = time;
                slot.addEventListener('click', () => selectTime(time, slot));
                slotsGrid.appendChild(slot);
            });
        }
        
        // Update total available count
        document.getElementById('totalAvailable').textContent = availableSlots.length;
        document.getElementById('selectedTimeDisplay').textContent = selectedTime || '--';
        
        // If there's already a selected time, highlight it
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
    // Remove previous selection
    document.querySelectorAll('.time-slot').forEach(slot => {
        slot.classList.remove('selected');
    });
    
    // Select current time
    element.classList.add('selected');
    selectedTime = time;
    
    // Update display
    document.getElementById('selectedTimeDisplay').textContent = time;
}

function confirmTimeSelection() {
    if (selectedTime && selectedDate) {
        // Update time field
        document.getElementById('appointment_time').value = selectedTime;
        
        // Hide modal
        document.getElementById('modalOverlay').style.display = 'none';
        document.getElementById('timeSlotsContainer').style.display = 'none';
        
        // Removed alert as requested
    } else {
        alert('Please select a time slot first.');
    }
}

// Close modal when clicking overlay
document.getElementById('modalOverlay').addEventListener('click', () => {
    document.getElementById('modalOverlay').style.display = 'none';
    document.getElementById('timeSlotsContainer').style.display = 'none';
});

// Navigation buttons
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

// Function to refresh availability for a specific date (useful after booking)
async function refreshDateAvailability(dateStr) {
    // Clear cache for this date
    delete availabilityCache[dateStr];
    
    // Regenerate calendar to show updated availability
    await generateCalendar();
}

// Function to clear all cached availability data
function clearAvailabilityCache() {
    Object.keys(availabilityCache).forEach(key => delete availabilityCache[key]);
}

// Initialize calendar on page load
document.addEventListener('DOMContentLoaded', function() {
    generateCalendar();
});

// Optional: Add error handling for network issues
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


    