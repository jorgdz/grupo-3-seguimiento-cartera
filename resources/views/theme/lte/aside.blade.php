
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @if(Auth::user())
  <!-- Brand Logo -->
    <a href="{{ route('inicio') }}" class="brand-link">
      <img src="{{ asset('inicio.png') }}" alt="logo" class="brand-image  elevation-8"
           style="opacity: 1">
      <span class="brand-text font-weight-light">&&</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            
          <img src="{{ asset('fotos/'.Auth::user()->foto) }}" class="img-circle elevation-4" alt="{{ Auth::user()->foto }}">
         
        </div>
        <div class="info">
          <a href="{{ route('perfil.edit') }}" class="d-block">{{ Auth::user()->nombre1 }} {{ Auth::user()->apellido_paterno }} {{ Auth::user()->apellido_materno }}</a>
        </div>
        @endif
      </div>
      @if(Auth::user())
        @if(Auth::user()->perfil_actualizado)
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
            @can('empresas.index')    
                <li class="nav-item has-treeview menu-open">
                  <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Administración
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  
                  @can('empresas.index') 
                  <ul class="nav nav-treeview">
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-building"></i>
                          <p>
                            Organización
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                    @endcan
                    @can('empresas.index')
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('empresas.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Empresas</p>
                        </a>
                      </li>
                    @endcan
                    @can('departamentos.index')
                      <li class="nav-item">
                        <a href="{{ route('departamentos.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Departamentos</p>
                        </a>
                      </li>
                    @endcan
                            @can('cargos.index')
                            <li class="nav-item">
                              <a href="{{ route('cargos.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cargos</p>
                              </a>
                            </li>
                            @endcan
                      </ul>
                  


                  

                  @can('users.index')
                    <li class="nav-item">
                      <a href="{{ route('users.index') }}" class="nav-link ">
                        <i class="far fa-address-card nav-icon"></i>
                        <p>Personal</p>
                      </a>
                    </li>
                  @endcan 

                  @can('permissions.index')
                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Permisos</p>
                        </a>
                      </li>
                  @endcan 

                    @can('roles.index')
                      <li class="nav-item">
                          <a href="{{ route('roles.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Roles</p>
                          </a>
                      </li>
                    @endcan 
                    
            
              </ul>
            </li>
            @endcan 
            
            
            @can('puestos.index')
            <li class="nav-item">
              <a href="{{ route('puestos.index') }}" class="nav-link">
                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                <p>Asignacion Puesto</p>
              </a>
            </li>
            @endcan 
          <!--  @if(Auth::user()->can('empresas.index') || Auth::user()->can('departamentos.index') || Auth::user()->can('cargos.index'))
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>
                  Organización
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              
                @can('empresas.index')
                <li class="nav-item">
                  <a href="{{ route('empresas.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Empresas</p>
                  </a>
                </li>
                @endcan
                
                @can('departamentos.index')
                <li class="nav-item">
                  <a href="{{ route('departamentos.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Departamentos</p>
                  </a>
                </li>
                @endcan

                @can('cargos.index')
                <li class="nav-item">
                  <a href="{{ route('cargos.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cargos</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endif-->

            @can('clientes.index')
          <!-- <li class="nav-item">
              <a href="{{ route('clientes.index') }}" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>Campañas de clientes</p>
              </a>
            </li>-->
            @endcan

          <!--  @can('clientes.campanias')
            <li class="nav-item">
              <a href="{{ route('clientes.campanias') }}" class="nav-link">
                <i class="nav-icon fas fa-money-check"></i>
                <p>Clientes (SysCobranza)</p>
              </a>
            </li>
            @endcan-->

            @can('clientes.index')
            <li class="nav-item">
              <a href="{{ route('clientes.index') }}" class="nav-link">
                <i class="nav-icon fas fa-money-check"></i>
                <p>Clientes (SysCobranza)</p>
              </a>
            </li>
            @endcan

            
            @can('procesos.index')
            <li class="nav-item">
              <a href="{{ route('procesos.index') }}" class="nav-link">
                <i class="nav-icon fas fa-sync-alt"></i>
                <strong><p>PROCESOS</p></strong>
              </a>
            </li>
            @endcan
          
            @can('operaciones.index')
            <li class="nav-item">
              <a href="{{ route('operaciones.index') }}" class="nav-link">
                <i class="nav-icon far fa-list-alt"></i>
              <strong><p>OPERACIONES</p></strong> 
              </a>
            </li>
            @endcan

            @can('Asignaciones.index')
            <li class="nav-item">
              <a href="{{ route('Asignaciones.index') }}" class="nav-link">
                <i class="nav-icon far fa-list-alt"></i>
              <strong><p>ASIGNACION CLIENTES</p></strong> 
              </a>
            </li>
            @endcan


            @can('bandeja.index')
            <li class="nav-item">
                <a href="{{ route('bandeja.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BANDEJA</p>
                </a>
              </li>
          @endcan 

          @can('agenda.index')
          <li class="nav-item">
              <a href="{{ route('agenda.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>MI AGENDA</p>
              </a>
            </li>
        @endcan 

        @can('agendar.index')
        <li class="nav-item">
            <a href="{{ route('agendar.create') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>AGENDAR</p>
            </a>
          </li>
      @endcan 
          <!-- <li class="nav-item">
              <a href="pages/widgets.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Widgets
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Layout Options
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">6</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/layout/top-nav.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Top Navigation</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/boxed.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Boxed</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/fixed.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Fixed</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/fixed-topnav.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Fixed Navbar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/fixed-footer.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Fixed Footer</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Collapsed Sidebar</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Charts
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ChartJS</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/charts/flot.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Flot</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/charts/inline.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inline</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                  UI Elements
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/UI/general.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>General</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/UI/icons.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Icons</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/UI/buttons.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Buttons</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/UI/sliders.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sliders</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/UI/modals.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Modals & Alerts</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Forms
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/forms/general.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>General Elements</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/forms/advanced.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Advanced Elements</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/forms/editors.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Editors</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Tables
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/tables/simple.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Simple Tables</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/tables/data.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Tables</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">EXAMPLES</li>
            <li class="nav-item">
              <a href="pages/calendar.html" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Calendar
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  Mailbox
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/mailbox/mailbox.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inbox</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/mailbox/compose.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compose</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/mailbox/read-mail.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Read</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Pages
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/examples/invoice.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Invoice</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/profile.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/login.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Login</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/register.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Register</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/lockscreen.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lockscreen</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                  Extras
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/examples/404.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Error 404</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/500.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Error 500</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/blank.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Blank Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="starter.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Starter Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Legacy User Menu</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">MISCELLANEOUS</li>
            <li class="nav-item">
              <a href="https://adminlte.io/docs" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Documentation</p>
              </a>
            </li>
            <li class="nav-header">LABELS</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Important</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Warning</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Informational</p>
              </a>
            </li>-->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
        @endif
      @endif
    </div>
    <!-- /.sidebar -->
   
  </aside>
 