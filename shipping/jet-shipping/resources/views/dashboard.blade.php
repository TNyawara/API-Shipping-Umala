<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                  Welcome {{ Auth::user()->name }}
                  <br>
                  <br>
                  <h5>Insert New Location</h5>
                  <section>
                    <form>
                      <div id="successLocation" class="">
                      </div>
                      <input type="text" id="inputLocation" name="inputLocation" placeholder="New Location">
                      <button class="btn btn-success" type="button" id="createLocation" name="createLocation">Create Location</button>
                    </form>
                  </section>
                  <hr>
                  <section>
                    <div id="successComplete" class="">
                    <table id="dtOngoingTbl" class="table ml-5 table-striped table-bordered table-sm" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th class="th-sm">#
                          </th>
                          <th class="th-sm">Consignment
                          </th>
                          <th class="th-sm">Origin
                          </th>
                          <th class="th-sm">Destination
                          </th>
                          <th class="th-sm">Weight
                          </th>
                          <th class="th-sm">Price
                          </th>
                          <th class="th-sm">Travel Distance
                          </th>
                          <th class="th-sm">Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $counter1 = 0; ?>
                        @foreach ($ongoingData as $l)
                        <?php $counter1 = $counter1 + 1; ?>
                        <tr>
                          <td>{{$counter1}}</td>
                          <td>{{$l->consignment}}</td>
                          <td>{{$l->origin}}</td>
                          <td>{{$l->destination}}</td>
                          <td>{{$l->weight}}</td>
                          <td>{{$l->price}}</td>
                          <td>{{$l->travel_distance}}</td>
                          <td> <button type="button" class="btn btn-success" onclick="completeOrder({{$l->id}});" name="button">Complete Order</button> </td>
                        </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>#
                          </th>
                          <th>Consignment
                          </th>
                          <th>Origin
                          </th>
                          <th>Destination
                          </th>
                          <th>Weight
                          </th>
                          <th>Price
                          </th>
                          <th>Travel Distance
                          </th>
                          <th>Actions
                          </th>
                        </tr>
                      </tfoot>
                    </table>
                  </section>
                  <script type="text/javascript">
                    function completeOrder(x){
                      $.ajax({
                       url: `/completeorder`,
                       type:"POST",
                       data:{
                         _token: $('meta[name="csrf-token"]').attr('content'),
                         complete: x,
                       },
                       success:function(response){
                         if (response=='success') {
                           $(`#successComplete`).addClass("alert alert-success");
                           $( `#successComplete` ).show();
                           document.getElementById(`successComplete`).innerHTML = "<strong>Success!</strong> Order has been Completed";
                         }
                       },
                      });
                    }
                    $('#createLocation').click(function() {
                      var loc = $('#inputLocation').val();
                      $.ajax({
                       url: `/createLocation/`,
                       type:"POST",
                       data:{
                         _token: $('meta[name="csrf-token"]').attr('content'),
                         location: loc,
                       },
                       success:function(response){
                         if (response=='success') {
                           $(`#successLocation`).addClass("alert alert-success");
                           $( `#successLocation` ).show();
                           document.getElementById(`successLocation`).innerHTML = "<strong>Success!</strong> Location has been updated";
                         }
                       },
                      });
                    });

                    $(document).ready(function () {
                    $('#dtOngoingTbl').DataTable();
                    $('.dataTables_length').addClass('bs-select');
                    });
                  </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
