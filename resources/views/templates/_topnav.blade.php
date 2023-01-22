{{-- Navigation Atas --}}
<div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('/map') ? 'active' : '' }}" href="/map">Map</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('/plan_mission') ? 'active' : '' }}" href="/plan_mission">Plan Mission</a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ request()->is('/documents') ? 'active' : '' }}" href="#">Documents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/flight') ? 'active' : '' }}" href="/flight">Flight</a>
        </li>
      <li class="nav-item">
        <a class="nav-link border-0 {{ request()->is('/operation_calendar') ? 'active' : '' }}" href="/calendar">Operation Calendar</a>
      </li>
    </ul>
  </div>
{{-- End Navigation Atas --}}