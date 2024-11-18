@extends('layouts.backendsettings')
@section('title', 'Overview')
@section('content')


   
 <!--  <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'root.css') }}"> -->
<!--   <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'custom.css') }}"> -->
  <link rel="stylesheet" href="{{ asset($constants['CSSFILEPATH'] . 'common.css') }}">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Activity Reports</title>


    <main class="flex w-full h-full cm">

       <!-- main content -->
        <div class="flex-grow border h-full main">
            <div class="flex w-full h-full flex-col content">
                <div class="px-2 lg:px-5 py-6">
                    <div class="flex items-center gap-4">
                        <i class="ri-settings-3-fill ri-xl"></i>
                        <span class="text-lg text-color-nav-black">Reports and Analytics</span>
                    </div>
                </div>

                <!-- top taskbar -->
                <div class="taskbar flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-2 sm:gap-4 w-full md:w-1/2">
                        <div class="flex items-center gap-1 sm:gap-2">
                          <span class="text-c-light-black text-sm sm:text-base"> Reports and Analytics </span>
                          <i class="ri-arrow-right-line ri-sm sm:ri-lg" style="color: #4D4D4D;"></i>
                          <span class="font-semibold text-c-black text-sm sm:text-base"> Activity Reports </span>
                       </div>  
                    </div>
                    <div class="flex-grow md:w-1/2">
                        <div class="flex items-center justify-end gap-2 md:gap-6">
                                <button id="add-btn"
                              class="flex items-center justify-center gap-2 bg-c-black text-c-yellow px-3 sm:px-4 py-1 sm:py-1.5 rounded-md w-22" 
                            >
                              <i class="ri-add-circle-fill"></i
                              ><span class="text-xs sm:text-sm">Add Graph</span>
                            </button>
                        </div>
                    </div>

                </div>

                <!--content -->
                <div class="overflow-y-scroll scroll relative h-full">
                   <div class="graph-modal graph-effect-1" id="modal">
                         <div style="height: 400px;">
                           <canvas id="successful-logout-chart"></canvas>
                          </div> 
                    </div>
                  <div class="graph-container">
                    <div class="p-4 w-full">
                      <div class="default-filter flex items-center gap-2 flex-wrap">
                          <div class="activity-dropdown inline-block relative">
                                <button
                                  class="activity-btn rounded px-6 py-1 custom-outline custom-safety-btn"
                                >
                                  <span>Activity Type</span>
                                  <i class="ri-arrow-down-s-fill"></i>
                                </button>
                                <ul
                                  class="activity-dropdown-menu activity-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                                >
                                  <li id="user" class="activity-item user-activity">
                                    <a
                                      class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                      href="#"
                                      >User Activity</a
                                    >
                                  </li>
                                  <li id="group" class="dropdown-submenu group activity-item group-activity">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Group Activity
                                    </a>
                                  </li>
                                  <li id="rbac" class="dropdown-submenu group activity-item rbac-activity">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      RBAC
                                    </a>
                                  </li>
                                  <li id="filemanagement" class="dropdown-submenu group activity-item filemanagement-activity">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      File management 
                                    </a>
                                  </li>
                                  <li id="softwareusage" class="dropdown-submenu group activity-item softwareusage-activity">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Software Usage
                                    </a>
                                  </li>
                                  <li id="locationbased" class="dropdown-submenu group activity-item locationbased-activity">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Location-Based Metrics 
                                    </a>
                                  </li>
                                  <li id="systemperformance" class="dropdown-submenu group activity-item systemperformance-activity">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      System Performance 
                                    </a>
                                  </li>
                                  <li id="security" class="dropdown-submenu group activity-item security-activity">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Security
                                    </a>
                                  </li>
                                  <li id="auditlogs" class="dropdown-submenu group activity-item auditlogs-activity">
                                    <a
                                      class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Audit Logs
                                    </a>
                                  </li>
                                </ul>
                          </div>
                          <div class="graph-dropdown inline-block relative">
                                <button
                                  class="select-graph rounded px-6 py-1 custom-outline custom-safety-btn user"
                                >
                                  <span>Select Graph</span>
                                  <i class="ri-arrow-down-s-fill"></i>
                                </button>
                                <ul
                                  class="user-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                                >
                                  <li id="user-login-over-time">
                                    <a
                                      class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                      href="#"
                                      >User Logins Over Time</a
                                    >
                                  </li>
                                  <li id="failed-login-attempt" class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Failed Login Attempts
                                    </a>
                                  </li>
                                  <li id="successful-logout" class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Successful Logouts
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Average Session Duration per User
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Most Active Users
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Inactive Users
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      File Accessed by Users 
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                    Files Downloaded by Users
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                    Files Uploaded by Users
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      File Types Accessed
                                    </a>
                                  </li>
                                </ul>
                                  <ul
                                  class="group-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                                >
                                  <li>
                                    <a
                                      class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                      href="#"
                                      >Groups Created Over Time</a
                                    >
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Group Activity Distribution
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Group File Access Patterns
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                    Number of Users in Groups
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                    Group Participation by Location
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                    File Sharing Between Groups
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                    External API Access by Groups
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                    Collaboration Patterns in Groups
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                  Inactive Groups
                                    </a>
                                  </li>
                                  <li class="dropdown-submenu group">
                                    <a
                                      class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                    Group Ownership Changes
                                    </a>
                                  </li>
                                </ul>
                                <ul
                                class="rbac-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                              >
                                <li>
                                  <a
                                    class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                    href="#"
                                    >Roles Created Over Time</a
                                  >
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Permission Changes by Roles
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Privileges Per Role
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Role Usage by Time
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Users Assigned to Roles
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                 Files Accessed by Role
                                  </a>
                                </li>
                              </ul>
                               <ul
                                class="filemanagement-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                              >
                                <li>
                                  <a
                                    class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                    href="#"
                                    >Files Accessed Over Time</a
                                  >
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Most Accessed Files
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Average File Access Time
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  File Modifications
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Deleted Files Over Time
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  File Access by Location
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Unauthorized File Access
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Large File Transfers
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                Sensitive File Access
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Files Accessed Outside Business Hours
                                  </a>
                                </li>
                              </ul>
                               <ul
                                class="softwareusage-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                              >
                                <li>
                                  <a
                                    class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                    href="#"
                                    >Software Installations</a
                                  >
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Software Engagement by Users
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Version Updates Over Time
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Software Crashes
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Software Usage Patterns by Users
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  License Expirations
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Software Used in Multiple Locations
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Software Vulnerabilities Exploited
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                Software Access Frequency
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Error Rates by Software
                                  </a>
                                </li>
                              </ul>
                              <ul
                                class="locationbased-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                              >
                                <li>
                                  <a
                                    class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                    href="#"
                                    >User Access by Country</a
                                  >
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Latency by Location
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    File Access by Country
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Failed File Transfers by Location
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Bandwidth Utilization by Location
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  User Activity Patterns by Country
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  File Sharing Between Countries
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Data Transfer Rates by Region
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                Network Latency by Time Zone
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Access from Unusual Locations
                                  </a>
                                </li>
                              </ul>
                              <ul
                                class="systemperformance-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                              >
                                <li>
                                  <a
                                    class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                    href="#"
                                    >CPU Usage Over Time</a
                                  >
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                   RAM Usage Over Time
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Disk I/O Rates
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Network Traffic
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Database Query Response Times
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  System Error Rates
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  System Uptime
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Server Response Time by Location
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                I/O Wait Time Distribution
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Resource Utilization per User
                                  </a>
                                </li>
                              </ul>
                              <ul
                                class="security-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                              >
                                <li>
                                  <a
                                    class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                    href="#"
                                    >Security Incidents Over Time</a
                                  >
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                   Unauthorized Network Access
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    Intrusion Detection Alerts
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  VPN Usage by Users
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Failed File Encryption Attempts
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Malware Infections
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                 Patches Applied Over Time
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Firewall Block Events
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                Suspicious Activity in Logs
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  System Vulnerability Scans
                                  </a>
                                </li>
                              </ul>
                              <ul
                                class="auditlogs-activity-menu graph-dropdown-menu graph-custom-dropdown-menu absolute hidden text-c-black shadow bg-custom-pure-white text-xs"
                              >
                                <li>
                                  <a
                                    class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                    href="#"
                                    >File Access History</a
                                  >
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                   User Session History
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                    User Privilege Changes
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Data Transfer Logs
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Deleted Files Audit
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Group Activity Logs
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                 Software Usage History
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  Role Assignment Changes
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                Unauthorized Access Logs
                                  </a>
                                </li>
                                <li class="dropdown-submenu group">
                                  <a
                                    class="rounded-b custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                    href="#"
                                  >
                                  System Backup Logs
                                  </a>
                                </li>
                              </ul>
                          </div>
                          <div class="data-label-dropdown inline-block relative ">
                                <button 
                                  class="label-btn rounded px-6 py-1 custom-outline custom-safety-btn"
                                >
                                  <span>Data Label</span>
                                  <i class="ri-arrow-down-s-fill"></i>
                                </button>
                                <ul
                                  class="label-dropdown-menu label-custom-dropdown-menu w-full absolute hidden text-c-black shadow bg-c-lighten-gray rounded overflow-hidden text-xs"
                                >
                                  <li id="on-label" class="activity-item">
                                    <a
                                      class="custom-bg-hover rounded-t py-2 px-4 block whitespace-no-wrap px-4"
                                      href="#"
                                      >On</a
                                    >
                                  </li>
                                  <li id="off-label" class="dropdown-submenu group activity-item">
                                    <a
                                      class="custom-bg-hover py-2 px-4 block whitespace-no-wrap flex justify-between items-center"
                                      href="#"
                                    >
                                      Off
                                    </a>
                                  </li>
                                </ul>
                          </div>
                          <button
                            class="custom-safety-btn rounded px-6 py-1 mr-1 hover:border-yellow-300"
                          >
                            Today
                          </button>
                          <button
                            class="custom-safety-btn focus:border-yellow-500 rounded px-6 py-1 mr-1 hover:border-yellow-300"
                          >
                            Last 7 days
                          </button>
                          <button
                            class="custom-safety-btn rounded px-6 py-1 mr-1 hover:border-yellow-300"
                          >
                            Last 30 days
                          </button>
                          <button
                            class="custom-safety-btn rounded px-6 py-1 mr-1 hover:border-yellow-300"
                          >
                            Custom Date
                          </button>   
                      </div>
                      <div class="graph-area rounded mt-6 relative">
                        <div class="graph-hidden-area">
                           <div class="pr-3 pt-4 flex gap-3 justify-end">
                            <i class="ri-eye-off-fill ri-lg" id="md-trigger"></i>
                            <i class="ri-eye-fill ri-lg hidden" id="md-close"></i>
                            <i class="ri-close-circle-fill ri-lg close-graph"></i>
                          </div>
                          <div class="graph-show">
                            <div id="user-login-over-time-graph" class="">
                              <div class="text-c-black font-medium text-xl text-center py-3">
                              Users Uploaded Data
                              </div>
                                <div class="pt-2">
                                    <div style="height: 370px;">
                                     <canvas id="chartId" width="300" height="150"></canvas>
                                    </div>
                                </div>
                                <div class="text-c-black font-normal text-lg text-center py-3">
                                  <!-- This graph shows the number of failed login attempts across different time periods. -->
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="flex justify-center items-center h-full hidden suggestion">
                         <h1 class="text-4xl text-c-black">
                          Select Graph From Filter
                         </h1>
                        </div>
                       
                      </div>
                    </div>
                </div>
                <div class="md-overlay">
                  <button class="nav-btn left" id="prev-slide"><i class="ri-arrow-left-wide-line"></i></button>
                  <button class="nav-btn right" id="next-slide"><i class="ri-arrow-right-wide-line"></i></button>
                  <div class="nav-track" id="nav-track">
                    <span id="slide-indicator"></span>
                  </div>
                </div>
                </div>

  
    </main> 
     <script src="{{ asset($constants['JSFILEPATH'] . 'graph-setup.js') }}"></script>
     <script src="{{ asset($constants['JSFILEPATH'] . 'reports-analytics.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/helpers.esm.min.js">
   </script>
