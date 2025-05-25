<style>
  #notif-count {
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
  }

  .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    min-width: 250px;
    padding: 0.5rem 0;
    margin-top: 0.125rem;
    font-size: 0.875rem;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 0.25rem;
  }

  .left-arrow-profile {
    margin-left: -143px;
  }

  #notif-list::-webkit-scrollbar {
    width: 6px;
  }

  #notif-list::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  #notif-list::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
  }

  #notif-list::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  @media (max-width: 768px) {
    .left-arrow-profile {
      margin-left: 0px;
    }
  }

  .notif-dropdown-container {
    display: none;
    min-width: 320px;
    max-width: 100%;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    position: absolute;
    top: 100%;
    right: 0;
    z-index: 1000;
  }
  .mark-read {
    font-size: 13px;
    color: #00a57a;
    cursor: pointer;
  }

  .notif-section-title {
    padding: 10px 16px;
    font-size: 13px;
    color: #888;
    border-bottom: 1px solid #eee;
    background-color: #f8f9fa;
  }
  .notif-icon {
    margin-right: 12px;
    margin-top: 4px;
    color: #aaa;
  }

  .notif-content {
    flex-grow: 1;
  }

  .notif-title {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
  }

  .notif-customer {
    font-size: 13px;
    color: #444;
  }

  .notif-time {
    font-size: 12px;
    color: #888;
    margin-top: 4px;
  }
  .view-all:hover {
    text-decoration: underline;
  }

  /**/
  .notif-item {
    background-color: #fff;
    transition: background 0.3s ease;
  }

  .notif-item:hover {
    background-color: #f9f9f9;
  }

  .notif-header {
    font-weight: bold;
    font-size: 14px;
  }

  .view-all {
    font-size: 13px;
    font-weight: 500;
  }
</style>
<div id="content-wrapper" class="d-flex flex-column">
  <div id="content" style="background-color:#FDF5F6;">
    <!-- TopBar -->
    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
      <button id="sidebarToggleTop" class="btn btn-link mr-3"
        style="display: flex; align-items: center; justify-content: center; padding: 0;">
        <img src="{{asset('assets/img/37.menu.png')}}" style="height: 24px; width: 24px;">
      </button>

      <ul class="navbar-nav ml-auto">
        <!--<button class="btn btn-primary detail-prject"-->
        <!--  style="background-color: #4b1809; border-color: #D84055;font-size: 13px; margin-left: 10px;padding: 7px 30px !important;    padding: 7px 30px !important;height: 38px;margin-top: 18px;"-->
        <!--  id="toggleBeepBtn" onclick="toggleAudio()">Turn On Beep</button>-->
        <!--<audio id="beep" src="{{ asset('beep.wav') }}"></audio>-->

        <li class="nav-item dropdown no-arrow mx-1" id="notif-wrapper" style="position: relative;">
    <a class="nav-link" href="#" id="notificationDropdown" role="button">
        <div class="text-center">
            <div style="
                        background: white;
                        border-radius: 16px;
                        padding: 20px;
                        position: relative;
                        width: 44px;
                        height: 44px;
                        display: flex;
                        align-items: center;
                        justify-content: center;">
                <img src="{{asset('assets/img/Group 14869.png')}}">
                <span class="badge badge-danger badge-counter" id="notif-count">0</span>
            </div>
        </div>
    </a>
    <div id="notif-dropdown" class="dropdown-menu shadow" style="display:none; min-width: 300px; position: absolute; top: 100%; left: auto; right: 0;">
        <!-- Static Header -->
        <div class="notif-header d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
            <span>🔔 Notifications</span>
        </div>
        <!-- Notifications will be added here -->
        <div id="notif-list" style="max-height: 400px; overflow-y: auto;"></div>
    </div>
</li>

        <li class="nav-item dropdown no-arrow">
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-1 small"
                  placeholder="What do you want to look for?" aria-label="Search" aria-describedby="basic-addon2"
                  style="border-color: #D84055;">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button"
                    style="background-color: #D84055; border-color: #D84055;">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            @auth
            <img class="img-profile rounded-circle"
              src="{{ asset(Auth::user()->profile_image ?? 'default-avatar.png') }}" style="max-width: 60px">
            <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::user()->name }}</span>
            @endauth
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in left-arrow-profile"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{route('profile')}}">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="{{route('update.password')}}">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Update Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('logout') }}" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>

          </div>
        </li>
      </ul>
    </nav>

    @php
    use App\Models\Appointment;
    $appointmentDetails = Appointment::with('customer')->get();

    foreach ($appointmentDetails as $appointment) {
    $appointment->customer->name;
    }
    @endphp

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
let previousBeepCount = 0;
let totalOldAppointments = 0;
let userInteracted = false;

