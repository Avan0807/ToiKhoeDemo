<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('doctor')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Bác sĩ</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route('doctor')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Trang tổng quan</span></a>
    </li>


      <div class="sidebar-heading">
          Công việc 
      </div>
      
    <!-- Heading -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('doctor.appointment.index')}}">
            <i class="fas fa-calendar-plus"></i>
              <span>Lịch làm việc</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('patients.index')}}">
            <i class="fas fa-calendar-plus"></i>
              <span>Bệnh nhân</span>
        </a>
      </li>

    <!-- Divider -->
      <hr class="sidebar-divider">

    <!-- Cửa hàng -->
      <div class="sidebar-heading">
          Cửa hàng
      </div>
    <!--Orders -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('doctor.order.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
              <span>Đơn hàng</span>
        </a>
      </li>

    <!-- Reviews -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('doctor.productreview.index')}}">
            <i class="fas fa-comments"></i>
              <span>Đánh giá</span></a>
      </li>


    <!-- Divider -->
      <hr class="sidebar-divider">

    <!-- Heading -->
      <div class="sidebar-heading">
        Bài viết
    </div>
    <!-- Comments -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('doctor.post-comment.index')}}">
          <i class="fas fa-comments fa-chart-area"></i>
            <span>Bình luận</span>
        </a>
      </li>
    <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

</ul>