<script>
    var ctx = document.getElementById('chartId').getContext('2d');
    var chartId = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),  // Inject labels from the controller
            datasets: [{
                label: "File Uploads per User",
                data: @json($data),    // Inject data from the controller
                backgroundColor: ['yellow', 'aqua', 'pink', 'lightgreen', 'lightblue', 'gold'],
                borderColor: ['red', 'blue', 'fuchsia', 'green', 'navy', 'black'],
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

   

   
   
    <script defer>
          document.getElementById("md-trigger").addEventListener("click", function(e) {
    document.getElementById("modal").classList.toggle("graph-show");
    document.getElementById('md-close').classList.remove('hidden')
     document.getElementById('md-trigger').classList.add('hidden')
    e.preventDefault();
});

document.getElementById('md-close').addEventListener("click",function(e){
   document.getElementById("modal").classList.toggle("graph-show");
    document.getElementById('md-close').classList.add('hidden')
     document.getElementById('md-trigger').classList.remove('hidden')
    e.preventDefault();
})



let currentSlide = 1;
const totalSlides = 10;

// Function to update the slide indicator and navigation logic
function updateSlideIndicator(slide) {
    document.getElementById('slide-indicator').textContent = `${slide}/${totalSlides}`;
}

updateSlideIndicator(currentSlide);

document.getElementById('prev-slide').addEventListener('click', function(e) {
   e.stopPropagation();
    if (currentSlide > 1) {
        currentSlide--;
        updateSlideIndicator(currentSlide);
    }
});

document.getElementById('next-slide').addEventListener('click', function(e) {
   e.stopPropagation();
    if (currentSlide < totalSlides) {
        currentSlide++;
        updateSlideIndicator(currentSlide);
    }
});

// Event listener to close modal when clicking outside
document.querySelector('.md-overlay').addEventListener('click', function(e) {
    document.getElementById('modal').classList.remove('graph-show');
     document.getElementById('md-trigger').classList.remove('hidden')
      document.getElementById('md-close').classList.add('hidden')
});

document.getElementById('modal').addEventListener('click', function(e) {
    e.stopPropagation();
});



    </script>
    @endsection