<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates._head')
</head>
<body>
  <div class="container-scroller">
    
    @include('templates._nav')

    <div class="container-fluid page-body-wrapper">
        
    @include('templates._sidebar')
     
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">

                @include('templates._topnav')

                <div class="tab-content tab-content-basic">
                    {{-- Content --}}
                    @yield('content')
                </div>
                
              </div>
            </div>
          </div>
        </div>
        
        @include('templates._footer')
        
      </div>
    </div>
  </div>

  @include('templates._script')

</body>

</html>

