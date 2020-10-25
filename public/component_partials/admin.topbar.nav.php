<header class="relative bg-white lg:py-0 py-2">
  <div class="w-full flex flex-wrap items-center md:w-3/4 px-6 md:px-0 md:mx-auto">
    <div class="flex-1 flex justify-between items-center">
      <a href="../index.php">
        <svg class="w-20 h-20" viewBox="0 0 261 220" fill="none">
          <path
            d="M.634 176v-35.547h12.451c4.313 0 7.585.83 9.814 2.49 2.23 1.644 3.345 4.061 3.345 7.251 0 1.742-.447 3.28-1.343 4.615-.895 1.318-2.14 2.286-3.735 2.905 1.823.456 3.255 1.375 4.297 2.759 1.058 1.383 1.587 3.076 1.587 5.078 0 3.418-1.09 6.006-3.272 7.763-2.18 1.758-5.29 2.653-9.326 2.686H.634zm7.324-15.479v9.595h6.274c1.726 0 3.069-.407 4.029-1.22.976-.831 1.465-1.97 1.465-3.418 0-3.256-1.685-4.908-5.054-4.957H7.958zm0-5.175h5.42c3.695-.065 5.542-1.538 5.542-4.419 0-1.612-.472-2.767-1.416-3.467-.928-.716-2.4-1.074-4.419-1.074H7.958v8.96zM66.392 170.116h15.551V176H59.067v-35.547h7.325v29.663zM133.224 168.676h-12.842L117.94 176h-7.788l13.233-35.547h6.787L143.478 176h-7.789l-2.465-7.324zm-10.865-5.933h8.887l-4.468-13.305-4.419 13.305zM200.666 164.159c-.277 3.825-1.693 6.836-4.248 9.033-2.539 2.198-5.892 3.296-10.059 3.296-4.557 0-8.146-1.53-10.766-4.59-2.604-3.076-3.906-7.291-3.906-12.646v-2.173c0-3.418.602-6.429 1.806-9.033 1.205-2.604 2.922-4.598 5.152-5.982 2.246-1.399 4.85-2.099 7.812-2.099 4.102 0 7.406 1.098 9.912 3.296 2.507 2.197 3.955 5.281 4.346 9.253h-7.324c-.179-2.295-.822-3.955-1.929-4.981-1.091-1.041-2.759-1.562-5.005-1.562-2.441 0-4.272.879-5.493 2.636-1.205 1.742-1.823 4.452-1.856 8.13v2.686c0 3.841.578 6.649 1.734 8.423 1.172 1.774 3.011 2.661 5.517 2.661 2.263 0 3.947-.513 5.054-1.538 1.123-1.042 1.766-2.645 1.929-4.81h7.324zM243.108 161.742l-3.808 4.102V176h-7.324v-35.547h7.324v16.113l3.222-4.419 9.058-11.694h9.009l-12.622 15.796L260.955 176h-8.716l-9.131-14.258zM36.857 207.476V220h-7.324v-35.547H43.4c2.67 0 5.013.488 7.032 1.465 2.034.977 3.597 2.368 4.687 4.175 1.09 1.79 1.636 3.833 1.636 6.128 0 3.483-1.196 6.233-3.589 8.252-2.376 2.002-5.672 3.003-9.888 3.003h-6.42zm0-5.933H43.4c1.937 0 3.41-.456 4.42-1.367 1.025-.912 1.537-2.214 1.537-3.906 0-1.742-.512-3.15-1.538-4.224-1.025-1.074-2.441-1.628-4.248-1.66h-6.714v11.157zM109.695 204.595H95.633v9.521h16.504V220H88.309v-35.547h23.779v5.933H95.633v8.471h14.062v5.738zM163.002 212.676H150.16L147.719 220h-7.788l13.232-35.547h6.787L173.256 220h-7.788l-2.466-7.324zm-10.864-5.933h8.886l-4.467-13.305-4.419 13.305zM214.209 205.742l-3.809 4.102V220h-7.324v-35.547h7.324v16.113l3.223-4.419 9.058-11.694h9.008l-12.622 15.796L232.056 220h-8.716l-9.131-14.258zM129.5 0L172 67l45 68-76-58.5 10.5-27L41 135 129.5 0z"
            fill="#000" />
        </svg>
      </a>
    </div>

    <label for="menu-toggle" class="pointer-cursor lg:hidden block">
      <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
        viewBox="0 0 20 20">
        <title>menu</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
      </svg>
    </label>
    <input class="hidden" type="checkbox" id="menu-toggle" />

    <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
      <nav>
        <ul class="pt-4 lg:pt-0 lg:flex items-center justify-between text-base text-gray-700">
          <?php
            $activeClasses = "font-semibold text-indigo-400 lg:border-indigo-400";
            $isBookingDashboard = isset($GLOBALS['active_nav_item']) && ($GLOBALS['active_nav_item'] == 'admin_dashboard');
            $isAssetsDashboard = isset($GLOBALS['active_nav_item']) && ($GLOBALS['active_nav_item'] == 'assets_dashboard');
            $isReportssDashboard = isset($GLOBALS['active_nav_item']) && ($GLOBALS['active_nav_item'] == 'reports_dashboard');
            
            if( isset($_COOKIE["employeeID"]) ) {
              echo '
                <li>
                  <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent 
                  md:hover:border-indigo-400 '. ($isBookingDashboard ? $activeClasses : "") .'"
                      href="../booking/index.booking.php">
                    Dashboard
                  </a>
                </li>
                <li>
                  <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent 
                  md:hover:border-indigo-400 '. ($isAssetsDashboard ? $activeClasses : "") .'"
                      href="../assets/index.assets.php">
                    Manage Assets
                  </a>
                </li>
                <li>
                  <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent
                   md:hover:border-indigo-400 lg:mb-0 mb-2 '. ($isReportssDashboard ? $activeClasses : "") .'"
                      href="../reports/vehicles.report.php">
                    Reports
                  </a>
                </li>
              ';
            } else {
              echo '
                <li>  
                  <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400" 
                      href="index.php">
                    Home
                  </a>
                </li>
                <li>
                  <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400"
                      href="#">
                    About
                  </a>
                </li>
                <li>
                  <a class="py-3 lg:py-6 lg:px-4 px-0 block border-b-4 border-transparent md:hover:border-indigo-400 lg:mb-0 mb-2"
                      href="#">
                    Contact
                  </a>
                </li>
              ';
            }
          ?>
              
        </ul>
      </nav>
      <?php
        if( isset($_COOKIE["employeeID"]) ) {
          $empID = $_COOKIE['employeeID'];
          echo '
            <a href="../employee/view.employee.php?employeeID='.$empID.'" class="lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor">
              <img class="rounded-full w-10 h-10 border-2 border-transparent hover:border-indigo-400"
                src="https://images.unsplash.com/photo-1509305717900-84f40e786d82?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=144&h=144&q=80"
                alt="Nkosinathi Nkomo">
            </a>
          ';
        }
      ?>
      

    </div>
  </div>
