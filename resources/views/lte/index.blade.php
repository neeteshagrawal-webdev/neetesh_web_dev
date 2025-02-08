@include('includes.header')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                      <h1 class="h3 mb-0 text-gray-800">LTE</h1>
                      
                  </div>

                  <!-- Content Row -->
                  <div class="row">

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 20px;">
                                            Overview</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><a style="font-size: 16px;color:#4e73df;" href="{{route('lte.overview')}}" class=" font-weight-bold">
                                       Click Here <i class="fas fa-arrow-right"></i>
                                    </a></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-book-open fa-2x text-primary"></i>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    

                      <!-- Earnings (Monthly) Card Example -->
                      <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                              <div class="card-body">
                                  <div class="row no-gutters align-items-center">
                                      <div class="col mr-2">
                                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 20px;">
                                            Brochure</div>
                                          <div class="h5 mb-0 font-weight-bold text-gray-800"><a style="font-size: 16px;color:#1cc88a;" href="{{route('lte.brochure')}}" class=" font-weight-bold">
                                       Click Here <i class="fas fa-arrow-right"></i>
                                    </a></div>
                                      </div>
                                      <div class="col-auto">
                                          <i class="fas fa-file-alt fa-2x text-success"></i>
                                      </div>
                                  </div>
                                
                              </div>
                          </div>
                      </div>

                      <!-- Earnings (Monthly) Card Example -->
                      <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2"  style="border-left: .25rem solid #f39c12 !important;">
                              <div class="card-body">
                                  <div class="row no-gutters align-items-center">
                                      <div class="col mr-2">
                                          <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 20px;color:#f39c12;">Advisories 
                                          </div>
                                          <div class="row no-gutters align-items-center">
                                              <div class="col-auto">
                                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="font-size: 16px;color:#f39c12;" href="{{route('lte.advisories')}}" class=" font-weight-bold">
                                       Click Here <i class="fas fa-arrow-right"></i>
                                    </a></div>
                                              </div>
                                             
                                          </div>
                                      </div>
                                      <div class="col-auto">
                                          <i class="fas fa-university fa-2x text-info" style="color: #f39c12 !important;"></i>
                                      </div>
                                  </div>
                                 
                              </div>
                          </div>
                      </div>
                      <!-- Earnings (Monthly) Card Example -->
                      <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2" style="border-left: .25rem solid #dd4b39 !important;">
                              <div class="card-body">
                                  <div class="row no-gutters align-items-center">
                                      <div class="col mr-2">
                                          <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 20px;color:#dd4b39;">Multimedia 
                                          </div>
                                          <div class="row no-gutters align-items-center">
                                              <div class="col-auto">
                                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><a style="font-size: 16px;color:#dd4b39;" href="{{route('lte.multimedia')}}" class=" font-weight-bold">
                                       Click Here <i class="fas fa-arrow-right"></i>
                                    </a></div>
                                              </div>
                                             
                                          </div>
                                      </div>
                                      <div class="col-auto">
                                          <i class="fas fa-photo-video fa-2x text-info" style="color: #dd4b39 !important;"></i>
                                      </div>
                                  </div>
                                
                              </div>
                          </div>
                      </div>
                     
                    


                     
                  </div>

                  <!-- Content Row -->

                  


                      </div>
                  </div>
 @include('includes.footer')