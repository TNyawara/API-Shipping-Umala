<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Quote') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="row">
                  <div class="col">
                    <form id="requestForm">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="consignment">Consignment</label>
                          <input type="text" class="form-control" name="consignment" id="consignment" placeholder="Goods Type...">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="weight">Weight (Kg)</label>
                          <input type="number" class="form-control" name="weight" id="weight" placeholder="Weight in Kgs...">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="origin">Origin</label>
                          <select name="origin" id="origin">
                            <option selected value="">Source of Consignment</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location->locations }}">{{ $location->locations }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="destination">Destination</label>
                          <select name="destination" id="destination">
                            <option selected value="">Destination of Consignment</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location->locations }}">{{ $location->locations }}</option>
                            @endforeach
                          </select>
                          <p id="help"></p>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="expected_date">Expected Date</label>
                          <input type="date" class="form-control" name="expected_date" id="expected_date">
                        </div>
                      </div>
                      <button type="submit"  class="btn btn-success">Request Delivery</button>
                    </form>
                  </div>
                  <div id="summary" class="col">
                    <h2>Quote Summary</h2>
                    <h5>Trip Distance: <i><span style="color:red;" id="tripDistance"></span></i> KMs</h5>
                    <h5>Price Per Km: <span> <b>{{ $pricePerKM }}</b> </span> KES/KM</h5>
                    <h5> <b>Total: <i><span style="color:green;" id="totalEstimate"></span></i> </b> </h5>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $("#destination").change(function(){
      var Origin = $( "#origin option:selected" ).text();
      var Destination = $( "#destination option:selected" ).text();
      tes =   $( "#destination option:selected" ).text();
      Destination = tes;
      if (Origin!=Destination && Origin!="" && Destination!="") {
        $("#help").text("");
        $("#summary").show();
        $.post(`/origin/${Origin}/destination/${Destination}`,
          {
            '_token':$('meta[name=csrf-token]').attr('content'),
            origin: Origin,
            destination: Destination
          },
          function(data){
            $("#tripDistance").text(data);
            var t = data * {{ $pricePerKM }};
            const formatter = new Intl.NumberFormat('en-US', {
                  style: 'currency',
                  currency: 'KES',
                  minimumFractionDigits: 2
                });
                $("#totalEstimate").text(formatter.format(t));
            //alert(data);
          });
      }else {
        alert('Can\'t be the Same Destination as Origin');
        $("#help").text("Destination can't be same as Origin");
      }
});
    $( document ).ready(function() {
      $("#summary").hide();
      $("#requestForm").submit( function (evt) {
        evt.preventDefault();
        var values = $("#requestForm").serializeArray();
        var tripDs = $("#tripDistance").text();
        var Tot = {{ $pricePerKM }} * tripDs;
        var csrss = values[0].value
        var con = values[1].value
        var wei = values[2].value
        var ori = values[3].value
        var dest = values[4].value
        var expect = values[5].value
        var myData =           {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    consignment: con,
                    weight: wei,
                    origin: ori,
                    destination: dest,
                    expected_date: expect,
                    user_id:{{ Auth::user()->id }},
                    price_per_km:{{ $pricePerKM }},
                    price: Tot,
                    travel_distance:tripDs
                  };
      alert(JSON.stringify(myData));

      $.ajax({
       url: "/orders",
       type:"POST",
       data:{
         _token: $('meta[name="csrf-token"]').attr('content'),
         consignment: con,
         weight: wei,
         origin: ori,
         destination: dest,
         expected_date: expect,
         user_id:{{ Auth::user()->id }},
         price_per_km:{{ $pricePerKM }},
         price: Tot,
         travel_distance:tripDs,
       },
       success:function(response){
         alert(JSON.stringify(response));
       },
      });
      });
    });
    </script>
</x-app-layout>
