<footer class="section footer-section">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-3 mb-5">
          <ul class="list-unstyled link">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Terms &amp; Conditions</a></li>
            <li><a href="#">Privacy Policy</a></li>
           <li><a href="#">Rooms</a></li>
          </ul>
        </div>
        <div class="col-md-3 mb-5">
          <ul class="list-unstyled link">
            <li><a href="#">The Rooms &amp; Suites</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Restaurant</a></li>
          </ul>
        </div>
        <div class="col-md-3 mb-5 pr-md-5 contact-info">
          <!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
          <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> Licab  Nueva Ecija, <br> Philippines</span></p>
          <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+63) 123 456 789</span></p>
          <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> info@domain.com</span></p>
        </div>
        <div class="col-md-3 mb-5">
          <p>Google map location:</p>
          <div id="map" style="height: 200px; width: 100%; margin-top: 10px; margin-bottom: 10px;"></div>
        </div>
      </div>
      <div class="row pt-5 text-center">
        <p class="col-md-6 text-left">

          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Hotel De Luna

        </p>

        <p class="col-md-6 text-right social">

          <a href="#"><span ><i class="fa-brands fa-facebook"></i></span></a>
          <a href="#"><span ><i class="fa-brands fa-instagram"></i></span></a>
          <a href="#"><span ><i class="fa-brands fa-x-twitter"></i></span></a>
          <a href="#"><span ><i class="fa-brands fa-youtube"></i></span></a>
        </p>
      </div>
    </div>

    <script>
        let map;
        let marker;

        function initMap() {
          const location = { lat: 15.5449, lng: 120.7689 };

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: location,
            });

            marker = new google.maps.Marker({
                position: location,
                map: map,
                title: "Hotel de Luna",
            });
        }
    </script>

  </footer>
