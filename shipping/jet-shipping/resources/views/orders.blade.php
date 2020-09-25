<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>
    <style media="screen">
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
      bottom: .5em;
    }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="bs-example">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#pending" class="nav-link active" data-toggle="tab">Pending Payment</a>
                        </li>
                        <li class="nav-item">
                            <a href="#ongoing" class="nav-link" data-toggle="tab">Ongoing</a>
                        </li>
                        <li class="nav-item">
                            <a href="#completed" class="nav-link" data-toggle="tab">Completed</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pending">
                            <h4 class="mt-2">Pending Payment</h4>
                            <table id="dtPendingTable" class="table ml-5 table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
                                @foreach ($ordersx as $l)
                                <?php $counter1 = $counter1 + 1; ?>
                                <tr>
                                  <td>{{$counter1}}</td>
                                  <td>{{$l->consignment}}</td>
                                  <td>{{$l->origin}}</td>
                                  <td>{{$l->destination}}</td>
                                  <td>{{$l->weight}}</td>
                                  <td>{{$l->price}}</td>
                                  <td>{{$l->travel_distance}}</td>
                                  <td> <button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#myModal{{$l->id}}">Pay</button> </td>
                                </tr>
                                <div id="myModal{{$l->id}}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Order ID: {{$l->id}}</h4>
                                      </div>
                                      <div class="modal-body">
                                        <h6>Consignment: {{$l->consignment}}</h6>
                                        <h6>Origin: {{$l->origin}}</h6>
                                        <h6>Destination: {{$l->destination}}</h6>
                                        <h6> <b>Total: {{$l->price}} KES</b> </h6>
                                        <br>
                                        <label for="payMethod">Payment Method</label>
                                        <select class="" id="payMethod{{$l->id}}" name="payMethod{{$l->id}}">
                                          <option value="MPESA">MPESA</option>
                                          <option value="PAYPAL">PAYPAL</option>
                                        </select>
                                        <button onclick="completePay({{$l->id}})" type="button" class="btn btn-primary" id="payment{{$l->id}}" name="payment{{$l->id}}">Complete Payment</button>
                                        <br>
                                            <div id="successPay{{$l->id}}" class="">
                                            </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
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
                        </div>
                        <div class="tab-pane fade" id="ongoing">
                            <h4 class="mt-2">Ongoing Deliveries</h4>
                            <table id="dtOngoingTable" class="table ml-5 table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
                                  <th class="th-sm">Expected Date
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
                                  <td>{{$l->expected_date}}</td>
                                  <td> <button type="button" class="btn btn-danger" name="button">Help</button> </td>
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
                                  <th>Expected Date
                                  </th>
                                  <th>Actions
                                  </th>
                                </tr>
                              </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="completed">
                            <h4 class="mt-2">Completed Deliveries</h4>
                            <table id="dtCompletedTable" class="table ml-5 table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
                                  <th class="th-sm">Expected Date
                                  </th>
                                  <th class="th-sm">Payment
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $counter1 = 0; ?>
                                @foreach ($completedData as $l)
                                <?php $counter1 = $counter1 + 1; ?>
                                <tr>
                                  <td>{{$counter1}}</td>
                                  <td>{{$l->consignment}}</td>
                                  <td>{{$l->origin}}</td>
                                  <td>{{$l->destination}}</td>
                                  <td>{{$l->weight}}</td>
                                  <td>{{$l->price}}</td>
                                  <td>{{$l->travel_distance}}</td>
                                  <td>{{$l->expected_date}}</td>
                                  <td>{{$l->payment}}</td>
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
                                  <th>Expected Date
                                  </th>
                                  <th>Payment
                                  </th>
                                </tr>
                              </tfoot>
                            </table>
                        </div>
                    </div>
              </div>
              <script type="text/javascript">
              function completePay(x){
                $.ajax({
                 url: `/quotes/${x}`,
                 type:"PATCH",
                 data:{
                   _token: $('meta[name="csrf-token"]').attr('content'),
                   payment: $( `#payMethod${x} option:selected` ).text(),
                 },
                 success:function(response){
                   if (response=='success') {
                     $(`#successPay${x}`).addClass("alert alert-success");
                     $( `#successPay${x}` ).show();
                     document.getElementById(`successPay${x}`).innerHTML = "<strong>Success!</strong> Payment Complete";
                   }
                 },
                });
              }
              $(document).ready(function () {
              $('#dtPendingTable').DataTable();
              $('#dtOngoingTable').DataTable();
              $('#dtCompletedTable').DataTable();
              $('.dataTables_length').addClass('bs-select');
              });
              </script>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