// Jab user click kare
document.addEventListener('click', function() {
    userInteracted = true;
});

function playNotificationSound() {
    if (userInteracted) {
        const beepSound = new Audio("{{ asset('beep.wav') }}");
        beepSound.play().catch(error => {
            console.error('Audio play failed:', error);
        });
    }
}

function dismissNotification(id) {
    $.ajax({
        url: '/dismiss-notification/' + id,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                $('#notif-item-' + id).remove();
                totalOldAppointments -= 1;
                $('#notif-count').text(totalOldAppointments);

                if (totalOldAppointments <= 0) {
                    $('#notif-count').hide();
                }
            } else {
                alert('Error: Notification update Failed.');
            }
        },
        error: function() {
            alert('Server error, try again.');
        }
    });
}

function fetchAppointmentCount() {
    $.ajax({
        url: '/get-appointment-count',
        type: 'GET',
        success: function(response) {
            const appointmentlist = response.appointmentlist;
            const now = new Date(response.current_date_time);

            let oldAppointmentCount = 0; // purane appointments ke liye
            let shouldBeep = false; // beep bajana hai ya nahi
            let html = '';
            appointmentlist.forEach(function(item) {
                if (item.appointment_date) {
                    const appointmentTime = new Date(item.appointment_date);
                    
                    if (now >= appointmentTime) {
                        oldAppointmentCount++;

                        const customer = item.customer?.name ?? 'Unknown';
                        const notes = item.notes ?? '';
                        const formattedTime = item.appointment_date ?? '';

                        html += `
                            <div class="notif-item border-bottom px-3 py-2 d-flex justify-content-between align-items-center" id="notif-item-${item.id}">
                                <div class="flex-grow-1" style="cursor: pointer;" onclick="window.location.href='/appointment-project/${item.project_id}'">
                                    <div class="fw-bold">Appointment With ${customer}</div>
                                    <div class="text-muted small">${notes}</div>
                                    <div class="text-end text-secondary small">${formattedTime}</div>
                                </div>
                                <div class="ms-3 d-flex align-items-center">
                                    <i class="fas fa-times text-danger" style="cursor:pointer;" onclick="dismissNotification(${item.id}); event.stopPropagation();"></i>
                                </div>
                            </div>
                        `; 
                    }
                       

                    // Beep ki condition: 1 minute pehle aur appointment time ke andar
                    const beepStartTime = new Date(appointmentTime);
                    beepStartTime.setMinutes(beepStartTime.getMinutes() - 30);
console.log(beepStartTime);
                    if (now >= appointmentTime) {
                        shouldBeep = true;
                    }
                }
            });

            // Beep bajao agar abhi match hua
            if (shouldBeep && oldAppointmentCount > previousBeepCount) {
                playNotificationSound();
            }

            previousBeepCount = oldAppointmentCount;
            totalOldAppointments = oldAppointmentCount;

            $('#notif-count').text(oldAppointmentCount);
            if (oldAppointmentCount > 0) {
                $('#notif-count').show();
            } else {
                $('#notif-count').hide();
            }
                //  else {
                //         html += `
                //             <div class="notif-item border-bottom px-3 py-2 d-flex justify-content-between align-items-center">
                //                 <p class="m-0">No Notifications</p>
                //             </div>
                //         `;
                //     } 
            document.getElementById('notif-list').innerHTML = html;
        }
    });
}

// Start
fetchAppointmentCount();
setInterval(fetchAppointmentCount, 10000); // Har 10 second me

