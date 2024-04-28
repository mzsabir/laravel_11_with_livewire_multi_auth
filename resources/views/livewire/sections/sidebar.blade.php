  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link " href="/">
          <i class="bi bi-house"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

    
      @if(Auth()->user()->role!="lawyer")
      <li class="nav-item">
        <a class="nav-link " href="/case/create">
          <i class="bi bi-grid"></i>
          <span>Create New Case</span>
        </a>
      </li>
      @endif

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>My Cases</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/case">
              <i class="bi bi-circle"></i><span>All Cases</span>
            </a>
          </li>  
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>Pending Cases</span>
            </a>
          </li>
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>Inprogress Cases</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Completed Cases</span>
            </a>
          </li>
        </ul>
      </li><!-- End Case Nav -->

      @if(Auth()->user()->role!="client")
      <li class="nav-item">
        <a class="nav-link" href="/hearing/create">
          <i class="bi bi-grid"></i>
          <span>Create New Hearing</span>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link " href="/hearing">
          <i class="bi bi-grid"></i>
          <span>Hearings</span>
        </a>
      </li><!-- End Hearing Nav -->

     
    

    

    </ul>

  </aside><!-- End Sidebar-->