</header>


<div id="deleteModel" 
  class="hidden absolute p-6 inset-x-0 mx-auto top-auto shadow-lg w-9/12 sm:w-1/2 lg:w-1/4 
    rounded-md border border-gray-200 bg-white ">
  <div class="w-12 h-12 mt-2 bg-red-200 flex flex-shrink-0 rounded-full items-center">
    <svg class="w-8 h-8 text-red-700 mx-auto py-auto block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>
  </div>
  <div class="pl-8">
    <p class="text-2xl font-semibold text-gray-800">Delete record</p>
    <p class="text-gray-600 text-sm">Are you sure you want to delete this record? All of data will be permanantly removed from our servers forever.</p>
    <p class="text-gray-600 text-sm mb-4">This action cannot be undone.</p>

    <div class="flex">
      <button 
        type="submit" 
        class="bg-red-500 hover:bg-red-700 text-gray-100 font-medium shadow-xs  border-red-600 border px-4 py-2 mr-3 rounded">
          Delete
      </button>
      <button
        type="button" 
        class="bg-gray-3
        00 font-medium text-gray-500 border-gray-600 hover:border-gray-800 hover:text-gray-800 border px-4 py-2 rounded" >
          Cancel
      </button>
    </div>
  </div>
</div>


<script>
  function closeModal() {

  }
  
  function confirmDelete() {
    var modal = document.getElementById("deleteModel");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
  }
</script>