@include('includes.header')
                <!-- Begin Page Content -->
                <div class="container-fluid">
 <div class="col-md-2">
    <button onclick="goBack()" class="btn btn-dark" style="font-size: 18px; padding: 10px 20px; border-radius: 8px;">
        ⬅ Back
    </button>
</div>
      <div class="container">
        <div class="card card-custom">
            <div class="card-header" style="background: #003366;">
                <i class="fas fa-wifi"></i> 5G Network Overview
            </div>
            <div class="card-body">
                <p><i class="fas fa-signal icons"></i> 5G networks are cellular networks, in which the service area is divided into small geographical areas called cells. All 5G wireless devices in a cell communicate by radio waves with a cellular base station via fixed antennas, over frequencies assigned by the base station. The base stations, termed nodes, are connected to switching centers in the telephone network and routers for Internet access by high-bandwidth optical fiber or wireless backhaul connections. As in other cellular networks, a mobile device moving from one cell to another is automatically handed off seamlessly.</p>

                <p><i class="fas fa-network-wired icons"></i> The industry consortium setting standards for 5G, the 3rd Generation Partnership Project (3GPP), defines "5G" as any system using 5G NR (5G New Radio) software — a definition that came into general use by late 2018. 5G continues to use OFDM encoding.</p>

                <p><i class="fas fa-broadcast-tower icons"></i> Several network operators use millimeter waves called FR2 in 5G terminology, for additional capacity and higher throughputs. Millimeter waves have a shorter range than the lower frequency microwaves, therefore the cells are of a smaller size. Millimeter waves also have more trouble passing through building walls and humans. Millimeter-wave antennas are smaller than the large antennas used in previous cellular networks.</p>

                <p><i class="fas fa-wind icons"></i> The increased data rate is achieved partly by using additional higher-frequency radio waves in addition to the low- and medium-band frequencies used in previous cellular networks. For providing a wide range of services, 5G networks can operate in three frequency bands — low, medium, and high.</p>

                <p><i class="fas fa-satellite icons"></i> 5G is capable of delivering significantly faster data rates than 4G, with peak data rates of up to 20 gigabits per second (Gbps). Furthermore, average 5G download speeds have been recorded at 186.3 Mbit/s in the U.S. by T-Mobile, while South Korea leads globally with average speeds of 432 megabits per second (Mbps).5G networks are also designed to provide significantly more capacity than 4G networks, with a projected 100-fold increase in network capacity and efficiency.</p>

            
           
            </div>
        </div>
    </div>
    
    
    
      <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
    p{
        color:black;
    }
        .card-custom {
            /*max-width: 700px;*/
            margin: 50px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        .card-header {
            
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body p {
            font-size: 14px;
            margin-bottom: 10px;
        }
        .icons {
            color: #003366;
            margin-right: 8px;
        }
    </style>

  
                      </div>
                  </div>

@include('includes.footer')

  <script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>