$(document).ready(function() {
    $('#notificationDropdown').on('click', function(e) {
        e.preventDefault();
        $('#notif-dropdown').toggle();
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#notif-wrapper').length) {
            $('#notif-dropdown').hide();
        }
    });
});
</script>


 




 
    <!--<script>-->
    <!--  setInterval(function () {-->
    <!--    $.ajax({-->
    <!--      url: '{{ url("/check-notifications") }}',-->
    <!--      method: 'GET',-->
    <!--      success: function (response) {-->
    <!--        if (response.count > 0) {-->
    <!--          if (response.play_beep) {-->
    <!--            let audio = document.getElementById('notif-sound');-->
    <!--            audio.pause();-->
    <!--            audio.currentTime = 0;-->
    <!--            audio.play();-->
    <!--          }-->
    <!--        } else {-->
    <!--          $('#notif-count').text('0');-->
    <!--        }-->
    <!--      },-->
    <!--      error: function (err) {-->
    <!--        console.log("Error checking notifications:", err);-->
    <!--      }-->
    <!--    });-->
    <!--  }, 30000); -->
    <!--</script>-->

    <!-------------------------- beep sound js -------------------------------->
    <!--<script>-->
    <!--  let beepEnabled = false;-->
    <!--  const language = 'en';-->

    <!--  function toggleAudio() {-->
    <!--    beepEnabled = !beepEnabled;-->
    <!--    const btn = document.getElementById("toggleBeepBtn");-->
    <!--    const beep = document.getElementById("beep");-->

    <!--    if (beepEnabled) {-->
    <!--      beep.play().then(() => {-->
    <!--        beep.pause();-->
    <!--        beep.currentTime = 0;-->
    <!--        btn.innerText = language === 'hi' ? "🟢 " : "🟢 Turn Off Beep";-->
    <!--      }).catch((err) => {-->
    <!--        console.error("Audio play error:", err);-->
    <!--        alert("⚠️ " + err.message);-->
    <!--        beepEnabled = false;-->
    <!--      });-->
    <!--    } else {-->
    <!--      btn.innerText = language === 'hi' ? "🔴 " : "🔴 Turn On Beep";-->
    <!--    }-->
    <!--  }-->

    <!--  function parseLocalDateTime(datetimeStr) {-->
    <!--    const [datePart, timePart] = datetimeStr.split(" ");-->
    <!--    const [year, month, day] = datePart.split("-");-->
    <!--    const [hour, minute, second] = timePart.split(":");-->
    <!--    return new Date(year, month - 1, day, hour, minute, second);-->
    <!--  }-->

    <!--  function checkDateTime() {-->
    <!--    if (!beepEnabled) return;-->

    <!--    const now = new Date();-->

    <!--    const currentDate = now.toLocaleDateString("en-US", {-->
    <!--      month: "2-digit",-->
    <!--      day: "2-digit",-->
    <!--      year: "numeric"-->
    <!--    });-->

    <!--    const currentTime = now.toLocaleTimeString("en-US", {-->
    <!--      hour: '2-digit',-->
    <!--      minute: '2-digit',-->
    <!--      hour12: true-->
    <!--    });-->

    <!--    targetDateTime.forEach(item => {-->

    <!--      if (item.played) return;-->

    <!--      const appointment = parseLocalDateTime(item.appointment_date);-->

    <!--      const appointmentDate = appointment.toLocaleDateString("en-US", {-->
    <!--        month: "2-digit",-->
    <!--        day: "2-digit",-->
    <!--        year: "numeric"-->
    <!--      });-->

    <!--      const appointmentTime = appointment.toLocaleTimeString("en-US", {-->
    <!--        hour: '2-digit',-->
    <!--        minute: '2-digit',-->
    <!--        hour12: true-->
    <!--      });-->

    <!--      if (appointmentDate === currentDate && appointmentTime === currentTime) {-->
    <!--        playBeep();-->
    <!--        item.played = true;-->
    <!--      }-->
    <!--    });-->

    <!--    // Always update notification count-->

    <!--    showNotification();-->
    <!--  }-->

    <!--  function playBeep() {-->
    <!--    const beep = document.getElementById("beep");-->
    <!--    beep.currentTime = 0;-->
    <!--    beep.play().catch(err => {-->
    <!--      console.error("Beep failed:", err);-->
    <!--    });-->
    <!--  }-->

    <!--  function showNotification() {-->

    <!--    const notifElem = document.getElementById("notif-count");-->

    <!--    const remaining = targetDateTime.filter(item => parseInt(item.notfication_status) !== 1).length;-->

    <!--    localStorage.setItem("notifCount", remaining);-->

    <!--    notifElem.textContent = remaining;-->
    <!--    notifElem.style.display = "inline-block";-->
    <!--    notifElem.style.visibility = "visible";-->
    <!--    notifElem.style.opacity = "1";-->

    <!--  }-->

    <!--  let showAllNotifications = false;-->

    <!--  function notifications() {-->
    <!--    const notifList = document.getElementById("notif-list");-->
    <!--    notifList.innerHTML = "";-->

    <!--    const unplayedItems = targetDateTime.filter(item => !item.played && item.notfication_status != 1);-->

    <!--    if (unplayedItems.length === 0) {-->
    <!--      notifList.innerHTML = `-->
    <!--          <div class="notif-item p-3 text-muted small">No pending notifications</div>-->
    <!--        `;-->
    <!--      return;-->
    <!--    }-->

    <!--    const itemsToShow = showAllNotifications ? unplayedItems : unplayedItems.slice(0, 4);-->

    <!--    itemsToShow.forEach(item => {-->
    <!--      const appointment = parseLocalDateTime(item.appointment_date);-->
    <!--      const formattedTime = appointment.toLocaleString("en-US", {-->
    <!--        month: "short", day: "numeric", year: "numeric",-->
    <!--        hour: '2-digit', minute: '2-digit', hour12: true-->
    <!--      });-->

    <!--      const customer = item.customer?.name || 'Unknown';-->
    <!--      const notes = item.notes || '';-->

    <!--      notifList.innerHTML += `-->
    <!--            <div class="notif-item border-bottom px-3 py-2 d-flex justify-content-between align-items-center">-->
    <!--                <div -->
    <!--                  class="flex-grow-1" -->
    <!--                  style="cursor: pointer;" -->
    <!--                  onclick="window.location.href='/appointment-project/${item.project_id}'"-->
    <!--                >-->
    <!--                  <div class="fw-bold">Appoinment With ${customer}</div>-->
    <!--                  <div class="text-muted small">${notes}</div>-->
    <!--                  <div class="text-end text-secondary small">${formattedTime}</div>-->
    <!--                </div>-->
    <!--                <div class="ms-3 d-flex align-items-center">-->
    <!--                  <i class="fas fa-times text-danger" style="cursor:pointer;" onclick="dismissNotification(${item.id}); event.stopPropagation();"></i>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        `;-->
    <!--    });-->
    <!--  }-->

    <!--  function toggleAllNotifications() {-->
    <!--    showAllNotifications = true;-->
    <!--    notifications();-->
    <!--  }-->

    <!--  function closeNotifications() {-->
    <!--    document.getElementById("notif-dropdown").style.display = "none";-->
    <!--  }-->

    <!--  document.addEventListener("DOMContentLoaded", () => {-->
    <!--    const notifElem = document.getElementById("notif-count");-->
    <!--    const savedCount = localStorage.getItem("notifCount");-->

    <!--    if (savedCount !== null) {-->
    <!--      notifElem.textContent = savedCount;-->
    <!--      notifElem.style.display = "inline-block";-->
    <!--      notifElem.style.visibility = "visible";-->
    <!--      notifElem.style.opacity = "1";-->
    <!--    }-->

    <!--    showNotification();-->
    <!--  });-->

    <!--  setInterval(checkDateTime, 1000);-->
    <!--  document.addEventListener("DOMContentLoaded", function () {-->
    <!--    const notifBtn = document.getElementById("notificationDropdown");-->
    <!--    const notifDropdown = document.getElementById("notif-dropdown");-->
    <!--    const notifWrapper = document.getElementById("notif-wrapper");-->

    <!--    notifBtn.addEventListener("click", function (e) {-->
    <!--      e.preventDefault();-->
    <!--      e.stopPropagation();-->
    <!--      notifications();-->
    <!--      notifDropdown.style.display = notifDropdown.style.display === "block" ? "none" : "block";-->
    <!--    });-->

    <!--    document.addEventListener("click", function (e) {-->
    <!--      if (!notifWrapper.contains(e.target)) {-->
    <!--        notifDropdown.style.display = "none";-->
    <!--      }-->
    <!--    });-->
    <!--  });-->

    <!--  function dismissNotification(id) {-->

    <!--    $.ajax({-->
    <!--      url: `{{ url("remove-appointment-from-notifications") }}/${id}`,-->
    <!--      method: 'POST',-->
    <!--      dataType: 'json',-->
    <!--      headers: {-->
    <!--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
    <!--      },-->
    <!--      success: function (response) {-->
    <!--        window.location.reload();-->
    <!--        notifications();-->
    <!--      },-->
    <!--      error: function (xhr, status, error) {-->
    <!--        alert('An error occurred. Please try again.');-->
    <!--      }-->
    <!--    });-->
    <!--  }-->

    <!--</script>-->

    <!--<script>-->
    <!--  const sidebarToggleBtn = document.getElementById('sidebarToggleTop');-->
    <!--  const sidebar = document.querySelector('.sidebar');-->
    <!--  const overlay = document.createElement('div');-->
    <!--  overlay.className = 'sidebar-overlay';-->
    <!--  document.body.appendChild(overlay);-->

    <!--  sidebarToggleBtn.addEventListener('click', () => {-->
    <!--    if (window.innerWidth <= 768) {-->
    <!--      sidebar.classList.toggle('show');-->
    <!--      overlay.style.display = sidebar.classList.contains('show') ? 'block' : 'none';-->
    <!--    } else {-->
    <!--      sidebar.classList.toggle('hide');-->
    <!--      document.body.classList.toggle('sidebar-collapsed');-->
    <!--    }-->
    <!--  });-->

    <!--  overlay.addEventListener('click', () => {-->
    <!--    sidebar.classList.remove('show');-->
    <!--    overlay.style.display = 'none';-->
    <!--  });-->
    <!--</script>-->