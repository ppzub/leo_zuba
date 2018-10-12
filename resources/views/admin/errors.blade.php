@if ($errors->any())

               <div class="row" id="alert_box">
                 <div class="col s12 m12">
                   <div class="card red darken-1">
                     <div class="row">
                        <div class="col s12 m10">
                         <div class="card-content white-text">
                            @foreach ($errors->all() as $error)
                              <p>{{ $error }}</p>
                            @endforeach
                          </div>
                        </div>
                     <div class="col s12 m2">
                       <i class="icon_style material-icons" id="alert_close" aria-hidden="true">close</i>
                     </div>
                   </div>
                  </div>
                 </div>
               </div>

          @endif